<?php
/*
Miguel Angel Jimenez Melendez
7/May/2020
*/
$Cn = mysqli_connect("localhost","root","","swift")or die("Server not found");
mysqli_set_charset($Cn,"utf8");
    $method=$_SERVER['REQUEST_METHOD'];
    $response = array();
    $objArray = json_decode(file_get_contents('php://input'), true);
    $email = $objArray ['email'];
    $result = mysqli_query($Cn,"SELECT * FROM users WHERE email = '$email'");
    if (!empty($result)) {
        $response["success"] = "202";
        $response["message"] = "User Found";

        $response["user"] = array();
        foreach ($result as $tupla){
            array_push($response["user"], $tupla);
        }
    }
    else{
        $response["success"] = "204";
        $response["message"] = "user not found";
        header($_SERVER['SERVER_PROTOCOL'] . " 500  Internal server error");
    }
    echo json_encode($response);
 ?>
