<?php
include "connect.php";  // Include your database connection file

// Declare variables
$Promo_Code=$Description=$Percentage="";
$Promo_CodeErr=$DescriptionErr=$PercentageErr="";

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $Promo_Code = $_POST['Promo_Code'];
    $Description = $_POST['Description'];
    $Percentage = $_POST['Percentage'];


    // Validate form fields
    if (empty($Promo_Code)) {
        $Promo_CodeErr = "Promo Code is required.";
    }
    if (empty($Description)) {
        $DescriptionErr = "Description is required.";
    }
    if (empty($Percentage)) {
        $PercentageErr = "Percentage is required.";
    }

    // If all fields are valid
    if (empty($Promo_CodeErr) && empty($DescriptionErr)) {
        // Prepare the SQL INSERT query
        $query = "INSERT INTO offer_details (Promo_Code,Description,Percentage) 
                  VALUES (?, ?, ?)";

        // Use prepared statements to prevent SQL injection
        if ($stmt = mysqli_prepare($conn, $query)) {
            // Bind the parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "sss", $Promo_Code,$Description, $Percentage);

            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                echo "Offer added successfully!";
                // Redirect to admin dashboard or any other page
                header("Location: admin_dashboard.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            // Close the prepared statement
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
    <title>Add Offer</title>
    <link rel="stylesheet" href="styleeditcustomer.css">  <!-- Add your custom CSS file here -->
</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container">
            <h4 style="color:white; background-color:#04AA6D">NeedACar</h4>
            <br>
            <h5 style="color:#04AA6D;">Add New Offer</h5>
            <br>

            <!-- Promo Code -->
            <label for="Promo_Code"><b>Promo Code</b></label><br>
            <input type="text" placeholder="Enter Promo Code" name="Promo_Code" value="<?php echo htmlspecialchars($Promo_Code); ?>" required>
            <span class="error"><?php echo $Promo_CodeErr; ?></span><br>

            <label for="Description"><b>Description</b></label><br>
            <input type="text" placeholder="Description" name="Description" value="<?php echo $Description; ?>">
            <span class="error"><?php echo $DescriptionErr; ?></span><br>


            <label for="Percentage"><b>Percentage</b></label><br>
            <input type="text" placeholder="Percentage" name="Percentage" value="<?php echo $Percentage; ?>">
            <span class="error"><?php echo $PercentageErr; ?></span><br>

            <br>
            <button type="submit" class="registerbtn">Add Offer</button>
        </div>

        <div class="container signin">
            <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
        </div>
    </form>

</body>
</html>
