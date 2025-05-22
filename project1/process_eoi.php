<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('settings.php');

$conn = mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn){
    die("Unable to connect to the database: ".mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // form variables
    $reference = $_POST['reference-no'];
    $firstname = trim($_POST['first-name']);
    $lastname = trim($_POST['last-name']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = trim($_POST['address']);
    $suburb = trim($_POST['suburb']);
    $state = $_POST['state'];
    $postcode = trim($_POST['postcode']);
    $email = trim($_POST['email']);
    $number = trim($_POST['number']);
    $otherskills = trim($_POST['other-skills']);

    $new_eoi = "INSERT INTO EOI (JobReferenceNumber, FirstName, LastName, DateOfBirth, Gender, StreetAddress, Suburb, State, Postcode, EmailAddress, PhoneNumber, OtherSkills) 
    VALUES ('$reference', '$firstname', '$lastname', '$dob', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$number', '$otherskills')";

    if ($conn->query($new_eoi) === TRUE) {
        echo "New record created successfully";
        $last_id = $conn->insert_id;
    } else {
        echo "Error: " . $new_eoi . "<br>" . $conn->error;
    }

    // skills checkboxes variables

    if (isset($_POST['aws-azure'])) {
        $skills_1 = 1;
        $conn->query("INSERT INTO EoiSkills (EoiID, SkillID) VALUES ('$last_id', '$skills_1')");
    }

    if (isset($_POST['script-lang'])) {
        $skills_2 = 2;
        $conn->query("INSERT INTO EoiSkills (EoiID, SkillID) VALUES ('$last_id', '$skills_2')");
    }

    if (isset($_POST['sys-admin'])) {
        $skills_3 = 3;
        $conn->query("INSERT INTO EoiSkills (EoiID, SkillID) VALUES ('$last_id', '$skills_3')");
    }

    if (isset($_POST['automation'])) {
        $skills_4 = 4;
        $conn->query("INSERT INTO EoiSkills (EoiID, SkillID) VALUES ('$last_id', '$skills_4')");
    }

    if (isset($_POST['security'])) {
        $skills_5 = 5;
        $conn->query("INSERT INTO EoiSkills (EoiID, SkillID) VALUES ('$last_id', '$skills_5')");
    }
}

?>
