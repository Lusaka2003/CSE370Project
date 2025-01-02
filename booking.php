<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeedACar - Booking</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <header>
        <a href="#" class="logo">NeedACar <span>.</span></a>
        <nav class="navbar">
            <a href="#about">About</a>
            <a href="#deals">Deals</a>
            <a href="#review">Reviews</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>
    <br>

    <section class="home" id="home">
        <div class="wrapper">
            <form action="process_booking.php" method="POST">
                <label for="pickup"><b>Pick Up Date</b></label>
                <input type="date" name="pickup_date" id="pickup" required><br><br>

                <label for="return"><b>Return Date</b></label>
                <input type="date" name="return_date" id="return" required><br><br>

                <label for="email"><b>Email</b></label>
                <input type="email" name="email" id="email" required><br><br>

                <button type="submit" style="height: 40px; width: 150px; background-color: #04AA6D; color: white; font-size: 120%; border: none; cursor: pointer;">
                    Submit Booking
                </button>
            </form>
        </div>
    </section>
</body>
</html>
