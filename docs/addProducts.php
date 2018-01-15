<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My Shop: Add New Product</title>
        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="w3.css" />
        <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    </head>
    <body background="photos/bgImage.jpg" style="background-size: cover">
        <div class="container w3-padding-16">

            <div class="w3-bar w3-border w3-card-4 w3-dark-gray" >
                <a href="index.php" class="w3-bar-item w3-button w3-large w3-padding-16" style="text-decoration: none">My Products</a>
                <a href="#" class="w3-bar-item w3-button w3-large w3-padding-16 w3-blue-grey" style="text-decoration: none">Add New Product</a>
            </div>
            <br>
            <?php
            if (isset($_POST["submit"])) {
                $target_dir = "photos/";
                $name = $_POST['name'];
                $category = $_POST['category'];
                $price = $_POST['price'];
                $features = $_POST['features'];
                $productId = $_POST['productId'];
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $uploadOk = 1;



                if ($_FILES["photo"]["tmp_name"] == null) {

                    echo '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Upload an image.</div>';
                    $uploadOk = 0;
                } else {
                    $check = getimagesize($_FILES["photo"]["tmp_name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    if ($check == false) {
                        echo '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>File is not an image.</div>';
                        $uploadOk = 0;
                    }
                    if (file_exists($target_file)) {
                        echo '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Sorry, file already exists.</div>';
                        $uploadOk = 0;
                    }
                    if ($_FILES["photo"]["size"] > 500000) {
                        echo '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Sorry, your file is too large.</div>';
                        $uploadOk = 0;
                    }
                    if ($imageFileType != "png") {
                        echo '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Sorry PNG  files are allowed.</div>';
                        $uploadOk = 0;
                    }
                }



                if ($productId == null or strlen(trim($productId)) == 0) {
                    $uploadOk = 0;
                    echo '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Enter product id.</div>';
                }

                if ($name == null or strlen(trim($name)) == 0) {
                    $uploadOk = 0;
                    echo '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Enter name.</div>';
                }


                if ($category == null or strlen(trim($category)) == 0) {
                    $uploadOk = 0;
                    echo '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Enter category.</div>';
                }



                if ($features == null or strlen(trim($features)) == 0) {
                    $uploadOk = 0;
                    echo '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Enter features.</div>';
                }
                if ($price == null or strlen(trim($price)) == 0) {
                    $uploadOk = 0;
                    echo '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Enter price.</div>';
                }
// Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo '<div class="alert alert-warning alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Sorry, your product was not added.</div>';
// if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                        $fileName = 'json/productList.json';
                        $data = file_get_contents($fileName);
                        $phpProducts = json_decode($data, true);
                        $photoName = basename($_FILES["photo"]["name"]);

                        $p = array(
                            'productId' => $_POST['productId'],
                            'name' => $_POST['name'],
                            'category' => $_POST['category'],
                            'features' => $_POST['features'],
                            'price' => $_POST['price'],
                            'photo' => $photoName
                        );

                        $phpProducts[] = $p;
                        $fdata = json_encode($phpProducts);
                        file_put_contents($fileName, $fdata);
                        echo "The product has been added.<br>";
                    }
                }
            }
            ?>

            <div class="w3-bar w3-border w3-card-4 w3-margin-top w3-blue" >
                <div class="w3-bar-item w3-large w3-padding-16 ">Enter Product Details</div>
            </div>


            <div class=" w3-bar w3-border w3-card-4 w3-light-grey " style="padding-top:5%;padding-right: 15%;padding-left: 15%" >
                
                        <form class = "w3-container " method="post"  enctype="multipart/form-data">

                        <label>Product Id:</label>
                        <input class="w3-input" type="number" name="productId" id="productId">
                        <br>

                        <label>Product Name:</label>
                        <input class="w3-input" type="text" name="name" id="name">
                        <br>

                        <label>Product Category:</label>
                        <input class="w3-input" type="text" name="category" id="category">
                        <br>

                        <label>Features:</label>
                        <input class="w3-input" type="text" name="features" id="features">
                        <br>



                        <label>Photo:</label>


                        <input type="file" name="photo" id="photo">

                        <br>

                        <label>Price:</label>
                        <input class="w3-input" type="number" name="price" id="price">
                        <br>

                        <input type="submit" value="Submit" name="submit" class="w3-button w3-white w3-border w3-border-blue w3-round-large w3-margin-bottom">

                    </form>
                    
                    
                </div>
            </div>
        </div>


        <?php
// put your code here
        echo 'This is a test';
        ?>
    </body>
</html>
