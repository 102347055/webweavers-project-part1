<?php
$host = "localhost";         // because XAMPP runs the server locally
$user = "root";          // default username for XAMPP's MySQL
$pwd = "";              // default password is empty in XAMPP
$sql_db = "lab10_db";  // replace with the actual name of your database

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}