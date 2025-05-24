<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Job Application Form">
    <meta name="keywords" content="Job, Application, Form">
    <meta name="author" content="Rose Healy">
    <link rel="stylesheet" href="styles/styles.css">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Apply</title>
</head>
<body id="apply-body">
    <?php include 'header.inc'; ?>
    
    <h1 id="apply-heading">Apply for a position</h1>
    <form method="post" action="process_eoi.php" class="ww-form" novalidate>     <!--Job application form-->
        <label for="reference-no" class="apply-input">Job Reference Number:
            <select name="reference-no" id="reference-no">      <!--Reference number dropdown selector-->
                <option value=" ">Please Select</option>
                <option value="COS01">COS01</option>
                <option value="COS02">COS02</option>
            </select>
        </label>
        <fieldset>
            <legend>Personal Information</legend>
            <label for="first-name">First Name:
                <input type="text" name="first-name" id="first-name" maxlength="20" pattern="[A-Za-z]+" required>   <!--Maxiumum of 20 alpha characters-->
            </label>
            <label for="last-name">Last Name:
                <input type="text" name="last-name" id="last-name" maxlength="20" pattern="[A-Za-z]+" required>
            </label>
            <label for="dob">Date of Birth:
                <input type="date" name="dob" id="dob" required>
            </label>
            <fieldset id="gender-field">
                <legend>Gender:</legend>     <!--Gender radio buttons in fieldset-->
                <label for="female">
                    <input type="radio" name="gender" id="female" value="female" required>
                    Female
                </label>
                <label for="male">
                    <input type="radio" name="gender" id="male" value="male">
                    Male
                </label>
                <label for="other">
                    <input type="radio" name="gender" id="other" value="other">
                    Other/Unspecified
                </label>
            </fieldset>
        </fieldset>
        <fieldset>
            <legend>Address</legend>    <!--Address details-->
            <label for="address">Street Address:
                <input type="text" name="address" id="address" maxlength="40" required>     <!---Address limits of 40 characters achieved with maxlength attribute-->
            </label>
            <label for="suburb">Suburb:
                <input type="text" name="suburb" id="suburb" maxlength="40" required>
            </label>
            <label for="state">State:
                <select name="state" id="state">    <!--State dropdown selector-->
                    <option value=" ">Please Select</option>
                    <option value="vic">VIC</option>
                    <option value="nsw">NSW</option>
                    <option value="qld">QLD</option>
                    <option value="nt">NT</option>
                    <option value="wa">WA</option>
                    <option value="sa">SA</option>
                    <option value="tas">TAS</option>
                    <option value="act">ACT</option>
                </select>
            </label>
            <label for="postcode">Postcode:
                <input type="text" name="postcode" id="postcode" maxlength="4" pattern="(020[0-9]|02[1-9][0-9]|0[3-9][0-9]{2}|[1-8][0-9]{3}|9[0-8][0-9]{2}|99[0-3][0-9]|994[0-4])" required>    <!--regex for postcodes ranging 0200 - 9944 (generated on https://3widgets.com/), maxlength specified as well as regex so user can recognise limit-->
            </label>
        </fieldset>
        <fieldset>
            <legend>Contact Details</legend>
            <label for="email">Email Address:
                <input type="text" name="email" id="email" pattern="[A-Za-z\d]+@[A-Za-z\d]+\.[A-Za-z]{1,3}" required>   <!--Email entered with text input, verified with regex-->
            </label>
            <label for="number">Phone Number:
                <input type="text" name="number" id="number" maxlength="12" pattern="[\d\s]{8,12}" required>    <!--Phone number - only digits or spaces, 8 to 12 characters-->
            </label>
        </fieldset>
        <fieldset>
            <legend>Skills</legend>
            <div id="tech-skills">   <!--Technical skills checkboxes-->
                <p>Required technical skills:</p>
                <label for="aws-azure">
                    <input type="checkbox" name="aws-azure" id="aws-azure" value="1" checked>
                    Knowledge of AWS/Azure cloud platforms
                </label>
                <label for="script-lang">
                    <input type="checkbox" name="script-lang" id="script-lang" value="2">
                    Familiarity with scripting languages (e.g. Bash, Python)
                </label>
                <label for="sys-admin">
                    <input type="checkbox" name="sys-admin" id="sys-admin" value="3">
                    System administration skills
                </label>
                <label for="automation">
                    <input type="checkbox" name="automation" id="automation" value="4">
                    Cloud automation proficiency
                </label>
                <label for="security">
                    <input type="checkbox" name="security" id="security" value="5">
                    Knowledge of cloud security best practices
                </label>
            </div>
            <label for="other-skills">Other Skills:
                <input type="checkbox" name="other-skills-check" id="other-skills-check">
                <textarea name="other-skills" id="other-skills" cols="50" rows="10" placeholder="Please describe any other relevant skills or experience"></textarea>
            </label>
        </fieldset>
        <div id="submit-reset">
            <input type="submit" value="Apply" class="button" id="submit">
            <input type="reset" value="Reset" class="button" id="reset">
        </div>
    </form>
    <hr>          
    <?php include 'footer.inc'; ?>
</body>
</html>