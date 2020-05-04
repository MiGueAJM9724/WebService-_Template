<?php
/*
Miguel Angel Jimenez Melendez
3/May/2020
Code to locate
a product
*/
$Cn = mysqli_connect("localhost","root","","Inventario")or die("Server not found");
mysqli_set_charset($Cn,"utf8");
$method=$_SERVER['REQUEST_METHOD'];
$objArray = json_decode( file_get_contents('php://input'), true);
if (empty($objArray)){
	 $response["success"] = 422;
   $response["message"] = "Error: Check input JSON";
   header($_SERVER['SERVER_PROTOCOL']." 422  Error: JSON input parameters are missing");
  }else{
    $id_product = $objArray['id_product'];
    $name_product = $objArray['name_product'];
    $existence = $objArray['existence'];
    $price = $objArray['price'];
    //$response = array();
    $result = mysqli_query($Cn, "UPDATE product SET name_product = '$name_product'".
    ", existence = $existence, price = $price WHERE id_product = $id_product");
    if ($result) {
        $response["success"] = "201";
        $response["message"] = "Update successful";
    }else{
        $response["success"] = "409";
        $response["message"] = "Update not successful";
        header($_SERVER['SERVER_PROTOCOL'] . " 411:Conflict when updating");
    }
  }
  echo json_encode($response);
 ?>
