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
    $response = array();
    $objArray = json_decode(file_get_contents('php://input'), true);
    $id_product = $objArray ['id_product'];
    $result = mysqli_query($Cn,"SELECT * FROM product WHERE id_product = $id_product");
    if (!empty($result)) {
        $response["success"] = "202";
        $response["message"] = "Products Found";

        $response["product"] = array();
        foreach ($result as $tupla){
            array_push($response["product"], $tupla);
        }
    }
    else{
        $response["success"] = "204";
        $response["message"] = "Products not found";
        header($_SERVER['SERVER_PROTOCOL'] . " 500  Internal server error");
    }
    echo json_encode($response);
 ?>
