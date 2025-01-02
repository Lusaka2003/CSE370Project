<?php
// Database connection
$servername = "127.0.0.1";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "carrentalmanagementsystem";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$email = $_POST['email'];
$pickup_date = $_POST['pickup_date'];
$return_date = $_POST['return_date'];

// Check if the user already exists
$sql_check = "SELECT * FROM customer WHERE email = '$email'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    // Update existing customer's pickup and return dates
    $sql_update = "UPDATE customer 
                   SET pickup_date = '$pickup_date', return_date = '$return_date' 
                   WHERE email = '$email'";
    if ($conn->query($sql_update) === TRUE) {
        echo "Booking updated successfully!";
    } else {
        echo "Error updating booking: " . $conn->error;
    }
} else {
    // Insert new customer with booking details
    $sql_insert = "INSERT INTO customer (name, email, phone, address, license, password, date_of_birth, pickup_date, return_date)
                   VALUES ('$name', '$email', '', '', 0, 'default', CURDATE(), '$pickup_date', '$return_date')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "New booking added successfully!";
    } else {
        echo "Error adding booking: " . $conn->error;
    }
}

$conn->close();
?>
