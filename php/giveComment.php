<?php

require("Database.php");
if(!isset($_SESSION)) { 
    session_start(); 
}
date_default_timezone_set('Asia/Taipei');

$response = [
    "status" => "fail"
];

if (!empty($_SESSION["type"]) && $_SESSION["type"]=='customer') {
    $c_id = $_SESSION["id"];
    $m_id = $_REQUEST["m_id"];
    $stars = $_REQUEST["stars"];
    $content = $_REQUEST["content"];
    $time = date('Y-m-d H:i:s');
    $giveComment = "
        INSERT INTO comments
        (c_id, m_id, stars, content, time)
        VALUES
        ('$c_id', '$m_id', '$stars', '$content', '$time')
        ON DUPLICATE KEY UPDATE stars='$stars', content='$content', time='$time'
    ";
    Database::$connect->query($giveComment);
    $response["status"] = "success";
    $response["data"] = Database::$connect->error;
}



header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);