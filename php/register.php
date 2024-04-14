<?php

require("User.php");
$response = [
    "status" => "fail",
];

if (!empty($_REQUEST["email"]) && !empty($_REQUEST["username"])
    && !empty($_REQUEST["password"]) && !empty($_REQUEST["phone"]) 
    && !empty($_REQUEST["type"])) {
    if($_REQUEST["type"] === "customer" || $_REQUEST["type"] === "merchant") {
        if (User::register($_REQUEST["email"], $_REQUEST["username"], 
            $_REQUEST["password"], $_REQUEST["phone"], $_REQUEST["type"])) {
            $response["status"] = "success";
        }
        else {
            // TODO : replace error messages
            $response["error"] = User::$error;
        }
    }
    else {
        $response["error"] = "請選擇註冊身分";
    }
}
else {
    $response["error"] = "不能有任何資料為空";
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);