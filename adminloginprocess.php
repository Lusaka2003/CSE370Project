<?php
require_once('connect.php');

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE Username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Wrong username or password. Please try again.'); window.location.href='adminlogin.php';</script>";
    }
} else {
    echo "<script>alert('Username and password cannot be empty.'); window.location.href='adminlogin.php';</script>";
}
?>
