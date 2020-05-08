<?php
/*
MacBook-Pro-MiGuAJM9724
Miguel Angel Jimenez Melendez
7/May/2020
*/
$Cn = mysqli_connect("localhost","root","","swift")or die("Server not found");
mysqli_set_charset($Cn,"utf8");
$method=$_SERVER['REQUEST_METHOD'];
$objArray = json_decode( file_get_contents('php://input'), true);
$id_report = $objArray['id_report'];
 if (empty($objArray)){
   $response["success"] = 422;
   $response["message"] = "Error: Check input JSON";
   header($_SERVER['SERVER_PROTOCOL']." 422  Error: JSON input parameters are missing");
   }else{
     $response = array();
     $result = mysqli_query($Cn, "DELETE FROM report WHERE id_report = $id_report");
     if ($result) {
       $response["success"] = "201";
       $response["message"] = "Delete successful";
     }else{
       $response["success"] = "409";
       $response["message"] = "Delete not successful";
       header($_SERVER['SERVER_PROTOCOL'] . " 410: Conflict when delete");
     }
   }
   echo json_encode($response);
 ?>
