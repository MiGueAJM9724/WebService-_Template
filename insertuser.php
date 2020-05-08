<?php
/*
Miguel Angel Jimenez Melendez
05/May/2020
*/
$Cn = mysqli_connect("localhost","root","","swift")or die("Server not found");
mysqli_set_charset($Cn,"utf8");
$method=$_SERVER['REQUEST_METHOD'];
$objArray = json_decode( file_get_contents('php://input'), true);
if (empty($objArray)){
	 $response["success"] = 422;
   $response["message"] = "Error: Check input JSON";
   header($_SERVER['SERVER_PROTOCOL']." 422  Error: JSON input parameters are missing");
  }else{
    $email = $objArray['email'];
    $name = $objArray['name'];
    $last_name = $objArray['last_name'];
    $birthdate = $objArray['birthdate'];
		$sex = $objArray['sex'];
    $result = mysqli_query($Cn, "INSERT INTO users (email, name, last_name, birthdate, sex)".
    " VALUES('$email', '$name', '$last_name', '$birthdate', '$sex')");
    if ($result) {
        $response["success"] = "201";
        $response["message"] = "Insert successful";
    }else{
        $response["success"] = "409";
        $response["message"] = "Insert not successful";
        header($_SERVER['SERVER_PROTOCOL'] . " 411:Conflict when updating");
    }
  }
  echo json_encode($response);
 ?>
