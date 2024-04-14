<?php

require("Database.php");
if(!isset($_SESSION)) { 
    session_start(); 
}

$response = [
    "status" => "fail"
];

if (!empty($_SESSION["type"]) && $_SESSION["type"]=='merchant') {
    $m_id = $_SESSION["id"];
    $getOrders = "
    SELECT *
    FROM orders
    WHERE is_accepted IS NULL
        AND m_id=$m_id
    ";
    $result = Database::$connect->query($getOrders);
    $o_ids = [];
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $o_ids[$row['o_id']] = $row["order_time"];
    }

    $data = [];
    foreach($o_ids as $o_id => $time) {
        $cost = 0;
        $getOrderDetail = "
            SELECT *
            FROM order_beverage, menu_beverage
            WHERE o_id=$o_id
                AND order_beverage.b_id=menu_beverage.b_id
        ";
        $result = Database::$connect->query($getOrderDetail);
        $data[$o_id] = [];
        $data[$o_id]["orders"] = [];
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {;
            $cost += $row["price"] * $row["quantity"];
            array_push($data[$o_id]["orders"], $row);
        }
        $data[$o_id]["cost"] = $cost;
        $data[$o_id]["time"] = $time;
    }
    $response["data"] = $data;
    $response["status"] = "success";
}


header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);