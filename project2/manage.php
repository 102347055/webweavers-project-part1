<?php
session_start();
// redirect to login page if user not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// redirect to home if not a manager
if (!isset($_SESSION['manager'])) {
    header("Location: index.php");
    exit();
}
require_once('settings.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Manage expressions of interest from job applicants at Web Weavers.">
    <meta name="keywords" content="Manage, Jobs, Interest, Web Weavers, Employee">
    <meta name="author" content="Rose Healy">
    <link rel="stylesheet" href="styles/styles.css">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Manager profile</title>
</head>
<body>
    <?php include 'header.inc'; ?>
    <div class="php-body">
        <h1 class="php-heading">Manage applications</h1>
        <?php echo"<p>Welcome, ". htmlspecialchars($_SESSION['username']) ."!</p>" ?>
        <h2 id="manage-h2">View Expressions of Interest</h2>
        <form method="post" id="eoi-search" class="ww-form">
            <label for="list_all" id="list_label">
                List all EOIs:
                <input type="radio" name="list_all" value="list_all" id="list_all">
            </label>
            <label for="list_by_ref">
                Search by job reference number:
                <select name="list_by_ref" id="list_by_ref">
                    <option value="">Please Select</option>
                    <option value="COS01">COS01</option>
                    <option value="COS02">COS02</option>
                </select>
            </label>
            <fieldset id="applicant-field" class="form-fieldset">
                <legend>Search by applicant</legend>
                <label for="firstname">
                    First Name:
                    <input type="text" name="firstname" id="firstname">
                </label>
                <label for="lastname">
                    Last Name:
                    <input type="text" name="lastname" id="lastname">
                </label>
            </fieldset>
            <label for="sort">
                Sort by:
                <select name="sort" id="sort">
                    <option value="">Please Select</option>
                    <option value="EoiID">ID (Default)</option>
                    <option value="JobReferenceNumber">Job Reference</option>
                    <option value="FirstName">First Name</option>
                    <option value="LastName">Last Name</option>
                    <option value="Status">Status</option>
                </select>
            </label>
            <label for="delete_by_ref">
                Delete all EOIs for job:
                <select name="delete_by_ref" id="delete_by_ref">
                    <option value="">Please Select</option>
                    <option value="COS01">COS01</option>
                    <option value="COS02">COS02</option>
                </select>
            </label>
            <input type="submit" value="Enter" class="button">
        </form>
        <div id="eoi-table-container">
    
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // variables from form input
            if (isset($_POST['list_all'])) {
                $list_all = $_POST['list_all'];
            }
            if (isset($_POST['list_be_ref'])) {
                $list_by_ref = $_POST['list_by_ref'];
            }
            if (isset($_POST['firstname'])) {
                $firstname = $_POST['firstname'];
            }
            if (isset($_POST['lastname'])) {
                $lastname = $_POST['lastname'];
            }
            if (isset($_POST['sort'])) {
                $sort = $_POST['sort'];
            }
            if (isset($_POST['delete_by_ref'])) {
                $delete_by_ref = $_POST['delete_by_ref'];
            }
            if (isset($_POST['eoi_num'])) {
                $eoi_num = $_POST['eoi_num'];
            }
            if (isset($_POST['status'])) {
                $status = $_POST['status'];
            }

            // build queries using prepared statements
            // list all EOIs
            if ($list_all) {
                $query = "SELECT * FROM EOI";
                $stmt = $conn->prepare($query);
            }

            // list by job reference number
            if ($list_by_ref) {
                $query = "SELECT * FROM EOI WHERE JobReferenceNumber = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $list_by_ref);
            }

            // list by name
            // first name
            if ($firstname) {
                $query = "SELECT * FROM EOI WHERE FirstName = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $firstname);
            }

            // last name
            if ($lastname) {
                $query = "SELECT * FROM EOI WHERE LastName = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $lastname);
            }

            // full name
            if ($firstname && $lastname) {
                $query = "SELECT * FROM EOI WHERE FirstName = ? AND LastName = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $firstname, $lastname);
            }

            // sort by
            if ($sort != "") {
                $query = "$query ORDER BY ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $sort);
            }

            // delete by reference number
            if ($delete_by_ref) {
                $delete_query = "DELETE FROM EOI WHERE JobReferenceNumber = ?";
                $delete_stmt = $conn->prepare($delete_query);
                $delete_stmt->bind_param("s", $delete_by_ref);
                if ($delete_stmt->execute() === TRUE) {
                    echo "Deletion of EOIs was successful";
                  } else {
                    echo "There was an error deleting EOIs";
                }
            }

            // change status
            if ($eoi_num && $status) {
                $eoi_query = "UPDATE EOI SET Status = ? WHERE EoiID = ?";
                $status_stmt = $conn->prepare($eoi_query);
                $status_stmt->bind_param("si", $status, $eoi_num);
                if ($status_stmt->execute() === TRUE) {
                    echo "EOI status successfully updated";
                  } else {
                    echo "Error updating EOI";
                }
            }

            $exec = $stmt->execute();
            $result = $stmt->get_result();

            // display EOI table
            if($result && $result->num_rows > 0) {
                echo "<table id='eoi-table'>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Job Reference Number</th>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>DOB</th>";
                echo "<th>Gender</th>";
                echo "<th>Street Address</th>";
                echo "<th>Suburb</th>";
                echo "<th>State</th>";
                echo "<th>Postcode</th>";
                echo "<th>Email Address</th>";
                echo "<th>Phone Number</th>";
                echo "<th>Required Skills</th>";
                echo "<th>Other Skills</th>";
                echo "<th>Status</th>";
                echo "<th>Edit Status</th>";
                echo "</tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['EoiID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['JobReferenceNumber']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['DateOfBirth']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Gender']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['StreetAddress']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Suburb']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['State']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Postcode']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['EmailAddress']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['PhoneNumber']) . "</td>";

                    // link to skills table
                    $skills_query = "SELECT Skills.SkillType FROM EOI JOIN EoiSkills ON EOI.EoiID = EoiSkills.EoiID JOIN Skills 
                    ON EoiSkills.SkillID = Skills.SkillID WHERE EOI.EoiID = ?";
                    $skills_stmt = $conn->prepare($skills_query);
                    $skills_stmt->bind_param("i", $row['EoiID']);
                    $skills_stmt->execute();
                    $skills_result = $skills_stmt->get_result();

                    // list required skills in one cell
                    echo "<td><ul>";
                    while ($skills_row = $skills_result->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($skills_row['SkillType']) . "</li>";
                    }
                    echo "</ul></td>";
                    
                    echo "<td>" . htmlspecialchars($row['OtherSkills']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Status']) . "</td>";
                    // form for updating status on table column - select and button
                    echo "<td>";
                    echo "<form method='post' class='status-form'>";
                    echo "<input type='hidden' name='eoi_num' value='" . htmlspecialchars($row['EoiID']) . "'>";
                    echo "<select name='status' class='status-select' required>
                            <option value=''>Select</option>
                            <option value='New'>New</option>
                            <option value='Current'>Current</option>
                            <option value='Final'>Final</option>
                          </select>";
                    echo "<input type='submit' value='Update Status' class='status-button'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } 
            else {
                echo "<p>No expressions of interest found.</p>";
            }
        }
        ?>

        </div>
    </div>
    <hr>
    <?php include 'footer.inc'; ?>
</body>
</html>