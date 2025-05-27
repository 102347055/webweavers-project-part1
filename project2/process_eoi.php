<?php
session_start();
require_once('settings.php');

// validate date function copied from https://www.codexworld.com/how-to/validate-date-input-string-in-php/
function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

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
    if (isset($_POST['reference-no'])) {
        $reference = $_POST['reference-no'];
    }
    if (isset($_POST['first-name'])) {
        $firstname = $_POST['first-name'];
    }
    if (isset($_POST['last-name'])) {
        $lastname = $_POST['last-name'];
    }
    if (isset($_POST['dob'])) {
        $dob = $_POST['dob'];
    }
    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    }
    if (isset($_POST['address'])) {
        $address = $_POST['address'];
    }
    if (isset($_POST['suburb'])) {
        $suburb = $_POST['suburb'];
    }
    if (isset($_POST['state'])) {
        $state = $_POST['state'];
    }
    if (isset($_POST['postcode'])) {
        $postcode = $_POST['postcode'];
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['number'])) {
        $number = $_POST['number'];
    }
    if (isset($_POST['other-skills-check'])) {
        $otherskills_check = $_POST['other-skills-check'];
    }
    if (isset($_POST['other-skills'])) {
        $otherskills = $_POST['other-skills'];
    }

    // validate input data and set error message if required
    $errMsg = "";
    if ($reference == "") {
        $errMsg .= "<p>Please select a job reference number.</p>";
    }

    if ($firstname == "") {
        $errMsg .= "<p>Please enter your first name.</p>";
    }
    elseif (!preg_match("/^([a-zA-Z]){1,20}$/", $firstname)) {
        $errMsg .= "<p>Maximum of 20 alpha characters allowed in your first name. Please check and enter again.</p>";
    }

    if ($lastname == "") {
        $errMsg .= "<p>Please enter your last name.</p>";
    }    
    elseif (!preg_match("/^([a-zA-Z'-]){1,20}$/", $lastname)) {
        $errMsg .= "<p>Only a maximum of 20 alpha characters, hyphens and dashes allowed in your last name. Please check and enter again.</p>";
    }

    if ($dob == "") {
        $errMsg .= "<p>Please enter your date of birth.</p>";
    }
    elseif (!validateDate($dob)) {
        $errMsg .= "<p>Please enter a valid date of birth.</p>";
    }

    if ($gender == "") {
        $errMsg .= "<p>Please select your gender.</p>";
    }

    if ($address == "") {
        $errMsg .= "<p>Please enter your address.</p>";
    }
    elseif (!preg_match("/^([a-zA-Z0-9 ]){0,40}$/", $address)) {
        $errMsg .= "<p>Maximum of 40 characters allowed in your address. Please check and enter again.</p>";
    }

    if ($suburb == "") {
        $errMsg .= "<p>Please enter your suburb.</p>";
    }
    elseif (!preg_match("/^([a-zA-Z0-9 ]){0,40}$/", $suburb)) {
        $errMsg .= "<p>Maximum of 40 characters allowed in your suburb. Please check and enter again.</p>";
    }

    if ($state == "") {
        $errMsg .= "<p>Please enter your state.</p>";
    }

    if ($postcode == "") {
        $errMsg .= "<p>Please enter your postcode.</p>";
    }
    elseif (!preg_match("/^(020[0-9]|02[1-9][0-9]|0[3-9][0-9]{2}|[1-8][0-9]{3}|9[0-8][0-9]{2}|99[0-3][0-9]|994[0-4])$/", $postcode)) { // regex checks for valid australian postcode range
        $errMsg .= "<p>Please enter a valid postcode.</p>";
    }

    if ($email == "") {
        $errMsg .= "<p>Please enter your email address.</p>";
    }
    elseif (!preg_match("/^[A-Za-z\d]+@[A-Za-z\d]+\.[A-Za-z]{1,3}$/", $email)) {
        $errMsg .= "<p>Please enter a valid email address.</p>";
    }

    if ($number == "") {
        $errMsg .= "<p>Please enter your phone number.</p>";
    }
    elseif (!preg_match("/^[\d\s]{8,12}$/", $number)) {
        $errMsg .= "<p>Please enter a valid phone number between 8 and 12 characters.</p>";
    }

    if ($otherskills_check && $otherskills == "") {
        $errMsg .= "<p>Please describe your skills.</p>";
    }

    // direct to error page if there are any errors
    if ($errMsg != "") {
        $_SESSION['errMsg'] = $errMsg;
        header("Location: error.php");
        exit();
    }
    else {
        $new_eoi = "INSERT INTO EOI (JobReferenceNumber, FirstName, LastName, DateOfBirth, Gender, StreetAddress, Suburb, State, Postcode, EmailAddress, PhoneNumber, OtherSkills) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($new_eoi);
        $stmt->bind_param("ssssssssssss", $reference, $firstname, $lastname, $dob, $gender, $address, $suburb, $state, $postcode, $email, $number, $otherskills);
        $exec = $stmt->execute();

        if ($exec) {
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
                $query = "INSERT INTO EoiSkills (EoiID, SkillID) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ii", $last_id, $skills_1);
                $stmt->execute();
            }
            if (isset($_POST['script-lang'])) {
                $skills_2 = 2;
                $query = "INSERT INTO EoiSkills (EoiID, SkillID) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ii", $last_id, $skills_2);
                $stmt->execute();
            }
            if (isset($_POST['sys-admin'])) {
                $skills_3 = 3;
                $query = "INSERT INTO EoiSkills (EoiID, SkillID) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ii", $last_id, $skills_3);
                $stmt->execute();
            }
            if (isset($_POST['automation'])) {
                $skills_4 = 4;
                $query = "INSERT INTO EoiSkills (EoiID, SkillID) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ii", $last_id, $skills_4);
                $stmt->execute();
            }
            if (isset($_POST['security'])) {
                $skills_5 = 5;
                $query = "INSERT INTO EoiSkills (EoiID, SkillID) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ii", $last_id, $skills_5);
                $stmt->execute();
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
    }
} else {
    // redirects to apply page if page is accessed directly
    header("Location: apply.php");
        exit();
}
?>
