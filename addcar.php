<?php
include "connect.php";

// Declare variables and error messages
$License_plate = $Status = $Seating_Capacity = $Car_Type = $Model = $Brand = $Color = $RentPerDay = "";
$License_plateErr = $StatusErr = $Seating_CapacityErr = $Car_TypeErr = $ModelErr = $BrandErr = $ColorErr = $RentPerDayErr = "";

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $License_plate = $_POST['License_plate'];
    $Status = $_POST['Status'];
    $Seating_Capacity = $_POST['Seating_Capacity'];
    $Car_Type = $_POST['Car_Type'];
    $Model = $_POST['Model'];
    $Brand = $_POST['Brand'];
    $Color = $_POST['Color'];
    $RentPerDay = $_POST['RentPerDay'];

    // Validate that License Plate is not empty
    if (empty($License_plate)) {
        $License_plateErr = "License Plate is required.";
    }

    // Validate other fields
    if (empty($Status)) {
        $StatusErr = "Status is required.";
    }
    if (empty($Seating_Capacity)) {
        $Seating_CapacityErr = "Seating Capacity is required.";
    }
    if (empty($Car_Type)) {
        $Car_TypeErr = "Car Type is required.";
    }
    if (empty($Model)) {
        $ModelErr = "Model is required.";
    }
    if (empty($Brand)) {
        $BrandErr = "Brand is required.";
    }
    if (empty($Color)) {
        $ColorErr = "Color is required.";
    }
    if (empty($RentPerDay)) {
        $RentPerDayErr = "Rent per day is required.";
    }

    // If there are no validation errors, proceed to insert the data
    if (empty($License_plateErr) && empty($StatusErr) && empty($Seating_CapacityErr) && empty($Car_TypeErr) && empty($ModelErr) && empty($BrandErr) && empty($ColorErr) && empty($RentPerDayErr)) {
        // Use prepared statement to insert data into car table
        $query = "INSERT INTO car (License_plate, Status, Seating_Capacity, Car_Type, Model, Brand, Color, RentPerDay) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "ssissssi", $License_plate, $Status, $Seating_Capacity, $Car_Type, $Model, $Brand, $Color, $RentPerDay); // 'ssissssi' means strings, integers
            if (mysqli_stmt_execute($stmt)) {
                echo "Car information inserted successfully!";
                // Redirect after successful insertion
                header("Location: admin_dashboard.php");
                exit();
            } else {
                echo "Error: Could not execute query: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: Could not prepare query: " . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Car Information</title>
    <link rel="stylesheet" href="styleeditcustomer.css">
</head>
<body>

    <br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container">
            <h4 style="color:white; background-color:#04AA6D">NeedACar</h4>
            <br>
            <h5 style="color:#04AA6D;">Insert Car Information</h5>
            <br>
            <!-- License Plate input field -->
            <label for="License_plate"><b>License Plate</b></label><br>
            <input type="text" placeholder="License Plate" name="License_plate" value="<?php echo htmlspecialchars($License_plate); ?>" required>
            <span class="error"><?php echo $License_plateErr; ?></span><br>

            <!-- Status field -->
            <label for="Status"><b>Status</b></label><br>
            <input type="text" placeholder="Status" name="Status" value="<?php echo htmlspecialchars($Status); ?>" required>
            <span class="error"><?php echo $StatusErr; ?></span><br>

            <!-- Seating Capacity -->
            <label for="Seating_Capacity"><b>Seating Capacity</b></label><br>
            <input type="number" name="Seating_Capacity" value="<?php echo htmlspecialchars($Seating_Capacity); ?>" required>
            <span class="error"><?php echo $Seating_CapacityErr; ?></span><br>

            <!-- Car Type -->
            <label for="Car_Type"><b>Car Type</b></label><br>
            <input type="text" name="Car_Type" value="<?php echo htmlspecialchars($Car_Type); ?>" required>
            <span class="error"><?php echo $Car_TypeErr; ?></span><br>

            <!-- Model -->
            <label for="Model"><b>Model</b></label><br>
            <input type="text" name="Model" value="<?php echo htmlspecialchars($Model); ?>" required>
            <span class="error"><?php echo $ModelErr; ?></span><br>

            <!-- Brand -->
            <label for="Brand"><b>Brand</b></label><br>
            <input type="text" name="Brand" value="<?php echo htmlspecialchars($Brand); ?>" required>
            <span class="error"><?php echo $BrandErr; ?></span><br>

            <!-- Color -->
            <label for="Color"><b>Color</b></label><br>
            <input type="text" name="Color" value="<?php echo htmlspecialchars($Color); ?>" required>
            <span class="error"><?php echo $ColorErr; ?></span><br>

            <!-- Rent per Day -->
            <label for="RentPerDay"><b>Rent per Day</b></label><br>
            <input type="number" name="RentPerDay" value="<?php echo htmlspecialchars($RentPerDay); ?>" required>
            <span class="error"><?php echo $RentPerDayErr; ?></span><br>

            <br>
            <button type="submit" class="registerbtn">Insert Car Information</button>
        </div>

        <div class="container signin">
            <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
        </div>
    </form>

</body>
</html>
