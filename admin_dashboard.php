<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styleadmintable.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet" />
    <title>Show Need A CAR Admin Dashboard</title>
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <img src="auto-car-logo-template-vector-icon.jpg" alt="Logo" class="header-image">
           
            <a href="index.php" style="text-decoration: none;">
                <h1 class="title" style="color: white;">NeedACar</h1>
            </a>

        </div>
        <h2 class="dashboard-title">Admin Dashboard</h2>
    </header>
    <main>
        <section class="customers">
            <div class="customer_box">
                <h1>Customers List</h1>
                <table class="customer_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>License Number</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        require_once("connect.php");
                        $sql = "SELECT * FROM customer";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td><?php echo $row["USER_ID"]; ?></td>
                            <td><?php echo $row["Name"]; ?></td>
                            <td><?php echo $row["address"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["date_of_birth"]; ?></td>
                            <td><?php echo $row["License_No"]; ?></td>
                            <td><?php echo $row["phone"]; ?></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <div class="editcustomer">
        <a href="modifycustomerinfo.php" class="edit-link">
            Edit Customer Information
        </a>
        </div>
        <br>

        <section class="cars">
            <div class="car_box">
                <h1>Car List</h1>
                <table class="car_table">
                    <thead>
                        <tr>
                            <th>License Plate</th>
                            <th>Seating Capacity</th>
                            <th>Car Type</th>
                            <th>Car Model</th>
                            <th>Car Brand</th>
                            <th>Color</th>
                            <th>Car Availability</th>
                            <th>Rent Per day</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        require_once("connect.php");
                        $sql = "SELECT * FROM car";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td><?php echo $row["License_plate"]; ?></td>
                            <td><?php echo $row["Seating_Capacity"]; ?></td>
                            <td><?php echo $row["Car_Type"]; ?></td>
                            <td><?php echo $row["Model"]; ?></td>
                            <td><?php echo $row["Brand"]; ?></td>
                            <td><?php echo $row["Color"]; ?></td>
                            <td><?php echo $row["Status"]; ?></td>
                            <td><?php echo $row["RentPerDay"]; ?></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <div class="editcar">
        <a href="modifycarinfo.php" class="edit-link">
            Edit Car Details
        </a>
        </div>
        <br>

        <section class="deal">
            <div class="deal_box">
                <h1>Offer List</h1>
                <table class="deal_table">
                    <thead>
                        <tr>
                            <th>Promo Code</th>
                            <th>Description</th>
                            <th>Promo Type</th>
                            <th>Percentage</th>
                            <th>Discount Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        require_once("connect.php");
                        $sql = "SELECT * FROM offer_details";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td><?php echo $row["Promo_Code"]; ?></td>
                            <td><?php echo $row["Description"]; ?></td>
                            <td><?php echo $row["Promo_Type"]; ?></td>
                            <td><?php echo $row["Percentage"]; ?></td>
                            <td><?php echo $row["Discounted_Amount"]; ?></td>
     
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <div class="editoffer">
        <a href="modifyofferinfo.php" class="edit-link">
            Edit Offer Details
        </a>
        </div>