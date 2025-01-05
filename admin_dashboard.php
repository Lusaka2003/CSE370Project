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
                            <th>     </th>
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
                            <td>
                        <!-- Edit link passing the USER_ID to the modifycustomerinfo.php page -->
                        <a href="modifycustomerinfo.php?user_id=<?php echo $row['USER_ID']; ?>" class="edit-link">Edit</a>
                    </td>
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
        <br>
        <br>
        <div class="deletecustomer">
        <a href="deletecustomer.php" class="edit-link">
            Delete Customer
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
        <div class="deletecar">
        <a href="deletecar.php" class="edit-link">
            Delete Car
        </a>
        </div>
        <br>
        <div class="addcar">
        <a href="addcar.php" class="edit-link">
            Add Car
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
                            <th>Percentage</th>
                           
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
                            <td><?php echo $row["Percentage"]; ?></td>
     
     
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
        <br>
        <div class="deleteoffer">
        <a href="deleteoffer.php" class="edit-link">
            Delete Offer
        </a>
        </div>
        <br>
        <div class="addoffer">
        <a href="addoffer.php" class="edit-link">
            Add Offer
        </a>
        </div>

        <br>
        <section class="reservation">
            <div class="reservation_box">
                <h1>Reservation List</h1>
                <table class="reservation_table">
                    <thead>
                        <tr>
                            <th>Reservation Id</th>
                            <th>Pick Up Date</th>
                            <th>Drop off Date</th>
                            <th>Car Rented</th>
                            <th>Promo Code Used</th>
                            <th>Amount to be Paid</th>
                            <th>Car Renter ID</th>
                            <th>Car Renter Name</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        require_once("connect.php");
                        // $sql = "SELECT * FROM reservation ORDER BY End_Date";
                        $sql = "SELECT r.Reservation_ID,r.Start_Date,r.End_Date,r.License_plate,r.Promo_Code,r.totalAmount,r.USER_ID,c.Name from reservation r, customer c where c.USER_ID=r.USER_ID ORDER BY r.End_Date";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td><?php echo $row["Reservation_ID"]; ?></td>
                            <td><?php echo $row["Start_Date"]; ?></td>
                            <td><?php echo $row["End_Date"]; ?></td>
                            <td><?php echo $row["License_plate"]; ?></td>
                            <td><?php echo $row["Promo_Code"]; ?></td>
                            <td><?php echo $row["totalAmount"]; ?></td>
                            <td><?php echo $row["USER_ID"]; ?></td>
                            <td><?php echo $row["Name"]; ?></td>
                            
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
        <div class="deletereservation">
        <a href="modifyreservation.php" class="edit-link">
            Edit Reservation Information
        </a>
        </div>
        <br>
        <div class="deletereservation">
        <a href="deletereservation.php" class="edit-link">
            Delete Reservation Information
        </a>
        </div>


