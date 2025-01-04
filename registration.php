<?php
require_once "connect.php";

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $license = $_POST['license'];
    $date_of_birth = $_POST['date_of_birth'];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];

    // Hash password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Array to store error messages
    $errors = array();

    // Check if required fields are empty
    if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($passwordRepeat)) {
        array_push($errors, "These fields are required");
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }

    // Check password length
    if (strlen($password) < 6) {
        array_push($errors, "Password must be at least 6 characters long");
    }

    // Check if passwords match
    if ($password !== $passwordRepeat) {
        array_push($errors, "Passwords do not match");
    }

    // Check if email already exists in the database
    $sql = "SELECT * FROM customer WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    
    if ($rowCount > 0) {
        array_push($errors, "Email already exists!");
    }

    // If there are errors, display them
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='error-msg'>$error</div>";
        }
    } else {
        $sql = "INSERT INTO customer (name, email, phone, address, license_no, date_of_birth, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "sssssss", $name, $email, $phone, $address, $license, $date_of_birth, $passwordHash);
            if (mysqli_stmt_execute($stmt)) {
              header("Location: login.php");
              exit();
            } else {
                echo "<div class='error-msg'>Something went wrong while registering your account.</div>";
            }
        } else {
            die("Something went wrong with the SQL query.");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">Please fill up this form to register</h1>
            <img src="auto-car-logo-template-vector-icon.jpg" alt="Logo" class="header-image">
        </div>

        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <input type="tel" class="form-control" name="phone" placeholder="Phone" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Address" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="license" placeholder="License No" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password" required>
            </div>
            <div class="form-group">
                <input type="date" class="form-control" name="date_of_birth" placeholder="Date of Birth" required>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        
        <div class="signin">
            <p>Already Registered? <a href="login.php">Login Here</a></p>
        </div>
    </div>
</body>
</html>
