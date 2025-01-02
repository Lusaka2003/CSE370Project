<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        form {
            width: 300px;
            margin: 0 auto;
        }
        label {
            font-weight: bold;
        }
        .paybtn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin: 10px 0;
        }
        .back-link {
            text-align: center;
            margin-top: 15px;
        }
        .back-link a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
  <form action="process_payment.php" method="post">
    <h1>Payment</h1>
    <label for="card_name"><b>Cardholder Name</b></label><br>
    <input type="text" placeholder="Name on Card" name="card_name" id="card_name" required><br><br>

    <label for="card_number"><b>Card Number</b></label><br>
    <input type="text" placeholder="Card Number" name="card_number" id="card_number" pattern="\d{16}" required><br><br>

    <label for="expiry_date"><b>Expiry Date</b></label><br>
    <input type="month" name="expiry_date" id="expiry_date" required><br><br>

    <label for="cvv"><b>CVV</b></label><br>
    <input type="text" placeholder="CVV" name="cvv" id="cvv" pattern="\d{3}" required><br><br>

    <label for="amount"><b>Payment Amount</b></label><br>
    <input type="number" placeholder="Amount" name="amount" id="amount" required><br><br>

    <button type="submit" class="paybtn">Make Payment</button>
  </form>

  <div class="back-link">
    <p><a href="index.php">Back to Login</a></p>
  </div>
</body>
</html>