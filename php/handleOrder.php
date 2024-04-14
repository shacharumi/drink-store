<?php

require("Database.php");

$response = [
    "status" => "fail"
];

if (!empty($_REQUEST["o_id"]) && !empty($_REQUEST["accept"])) {
    $o_id = $_REQUEST["o_id"];
    $accept = $_REQUEST["accept"];
    date_default_timezone_set('Asia/Taipei');
    $time = date('Y-m-d H:i:s');
    $updateOrder = "UPDATE orders SET is_accepted='$accept', accepted_time='$time' WHERE o_id='$o_id'";
    Database::$connect->query($updateOrder);
    $response["status"] = "success";
}


header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);