<?php

require("Database.php");
if(!isset($_SESSION)) { 
    session_start(); 
} 
header('Content-Type: application/json; charset=utf-8');
date_default_timezone_set('Asia/Taipei');

$response = [
    "status" => "fail"
];


$c_id = $_SESSION["id"];
$m_id = $_REQUEST["m_id"];
$time = date('Y-m-d H:i:s');

// begin transaction
Database::$connect->autocommit(False);
$generateOrder = "
    INSERT INTO orders
    (c_id, m_id, order_time)
    VALUES
    ($c_id, $m_id, '$time');
";
$isSuccessful = Database::$connect->query($generateOrder);
if (!$isSuccessful) {
    $response["data"] = Database::$connect->error;
    Database::$connect->rollback();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}
$getOid = "SELECT o_id FROM orders WHERE c_id='$c_id' AND m_id='$m_id' AND order_time='$time'";
$result = Database::$connect->query($getOid);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $o_id = $row["o_id"];
}
foreach($_REQUEST["orders"] as $b_id => $order) {
    $price = $order['price'];
    $quantity = $order['quantity'];
    $sugar = $order['sugar'];
    $ice = $order['ice'];
    $generateOrderDetail = "
        INSERT INTO order_beverage
        (o_id, b_id, sugar, ice, quantity)
        VALUES
        ($o_id, $b_id, $sugar, $ice, $quantity)
    ";
    $isSuccessful = Database::$connect->query($generateOrderDetail);
    if (!$isSuccessful) {
        $response["data"] = Database::$connect->error;
        Database::$connect->rollback();
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
Database::$connect->autocommit(True);
$response["status"] = "success";
echo json_encode($response, JSON_UNESCAPED_UNICODE);