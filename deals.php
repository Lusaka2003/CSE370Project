<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styleadmintable.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet" />
    <title>Show Need A CAR Deals</title>
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <img src="auto-car-logo-template-vector-icon.jpg" alt="Logo" class="header-image">
            <a href="index.php" style="text-decoration: none;">
                <h1 class="title" style="color: white;">NeedACar</h1>
            </a>
        </div>
        <h2 class="dashboard-title">Deals</h2>
    </header>
    <main>
        <section class="deal">
            <div class="deal_box">
                <h1>Offer List</h1>
                <table class="deal_table">
                    <thead>
                        <tr>
                            <th>Promo Code</th>
                       
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

