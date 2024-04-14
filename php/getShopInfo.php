<?php

require("Database.php");

$response = [
    "status" => "fail"
];
if(!empty($_REQUEST["m_id"])) {
    $response["status"] = "success";
    $data = [];
    $u_id = $_REQUEST["m_id"];
    $getInfo = "SELECT * FROM merchant WHERE u_id='$u_id'";
    $result = Database::$connect->query($getInfo);
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $data = $row;
    }
    $response["data"] = $data;
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);