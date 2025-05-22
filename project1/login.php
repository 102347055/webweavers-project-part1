<?php
session_start();
require_once("settings.php");

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Retrieve user data securely
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $db_user = mysqli_fetch_assoc($result);

    if ($db_user) {
    $now = new DateTime();
    $locked_until = $db_user['locked_until'] ? new DateTime($db_user['locked_until']) : null;

    if ($locked_until && $now < $locked_until) {
        echo "❌ Account is locked until " . $locked_until->format('Y-m-d H:i:s');
    } elseif ($password === $db_user['user_password']) {  // <-- updated here
        // ✅ Login successful
        $_SESSION['username'] = $db_user['username'];

        // Reset lockout state
        $reset_query = "UPDATE users SET failed_attempts = 0, locked_until = NULL WHERE username = ?";
        $reset_stmt = mysqli_prepare($conn, $reset_query);
        mysqli_stmt_bind_param($reset_stmt, "s", $username);
        mysqli_stmt_execute($reset_stmt);

        header("Location: manage.php");
        exit();
    } else {
        // ❌ Login failed
        $attempts = $db_user['failed_attempts'] + 1;

        if ($attempts >= 3) {
            $lock_until = (new DateTime())->modify('+10 minutes')->format('Y-m-d H:i:s');
            $lock_query = "UPDATE users SET failed_attempts = ?, locked_until = ? WHERE username = ?";
            $lock_stmt = mysqli_prepare($conn, $lock_query);
            mysqli_stmt_bind_param($lock_stmt, "iss", $attempts, $lock_until, $username);
            mysqli_stmt_execute($lock_stmt);
            echo "❌ Account locked for 10 minutes due to 3 failed attempts.";
        } else {
            $fail_query = "UPDATE users SET failed_attempts = ? WHERE username = ?";
            $fail_stmt = mysqli_prepare($conn, $fail_query);
            mysqli_stmt_bind_param($fail_stmt, "is", $attempts, $username);
            mysqli_stmt_execute($fail_stmt);
            echo "❌ Incorrect username or password. Attempt $attempts of 3.";
        }
    }
} else {
    echo "❌ User not found.";
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
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>


<body id="apply-body">
    <?php include 'header.inc'; ?>
    <h1 id="apply-heading">Log In</h1>

    <form action="" method="post" id="eoi_search">
        <p>
            <label for="username"></label>Username:
            <input type="text" name="username" id="username" required>
        </p>
        <p>
            <label for="password"></label>Password:
            <input type="text" name="password" id="password" required>
        </p>
        <button type="submit" value="Submit" class="button">Log In</button>
    </form>
    <?php include 'footer.inc'; ?>
</body>
</html>