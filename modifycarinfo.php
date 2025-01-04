<?php
include "connect.php";

// Declare variables
$License_plate=$Status="";
$License_plateErr=$StatusErr="";
// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form data
    $License_plate = $_POST['License_plate'];
    $Status = $_POST['Status'];

    // Validate that USER_ID is not empty
    if (empty($License_plate)) {
        $License_plateErr = "License Plate is required.";
    }

    // If there are no validation errors, proceed to update the data
    if (empty($License_plateErr) && empty($StatusErr) ) {
        // Prepare SQL query to update customer data based on USER_ID
        $query = "UPDATE car 
                  SET Status = '$Status'
                  WHERE License_plate = '$License_plate'";

        if (mysqli_query($conn, $query)) {
            echo "Car information updated successfully!";
            // Redirect back to the dashboard or wherever you want after the update
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Check if USER_ID is provided for the form (via POST) to update
if (isset($_POST['License_plate'])) {
    $License_plate = $_POST['License_plate'];
    $sql = "SELECT * FROM car WHERE License_plate = '$License_plate'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Pre-fill the form with the existing data
        $License_plate=$row['License_plate'];
        $Status=$row['Status'];

    } else {
        echo "Car not found!";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer Information</title>
    <link rel="stylesheet" href="styleeditcustomer.css">
</head>
<body>

    <br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="container">
        <h4 style="color:white; background-color:#04AA6D">NeedACar</h4>
        <br>
        <h5 style="color:#04AA6D;">Edit Car Information</h5>
        <br>
        <!-- User ID input field -->
        <label for="License_plate"><b>License Plate</b></label><br>
        <input type="text" placeholder="License Plate" name="License_plate" value="<?php echo $License_plate; ?>" required>
        <span class="error"><?php echo $License_plateErr; ?></span><br>

        <!-- Name field -->
        <label for="Status"><b>Status</b></label><br>
        <input type="text" placeholder="Status" name="Status" value="<?php echo $Status; ?>" required>
        <span class="error"><?php echo $StatusErr; ?></span><br>

        <br>
        <button type="submit" class="registerbtn">Update Information</button>
    </div>

    <div class="container signin">
        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
    </div>
</form>

</body>
</html>
