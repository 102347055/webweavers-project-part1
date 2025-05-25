<?php
session_start();
require_once('settings.php');
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
<body>
    <?php include 'header.inc'; ?>
    <div id="manage-body">
        <h1 id="manage-h1">Manage</h1>
        <p>Welcome</p>
        <h2 id="manage-h2">View Expressions of Interest</h2>
        <form method="post" id="eoi_search" class="ww-form">
            <label for="list_all">
                List all EOIs
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
            <label for="sort">
                Sort by:
                <select name="sort" id="sort">
                    <option value="">Please Select</option>
                    <option value="EoiID">ID</option>
                    <option value="JobReferenceNumber">Job Reference</option>
                    <option value="FirstName">First Name</option>
                    <option value="LastName">Last Name</option>
                    <option value="Status">Status</option>
                </select>
            </label>
            <label for="delete_by_ref">
                Delete all EOIs for job:
                <select name="delete_by_ref" id="delete_by_ref">
                    <option value=" ">Please Select</option>
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
            $list_all = sanitise_input($_POST['list_all']);
            $list_by_ref = sanitise_input($_POST['list_by_ref']);
            $firstname = sanitise_input($_POST['firstname']);
            $lastname = sanitise_input($_POST['lastname']);
            $sort = sanitise_input($_POST['sort']);
            $delete_by_ref = sanitise_input($_POST['delete_by_ref']);
            $eoi_num = sanitise_input($_POST['eoi-num']);
            $status = sanitise_input($_POST['status']);

            // list all EOIs
            if ($list_all) {
                $query = "SELECT * FROM EOI";
            }

            // list by job reference number
            if ($list_by_ref) {
                $query = "SELECT * FROM EOI WHERE JobReferenceNumber = '$list_by_ref'";
            }

            // list by name
            // first name
            if ($firstname) {
                $query = "SELECT * FROM EOI WHERE FirstName = '$firstname'";
            }

            // last name
            if ($lastname) {
                $query = "SELECT * FROM EOI WHERE LastName = '$lastname'";
            }

            // full name
            if ($firstname and $lastname) {
                $query = "SELECT * FROM EOI WHERE FirstName = '$firstname' AND LastName = '$lastname'";
            }

            // sort by
            if ($sort != "") {
                $query = "$query ORDER BY $sort";
            }

            // delete by reference number
            if ($delete_by_ref) {
                $query = "DELETE FROM EOI WHERE JobReferenceNumber = '$delete_by_ref'";
                if ($conn->query($query) === TRUE) {
                    echo "Deletion of EOIs was successful";
                  } else {
                    echo "Error deleting: " . $conn->error;
                }
            }

            // change status
            if ($eoi_num && $status) {
                $query = "UPDATE EOI SET Status='$status' WHERE EoiID='$eoi_num'";
                if ($conn->query($query) === TRUE) {
                    echo "EOI status successfully updated";
                  } else {
                    echo "Error updating record: " . $conn->error;
                }
            }

            $result = mysqli_query($conn,$query);

            if($result && (mysqli_num_rows($result) > 0)) {
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
                echo "<th>Other Skills</th>";
                echo "<th>Status</th>";
                echo "<th>Edit Status</th>";
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
                    echo "<td>" . $row['OtherSkills'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    // form for updating status on table column - select and button
                    echo "<td>";
                    echo "<form method='post' class='status-form'>";
                    echo "<input type='hidden' name='eoi-num' value='" . $row['EoiID'] . "'>";
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