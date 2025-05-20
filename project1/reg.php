<?php
session_start();
require_once("settings.php");

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$sql_3 = "INSERT INTO 'users' ('username', 'user_password') VALUES ('hi', 'bye')";
$result_3 = mysqli_query($conn, $sql_3);

if($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $new_user = $_POST["username"]; 
    $new_pwd = $_POST["user_password"]; 
  
    $sql = "Select * from users where username='$new_user'";
  
    $result = mysqli_query($conn, $sql);
  
    $num = mysqli_num_rows($result); 
  
    // This sql query is use to check if
    // the username is already present 
    // or not in our Database
    
    //checking if username exists, if returns no rows, that means username isn't taken
    if($num == 0) {
      $sql_2 = "INSERT INTO 'users' ('username', 'user_password') VALUES ('$new_user', '$new_pwd')";
      $result_2 = mysqli_query($conn, $sql_2);
        }    
  
   if($num>0) 
   {
      echo "Username not available"; 
   } 
  
}//end if   
  

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
        <form action = "./manage.php" method="post" >
                <h5 class="p-4" style="font-weight: 700;">Create Your Account</h5>

            <div class="details">
                <label for="username">User Name</label>
                <input type="text" name="username" id="username"
                  class="form-control" required>
            </div>

            <div class="details">
                <label for="user_password">Password</label>
                <input type="text" name="user_password" id="user_password"
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