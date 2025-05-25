<?php
// Can store user-specific data like username across multiple pages
session_start();
require_once("settings.php");

// Set the default timezone to Melbourne, VIC, Australia
date_default_timezone_set('Australia/Melbourne');

// Establish a connection to MySQL database
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

// If connection fails, stop script and show error
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Remove extra whitespace from the beginning and end of the input
    $username = trim($_POST["username"]);
    $password = trim($_POST["user_password"]);

    // Prepare a secure SQL query to find the user by username
    // Prepare a SQL query with a placeholder (?) for the username to avoid SQL injection.
    // For example, if a user enters ' OR 1=1 --
    // If this is exectued as SQL code and not a value, the query would be SELECT * FROM users WHERE username = '' OR 1=1 --'
    // The -- starts a comment, so anything after it is ignored
    // Result: This query selects all users because 1=1 is always true. The attacker may be logged in without knowing any real username or password
    $query = "SELECT * FROM users WHERE username = ?";
    // Parse and compile the SQL statement, keep a placeholder (?) for later input, return a prepared statement object to PHP ($stmt).
    // Basically telling MySQL server: "here's my query. I'll tell you the ? value later, but it is data and NOT SQL code"
    $stmt = mysqli_prepare($conn, $query);
    // Bind the actual $username value to the ? in the SQL query ("s" means you're binding a string value)
    mysqli_stmt_bind_param($stmt, "s", $username);
    // Runs query
    mysqli_stmt_execute($stmt); 
    // Fetch the result set from the executed prepared statement ($stmt),
    // Does not yet give you the actual data, just a pointer to the results.
    // If no row, still returns result object
    $result = mysqli_stmt_get_result($stmt); 
    // Take the first row (bc unique users) from the $result object.
    // Convert it into an associative array like this
    // If no user, returns false
    $db_user = mysqli_fetch_assoc($result);

    if ($db_user) {
        // Get current time
        $now = new DateTime(); 
        // Convert the locked_until value from the database into a DateTime object (if it's set).
        $locked_until = $db_user['locked_until'] ? new DateTime($db_user['locked_until']) : null;

        // Check if the account is currently locked
        if ($locked_until && $now < $locked_until) {
            // Format lockout message: date (dd/mm/yyyy) and 12-hour time with am/pm
            echo "❌ Account is locked until date " . $locked_until->format('d/m/Y h:i A');
        // password_verify is a built-in PHP function used to check if a plain text password ($user_password, entered by the user) matches a hashed password ($db_user['user_password'], stored in database)
        } elseif (password_verify($password, $db_user['user_password'])) {
            // ✅ Login successful: store username in session
            // Save username in the session, so you can remember the logged-in user across pages
            $_SESSION['username'] = $db_user['username'];

            // Reset failed attempts and lockout time
            $reset_query = "UPDATE users SET failed_attempts = 0, locked_until = NULL WHERE username = ?";
            $reset_stmt = mysqli_prepare($conn, $reset_query);
            mysqli_stmt_bind_param($reset_stmt, "s", $username);
            mysqli_stmt_execute($reset_stmt);

            // Redirect based on manager status
            if ($db_user['manager']) {
                header("Location: manage.php");
            } else {
                header("Location: index.php");
            }
            exit();

        } else {
            // ❌ Login failed: increase failed attempt count
            $attempts = $db_user['failed_attempts'] + 1;

            // Lock the account if 3 failed attempts reached
            if ($attempts >= 3) {
                // Locks the account for 10 minutes from current time
                $lock_until = (new DateTime())->modify('+10 minutes')->format('Y-m-d H:i:s');
                // Prepare a query to update the user's failed attempts and lockout time.
                $lock_query = "UPDATE users SET failed_attempts = ?, locked_until = ? WHERE username = ?";
                $lock_stmt = mysqli_prepare($conn, $lock_query);
                // Bind "i" (integer) for attempts and "s" (string) for datetime and username
                mysqli_stmt_bind_param($lock_stmt, "iss", $attempts, $lock_until, $username);
                mysqli_stmt_execute($lock_stmt);
                echo "❌ Account locked for 10 minutes due to 3 failed attempts.";
            } else {
                // Updates only the attempt counter
                $fail_query = "UPDATE users SET failed_attempts = ? WHERE username = ?";
                $fail_stmt = mysqli_prepare($conn, $fail_query);
                mysqli_stmt_bind_param($fail_stmt, "is", $attempts, $username);
                mysqli_stmt_execute($fail_stmt);
                echo "❌ Incorrect username or password. Attempt $attempts of 3.";
            }
        }
    } else {
        // No user was found with that username
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
        <title>Log In</title>
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
        <form action="" method="post" id="login_form" class="ww-form">
            <div class="form-row">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-row">
                <label for="password">Password: </label> 
                <input type="password" name="user_password" id="user_password" required>
            </div>
            <button type="submit" class="button">Log In</button>
        </form>
        <?php include 'footer.inc'; ?>
    </body>
</html>