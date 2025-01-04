<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Listing</title>
    <link rel="stylesheet" href="style4.css">
</head>
<body>
    
<section class="cars">
            <div class="car_box">
                <h1>Avialable Car List</h1>
                <h1>Copy the license plate of the car you want rent and proceed to Rent Now</h1>
                <table class="car_table">
                    <thead>
                        <tr>
                            <th>License Plate</th>
                            <th>Seating Capacity</th>
                            <th>Car Type</th>
                            <th>Car Model</th>
                            <th>Car Brand</th>
                            <th>Color</th>
                            <!-- <th>Car Availability</th> -->
                            <th>Rent Per Day</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        require_once("connect.php");
                        $sql = "SELECT * FROM car where Status='Available'";
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
                            <!-- <td><?php echo $row["Status"]; ?></td> -->
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
    <section class=car_pictures>
        <br>
        <a href="sortprice.php" style="text-decoration: none;">
    <h1 class="rentnow" style="color: green; text-align: center;">Sort by Price</h1>
    </a>
    <br>

    <a href="rentnow.php" style="text-decoration: none;">
    <h1 class="rentnow" style="color: green; text-align: center;">RENT NOW</h1>
</a>
    <br>
    <div class="container">
        <div class="car">
            <img src="1992-1995_Honda_Civic_sedan_--_03-21-2012.JPG" alt="Car 1">
            <h3>Honda Civic</h3>
            <p>Price: 3000 taka/day</p>
            
        </div>
        <div class="car">
            <img src="corolla.jpg" alt="Car 2">
            <h3>Toyota Corolla</h3>
            <p>Price: 3000 taka/day</p>
       
        </div>
        <div class="car">
            <img src="premio.jpg" alt="Car 3">
            <h3>Toyota Premio</h3>
            <p>Price: 3000 taka/day</p>
        </div>
        <div class="car">
            <img src="allion.jpg" alt="Car 4">
            <h3>Toyota Allion</h3>
            <p>Price: 3500 taka/day</p>
        </div>
        <div class="car">
            <img src="subaru forestar.jpg" alt="Car 5">
            <h3>Subaru Forestar</h3>
            <p>Price: 3000 taka/day</p>
        </div>
        <div class="car">
            <img src="nissan.jpg" alt="Car 6">
            <h3>Nissan Silvia</h3>
            <p>Price: 4000 taka/day</p>
        </div>
    </div>
    </section>
</body>
</html>
