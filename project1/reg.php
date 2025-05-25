<?php
session_start();
require_once("settings.php");

// Connect to database
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $new_user = mysqli_real_escape_string($conn, $_POST["username"]);
    $new_pwd = mysqli_real_escape_string($conn, $_POST["user_password"]);

    // Password rule: min 7 characters, at least 1 number
    if (!preg_match('/^(?=.*\d).{7,}$/', $new_pwd)) {
        echo "❌ Password must be at least 7 characters long and contain at least one number.";
        exit;
    }

    // Check if username already exists
    $sql = "SELECT * FROM `users` WHERE `username` = '$new_user'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error checking username: " . mysqli_error($conn));
    }

    $num = mysqli_num_rows($result);

    if ($num == 0) {
        // Insert new user
        $sql = "INSERT INTO `users` (`username`, `user_password`) VALUES ('$new_user', '$new_pwd')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "✅ Account created successfully.";
        } else {
            echo "❌ Error inserting user: " . mysqli_error($conn);
        }
    } else {
        echo "⚠️ Username not available.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Economica&family=Poppins&display=swap" rel="stylesheet">
</head>

<body id="apply-body">
  <?php include 'header.inc'; ?>
  <h1 id="apply-heading">Create Your Account</h1>
  <form action="reg.php" method="post" id="registration-form" class="ww-form">
  <div class="reg-row">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" class="form-control" required>
  </div>

  <div class="reg-row">
    <label for="user_password">Password (7-20 characters and 1 number):</label>
    <input type="text" name="user_password" id="user_password"
      class="form-control" required
      pattern="^(?=.*\d).{7,}$"
      title="Password must be at least 7 characters long and contain at least one number">
  </div>

  <div class= "reg-button">
    <button type="submit" class="button">Create Account</button>
  </div>

    <p id="alreadyacc">
      I have an Account <a href="./login.php" id="loginalreadyacc">Login</a>
    </p>
</form>
  <?php include 'footer.inc'; ?>
</body>
</html>