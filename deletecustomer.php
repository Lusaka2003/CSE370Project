<?php
include "connect.php";

// Declare variables
$USER_ID ="";
$USER_IDErr="";

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form data
    $USER_ID = $_POST['USER_ID'];


    // Validate that USER_ID is not empty
    if (empty($USER_ID)) {
        $USER_IDErr = "User ID is required.";
    }

    // If there are no validation errors, proceed to update the data
    if (empty($USER_IDErr) ) {
        // Prepare SQL query to update customer data based on USER_ID
        $query = "DELETE FROM customer WHERE USER_ID='$USER_ID'";

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

// Check if USER_ID is provided for the form (via POST) to update
if (isset($_POST['USER_ID'])) {
    $user_id = $_POST['USER_ID'];
    $sql = "SELECT * FROM customer WHERE USER_ID = '$USER_ID'";
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
        <h5 style="color:#04AA6D;">Delete Customer</h5>
        <br>
        <!-- User ID input field -->
        <label for="USER_ID"><b>User ID</b></label><br>
        <input type="text" placeholder="User ID" name="USER_ID" value="<?php echo $USER_ID; ?>" required>
        <span class="error"><?php echo $USER_IDErr; ?></span><br>

        
        <br>
        <button type="submit" class="registerbtn">Delete Customer</button>
    </div>

    <div class="container signin">
        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
    </div>
</form>

</body>
</html>

