<?php
include "connect.php";

// Declare variables and error messages
$email = $Start_Date = $End_Date = $License_plate = $Promo_Code = "";
$emailErr = $Start_DateErr = $End_DateErr = $License_plateErr = $Promo_CodeErr = "";
$totalAmount = 0;

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $email = $_POST['email'];
    $Start_Date = $_POST['Start_Date'];
    $End_Date = $_POST['End_Date'];
    $License_plate = $_POST['License_plate'];
    $Promo_Code = $_POST['Promo_Code'];

    // Validate other fields
    if (empty($email)) {
        $emailErr = "Email is required.";
    }
    if (empty($Start_Date)) {
        $Start_DateErr = "Start Date is required.";
    }
    if (empty($End_Date)) {
        $End_DateErr = "End Date is required.";
    }
    if (empty($License_plate)) {
        $License_plateErr = "License plate is required.";
    }

    // Fetch User_ID from the customers table based on the email
    $User_ID = null;
    if (empty($emailErr)) {
        $query = "SELECT User_ID FROM customer WHERE email = ?";
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $User_ID);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: Could not prepare query: " . mysqli_error($conn);
        }

        // If no user was found with the provided email
        if ($User_ID === null) {
            $emailErr = "No user found with the given email.";
        }
    }

    // If there are no validation errors, proceed to insert the data
    if (empty($Start_DateErr) && empty($End_DateErr) && empty($License_plateErr) && empty($Promo_CodeErr)) {
        // Verify if the car with the given license plate is available
        $carAvailable = false;
        $carQuery = "SELECT Status, RentPerDay FROM car WHERE License_plate = ?";
        if ($carStmt = mysqli_prepare($conn, $carQuery)) {
            mysqli_stmt_bind_param($carStmt, "s", $License_plate);
            mysqli_stmt_execute($carStmt);
            mysqli_stmt_bind_result($carStmt, $Status, $rent_per_day);
            mysqli_stmt_fetch($carStmt);
            if ($Status == 'Available') {
                $carAvailable = true;
            }
            mysqli_stmt_close($carStmt);
        }

        // If the car is available, proceed to calculate the total amount
        if ($carAvailable) {
            // Calculate the number of rental days
            $startDate = new DateTime($Start_Date);
            $endDate = new DateTime($End_Date);
            $interval = $startDate->diff($endDate);
            $rentalDays = $interval->days;

            // Calculate total amount
            if ($rentalDays > 0) {
                $totalAmount = $rentalDays * $rent_per_day;
            } else {
                $Start_DateErr = "End Date must be after Start Date.";
            }

            if (!empty($Promo_Code)) {
                $promoQuery = "SELECT Percentage FROM offer_details WHERE Promo_Code = ?";
                if ($promoStmt = mysqli_prepare($conn, $promoQuery)) {
                    mysqli_stmt_bind_param($promoStmt, "s", $Promo_Code);
                    mysqli_stmt_execute($promoStmt);
                    mysqli_stmt_bind_result($promoStmt, $discount_percentage);
                    mysqli_stmt_fetch($promoStmt);

                    // If a valid promo code is found, calculate the discount
                    if ($discount_percentage) {
                        $discount = ($totalAmount * $discount_percentage) / 100;
                        $totalAmount -= $discount; // Subtract the discount from the total amount
                    } else {
                        $Promo_CodeErr = "Invalid promo code.";
                    }
                    mysqli_stmt_close($promoStmt);
                } else {
                    echo "Error: Could not prepare query for promo code: " . mysqli_error($conn);
                }
            }

            // If total amount is calculated successfully, insert the reservation
            // If total amount is calculated successfully, insert the reservation
            if ($totalAmount > 0) {
                $query = "INSERT INTO reservation (Start_Date, End_Date, License_plate, Promo_Code, User_ID, totalAmount)
                        VALUES (?, ?, ?, ?, ?, ?)";
                if ($stmt = mysqli_prepare($conn, $query)) {
                    mysqli_stmt_bind_param($stmt, "ssssis", $Start_Date, $End_Date, $License_plate, $Promo_Code, $User_ID, $totalAmount);
                    if (mysqli_stmt_execute($stmt)) {
                        // Update car status to 'Rented' or 'Not Available'
                        $updateQuery = "UPDATE car SET Status = 'Not Available' WHERE License_plate = ?";
                        if ($updateStmt = mysqli_prepare($conn, $updateQuery)) {
                            mysqli_stmt_bind_param($updateStmt, "s", $License_plate);
                            mysqli_stmt_execute($updateStmt);
                            mysqli_stmt_close($updateStmt);
                        } else {
                            echo "Error: Could not update car status: " . mysqli_error($conn);
                        }

                        // Store reservation data in session
                        $_SESSION['totalAmount'] = $totalAmount;
                        $_SESSION['startDate'] = $Start_Date;
                        $_SESSION['endDate'] = $End_Date;
                        $_SESSION['licensePlate'] = $License_plate;
                        $_SESSION['promoCode'] = $Promo_Code;
                        
                        // Redirect to reservation summary page
                        header("Location: summary.php");
                        exit();
                    } else {
                        echo "Error: Could not execute query: " . mysqli_error($conn);
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error: Could not prepare query: " . mysqli_error($conn);
                }
            }

        } else {
            $License_plateErr = "The car is not available for the selected dates.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Reservation Information</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>

    <br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container">
            <h1 style="color:white; background-color:#04AA6D">NeedACar</h1>
            <br>
            <br>

            <!-- email field -->
            <label for="email"><b>Email</b></label><br>
            <input type="text" placeholder="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <span class="error"><?php echo $emailErr; ?></span><br>

            <!-- Pick up Date -->
            <label for="Start_Date"><b>Pick up Date</b></label><br>
            <input type="date" name="Start_Date" value="<?php echo htmlspecialchars($Start_Date); ?>" required>
            <span class="error"><?php echo $Start_DateErr; ?></span><br>

            <!-- Drop off Date -->
            <label for="End_Date"><b>Drop off Date</b></label><br>
            <input type="date" name="End_Date" value="<?php echo htmlspecialchars($End_Date); ?>" required>
            <span class="error"><?php echo $End_DateErr; ?></span><br>

            <!-- License plate -->
            <label for="License_plate"><b>License Plate</b></label><br>
            <input type="text" name="License_plate" value="<?php echo htmlspecialchars($License_plate); ?>" required>
            <span class="error"><?php echo $License_plateErr; ?></span><br>

            <!-- Promo Code -->
            <label for="Promo_Code"><b>Promo Code</b></label><br>
            <input type="text" name="Promo_Code" value="<?php echo htmlspecialchars($Promo_Code); ?>">
            <span class="error"><?php echo $Promo_CodeErr; ?></span><br>

            <br>

            <!-- Display total amount -->
            <div>
                <?php if ($totalAmount > 0) { echo "Total Amount: $" . $totalAmount; } ?>
            </div>

            <br>
            <button type="submit" class="registerbtn">PROCEED TO RENT</button>
        </div>

    </form>

</body>
</html>
