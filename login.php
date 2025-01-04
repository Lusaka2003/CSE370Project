<?php
session_start();

require_once "connect.php";

if (isset($_POST["login"])) {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query to check if email exists
    $sql = "SELECT * FROM customer WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        header("Location: userprofile.php");
          exit();
        } else {
            echo "<div class='alert alert-danger'>Email does not match</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class="wrapper">
    <form action="login.php" method="POST">
      <h1>Login</h1>
      <div class="input-box">
        <input type="email" name="email" placeholder="Enter Email" required>
        <i class='bx bxs-envelope'></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Enter Password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <button type="submit" name="login" class="login">Login</button>
    </form>
    <div class="register-link">
      <p>Not registered yet? <a href="registration.php">Register Here</a></p>
    </div>
  </div>
</body>
</html>
