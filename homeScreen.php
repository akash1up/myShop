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
        <script>
            $(document).ready(function () {
                

                $.getJSON('json/homeScreen.json', function (data) {
                    offer = data.offer;
                    contact = data.contact;
                    console.log(data.contact);
                });

                $(".menu").click(function () {
                    var nameValue = $(this).attr('id');
                    $(".modal-body #name").text(nameValue);
                    
                    
                    if( nameValue === "offer" ){
                        var f = document.createElement("form");
                        f.setAttribute('method', "post");
                        f.setAttribute('action', "submit.php");
                        f.setAttribute('id' , "form");

                        var i = document.createElement("input"); //input element, text
                        i.setAttribute('type', "text");
                        i.setAttribute('name', "username");

                        var s = document.createElement("input"); //input element, Submit button
                        s.setAttribute('type', "submit");
                        s.setAttribute('value', "Submit");

                        f.appendChild(i);
                        f.appendChild(s);

                        var modal = document.getElementById("modal-body");

                        modal.appendChild(f);
                    }
                    
                    if( nameValue === "Developer"){
                        $("#form").remove();
                    }

                    
                });
            });
        </script>

    </head>

    <body background="photos/bgImage.jpg" style="background-size: cover">
        <div class="container w3-padding-16">

            <div class="w3-bar w3-border w3-card-4 w3-dark-gray" >
                <a href="index.php" class="w3-bar-item w3-button w3-large w3-padding-16" style="text-decoration: none">My Products</a>
                <a href="addProducts.php" class="w3-bar-item w3-button w3-large w3-padding-16 " style="text-decoration: none">Add New Product</a>
            </div>
            <br>
            <div class="w3-bar w3-border w3-card-4 w3-margin-top w3-blue" >
                <div class="w3-bar-item w3-large w3-padding-16 ">All Products</div>
            </div>

            <div class=" w3-bar w3-border w3-card-4 w3-light-grey " >
                <div style="width:90%; margin: 0 auto; margin-top: 3%;">


                    <?php
                    $fileName = 'json/homeScreen.json';
                    $data = file_get_contents($fileName);
                    $arrayJson = json_decode($data, true);
                    print_r($arrayJson);
                    echo $arrayJson["menu"][0]["name"];
                    print_r($arrayJson["menu"]);
                    echo count($arrayJson["menu"]);
                    $numberOfTableRows = ceil(count($arrayJson) / 2.0);

                    $arrayKey = 0;
                    $totalNumber = ceil(count($arrayJson)) - 1;
                    for ($ndx = 0; $ndx < $numberOfTableRows; $ndx++) {
                        ?>

                        <div class="row">

                            <div class="col-sm-3" >

                            </div>

                            <div class="col-sm-3" style="border: thin solid black;text-align: center;margin:auto" >

                                <p>
                                    <?php
                                    $icon = $arrayJson["menu"][$arrayKey]['icon'];
                                    $name = $arrayJson["menu"][$arrayKey]['name'];

                                    echo '<img src="photos/' . $icon . '" style="height: 210px;width: 200px" data-toggle="modal" href="#myModal" class="menu" id="' . $name . '">';
                                    $arrayKey += 1;
                                    ?> 
                                </p>
                            </div>

                            <div class="col-sm-3" style="border: thin solid black;text-align: center;margin:auto">
                                <p>
                                    <?php
                                    if ($arrayKey > $totalNumber) {
                                        echo '<img src="photos/blank.png" style="height: 210px;width: 200px " >';
                                    } else {
                                        $icon = $arrayJson["menu"][$arrayKey]['icon'];
                                        $name = $arrayJson["menu"][$arrayKey]['name'];

                                        echo '<img src="photos/' . $icon . '" style="height: 210px;width: 200px" data-toggle="modal" href="#myModal" class="menu" id="' . $name . '">';
                                    }
                                    $arrayKey += 1;
                                    ?>
                                </p>
                            </div>

                            <div class="col-sm-3" >
                            </div>

                        </div>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <p class="modal-title"><?php ?></p>
                                    </div>
                                    <div class="modal-body" id="modal-body">
                                        <p id="name"></p>
                                        <p id = "cookie"></p>
                                        

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <?php
                    }
//                    
                    ?>


                </div>
            </div>
        </div>




    </body>
</html>
