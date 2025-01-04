<?php
include "connect.php";

// Declare variables
$Promo_Code=$Description=$Promo_Type=$Percentage=$Discounted_Amount="";
$Promo_CodeErr=$DescriptionErr=$Promo_TypeErr=$PercentageErr=$Discounted_AmountErr="";
// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form data
    $Promo_Code = $_POST['Promo_Code'];
    $Description = $_POST['Description'];
    $Promo_Type = $_POST['Promo_Type'];
    $Percentage = $_POST['Percentage'];
    $Discounted_Amount = $_POST['Discounted_Amount'];

    // Validate that USER_ID is not empty
    if (empty($Promo_Code)) {
        $Promo_CodeErr = "Promo_Code is required.";
    }

    // If there are no validation errors, proceed to update the data
    if (empty($Promo_CodeErr) && empty($StatusErr) ) {
        // Prepare SQL query to update customer data based on USER_ID
        $query = "UPDATE offer_details
                  SET Description = '$Description', Promo_Type = '$Promo_Type',Percentage = '$Percentage', Discounted_Amount = '$Discounted_Amount'
                  WHERE Promo_Code = '$Promo_Code'";

        if (mysqli_query($conn, $query)) {
            echo "Offer Details updated successfully!";
            // Redirect back to the dashboard or wherever you want after the update
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Check if USER_ID is provided for the form (via POST) to update
if (isset($_POST['Promo_Code'])) {
    $Promo_Code = $_POST['Promo_Code'];
    $sql = "SELECT * FROM offer_details WHERE Promo_Code = '$Promo_Code'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Pre-fill the form with the existing data
        $Promo_Code=$row['Promo_Code'];
        $Description=$row['Description'];
        $Promo_Typee=$row['Promo$Promo_Typee'];
        $Percentage=$row['Percentage'];
        $Discounted_Amount=$row['Discounted_Amount'];

    } else {
        echo "Offer not found!";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Offer Information</title>
    <link rel="stylesheet" href="styleeditcustomer.css">
</head>
<body>

    <br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="container">
        <h4 style="color:white; background-color:#04AA6D">NeedACar</h4>
        <br>
        <h5 style="color:#04AA6D;">Edit Offer Information</h5>
        <br>
        <!-- User ID input field -->
        <label for="Promo_Code"><b>Promo Code</b></label><br>
        <input type="text" placeholder="Promo Code" name="Promo_Code" value="<?php echo $Promo_Code; ?>" required>
        <span class="error"><?php echo $Promo_CodeErr; ?></span><br>

        <!-- Name field -->
        <label for="Description"><b>Description</b></label><br>
        <input type="text" placeholder="Description" name="Description" value="<?php echo $Description; ?>" required>
        <span class="error"><?php echo $DescriptionErr; ?></span><br>

        <label for="Promo_Type"><b>Promo_Type</b></label><br>
        <input type="text" placeholder="Promo_Type" name="Promo_Type" value="<?php echo $Promo_Type; ?>" required>
        <span class="error"><?php echo $Promo_TypeErr; ?></span><br>

        <label for="Percentage"><b>Percentage</b></label><br>
        <input type="text" placeholder="Percentage" name="Percentage" value="<?php echo $Percentage; ?>">
        <span class="error"><?php echo $PercentageErr; ?></span><br>

        <label for="Discounted_Amount"><b>Discounted_Amount</b></label><br>
        <input type="text" placeholder="Discounted_Amount" name="Discounted_Amount" value="<?php echo $Discounted_Amount; ?>">
        <span class="error"><?php echo $Discounted_AmountErr; ?></span><br>

        <br>
        <button type="submit" class="registerbtn">Update Information</button>
    </div>

    <div class="container signin">
        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
    </div>
</form>

</body>
</html>
