<?php
require_once('connect.php');

// Get the email passed via the URL
if (isset($_GET['email']) && !empty($_GET['email'])) {
    $email = $_GET['email'];
} else {
    echo "User not found!";
    exit();
}

// Fetch user data from the database using the email
$sql = "SELECT * FROM customer WHERE email = '$email' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    // Assign the values from the database to variables
    $user_id = $user['USER_ID'];
    $name = $user['Name'];
    $contact = $user['phone'];
} else {
    echo "User not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styleuserprofile.css">
</head>
<body>
    <!-- Header Section -->
    <header>

        <a href="index.php" style="text-decoration: none;">
                <h1 class="title" style="color: white;">NeedACar</h1>
        </a>
        <nav class="nav-bar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="deals.php">Deals</a></li>
                <li><a href="review.php">Reviews</a></li>
                <li><a href="contact.html">Contacts</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Profile Section -->
    <main>
        <section class="user-profile-section">
            <h2>Your Profile</h2>
                <!-- User ID -->
                <div class="profile-details">
                    <label for="user_id">User ID: </label>
                    <span class="info-box"><?php echo isset($user_id) ? $user_id : ''; ?></span>
                </div>

                <!-- Name -->
                <div class="profile-details">
                    <label for="name">Name: </label>
                    <span class="info-box"><?php echo isset($name) ? $name : ''; ?></span>
                </div>

                <!-- Email -->
                <div class="profile-details">
                    <label for="email">Email: </label>
                    <span class="info-box"><?php echo isset($email) ? $email : ''; ?></span>
                </div>

                <!-- Contact -->
                <div class="profile-details">
                    <label for="contact">Contact: </label>
                    <span class="info-box"><?php echo isset($contact) ? $contact : ''; ?></span>
                </div>
            </form>

            <!-- Prominent Select Car Button -->
            <button class="select-car-btn" onclick="location.href='selectcar.php';">Select a Car</button>

            <!-- Logout Button -->
            <button class="logout-btn" onclick="location.href='logout.php';">Logout</button>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2025 Car Rental Management System | All rights reserved</p>
    </footer>
</body>
</html>
