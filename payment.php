<?php
session_start();

include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount_paid = $_POST['amount_paid'];
    $card_no = $_POST['card_no'] ? $_POST['card_no'] : null;
    $name_on_card = $_POST['name_on_card'] ? $_POST['name_on_card'] : null;
    $paid_by_cash = isset($_POST['paid_by_cash']) ? 1 : 0;
    $paid_by_card = isset($_POST['paid_by_card']) ? 1 : 0;

    // Insert payment into database
    $query = "INSERT INTO payment (Amount_Paid, Card_No, Name_On_Card, Paid_By_Cash, Paid_By_Card) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issii", $amount_paid, $card_no, $name_on_card, $paid_by_cash, $paid_by_card);
    
    if ($stmt->execute()) {
        echo "<p class='success'>Payment successfully processed!</p>";
    } else {
        echo "<p class='error'>Error processing payment.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="stylepayment.css"> 
</head>
<body>
    <div class="container">
        <h2>Make a Payment</h2>

        <form action="payment.php" method="POST">
            <label for="amount_paid">Amount Paid:</label>
            <input type="number" id="amount_paid" name="amount_paid" required>

            <label for="card_no">Card Number:</label>
            <input type="text" id="card_no" name="card_no">

            <label for="name_on_card">Name on Card:</label>
            <input type="text" id="name_on_card" name="name_on_card">

            <div class="checkbox-group">
                <label for="paid_by_cash">
                    <input type="checkbox" id="paid_by_cash" name="paid_by_cash">
                    Pay by Cash
                </label>
                <label for="paid_by_card">
                    <input type="checkbox" id="paid_by_card" name="paid_by_card">
                    Pay by Card
                </label>
            </div>

            <input type="submit" value="Submit Payment">
        </form>

        <div class="footer">
            <p>Thank you for choosing our car rental service!</p>
        </div>
    </div>
</body>
</html>
