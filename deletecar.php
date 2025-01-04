<?php
include "connect.php";

$License_plate="";
$License_plateErr="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $License_plate= $_POST['License_plate'];

    if (empty($License_plate)) {
        $License_plateErr = "License_plate is required.";
    }

    if (empty($License_plateErr) ) {
 
        $query = "DELETE FROM car WHERE License_plate='$License_plate'";

        if (mysqli_query($conn, $query)) {
            echo "Car Deleted successfully!";

            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}


if (isset($_POST['License_plate'])) {
    $License_plate= $_POST['License_plate'];
    $sql = "SELECT * FROM car WHERE License_plate= '$License_plate'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Pre-fill the form with the existing data
        // $name = $row['Name'];
        // $phone = $row['phone'];
        // $address = $row['address'];
        // $license = $row['License_No'];
        // $email = $row['email'];
        // $date_of_birth = $row['date_of_birth'];
    } else {
        echo "Customer not found!";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Car</title>
    <link rel="stylesheet" href="styleeditcustomer.css">
</head>
<body>

    <br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="container">
        <h4 style="color:white; background-color:#04AA6D">NeedACar</h4>
        <br>
        <h5 style="color:#04AA6D;">Delete Car</h5>
        <br>
        <!-- User ID input field -->
        <label for="License_plate"><b>License Plate</b></label><br>
        <input type="text" placeholder="License Plate" name="License_plate" value="<?php echo $License_plate; ?>" required>
        <span class="error"><?php echo $License_plateErr; ?></span><br>

        
        <br>
        <button type="submit" class="registerbtn">Delete Car</button>
    </div>

    <div class="container signin">
        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
    </div>
</form>

</body>
</html>
