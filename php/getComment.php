<?php

require("Database.php");
$response = [
    "status" => "success"
];
header('Content-Type: application/json; charset=utf-8');

if(!isset($_SESSION)) { 
    session_start(); 
}

if (!empty($_REQUEST["m_id"])) {
    $m_id = $_REQUEST["m_id"];
    $getComment = "SELECT u_name, stars, content, time FROM users, comments WHERE c_id=u_id AND m_id='$m_id'";
    $result = Database::$connect->query($getComment);
    $data = [];
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        array_push($data, $row);
    }
}
else {
    if (!empty($_SESSION["type"]) && $_SESSION["type"]=='customer') {
        $c_id = $_SESSION["id"];
        $getComment = "SELECT m_name, stars, content, time FROM merchant, comments WHERE m_id=u_id AND c_id='$c_id'";
        $result = Database::$connect->query($getComment);
        $data = [];
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }
    }
    else {
        $m_id = $_SESSION["id"];
        $getComment = "SELECT u_name, stars, content, time FROM users, comments WHERE c_id=u_id AND m_id='$m_id'";
        $result = Database::$connect->query($getComment);
        $data = [];
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }
    }
}


$response["data"] = $data;

echo json_encode($response, JSON_UNESCAPED_UNICODE);