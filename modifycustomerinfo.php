<?php
require_once("connect.php");

// Check if user_id is set in the URL
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch the customer data based on the user_id
    $sql = "SELECT * FROM customer WHERE USER_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Customer not found!";
        exit();
    }
} else {
    echo "Invalid request!";
    exit();
}

// Handling form submission (for example, updating customer data)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $license_no = $_POST['license_no'];
    $phone = $_POST['phone'];

    // Update customer data in the database
    $update_sql = "UPDATE customer SET Name = ?, address = ?, email = ?, date_of_birth = ?, License_No = ?, phone = ? WHERE USER_ID = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssssi", $name, $address, $email, $date_of_birth, $license_no, $phone, $user_id);
    
    if ($stmt->execute()) {
        // echo "Customer data updated successfully!";
    } else {
        echo "Error updating customer data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styleeditcustomer.css" />
    <title>Edit Customer</title>
</head>
<body>
    <!-- <h1>Edit Customer Information</h1> -->

    <form method="POST" action="modifycustomerinfo.php?user_id=<?php echo $user_id; ?>">
    <div class="container">
    <h4 style="color:white; background-color:#04AA6D">NeedACar</h4>
        <br>
        <h5 style="color:#04AA6D;">Edit Customer Information</h5>
        <br>
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['Name']); ?>" required /><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" required /><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required /><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($row['date_of_birth']); ?>" required /><br>

        <label for="license_no">License Number:</label>
        <input type="text" name="license_no" value="<?php echo htmlspecialchars($row['License_No']); ?>" required /><br>

        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required /><br>

        <button type="submit">Update Customer</button>
        </form>
    <div class="container signin">
    <p><a href="admin_dashboard.php" style="background-color:  #04AA6D; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Back to Dashboard</a></p>
    </div>
</div>
    
</body>
</html>
