<?php
include "connect.php";

// Declare variables
$Reservation_ID ="";
$Reservation_IDErr="";

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form data
    $Reservation_ID = $_POST['Reservation_ID'];


    // Validate that Reservation_ID is not empty
    if (empty($Reservation_ID)) {
        $Reservation_IDErr = "Reservation Id is required.";
    }

    // If there are no validation errors, proceed to update the data
    if (empty($Reservation_IDErr) ) {
        // Prepare SQL query to update customer data based on Reservation_ID
        $query = "DELETE FROM customer WHERE Reservation_ID='$Reservation_ID'";

        if (mysqli_query($conn, $query)) {
            echo "Customer Deleted successfully!";
            // Redirect back to the dashboard or wherever you want after the update
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Check if Reservation_ID is provided for the form (via POST) to update
if (isset($_POST['Reservation_ID'])) {
    $Reservation_ID = $_POST['Reservation_ID'];
    $sql = "SELECT * FROM customer WHERE Reservation_ID = '$Reservation_ID'";
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
    <title>Delete Customer</title>
    <link rel="stylesheet" href="styleeditcustomer.css">
</head>
<body>

    <br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="container">
        <h4 style="color:white; background-color:#04AA6D">NeedACar</h4>
        <br>
        <h5 style="color:#04AA6D;">Delete Reservation</h5>
        <br>
        <!-- Reservation Id input field -->
        <label for="Reservation_ID"><b>Reservation Id</b></label><br>
        <input type="text" placeholder="Reservation Id" name="Reservation_ID" value="<?php echo $Reservation_ID; ?>" required>
        <span class="error"><?php echo $Reservation_IDErr; ?></span><br>

        
        <br>
        <button type="submit" class="registerbtn">Delete Reservation</button>
    </div>

    <div class="container signin">
        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
    </div>
</form>

</body>
</html>
