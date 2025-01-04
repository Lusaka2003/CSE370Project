<?php
require_once('connect.php');

$email = $_POST['email']; 
$sql = "SELECT * FROM customer WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

// Fetch user data
$user = mysqli_fetch_assoc($result);
$user_id = $user['USER_ID'];
$name = $user['Name'];
$contact = $user['phone'];
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
        <div class="header-container">
            <h1>NeedACar</h1>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="deals.php">Deals</a></li>
                <li><a href="review.php">Reviews</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Profile Section -->
    <main>
        <section class="user-profile-section">
            <h2>Your Profile</h2>
            <form action="updateuserprofile.php" method="POST">
                <!-- User ID -->
                <div class="profile-details">
                    <label for="user_id">User ID: </label>
                    <span class="info-box"><?php echo $user_id; ?></span>
                </div>

                <!-- Name -->
                <div class="profile-details">
                    <label for="name">Name: </label>
                    <input type="text" name="name" value="<?php echo $name; ?>" class="info-box" required>
                    <button type="submit" class="update-btn">Update Name</button>
                </div>

                <!-- Email -->
                <div class="profile-details">
                    <label for="email">Email: </label>
                    <span class="info-box"><?php echo $email; ?></span>
                </div>

                <!-- Contact -->
                <div class="profile-details">
                    <label for="contact">Contact: </label>
                    <span class="info-box"><?php echo $contact; ?></span>
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
