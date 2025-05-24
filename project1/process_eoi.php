<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('settings.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // create eoi table if it doesn't exist
    $conn->query("CREATE TABLE IF NOT EXISTS `EOI` (
        `EoiID` smallint(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `JobReferenceNumber` varchar(20) NOT NULL,
        `FirstName` varchar(20) NOT NULL,
        `LastName` varchar(20) NOT NULL,
        `DateOfBirth` date NOT NULL,
        `Gender` enum('Female','Male','Other') NOT NULL,
        `StreetAddress` varchar(40) NOT NULL,
        `Suburb` varchar(40) NOT NULL,
        `State` enum('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
        `Postcode` varchar(10) NOT NULL,
        `EmailAddress` varchar(100) NOT NULL UNIQUE,
        `PhoneNumber` varchar(20) NOT NULL UNIQUE,
        `OtherSkills` text,
        `Status` enum('New','Current','Final') NOT NULL DEFAULT 'New',
        FOREIGN KEY (`JobReferenceNumber`) REFERENCES `Jobs` (`JobReferenceNumber`) ON DELETE CASCADE
      ) ENGINE=InnoDB");

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
        $last_id = $conn->insert_id;    // get newly created ID to use for skills table input

        // create skills table if it doesn't exist
        $conn->query("CREATE TABLE IF NOT EXISTS `EoiSkills` (
            `EoiID` smallint(6) NOT NULL,
            `SkillID` smallint(6) NOT NULL,
            PRIMARY KEY (`EoiID`, `SkillID`),
            FOREIGN KEY (`EoiID`) REFERENCES `EOI` (`EoiID`) ON DELETE CASCADE,
            FOREIGN KEY (`SkillID`) REFERENCES `Skills` (`SkillID`) ON DELETE CASCADE
          ) ENGINE=InnoDB");

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

        // create session variables to pass to confirmation page
        $_SESSION['reference'] = $reference;
        $_SESSION['last_id'] = $last_id;
        
        // divert user to confirmation page
        header("Location: confirmation.php");
        exit();

    } else {
        echo "Error: " . $new_eoi . "<br>" . $conn->error;
    }
} else {
    // redirects to apply page if page is accessed directly
    header("Location: apply.php");
        exit();
}
?>
