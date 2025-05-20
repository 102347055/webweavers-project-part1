<?php
session_start();
require_once("settings.php");

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    // Simple query to check credentials
    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $db_user = mysqli_fetch_assoc($result);

    if ($db_user) {
        $_SESSION['username'] = $db_user['username'];
        header("Location: profile.php");
        exit();

    //not showing up when user not in db
    } else {
        echo "❌ Incorrect username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Home Page of Web Weavers; a tech company-" >
    <meta name="keywords" content="Web, Weavers, Technology, Cloud, Jobs, Innovative">
    <meta name="author" content="Rayan Arain">
    <title>Manager's Log In</title>
</head>

<body id="apply-body">
    <?php include 'header.inc'; ?>
    
    <h1 id="apply-heading">Log In</h1>

    <form action="./manage.php" method="post" id="eoi_search">
        <p>
            <label for="username">User:</label>
            <input type="text" name="username" id="username" required>
        </p>
        <p>
            <label for="password">Password:</label>
            <input type="text" name="password" id="password" required>
        </p>
        <input type="submit" value="Submit">
    </form>
</body>
</html>