<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeedACar - Payment</title>
    <link rel="stylesheet" href="stylepayment.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <a href="index.php" style="text-decoration: none;">
            <h1 class="title" style="color: white;">NeedACar</h1>
        </a>
        <nav class="nav-bar">
    </header>

    <!-- Main Content -->
    <main class="payment-container">
        <div class="thank-you-box">
            <?php
            // Fetch total amount from the query string
            if (isset($_GET['totalAmount'])) {
                $totalAmount = htmlspecialchars($_GET['totalAmount']); // Sanitize the input for safety
                echo "<h2>Car Booked!</h2>";
                echo "<h1><strong>Please Pay:</strong> $" . $totalAmount . " at the time of pick-up</h1>";
                echo"<p>  ---  </p>";
                echo "<p>We appreciate you choosing <strong>NeedACar</strong>.</p>";
            } else {
                echo "<h2>Thank You!</h2>";
                echo "<p>We appreciate you choosing <strong>NeedACar</strong>.</p>";
                echo "<p>However, we could not retrieve the payment amount. Please contact support for assistance.</p>";
            }
            ?>
        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2025 NeedACar. All rights reserved.</p>
    </footer>
</body>
</html>
