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
                <a href="addProducts.php" class="w3-bar-item w3-button w3-large w3-padding-16 " style="text-decoration: none">Add New Product</a>
            </div>
            <br>
            <?php
            if (isset($_POST["submit"])) {
                $name = $_POST['name'];
                $target_dir = "photos/";
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);

                if (basename($_FILES["photo"]["name"]) != null) {

                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $check = getimagesize($_FILES["photo"]["tmp_name"]);
                    if ($check !== false) {
                        echo "<br>File is an image - <br>" . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.<br>";
                        $uploadOk = 0;
                    }

                    if (file_exists($target_file)) {
                        echo "Sorry, file already exists.<br>";
                        $uploadOk = 0;
                    }
// Check file size
                    if ($_FILES["photo"]["size"] > 500000) {
                        echo "Sorry, your file is too large.<br>";
                        $uploadOk = 0;
                    }
// Allow certain file formats
                    if ($imageFileType != "png") {
                        echo "Sorry PNG  files are allowed.<br>";
                        $uploadOk = 0;
                    }
// Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.<br>";
// if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                            echo "The file " . basename($_FILES["photo"]["name"]) . " has been uploaded.<br>";
                        } else {
                            echo "Sorry, there was an error uploading your file.<br>";
                        }
                    }
                }


                $fileName = 'json/productList.json';
                $data = file_get_contents($fileName);
                $arrayJson = json_decode($data, true);
                $phpProducts = json_decode($data, true);
                $photoName = basename($_FILES["photo"]["name"]);


                foreach ($arrayJson as $key => $value) {
                    if ($value['name'] == $_GET['name']) {
                        if ($photoName == null) {
                            $pN = $value['photo'];
                            $delFile = 0;
                        } else {
                                                        $pN = $photoName;

                            $delFile = 1;
                        };
                        $oldPhoto = $value['photo'];
                        $p = array(
                            'productId' => $_POST['productId'],
                            'name' => $_POST['name'],
                            'category' => $_POST['category'],
                            'features' => $_POST['features'],
                            'price' => $_POST['price'],
                            'photo' => $pN
                        );

                        $phpProducts[$key] = $p;
                        $fdata = json_encode($phpProducts);
                        file_put_contents($fileName, $fdata);
                    }
                    
                    if ($delFile == 1) {
                        header('Location:filedel.php?name=' . $oldPhoto);
                    } else {
                        header('Location:index.php');
                    }
                }
            }
            ?>


            <div class="w3-bar w3-border w3-card-4 w3-margin-top w3-blue" >
                <div class="w3-bar-item w3-large w3-padding-16 ">Edit</div>
            </div>


            <div class=" w3-bar w3-border w3-card-4 w3-light-grey " style="padding-top:5%;padding-right: 15%;padding-left: 15%" >
<?php
$fileName = 'json/productList.json';
$data = file_get_contents($fileName);
$arrayJson = json_decode($data, true);
$i = 0;
$name = $_GET['name'];
foreach ($arrayJson as $key => $value) {
    if ($value['name'] == $name) {
        $productId = (int) $value['productId'];
        $category = $value['category'];
        $features = $value['features'];
        $price = $value['price'];
        $photo = $value['photo'];
        echo '<form class = "w3-container " method="post"  enctype="multipart/form-data">

                    <label>Product Id:</label>
                    <input class="w3-input" type="number" name="productId" id="productId" value=' . $productId . '>
                    <br>

                    <label>Product Name:</label>
                    <input class="w3-input" type="text" name="name" id="name" value =' . $name . '>
                    <br>

                    <label>Product Category:</label>
                    <input class="w3-input" type="text" name="category" id="category" value=' . $category . '>
                    <br>

                    <label>Features:</label>
                    <input class="w3-input" type="text" name="features" id="features" value =' . $features . '>
                    <br>



                    <label>Photo:</label><br>

                    <img src="photos/' . $photo . '" class="w3-border w3-padding" alt="bike"><br>
                    <label>Upload Another Photo:</label><br>

                    <input type="file" name="photo" id="photo" >

                    <br>

                    <label>Price:</label>
                    <input class="w3-input" type="number" name="price" id="price" value =' . $price . '>
                    <br>

                    <input type="submit" value="Submit" name="submit" class="w3-button w3-white w3-border w3-border-blue w3-round-large w3-margin-bottom">

                </form>';
        break;
    }
    $i++;
}
?>



            </div>
        </div>



    </body>
</html>
