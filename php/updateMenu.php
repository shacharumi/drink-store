<?php

require("Database.php");
if(!isset($_SESSION)) { 
    session_start(); 
} 

$value = ['0', '1', '3', '5', '7', '10'];

$response = [
    "status" => "fail"
];

$u_id = $_SESSION["id"];
$b_id = $_REQUEST["b_id"];
$b_name = $_REQUEST["b_name"];
$price = $_REQUEST["price"];
$sugar = $_REQUEST["sugar"];
$ice = $_REQUEST["ice"];

$updateMenu = "
    UPDATE menu_beverage 
    SET b_name='$b_name', price='$price'
    WHERE u_id='$u_id'
        AND b_id='$b_id'
";
Database::$connect->query($updateMenu);

$del = array_diff($value, $sugar);
foreach ($sugar as $s) {
    $updateSugar = "
        INSERT INTO sugar_type(b_id, sugar_value)
        VALUES($b_id, $s)
        ON DUPLICATE KEY 
            UPDATE b_id=$b_id, sugar_value=$s
    ";
    Database::$connect->query($updateSugar);
}
foreach ($del as $s) {
    $deleteSugar = "DELETE FROM sugar_type WHERE b_id=$b_id AND sugar_value=$s";
    Database::$connect->query($deleteSugar);
}

$del = array_diff($value, $ice);
foreach ($ice as $i) {
    $updateIce = "
        INSERT INTO ice_type(b_id, ice_value)
        VALUES($b_id, $i)
        ON DUPLICATE KEY 
            UPDATE b_id=$b_id, ice_value=$i
    ";
    Database::$connect->query($updateIce);
}
foreach ($del as $i) {
    $deleteIce = "DELETE FROM ice_type WHERE b_id=$b_id AND ice_value=$i";
    Database::$connect->query($deleteIce);
}

$response["status"] = "success";

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);