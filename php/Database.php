<?php

class Database {
    public static $connect;
    static function connect() {
        $host = "localhost";
        $user = "root";
        $pswd = "";
        $db = "beverage_shop";
        self::$connect = new mysqli($host, $user, $pswd, $db);
        self::$connect->query("SET NAMES 'utf8'");
    }
}
Database::connect();
