<?php
session_start();
require_once("settings.php");

// Connect to database
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if someone has submitted the form
// Only run this code when a form has been submitted, not when the page is just opened.
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    // Remove extra whitespace from the beginning and end of the input
    $new_user = trim($_POST["username"]);
    $new_pwd_raw = trim($_POST["user_password"]); // Store the raw password temporarily

    // Password rule: 7 to 20 characters, and at least 1 number
    if (!preg_match('/^(?=.*\d)[A-Za-z\d]{7,20}$/', $new_pwd_raw)) {
        echo "❌ Password must be 7–20 characters long and contain at least one number.";
        exit;
    }

    // Hash the password for security before storing it
    $new_pwd = password_hash($new_pwd_raw, PASSWORD_DEFAULT);

    // Check if username already exists
    // Use a placeholder `?` to prevent SQL injection
    $check_stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
    // Bind the user's $username to the placeholder in the SQL query
    mysqli_stmt_bind_param($check_stmt, "s", $new_user); // "s" = string
    mysqli_stmt_execute($check_stmt);
    // Get the result of the query — this is like asking the database: "Did you find any rows with this username?"
    // It gives us back a result set (which we can count or loop through)
    $result = mysqli_stmt_get_result($check_stmt);

    if (!$result) {
      die("Error checking username: " . mysqli_error($conn));
    }

    // Count how many rows were returned (how many users had that username)
    $num = mysqli_num_rows($result);

    // If 0, the username is not taken
    if ($num == 0) {
        // Insert new user using prepared INSERT
        $insert_stmt = mysqli_prepare($conn, "INSERT INTO users (username, user_password) VALUES (?, ?)");
        mysqli_stmt_bind_param($insert_stmt, "ss", $new_user, $new_pwd); // "ss" = 2 strings
        // Run the query to insert the user into the database
        $success = mysqli_stmt_execute($insert_stmt);

        // Check if the insertion was successful
        if ($success) {
            echo "✅ Account created successfully.";
        } else {
            echo "❌ Error inserting user: " . mysqli_stmt_error($insert_stmt);
        }

        // Close the prepared statement to free up resources
        mysqli_stmt_close($insert_stmt);
    } else {
        echo "⚠️ Username not available.";
    }

    // Close the statement used for checking username (also cleanup)
    mysqli_stmt_close($check_stmt);
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