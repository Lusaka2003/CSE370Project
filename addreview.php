<?php
include "connect.php";  // Include your database connection file

// Declare variables for form input and errors
$Name = $CustomerReview = "";
$NameErr = $CustomerReviewErr = "";

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $Name = $_POST['Name'];
    $CustomerReview = $_POST['CustomerReview'];

    // Validate the inputs
    if (empty($Name)) {
        $NameErr = "Name is required.";
    }
    if (empty($CustomerReview)) {
        $CustomerReviewErr = "Review is required.";
    }

    // If there are no validation errors
    if (empty($NameErr) && empty($CustomerReviewErr)) {
        // Prepare the SQL INSERT query
        $query = "INSERT INTO reviews (Name, CustomerReview) VALUES (?, ?)";

        // Use prepared statements to prevent SQL injection
        if ($stmt = mysqli_prepare($conn, $query)) {
            // Bind the parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "ss", $Name, $CustomerReview);

            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                echo "Review added successfully!";
                // Optionally, you can redirect to another page, like a review page or the homepage
                header("Location: review.php");
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
    <title>Add Review</title>
    <link rel="stylesheet" href="styleeditcustomer.css">  <!-- Add your custom CSS file here -->
</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container">
            <h4 style="color:white; background-color:#04AA6D">NeedACar</h4>
            <br>
            <h5 style="color:#04AA6D;">Add Your Review</h5>
            <br>

            <!-- Name -->
            <label for="Name"><b>Name</b></label><br>
            <input type="text" placeholder="Enter your name" name="Name" value="<?php echo htmlspecialchars($Name); ?>" required>
            <span class="error"><?php echo $NameErr; ?></span><br>

            <!-- Customer Review -->
            <label for="CustomerReview"><b>Your Review</b></label><br>
            <textarea name="CustomerReview" placeholder="Enter your review here" rows="4" cols="50" required><?php echo htmlspecialchars($CustomerReview); ?></textarea><br>
            <span class="error"><?php echo $CustomerReviewErr; ?></span><br>

            <br>
            <button type="submit" class="registerbtn">Submit Review</button>
        </div>

        <div class="container signin">
            <p><a href="index.php">Back to Home</a></p>
        </div>
    </form>

</body>
</html>
