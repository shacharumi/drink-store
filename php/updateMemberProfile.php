<?php

require("Database.php");
header('Content-Type: application/json; charset=utf-8');

$response = [
    "status" => "fail"
];

if(!isset($_SESSION)) { 
    session_start(); 
} 

if (!empty($_REQUEST["email"]) && !empty($_REQUEST["username"]) && 
    !empty($_REQUEST["name"]) && !empty($_REQUEST["phone"])) {
    $u_id = $_SESSION["id"];
    $email = $_REQUEST["email"];
    $username = $_REQUEST["username"];
    $name = $_REQUEST["name"];
    $phone = $_REQUEST["phone"];
    $update = "UPDATE users SET email='$email', u_name='$username' WHERE u_id='$u_id'";
    $res = Database::$connect->query($update);
    if (!$res) {
        $response["error"] = Database::$connect->error;
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
    $update = "UPDATE customer SET c_name='$name', c_phone='$phone' WHERE u_id='$u_id'";
    $res = Database::$connect->query($update);
    if (!$res) {
        $response["error"] = Database::$connect->error;
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
    $response["status"] = "success";
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);