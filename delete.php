<?php


$photo = $_GET['name'];
$i = $_GET['id'];
$fileName = 'json/productList.json';
$data = file_get_contents($fileName);
$arrayJson = json_decode($data,true);
unset($arrayJson[$i]);

$arr = array_values($arrayJson);

$fdata = json_encode($arr);
file_put_contents($fileName, $fdata);
unlink("photos/" . $photo);
header('Location:index.php');
?>