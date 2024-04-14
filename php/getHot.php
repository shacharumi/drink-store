<?php

require("Database.php");

$response = [
    "status" => "fail"
];

$getInfo = "
    SELECT *
    FROM merchant, orders 
    WHERE merchant.u_id=orders.m_id
    GROUP BY m_id
    ORDER BY COUNT(*) DESC
    LIMIT 6
";
$result = Database::$connect->query($getInfo);
$data = [];
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $m_id = $row["m_id"];
    $comments = [];
    $getComments = "
        SELECT *
        FROM comments
        WHERE m_id=$m_id
        ORDER BY time
        LIMIT 2
    ";
    $res = Database::$connect->query($getComments);
    while ($r = $res->fetch_array(MYSQLI_ASSOC)) {
        array_push($comments, $r);
    }
    $getHotBeverage = "
    SELECT b_name, s.sum_q
    FROM (
        SELECT b_name, SUM(quantity) AS sum_q
        FROM order_beverage AS o, menu_beverage AS m
        WHERE o.b_id=m.b_id
            AND o_id IN (
                SELECT o_id 
                FROM orders 
                WHERE m_id=$m_id
            )
        GROUP BY o.b_id
    ) AS s
    ";
    $max = 0;
    $res = Database::$connect->query($getHotBeverage);
    while ($r = $res->fetch_array(MYSQLI_ASSOC)) {
        if ($max < $r["sum_q"]) {
            $hot = $r["b_name"];
        }
    }

    array_push($data, [
        "info" => $row,
        "comments" => $comments,
        "hot" => $hot,
    ]);
}
$response["data"] = $data;
$response["status"] = "success";

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);