<?php
require_once('connect.php');
if (!empty($_POST['email']) && !empty($_POST['Password'])) {
    $email = $_POST['email'];
    $Password = $_POST['Password'];
    
    $sql = "SELECT * FROM customer WHERE email = '$email' AND Password = '$Password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        
        header("Location: userprofile.php");
        exit();

    } else {
        echo "<script>alert('Wrong username or password. Please try again.'); window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('Username and password cannot be empty.'); window.location.href='login.php';</script>";
}
?>
