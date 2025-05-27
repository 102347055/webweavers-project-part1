<?php
session_start();
// unset session variables & destroy session
$_SESSION = array();
session_destroy();

// redirect to login page
header("Location: login.php");
exit();
?>