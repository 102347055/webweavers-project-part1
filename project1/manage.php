<?php
session_start();
require_once('settings.php');

$conn = mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn){
    die("Unable to connect to the database: ".mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Weavers manager page">
    <meta name="keywords" content="Manage, Jobs, Interest">
    <meta name="author" content="Rose Healy">
    <link rel="stylesheet" href="styles/styles.css">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Manager profile</title>
</head>
<body id="manage-body">
    <?php include 'header.inc'; ?>

    <h1 id="manage-h1">Manage</h1>
    <p>Welcome</p>
    <h2 id="manage-h2">View Expressions of Interest</h2>
    <form action="" method="post" id="eoi_search">
        <label for="list_all">
            List all EOIs
            <input type="radio" name="list_all" value="list_all" id="list_all">
        </label>
        <label for="list_by_ref">
            Search by job reference number:
            <select name="list_by_ref" id="list_by_ref">
                <option value=" ">Please Select</option>
                <option value="COS01">COS01</option>
                <option value="COS02">COS02</option>
            </select>
        </label>
        <fieldset>
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
        <label for="delete_by_ref">
            Delete all EOIs for job:
            <select name="delete_by_ref" id="delete_by_ref">
                <option value=" ">Please Select</option>
                <option value="COS01">COS01</option>
                <option value="COS02">COS02</option>
            </select>
        </label>
        <!-- add status change (once table appears?) -->
        <input type="submit" value="Enter">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // valuables from form input
        $list_all = $_POST['list_all'];
        $list_by_ref = $_POST['list_by_ref'];
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $delete_by_ref = $_POST['delete_by_ref'];
        
        // list all EOIs
        if ($list_all) {
            $query = "SELECT * FROM EOI";
            $result = mysqli_query($conn,$query);
            if($result) {
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
                echo "<th>Technical Skills</th>";
                echo "<th>Other Skills</th>";
                echo "<th>Status</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['EoiID'] . "</td>";
                    echo "<td>" . $row['JobReferenceNumber'] . "</td>";
                    echo "<td>" . $row['FirstName'] . "</td>";
                    echo "<td>" . $row['LastName'] . "</td>";
                    echo "<td>" . $row['DateOfBirth'] . "</td>";
                    echo "<td>" . $row['Gender'] . "</td>";
                    echo "<td>" . $row['StreetAddress'] . "</td>";
                    echo "<td>" . $row['Suburb'] . "</td>";
                    echo "<td>" . $row['State'] . "</td>";
                    echo "<td>" . $row['Postcode'] . "</td>";
                    echo "<td>" . $row['EmailAddress'] . "</td>";
                    echo "<td>" . $row['PhoneNumber'] . "</td>";
                    echo "<td>" . $row['TechnicalSkills'] . "</td>";
                    echo "<td>" . $row['OtherSkills'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } 
            else {
                echo "<p>No expressions of interest found.</p>";
            }
        }

        // list by job reference number

        // list by name

        // delete by reference number
    } else {
        echo "<p>Unable to load form.<p>";
    }
    ?>

    <?php include 'footer.inc'; ?>
</body>
</html>