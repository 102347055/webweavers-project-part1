<?php
session_start();
require_once('settings.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // form variables
    $reference = sanitise_input($_POST['reference-no']);
    $firstname = sanitise_input($_POST['first-name']);
    $lastname = sanitise_input($_POST['last-name']);
    $dob = sanitise_input($_POST['dob']);
    $gender = sanitise_input($_POST['gender']);
    $address = sanitise_input($_POST['address']);
    $suburb = sanitise_input($_POST['suburb']);
    $state = sanitise_input($_POST['state']);
    $postcode = sanitise_input($_POST['postcode']);
    $email = sanitise_input($_POST['email']);
    $number = sanitise_input($_POST['number']);
    $otherskills = sanitise_input($_POST['other-skills']);

    $new_eoi = "INSERT INTO EOI (JobReferenceNumber, FirstName, LastName, DateOfBirth, Gender, StreetAddress, Suburb, State, Postcode, EmailAddress, PhoneNumber, OtherSkills) 
    VALUES ('$reference', '$firstname', '$lastname', '$dob', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$number', '$otherskills')";

    if ($conn->query($new_eoi) === TRUE) {
        echo "New record created successfully";
        $last_id = $conn->insert_id;    // get newly created ID to use for skills table input
    } else {
        echo "Error: " . $new_eoi . "<br>" . $conn->error;
    }

    // skills checkboxes variables - insert into skills table

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
