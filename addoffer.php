<?php
include "connect.php";  // Include your database connection file

// Declare variables
$Promo_Code = $Description = $Promo_Type = $Percentage = $Discounted_Amount = "";
$Promo_CodeErr = $DescriptionErr = $Promo_TypeErr = $PercentageErr = $Discounted_AmountErr = "";

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $Promo_Code = $_POST['Promo_Code'];
    $Description = $_POST['Description'];
    $Promo_Type = $_POST['Promo_Type'];
    $Percentage = $_POST['Percentage'];
    $Discounted_Amount = $_POST['Discounted_Amount'];

    // Validate form fields
    if (empty($Promo_Code)) {
        $Promo_CodeErr = "Promo Code is required.";
    }
    if (empty($Promo_Type)) {
        $Promo_TypeErr = "Promo Type is required.";
    }

    // If all fields are valid
    if (empty($Promo_CodeErr) && empty($Promo_TypeErr)) {
        // Prepare the SQL INSERT query
        $query = "INSERT INTO offer_details (Promo_Code, Description, Promo_Type, Percentage, Discounted_Amount) 
                  VALUES (?, ?, ?, ?, ?)";

        // Use prepared statements to prevent SQL injection
        if ($stmt = mysqli_prepare($conn, $query)) {
            // Bind the parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "sssss", $Promo_Code, $Description, $Promo_Type, $Percentage, $Discounted_Amount);

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

            <!-- Description -->
            <label for="Description"><b>Description</b></label><br>
            <input type="text" placeholder="Enter Offer Description" name="Description" value="<?php echo htmlspecialchars($Description); ?>"><br>

            <!-- Promo Type -->
            <label for="Promo_Type"><b>Promo Type</b></label><br>
            <input type="text" placeholder="Enter Promo Type" name="Promo_Type" value="<?php echo htmlspecialchars($Promo_Type); ?>" required>
            <span class="error"><?php echo $Promo_TypeErr; ?></span><br>

            <!-- Percentage -->
            <label for="Percentage"><b>Percentage</b></label><br>
            <input type="text" placeholder="Percentage" name="Percentage" value="<?php echo $Percentage; ?>">
            <span class="error"><?php echo $PercentageErr; ?></span><br>
    
            <label for="Discounted_Amount"><b>Discounted_Amount</b></label><br>
            <input type="text" placeholder="Discounted_Amount" name="Discounted_Amount" value="<?php echo $Discounted_Amount; ?>">
            <span class="error"><?php echo $Discounted_AmountErr; ?></span><br>

            <br>
            <button type="submit" class="registerbtn">Add Offer</button>
        </div>

        <div class="container signin">
            <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
        </div>
    </form>

</body>
</html>
