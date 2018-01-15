<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="w3.css" />
        <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script src="masonry.pkgd.min.js"></script>
        <title>Shop101</title>
    </head>
    <body background="photos/bgImage.jpg" style="background-size: cover">
        <div class="container w3-padding-16">

            <div class="w3-bar w3-border w3-card-4 w3-dark-gray" >
                <a href="index.php" class="w3-bar-item w3-button w3-large w3-padding-16 w3-blue-grey" style="text-decoration: none">My Products</a>
                <a href="addProducts.php" class="w3-bar-item w3-button w3-large w3-padding-16 " style="text-decoration: none">Add New Product</a>
                <a href="homeScreen.php" class="w3-bar-item w3-button w3-large w3-padding-16 " style="text-decoration: none">Home Screen</a>
            </div>
            <br>

            <div class="w3-bar w3-border w3-card-4 w3-margin-top w3-blue" >
                <div class="w3-bar-item w3-large w3-padding-16 ">All Products</div>
            </div>

            <div class=" w3-bar w3-border w3-card-4 w3-light-grey " >
                <div style="width:90%; margin: 0 auto; margin-top: 3%;">
                    <div class ="grid" data-masonry='{ "itemSelector": ".grid-item" }' >

                        <?php
                        $fileName = 'json/productList.json';
                        $data = file_get_contents($fileName);
                        $arrayJson = json_decode($data, true);
                        
                        foreach ($arrayJson as $key => $value) {
                            $photo = $value['photo'];
                            $name = $value['name'];
                            $price = $value['price'];
                            
                            echo '<div class="grid-item">
                            <a href ="productDetails.php?name='. $name . ' " style="text-decoration: none">
                                <div class="w3-card-4 w3-hover-opacity" style="height: 210px;width: 200px; margin: 20px">

                                    <header class="w3-container w3-blue">
                                        <img src="photos/' . $photo . '" style="height: 150px;width: 100%" >
                                    </header>

                                    <div class="w3-container" id= "name">
                                        <p>' . $name . '</p>
                                    </div>

                                    <footer class="w3-container w3-blue" id="price">
                                        <h5>NRs.'. $price . '</h5>
                                    </footer>

                                </div>
                            </a>
                        </div>';
                            
                           
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>
