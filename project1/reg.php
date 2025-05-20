<?php
session_start();
require_once("settings.php");

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Simple query to check credentials
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $db_user = mysqli_fetch_assoc($result);
    if ($db_user) {
        $_SESSION['username'] = $db_user['username'];
        header("Location: manage.php");
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

    <title>Registration</title>
    <!-- custom css link-->
  <link rel="stylesheet" href="styles/styles.css">
  <!-- google fonts link-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>

<body>
        <form method="post" >
                <h5 class="p-4" style="font-weight: 700;">Create Your Account</h5>

            <div class="details">
                <label for="username">User Name</label>
                <input type="text" name="username" id="username"
                  class="form-control" required>
            </div>

            <div class="details">
                <label for="username">Password</label>
                <input type="text" name="password" id="password"
                  class="form-control" required>
            </div>

            <div class="mb-2 mt-3">
                <button type="submit" 
                  class="btn btn-success
                bg-success" style="font-weight: 600;">Create
                    Account</button>
            </div>

            <div class="mb-2 mt-4">
                <p id = "already_acc" style="font-weight: 600; 
                color: navy;">I have an Account <a href="./login.php"
                        style="text-decoration: none;">Login</a></p>
            </div>
        </form>
</body>

</html>