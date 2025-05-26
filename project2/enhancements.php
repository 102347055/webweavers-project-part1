<?php
session_start();
require_once('settings.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A list of the enhancements implemented on the Web Weavers website using various PHP features." >
    <meta name="keywords" content="PHP, Enhancements, Web Weavers">
    <meta name="author" content="Rose Healy">
    <link rel="stylesheet" href="styles/styles.css">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Application Confirmation</title>
</head>
<body>
    <?php include 'header.inc'; ?>
    <div class="php-body">
        <h1 class="php-heading">Enhancements</h1>
        <div class="php-inner-div">
            <p>The Web Weavers team have implemented the following enhancements on our website:</p>
            <br>
            <ul id="enhancements-ul">
                <li>On the <a href="manage.php">manage</a> page, the EOI table is able to be sorted by various fields by selecting from a dropdown list on the form.</li>
                <li>There is a <a href="reg.php">registration</a> and <a href="login.php">login</a> page, allowing users to create an account.</li>
                <li>Manager credentials are also stored in our users table, allowing specific users to gain access to the manage page upon logging in. 
                    <br>(Manager account for testing purposes - Username: nick Password: nick123)</li>
                <li>Users are warned after each unsuccessful login attempt. After 3 attempts, user accounts will lock for a period of 10 minutes.</li>
            </ul>
        </div>
    </div>
    <hr>
    <?php include 'footer.inc'; ?>
</body>
</html>