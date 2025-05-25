<?php
session_start();
require_once('settings.php');

$errMsg = $_SESSION['errMsg'];

// redirect if page is directly accessed and there are no form errors
if (!$errMsg) {
    header("Location: apply.php");
    exit();
}
// unset so error page cannot be accessed later
unset($_SESSION['errMsg']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Manage, Jobs, Interest">
    <meta name="author" content="Rose Healy">
    <link rel="stylesheet" href="styles/styles.css">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Error</title>
</head>
<body>
    <?php include 'header.inc'; ?>
    <div class="php-body">
        <h1 class="php-heading">Error</h1>
        <br>
        <p>There was a problem submitting your application.</p>
        <p>Please check the following and <a href="apply.php">resubmit</a>:</p>
        <br>
        <?php echo"$errMsg" ?>
    </div>
    <hr>
    <?php include 'footer.inc'; ?>
</body>
</html>