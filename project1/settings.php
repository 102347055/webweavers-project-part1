<?php
$host = "localhost";         // because XAMPP runs the server locally
$user = "root";          // default username for XAMPP's MySQL
$pwd = "";              // default password is empty in XAMPP
$sql_db = "WebWeavers_DB";  // replace with the actual name of your database

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>