<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Job Openings - Cloud Engineer & Cloud Systems Administrator at Web Weavers">
    <meta name="keywords" content="Cloud Engineer, Cloud Systems Administrator, Work from home, Hybrid work, Microsoft Azure, AWS, level 2 administrator, Web, Weavers, Technology, Cloud, Jobs, Innovative">
    <meta name="author" content="Web Weavers">
    <title>Current Job Openings - Web Weavers</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body id="jobs_body">
    <main>
        <?php include 'header.inc'; ?>

        <div id="job_heading_links">
            <h1 class="job_heading1">Position Vacancies</h1> 
            <ol id="job_nav">
                <li><a href="#cloud_engineer" class="button apply_link">Cloud Engineer</a></li>
                <li><a href="#cloud_systems_administrator" class="button apply_link">Cloud Systems Administrator</a></li>
                <li><a href="#why_sign_up" class="button apply_link">Sign up Perks</a></li>
            </ol>
        </div>
        

        <?php
        start_session()
        require_once('settings.php');
        $conn = mysqli_connect($host, $user, $pwd, $sql_db);

        if (!$conn){
            die("Unable to connect to the database: ".mysqli_connect_error());
        }
        
        // Select all records from jobs tbale 
        $sql = "SELECT * FROM Jobs";
        $result = $conn->query($sql);
      
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { //A loop that iterates over each row in the result as an associative array
                echo "<section id=\"" . strtolower(str_replace(' ', '_', $row['PositionTitle'])) . "\">";
                echo "<h2 class='job_heading2'>" . htmlspecialchars($row['PositionTitle']) . "</h2>";
                echo "<article>"; //Creates block for jobs information
                echo "<div class='job_descriptions'>";
                echo "<p><strong>Reference No:</strong> " . htmlspecialchars($row['JobReferenceNumber']) . "</p>";
                echo "<p><strong>Position Title:</strong> " . htmlspecialchars($row['PositionTitle']) . "</p>";
                echo "<p><strong>The Role:</strong> " . htmlspecialchars($row['Role']) . "</p>";
                echo "<p><strong>Salary Range:</strong> " . htmlspecialchars($row['SalaryRange']) . "</p>";
                echo "<p><strong>Reports To:</strong> " . htmlspecialchars($row['ReportsTo']) . "</p>";
                echo "</div>";
            
                echo "<aside class='position_aside' aria-label='" . htmlspecialchars($row['RelevanceHeading']) . "'>";
                echo "<h3 class='job_heading4'>" . htmlspecialchars($row['RelevanceHeading']) . "</h3>";
                echo "<p>" . htmlspecialchars($row['RelevanceDescription']) . "</p>";
                echo "</aside>";
            
                echo "<div class='apply_now'>"; //Add apply now button
                echo "<a href='" . htmlspecialchars($row['ApplyHyperLink']) . "' class='button apply_link'>Apply Now</a>";
                echo "</div>";
                echo "</article>";
                echo "</section>";
            }
        } else {
            echo "<p>No job listings available at this time.</p>"; //error message 
        }

        $conn->close();
        ?>
        
        <article id="why_sign_up">
            <h2 class="job_heading2">Why Sign Up?</h2>
            <ol>
                <li>Flexible working arrangements, with the option to work from home three days a week.</li>
                <li>A home office setup allowance.</li>
                <li>An additional two weeks of annual leave.</li>
                <li>Health &amp; wellbeing benefits including discounts on gym memberships.</li>
            </ol>
        </article>
    </main>

    <hr>
    <?php include 'footer.inc'; ?>
</body>
</html>
