<?php

require("Database.php");
require("File.php");
if(!isset($_SESSION)) { 
    session_start(); 
} 

$response = [
    "status" => "fail"
];

if (!empty($_REQUEST["m_name"]) && !empty($_REQUEST["address_city"]) 
&& !empty($_REQUEST["address_district"]) && !empty($_REQUEST["address_detail"]) 
&& !empty($_REQUEST["m_phone"]) && !empty($_REQUEST["manager_name"]) 
&& !empty($_REQUEST["manager_phone"]) && !empty($_REQUEST["opening_hours_start"]) 
&& !empty($_REQUEST["opening_hours_end"]) && !empty($_REQUEST["delivery"])) {
    $u_id = $_SESSION["id"];
    $m_name = $_REQUEST["m_name"];
    $address_city = $_REQUEST["address_city"];
    $address_district = $_REQUEST["address_district"];
    $address_detail = $_REQUEST["address_detail"];
    $m_phone = $_REQUEST["m_phone"];
    $manager_name = $_REQUEST["manager_name"];
    $manager_phone = $_REQUEST["manager_phone"];
    $opening_hours_start = $_REQUEST["opening_hours_start"];
    $opening_hours_end = $_REQUEST["opening_hours_end"];
    $delivery = $_REQUEST["delivery"];

    $update = "
    UPDATE merchant
    SET m_name='$m_name',
        address_city='$address_city',
        address_district='$address_district',
        address_detail='$address_detail',
        m_phone='$m_phone',
        manager_name='$manager_name',
        manager_phone='$manager_phone',
        opening_hours_start='$opening_hours_start',
        opening_hours_end='$opening_hours_end',
        delivery='$delivery'
    WHERE u_id='$u_id'
    ";

    Database::$connect->query($update);
    if ($_FILES["photo"]["type"]) {
        $photo = $_FILES["photo"];
        $photoName = $photo["name"];
        File::upload($photo, "../static/img/$photoName");
        $update = "
        UPDATE merchant
        SET photo='$photoName'
        WHERE u_id='$u_id'
        ";
        Database::$connect->query($update);
    }
    $response["status"] = "success";
}


header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);