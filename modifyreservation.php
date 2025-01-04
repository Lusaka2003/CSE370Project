<?php
include "connect.php";

// Declare variables
$Reservation_ID=$totalAmount="";
$Reservation_IDErr=$totalAmountErr="";
// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form data
    $Reservation_ID = $_POST['Reservation_ID'];
    $totalAmount = $_POST['totalAmount'];

    // Validate that USER_ID is not empty
    if (empty($Reservation_ID)) {
        $Reservation_IDErr = "Reservation ID is required.";
    }

    // If there are no validation errors, proceed to update the data
    if (empty($Reservation_IDErr) && empty($totalAmountErr) ) {
        // Prepare SQL query to update customer data based on USER_ID
        $query = "UPDATE reservation 
                  SET totalAmount = '$totalAmount'
                  WHERE Reservation_ID = '$Reservation_ID'";

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
if (isset($_POST['Reservation_ID'])) {
    $Reservation_ID = $_POST['Reservation_ID'];
    $sql = "SELECT * FROM car WHERE Reservation_ID = '$Reservation_ID'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Pre-fill the form with the existing data
        $Reservation_ID=$row['Reservation_ID'];
        $totalAmount=$row['totalAmount'];

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
        <h5 style="color:#04AA6D;">Edit Reservation Information</h5>
        <br>
        <!-- User ID input field -->
        <label for="License_plate"><b>Reservation ID</b></label><br>
        <input type="text" placeholder="Reservation ID" name="License_plate" value="<?php echo $License_plate; ?>" required>
        <span class="error"><?php echo $License_plateErr; ?></span><br>

        <!-- Name field -->
        <label for="totalAmount"><b>Total Amount to be Paid</b></label><br>
        <input type="text" placeholder="totalAmount" name="totalAmount" value="<?php echo $totalAmount; ?>" required>
        <span class="error"><?php echo $totalAmountErr; ?></span><br>

        <br>
        <button type="submit" class="registerbtn">Update Information</button>
    </div>

    <div class="container signin">
        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
    </div>
</form>

</body>
</html>