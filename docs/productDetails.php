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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script src="js/function.js" type="text/javascript"></script>
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <title>My Shop :My Products</title>

    </head>
    <body background="photos/bgImage.jpg" style="background-size: cover">
        <div class="container w3-padding-16">
            <div class="w3-bar w3-border w3-card-4 w3-dark-gray" >
                <a href="index.php" class="w3-bar-item w3-button w3-large w3-padding-16 w3-blue-grey" style="text-decoration: none">My Products</a>
                <a href="addProducts.php" class="w3-bar-item w3-button w3-large w3-padding-16 " style="text-decoration: none">Add New Product</a>
            </div>
            <br>
            <div class="w3-bar w3-border w3-card-4 w3-margin-top w3-blue" >
                <div class="w3-bar-item w3-large w3-padding-16 ">Product Details</div>
            </div>
            <div class=" w3-bar w3-border w3-card-4 w3-light-grey " >
                <?php
                $name = $_GET['name'];
                $fileName = 'json/productList.json';
                $data = file_get_contents($fileName);
                $arrayJson = json_decode($data, true);
                
                foreach ($arrayJson as $key => $value) {
                    if ($value['name'] == $name) {
                        $productId = $value['productId'];
                        $category = $value['category'];
                        $features = $value['features'];
                        $price = $value['price'];
                        $photo = $value['photo'];
                        
                        echo '<div class="row" style="padding:2%">
                            
                                <div class="col-sm-6">
                                   <div class="w3-card-4">
                                   <img src="photos/' . $photo . ' " class="w3-animate-zoom" alt="Person" style="height:100%;width:100%">
                                   </div>
                                </div>
                                
                                <div class="col-sm-6 ">
                                <div class="w3-card-4">

                                <header class="w3-container w3-blue">
                                    <h1>Product ID</h1>
                                </header>
                                <div class="w3-container">
                                    <p>' . $productId . '</p>
                                </div>
                                




                            </div>
                            <br>
                            <br>
                            
                            <div class="w3-card-4">
                                <header class="w3-container w3-blue">
                                    <h1>Name</h1>
                                </header>

                                <div class="w3-container">
                                    <p>' . $name . '</p>
                                </div>
                            </div>
                            <br>
                            <br>
                            

                            <div class="w3-card-4">
                                <header class="w3-container w3-blue">
                                    <h1>Category</h1>
                                </header>

                                <div class="w3-container">
                                    <p>' . $category . '</p>
                                </div>
                            </div>
                            <br>
                            <br>
                            

                            <div class="w3-card-4">
                                <header class="w3-container w3-blue">
                                    <h1>Features</h1>
                                </header>

                                <div class="w3-container">
                                    <p>' . $features . '</p>
                                </div>
                            </div>
                            <br>
                            <br>
                            
                            <div class="w3-card-4">
                                <header class="w3-container w3-blue">
                                    <h1>Price</h1>
                                </header>

                                <div class="w3-container">
                                    <p>NRs.' . $price . '</p>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div >
                            <a href="edit.php?name='.$name. ' " class = "btn btn-default" style = "text-decoration:none">Edit</a>
                                


                                
                                    <!-- Trigger the modal with a button -->
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Delete</button>

                                <!-- Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content" >
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                  </div>
                                  <div class="modal-body" style="text-align:center">
                                  <script>
                                  function proceed(){

                                     window.location.assign("delete.php?name=' . $photo . '&id=' . $key . '");
                                    }
                                  </script>
                                    <p >Are you sure you want to delete the product ?</p>
                                    <div >
                                    <button type="button" class="btn btn-default" onClick="proceed()" style = "width:20%"> Yes</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal" style = "width:20%">No</button>
                                    </div>
                                  </div>
      
                                    </div>

                                  </div>
                                </div>
                                   
                                </div>
                                
                            </div>';                        
                        break;
                    }
                    
                }
                ?>

            </div>

    </body>
</html>
