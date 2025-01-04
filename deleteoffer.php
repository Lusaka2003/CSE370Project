<?php
include "connect.php";  // Include your database connection file

// Declare variables
$Promo_Code = "";
$Promo_CodeErr = "";

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capture the Promo_Code from the form
    $Promo_Code = $_POST['Promo_Code'];

    // Validate that the Promo_Code is not empty
    if (empty($Promo_Code)) {
        $Promo_CodeErr = "Promo Code is required.";
    }

    // If there are no validation errors
    if (empty($Promo_CodeErr)) {
        // Prepare the DELETE query to remove the offer
        $query = "DELETE FROM offer_details WHERE Promo_Code = ?";
        
        // Use prepared statements to prevent SQL injection
        if ($stmt = mysqli_prepare($conn, $query)) {
            // Bind the Promo_Code to the statement
            mysqli_stmt_bind_param($stmt, "s", $Promo_Code);
            
            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                echo "Offer deleted successfully!";
                // Redirect back to the admin dashboard after successful deletion
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
    <title>Delete Offer</title>
    <link rel="stylesheet" href="styleeditcustomer.css">
</head>
<body>

    <br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container">
            <h4 style="color:white; background-color:#04AA6D">NeedACar</h4>
            <br>
            <h5 style="color:#04AA6D;">Delete Offer</h5>
            <br>
            <!-- Promo Code input field -->
            <label for="Promo_Code"><b>Promo Code</b></label><br>
            <input type="text" placeholder="Enter Promo Code" name="Promo_Code" value="<?php echo htmlspecialchars($Promo_Code); ?>" required>
            <span class="error"><?php echo $Promo_CodeErr; ?></span><br>

            <br>
            <button type="submit" class="registerbtn">Delete Offer</button>
        </div>

        <div class="container signin">
            <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
        </div>
    </form>

</body>
</html>
