<?php
include('db_config.php');

// Fetch customer details to edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Customer WHERE USER_ID = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Handle the update form submission
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $license_no = $_POST['license_no'];

    $updateQuery = "UPDATE Customer SET 
                    Name = :name, 
                    email = :email, 
                    Password = :password, 
                    date_of_birth = :dob, 
                    phone = :phone, 
                    address = :address, 
                    License_No = :license_no 
                    WHERE USER_ID = :id";
    
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->bindParam(':id', $id);
    $updateStmt->bindParam(':name', $name);
    $updateStmt->bindParam(':email', $email);
    $updateStmt->bindParam(':password', $password);
    $updateStmt->bindParam(':dob', $dob);
    $updateStmt->bindParam(':phone', $phone);
    $updateStmt->bindParam(':address', $address);
    $updateStmt->bindParam(':license_no', $license_no);
    $updateStmt->execute();
    
    header("Location: manage_customers.php"); // Redirect to manage page after update
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
</head>
<body>
    <h1>Edit Customer</h1>
    
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $customer['USER_ID']; ?>">
        <label>Name: </label>
        <input type="text" name="name" value="<?php echo $customer['Name']; ?>" required><br><br>
        <label>Email: </label>
        <input type="email" name="email" value="<?php echo $customer['email']; ?>" required><br><br>
        <label>Password: </label>
        <input type="password" name="password" value="<?php echo $customer['Password']; ?>" required><br><br>
        <label>Date of Birth: </label>
        <input type="date" name="dob" value="<?php echo $customer['date_of_birth']; ?>" required><br><br>
        <label>Phone: </label>
        <input type="text" name="phone" value="<?php echo $customer['phone']; ?>" required><br><br>
        <label>Address: </label>
        <input type="text" name="address" value="<?php echo $customer['address']; ?>" required><br><br>
        <label>License No: </label>
        <input type="text" name="license_no" value="<?php echo $customer['License_No']; ?>" required><br><br>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
