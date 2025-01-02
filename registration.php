<?php
include "connect.php"; 

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection Failed: ". $conn->connect_error);
}else{
    // echo "Connection Established";
    mysqli_select_db($conn, $dbname);
}

$name = $phone = $address = $license = $email = $date_of_birth = $password = $confirm_password = "";
$nameErr = $phoneErr = $addressErr = $licenseErr = $emailErr = $date_of_birthErr = $passwordErr = $confirm_passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $license = $_POST['license'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $password = $_POST['psw'];
    $confirm_password = $_POST['psw-repeat'];

    // Validate the inputs
    if (empty($name)) {
        $nameErr = "Name is required";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $nameErr = "Name should only contain letters and spaces";
    }

    if (empty($phone)) {
        $phoneErr = "Phone number is required";
    } elseif (!preg_match("/^[0-9]{11}$/", $phone)) { // Checks for exactly 11 digits
        $phoneErr = "Phone number must be exactly 11 digits";
    } else {
        // Check if phone number exists
        $phone_check_query = "SELECT * FROM customer WHERE phone='$phone'";
        $result = mysqli_query($conn, $phone_check_query);
        if (mysqli_num_rows($result) > 0) {
            $phoneErr = "Phone number is already registered";
        }
    }

    if (empty($address)) {
        $addressErr = "Address is required";
    }

    if (empty($license)) {
        $licenseErr = "License number is required";
    }

    if (empty($email)) {
        $emailErr = "Email is required";
    } else {
        $email_check_query = "SELECT * FROM customer WHERE email='$email'";
        $result = mysqli_query($conn, $email_check_query);
        if (mysqli_num_rows($result) > 0) {
            $emailErr = "Email is already registered";
        }
    }
    // Validate Date of Birth: Age must be above 18
    if (empty($date_of_birth)) {
        $date_of_birthErr = "Date of birth is required";
    } else {
        $dob = new DateTime($date_of_birth);
        $today = new DateTime();
        $age = $today->diff($dob)->y;
        if ($age < 18) {
            $date_of_birthErr = "You must be at least 18 years old";
        }
    }

    // Validate Password: Must be at least 6 characters long and contain both letters and numbers
    if (empty($password)) {
        $passwordErr = "Password is required";
    } elseif (strlen($password) < 6) {
        $passwordErr = "Password must be at least 6 characters";
    } elseif (!preg_match("/[a-zA-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
        $passwordErr = "Password must contain both letters and numbers";
    }

    if ($password != $confirm_password) {
        $confirm_passwordErr = "Passwords do not match";
    }

    // If there are no errors, insert into the database
    if (empty($nameErr) && empty($phoneErr) && empty($addressErr) && empty($licenseErr) && empty($emailErr) && empty($date_of_birthErr) && empty($passwordErr) && empty($confirm_passwordErr)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query to insert data
        $query = "INSERT INTO Customer (Name, phone, address, license_no, email, date_of_birth, password) 
                  VALUES ('$name', '$phone', '$address', '$license', '$email', '$date_of_birth', '$hashed_password')";

        // Execute the query
        if (mysqli_query($conn, $query)) {
            echo "Registration successful!";
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="container">
    <header class="header">
        <h1 class="title">Please fill up this form to register</h1>
        <img src="auto-car-logo-template-vector-icon.jpg" alt="Logo" class="header-image">
    </header>
    <hr>
    <label for="name"><b>Name</b></label><br>
    <input type="text" placeholder="Name" name="name" id="name" value="<?php echo $name; ?>" required>
    <span class="error"><?php echo $nameErr; ?></span><br>

    <label for="phone"><b>Phone number:</b></label><br>
    <input type="tel" placeholder="Phone Number" id="phone" name="phone" pattern=" /(^(\+8801|8801|01))[1|3-9]{1}(\d){8}$/" value="<?php echo $phone; ?>" required>
    <span class="error"><?php echo $phoneErr; ?></span><br>

    <label for="address"><b>Address</b></label><br>
    <input type="text" placeholder="Address" name="address" id="address" value="<?php echo $address; ?>" required><br>
    <span class="error"><?php echo $addressErr; ?></span>

    <label for="license"><b>License Number</b></label><br>
    <input type="text" placeholder="License Number" name="license" id="license" value="<?php echo $license; ?>" required><br>
    <span class="error"><?php echo $licenseErr; ?></span>

    <label for="email"><b>Email</b></label><br>
    <input type="email" placeholder="Enter Email" name="email" id="email" value="<?php echo $email; ?>" required>
    <span class="error"><?php echo $emailErr; ?></span><br>

    <label for="date_of_birth"><b>Date of Birth</b></label><br>
    <input type="date" placeholder="Enter date of birth" id="date_of_birth" name="date_of_birth" value="<?php echo $date_of_birth; ?>" required> 
    <span class="error"><?php echo $date_of_birthErr; ?></span><br>

    <label for="psw"><b>Password</b></label><br>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required><br>
    <span class="error"><?php echo $passwordErr; ?></span><br>

    <label for="psw-repeat"><b>Repeat Password</b></label><br>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
    <span class="error"><?php echo $confirm_passwordErr; ?></span><br><hr>

    <button type="submit" class="registerbtn">Register</button>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in </a></p>
  </div>
</form>

</body>
</html>