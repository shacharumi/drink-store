<?php

require("Database.php");
if(!isset($_SESSION)) { 
    session_start(); 
} 
header('Content-Type: application/json; charset=utf-8');

$response = [
    "status" => "fail"
];

$u_id = $_SESSION["id"];
$b_name = $_REQUEST["b_name"];
$price = $_REQUEST["price"];
$sugar = $_REQUEST["sugar"];
$ice = $_REQUEST["ice"];

// begin transaction
Database::$connect->autocommit(False);
$addMenu = "
    INSERT INTO menu_beverage
    (u_id, b_name, price)
    VALUES
    ('$u_id', '$b_name', '$price')
";
$isSuccessful = Database::$connect->query($addMenu);
if (!$isSuccessful) {
    $response["error"] = Database::$connect->error;
    Database::$connect->rollback();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}
$getId = "SELECT b_id FROM menu_beverage WHERE u_id='$u_id' AND b_name='$b_name'";
$result = Database::$connect->query($getId);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $b_id = $row["b_id"];
}
foreach($sugar as $s) {
    $addSugarOptions = "
        INSERT INTO sugar_type
        (b_id, sugar_value)
        VALUES
        ('$b_id', '$s')
    ";
    $isSuccessful = Database::$connect->query($addSugarOptions);
    if (!$isSuccessful) {
        $response["error"] = Database::$connect->error;
        Database::$connect->rollback();
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
foreach($ice as $i) {
    $addIceOptions = "
        INSERT INTO ice_type
        (b_id, ice_value)
        VALUES
        ('$b_id', '$i')
    ";
    $isSuccessful = Database::$connect->query($addIceOptions);
    if (!$isSuccessful) {
        $response["error"] = Database::$connect->error;
        Database::$connect->rollback();
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
Database::$connect->autocommit(True);
$response["status"] = "success";
echo json_encode($response, JSON_UNESCAPED_UNICODE);