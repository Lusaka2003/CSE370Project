<?php
include "connect.php";

// Declare variables
$user_id = $name = $phone = $address = $license = $email = $date_of_birth = "";
$user_idErr = $nameErr = $phoneErr = $addressErr = $licenseErr = $emailErr = $date_of_birthErr = "";

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form data
    $user_id = $_POST['USER_ID'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $license = $_POST['license'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];

    // Validate that USER_ID is not empty
    if (empty($user_id)) {
        $user_idErr = "User ID is required.";
    }

    // If there are no validation errors, proceed to update the data
    if (empty($user_idErr) && empty($nameErr) && empty($phoneErr) && empty($addressErr) && empty($licenseErr) && empty($emailErr) && empty($date_of_birthErr)) {
        // Prepare SQL query to update customer data based on USER_ID
        $query = "UPDATE customer 
                  SET Name = '$name', phone = '$phone', address = '$address', License_No = '$license', email = '$email', date_of_birth = '$date_of_birth' 
                  WHERE USER_ID = '$user_id'";

        if (mysqli_query($conn, $query)) {
            echo "Customer information updated successfully!";
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
    $sql = "SELECT * FROM customer WHERE USER_ID = '$user_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Pre-fill the form with the existing data
        $name = $row['Name'];
        $phone = $row['phone'];
        $address = $row['address'];
        $license = $row['License_No'];
        $email = $row['email'];
        $date_of_birth = $row['date_of_birth'];
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
    <title>Edit Customer Information</title>
    <link rel="stylesheet" href="styleeditcustomer.css">
</head>
<body>

    <br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="container">
        <h4 style="color:white; background-color:#04AA6D">NeedACar</h4>
        <br>
        <h5 style="color:#04AA6D;">Edit Customer Information</h5>
        <br>
        <!-- User ID input field -->
        <label for="user_id"><b>User ID</b></label><br>
        <input type="text" placeholder="User ID" name="USER_ID" value="<?php echo $user_id; ?>" required>
        <span class="error"><?php echo $user_idErr; ?></span><br>

        <!-- Name field -->
        <label for="name"><b>Name</b></label><br>
        <input type="text" placeholder="Name" name="name" value="<?php echo $name; ?>" required>
        <span class="error"><?php echo $nameErr; ?></span><br>

        <!-- Phone number field -->
        <label for="phone"><b>Phone number:</b></label><br>
        <input type="tel" placeholder="Phone Number" name="phone" value="<?php echo $phone; ?>" required>
        <span class="error"><?php echo $phoneErr; ?></span><br>

        <!-- Address field -->
        <label for="address"><b>Address</b></label><br>
        <input type="text" placeholder="Address" name="address" value="<?php echo $address; ?>" required><br>
        <span class="error"><?php echo $addressErr; ?></span><br>

        <!-- License number field -->
        <label for="license"><b>License Number</b></label><br>
        <input type="text" placeholder="License Number" name="license" value="<?php echo $license; ?>" required><br>
        <span class="error"><?php echo $licenseErr; ?></span><br>

        <!-- Email field -->
        <label for="email"><b>Email</b></label><br>
        <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
        <span class="error"><?php echo $emailErr; ?></span><br>

        <!-- Date of birth field -->
        <label for="date_of_birth"><b>Date of Birth</b></label><br>
        <input type="date" placeholder="Enter Date of Birth" name="date_of_birth" value="<?php echo $date_of_birth; ?>" required>
        <span class="error"><?php echo $date_of_birthErr; ?></span><br>
        <br>
        <button type="submit" class="registerbtn">Update Information</button>
    </div>

    <div class="container signin">
        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
    </div>
</form>

</body>
</html>

