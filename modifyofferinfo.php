<?php
include "connect.php";

$promo_code = $description = $promo_type = $percentage = $discounted_amount = "";
$promo_codeErr = $descriptionErr = $promo_typeErr = $percentageErr = $discounted_amountErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $promo_code = $_POST['promo_code'];
    $description = $_POST['description'];
    $promo_type = $_POST['promo_type'];
    $percentage = $_POST['percentage'];
    $discounted_amount = $_POST['discounted_amount'];

    // Validate that promo_code is not empty
    if (empty($promo_code)) {
        $promo_codeErr = "Promo code is required.";
    }

    // If there are no validation errors, proceed to update the data
    if (empty($promo_codeErr) && empty($descriptionErr) && empty($promo_typeErr) && empty($percentageErr) && empty($discounted_amountErr)) {
        // Prepare SQL query to update offer data based on promo_code
        $query = "UPDATE offer_details 
                  SET Description = '$description', Promo_Type = '$promo_type', Percentage = '$percentage', Discounted_Amount = '$discounted_amount' 
                  WHERE Promo_Code = '$promo_code'";

        if (mysqli_query($conn, $query)) {
            echo "Offer information updated successfully!";
            // Redirect back to the dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Check if promo_code is provided for the form to update
if (isset($_POST['promo_code'])) {
    $promo_code = $_POST['promo_code'];
    $sql = "SELECT * FROM offer_details WHERE Promo_Code = '$promo_code'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Pre-fill the form with the existing data
        $description = $row['Description'];
        $promo_type = $row['Promo_Type'];
        $percentage = $row['Percentage'];
        $discounted_amount = $row['Discounted_Amount'];
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
    <link rel="stylesheet" href="styleeditoffer.css">
</head>
<body>

    <br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="container">
        <h4 style="color:white; background-color:#04AA6D">NeedACar</h4>
        <br>
        <h5 style="color:#04AA6D;">Edit Offer Information</h5>
        <br>
        <!-- Promo Code input field -->
        <label for="promo_code"><b>Promo Code</b></label><br>
        <input type="text" placeholder="Promo Code" name="promo_code" value="<?php echo $promo_code; ?>" required>
        <span class="error"><?php echo $promo_codeErr; ?></span><br>

        <!-- Description field -->
        <label for="description"><b>Description</b></label><br>
        <input type="text" placeholder="Description" name="description" value="<?php echo $description; ?>" required>
        <span class="error"><?php echo $descriptionErr; ?></span><br>

        <!-- Promo Type field -->
        <label for="promo_type"><b>Promo Type</b></label><br>
        <input type="text" placeholder="Promo Type" name="promo_type" value="<?php echo $promo_type; ?>" required><br>
        <span class="error"><?php echo $promo_typeErr; ?></span><br>

        <!-- Percentage field -->
        <label for="percentage"><b>Percentage</b></label><br>
        <input type="number" placeholder="Percentage" name="percentage" value="<?php echo $percentage; ?>" required><br>
        <span class="error"><?php echo $percentageErr; ?></span><br>

        <!-- Discounted Amount field -->
        <label for="discounted_amount"><b>Discounted Amount</b></label><br>
        <input type="number" placeholder="Discounted Amount" name="discounted_amount" value="<?php echo $discounted_amount; ?>" required><br>
        <span class="error"><?php echo $discounted_amountErr; ?></span><br>

        <br>
        <button type="submit" class="registerbtn">Update Information</button>
    </div>

    <div class="container signin">
        <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
    </div>
</form>

</body>
</html>
