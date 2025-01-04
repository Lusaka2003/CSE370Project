<?php
include "connect.php";

$license_plate = $seating_capacity = $car_type = $model = $brand = $color = $status = $rent_per_day = "";
$license_plateErr = $seating_capacityErr = $car_typeErr = $modelErr = $brandErr = $colorErr = $statusErr = $rent_per_dayErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $license_plate = $_POST['license_plate'];
    $seating_capacity = $_POST['seating_capacity'];
    $car_type = $_POST['car_type'];
    $model = $_POST['model'];
    $brand = $_POST['brand'];
    $color = $_POST['color'];
    $status = $_POST['status'];
    $rent_per_day = $_POST['rent_per_day'];

    // Validate that license_plate is not empty
    if (empty($license_plate)) {
        $license_plateErr = "License plate is required.";
    }

    // If there are no validation errors, proceed to update the data
    if (empty($license_plateErr) && empty($seating_capacityErr) && empty($car_typeErr) && empty($modelErr) && empty($brandErr) && empty($colorErr) && empty($statusErr) && empty($rent_per_dayErr)) {
        // Prepare SQL query to update car data based on license_plate
        $query = "UPDATE car 
                  SET Seating_Capacity = '$seating_capacity', Car_Type = '$car_type', Model = '$model', Brand = '$brand', Color = '$color', Status = '$status', RentPerDay = '$rent_per_day' 
                  WHERE License_plate = '$license_plate'";

        if (mysqli_query($conn, $query)) {
            echo "Car information updated successfully!";
            // Redirect back to the dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Check if license_plate is provided for the form to update
if (isset($_POST['license_plate'])) {
    $license_plate = $_POST['license_plate'];
    $sql = "SELECT * FROM car WHERE License_plate = '$license_plate'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Pre-fill the form with the existing data
        $seating_capacity = $row['Seating_Capacity'];
        $car_type = $row['Car_Type'];
        $model = $row['Model'];
        $brand = $row['Brand'];
        $color = $row['Color'];
        $status = $row['Status'];
        $rent_per_day = $row['RentPerDay'];
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
    <title>Edit Car Information</title>
    <link rel="stylesheet" href="styleeditcar.css">
</head>
<body>

    <br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="container">
        <h4 style="color:white; background-color:#04AA6D">NeedACar</h4>
        <br>
        <h5 style="color:#04AA6D;">Edit Car Information</h5>
        <br>
        <!-- License Plate input field -->
        <label for="license_plate"><b>License Plate</b></label><br>
        <input type="text" placeholder="License Plate" name="license_plate" value="<?php echo $license_plate; ?>" required>
        <span class="error"><?php echo $license_plateErr; ?></span><br>

        <!-- Seating Capacity field -->
        <label for="seating_capacity"><b>Seating Capacity</b></label><br>
        <input type="number" placeholder="Seating Capacity" name="seating_capacity" value="<?php echo $seating_capacity; ?>" required>
        <span class="error"><?php echo $seating_capacityErr; ?></span><br>

        <!-- Car Type field -->
        <label for="car_type"><b>Car Type:</b></label><br>
        <input type="text" placeholder="Car Type" name="car_type" value="<?php echo $car_type; ?>" required>
        <span class="error"><?php echo $car_typeErr; ?></span><br>

        <!-- Model field -->
        <label for="model"><b>Model</b></label><br>
        <input type="text" placeholder="Model" name="model" value="<?php echo $model; ?>" required><br>
        <span class="error"><?php echo $modelErr; ?></span><br>

        <!-- Brand field -->
        <label for="brand"><b>Brand</b></label><br>
        <input type="text" placeholder="Brand" name="brand" value="<?php echo $brand; ?>" required><br>
        <span class="error"><?php echo $brandErr; ?></span><br>

        <!-- Color field -->
        <label for="color"><b>Color</b></label><br>
        <input type="text" placeholder="Color" name="color" value="<?php echo $color; ?>" required><br>
        <span class="error"><?php echo $colorErr; ?></span><br>

        <!-- Car Availability field -->
        <label for="status"><b>Car Availability</b></label><br>
        <input type="text" placeholder="Status" name="status" value="<?php echo $status; ?>" required><br>
        <span class="error"><?php echo $statusErr; ?></span><br>

        <!-- Rent Per Day field -->
        <label for="rent_per_day"><b>Rent Per Day</b></label><br>
        <input type="number" placeholder="Rent Per Day" name="rent_per_day" value="<?php echo $rent_per_day; ?>" required><br>
        <span class="error"><?php echo $rent_per_dayErr; ?></span><br>

        <br>
        <button type="submit" class="registerbtn">Update Information</button>
    </div>

    <div class="container signin">
        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
    </div>
</form>

</body>
</html>
