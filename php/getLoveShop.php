<?php

require("Database.php");

$response = [
    "status" => "fail"
];

if(!isset($_SESSION)) { 
    session_start(); 
} 

if (!empty($_SESSION["type"]) && $_SESSION["type"]==="customer") {
    $response["status"] = "success";
    $data = [];
    $u_id = $_SESSION["id"];
    $getInfo = "SELECT m_id, m_name FROM merchant, love_shop WHERE u_id=m_id AND c_id='$u_id'";
    $result = Database::$connect->query($getInfo);
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        array_push($data, $row);
    }
    $response["data"] = $data;
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);