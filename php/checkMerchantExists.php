<?php

require("Database.php");
$response = [
    "status" => "fail"
];

if (!empty($_REQUEST["m_id"])) {
    $m_id = $_REQUEST["m_id"];
    $check = "
    SELECT u_id
    FROM merchant 
    WHERE u_id=$m_id
        AND m_name IS NOT NULL
        AND m_phone IS NOT NULL
        AND	opening_hours_start IS NOT NULL
        AND opening_hours_end IS NOT NULL
        AND delivery IS NOT NULL
        AND address_city IS NOT NULL
        AND address_district IS NOT NULL
        AND address_detail IS NOT NULL
    ";
    $result = Database::$connect->query($check);
    $isEmpty = true;
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $isEmpty = false;
    }
    $response["status"] = "success";
    $response["data"]["isEmpty"] = $isEmpty;
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);