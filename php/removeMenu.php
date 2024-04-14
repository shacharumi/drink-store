<?php

require("Database.php");
if(!isset($_SESSION)) { 
    session_start(); 
} 

$response = [
    "status" => "fail"
];

$u_id = $_SESSION["id"];
$b_id = $_REQUEST["b_id"];
$delete = "
    DELETE FROM menu_beverage
    WHERE u_id=$u_id
    AND b_id=$b_id
";
Database::$connect->query($delete);
$response["status"] = "success";

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);