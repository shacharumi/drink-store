<?php

require("User.php");
$response = [
    "status" => "fail",
];

if (!empty($_REQUEST["account"]) && !empty($_REQUEST["password"])) {
    if (User::login($_REQUEST["account"], $_REQUEST["password"])) {
        $response["status"] = "success";
    }
    else {
        $response["error"] = "帳號或密碼錯誤";
    }
}
else {
    $response["error"] = "帳號或密碼為空";
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE);
