<?php
session_start();
require_once("settings.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Current Job Openings at Web Weavers, sign up and become apart of our diverse and exceptional team.">
    <meta name="keywords" content="Cloud Engineer, Cloud Systems Administrator, Work from home, Hybrid work, Microsoft Azure, AWS, level 2 administrator, Web, Weavers, Technology, Cloud, Jobs, Innovative">
    <meta name="author" content="Web Weavers">
    <title>Current Job Openings - Web Weavers</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>

<body id="jobs_body">
<main>

    <?php include 'header.inc'; ?>

    <div id="job_heading_links">
        <h1 class="job_heading1">Position Vacancies</h1> 
        <ol id="job_nav">
            <?php
            $nav_query = "SELECT PositionTitle FROM Jobs";
            $nav_result = $conn->query($nav_query);

            if ($nav_result->num_rows > 0) {
                while ($nav_row = $nav_result->fetch_assoc()) {
                    $id = strtolower(str_replace(' ', '_', $nav_row['PositionTitle']));
                    echo "<li><a href=\"#$id\" class=\"button apply_link\">{$nav_row['PositionTitle']}</a></li>";
                }
            }
            ?>
            <li><a href="#why_sign_up" class="button apply_link">Sign up Perks</a></li>
        </ol>
    </div>

    <?php
    // Main job listings
    $sql = "SELECT * FROM Jobs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $jobID = $row['JobsID'];

            echo "<section id=\"" . strtolower(str_replace(' ', '_', $row['PositionTitle'])) . "\">";
            echo "<h2 class='job_heading2'>" . htmlspecialchars($row['PositionTitle']) . "</h2>";
            echo "<article>";
            echo "<div class='job_descriptions'>";
            echo "<p><strong>Reference No:</strong> " . htmlspecialchars($row['JobReferenceNumber']) . "</p>";
            echo "<p><strong>Position Title:</strong> " . htmlspecialchars($row['PositionTitle']) . "</p>";
            echo "<p><strong>The Role:</strong> " . htmlspecialchars($row['Role']) . "</p>";
            echo "<p><strong>Salary Range:</strong> " . htmlspecialchars($row['SalaryRange']) . "</p>";
            echo "<p><strong>Reports To:</strong> " . htmlspecialchars($row['ReportsTo']) . "</p>";
            echo "</div>";

            // Relevance aside
            echo "<aside class='position_aside' aria-label='" . htmlspecialchars($row['RelevanceHeading']) . "'>";
            echo "<h3 class='job_heading4'>" . htmlspecialchars($row['RelevanceHeading']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['RelevanceDescription']) . "</p>";
            echo "</aside>";

            // Responsibilities
            $responsibility_query = "SELECT Responsibility FROM Responsibilities WHERE JobsID = $jobID";
            $responsibility_result = $conn->query($responsibility_query);
            if ($responsibility_result->num_rows > 0) {
                echo "<div class='key_responsibilities'>";
                echo "<h3 class='job_heading3'>Key Responsibilities</h3><ul>";
                
                while ($responsibility_row = $responsibility_result->fetch_assoc()) {
                    echo "<li>" . htmlspecialchars($responsibility_row['Responsibility']) . "</li>";
                }
                echo "</ul></div>";
            }

            // Qualifications
            $essential_query = "SELECT Qualification FROM Qualifications WHERE JobsID = $jobID AND ColumnType = 'Essential'";
            $preferable_query = "SELECT Qualification FROM Qualifications WHERE JobsID = $jobID AND ColumnType = 'Preferable'";
            $essential_result = $conn->query($essential_query);
            $preferable_result = $conn->query($preferable_query);

            if ($essential_result->num_rows > 0 || $preferable_result->num_rows > 0) {
                echo "<h3 class='qualifications_heading'>Required Qualifications & Skills</h3>";
                echo "<div class='qualifications_container'>";

                // Essential
                echo "<div class='essential_div'>";
                echo "<h4 class='job_heading4'>Essential</h4><ul>";
                if ($essential_result->num_rows > 0) {
                    while ($essential_row = $essential_result->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($essential_row['Qualification']) . "</li>";
                    }
                } else {
                    echo "<li>No essential qualifications listed.</li>";
                }
                echo "</ul></div>";

                // Preferable
                echo "<div class='preferable_div'>";
                echo "<h4 class='job_heading4'>Preferable</h4><ul>";
                if ($preferable_result->num_rows > 0) {
                    while ($preferable_row = $preferable_result->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($preferable_row['Qualification']) . "</li>";
                    }
                } else {
                    echo "<li>No preferable qualifications listed.</li>";
                }
                echo "</ul></div>";

                echo "</div>"; // Close qualifications_container
            }

            // Apply now button
            echo "<div class='apply_now'>";
            echo "<a href='" . htmlspecialchars($row['ApplyHyperLink']) . "' class='button apply_link'>Apply Now</a>";
            echo "</div>";
            echo "</article>";
            echo "</section>";
        }
    } else {
        echo "<p>No job listings available at this time.</p>";
    }
    ?>

    <article id="why_sign_up">
        <h2 class="job_heading2">Why Sign Up?</h2>
        <ol>
            <?php
            // Perks
            $perk_query = "SELECT Reasons FROM Perks ORDER BY PerkID";
            $perk_result = $conn->query($perk_query);

            if ($perk_result->num_rows > 0) {
                while ($perk_row = $perk_result->fetch_assoc()) {
                    echo "<li>" . htmlspecialchars($perk_row['Reasons']) . "</li>";
                }
            } else {
                echo "<li>There are no perks currently available.</li>";
            }
            ?>
        </ol>
    </article>

</main>
<hr>
<?php include 'footer.inc'; ?>
<?php $conn->close(); ?>
</body>
</html>