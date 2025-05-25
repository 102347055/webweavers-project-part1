<?php
session_start();
require_once('settings.php');

$last_id = $_SESSION['last_id'];
$reference = $_SESSION['reference'];
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
    <title>Application Confirmation</title>
</head>
<body>
    <?php include 'header.inc'; ?>
    <div class="php-body">
        <h1 class="php-heading">Confirmation</h1>
        <br>
        <p>Thank you! Your application for position <?php echo"$reference" ?> at Web Weavers has been successfully submitted.</p>
        <p>Your reference number is <?php echo"$last_id" ?>.</p>
        <br>
        <p>If you have any questions about the hiring process please <a href="mailto:info@webweavers.edu.au">contact our team.</a></p>
        <p>If you're interested in other positions read about our current opportunities <a href="jobs.php">here.</a></p>
        <br><br><br><br><br>
    </div>
    <hr>
    <?php include 'footer.inc'; ?>
</body>
</html>