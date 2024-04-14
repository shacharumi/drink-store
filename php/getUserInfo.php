<?php

require("Database.php");

$response = [
    "status" => "fail"
];

if(!isset($_SESSION)) { 
    session_start(); 
} 

if (!empty($_SESSION["type"])) {
    $response["status"] = "success";
    $data = [];
    $u_id = $_SESSION["id"];
    if ($_SESSION["type"]==="customer") {
        $getInfo = "SELECT * FROM users, customer WHERE users.u_id=customer.u_id AND users.u_id='$u_id'";
        $result = Database::$connect->query($getInfo);
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $data["username"] = $row["u_name"];
            $data["email"] = $row["email"];
            $data['name'] = $row["c_name"];
            $data["phone"] = $row["c_phone"];
        }
    }
    else {
        $getInfo = "SELECT * FROM users, merchant WHERE users.u_id=merchant.u_id AND users.u_id='$u_id'";
        $result = Database::$connect->query($getInfo);
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $data = $row;
        }
    }
    $response["data"] = $data;
}


header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);