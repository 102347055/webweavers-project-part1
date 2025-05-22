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
    $query = "SELECT * FROM Employee WHERE UserName = '$username' AND UserPassword = '$password'";
    $result = mysqli_query($conn, $query);
    $db_user = mysqli_fetch_assoc($result);

    if ($db_user) {
        $_SESSION['username'] = $db_user['username'];
        header("Location: manage.php");
        exit();

    
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
    <!-- custom css link-->
  <link rel="stylesheet" href="styles/styles.css">
  <!-- google fonts link-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<?php include 'header.inc'; ?>

<body id="apply-body">
    <h1 id="apply-heading">Log In</h1>

    <form action="" method="post" id="eoi_search">
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
    <?php include 'footer.inc'; ?>
</body>
</html>