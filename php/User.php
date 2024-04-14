<?php

require("Database.php");
class User {
    public static $error = NULL;
    static function isValid($account, $password) {
        $hashPassword = hash("sha256", $password);
        $select = "SELECT Password FROM users WHERE email='$account' OR u_name='$account'";
        $result = Database::$connect->query($select);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            if ($row["Password"] === $hashPassword) {
                return true;
            }
            break;
        }
        return False;
    }
    static function createSession($data) {
        session_start();
        foreach ($data as $key => $val) {
            $_SESSION[$key] = $val;
        }
    }
    static function createCookie($data) {
        foreach ($data as $key => $val) {
            setcookie($key, $val, time()+60*60, "/", "", 0);
        }
    }
    static function login($account, $password) {
        if (self::isValid($account, $password)) {
            $select = "SELECT * FROM users WHERE email='$account' OR u_name='$account'";
            $result = Database::$connect->query($select);
            $data = [];
            $token = bin2hex(random_bytes(16));  # 32 bits
            while ($row = $result->fetch_array(MYSQLI_ASSOC)){
                $data["id"] = $row["u_id"];
                $data["type"] = $row["type"];
                $data["token"] = $token;
                self::createSession($data);
                self::createCookie($data);
                return true;
            }
        }
        return False;
    }
    static function logout() {
        if (isset($_SERVER['HTTP_REFERER'])) {
            foreach ($_COOKIE as $key=>$value) {
                setcookie($key, "", time()-3600, "/", "", 0);
            }
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        else {
            header("Location: ./");
        }
    }
    static function check() {
        if(!isset($_SESSION)) { 
            session_start(); 
        } 
        if (!empty($_COOKIE["token"])) {
            if (!empty($_SESSION["token"]) && $_SESSION["token"]===$_COOKIE["token"]) {
                return true;
            }
        }
        return False;
    }

    static function register($email, $username, $password, $phone, $type) {
        $hashPassword = hash("sha256", $password);
        
        // begin transaction
        Database::$connect->autocommit(False);
        $insert = "
            INSERT INTO 
            users(email, u_name, password, type) 
            VALUES('$email', '$username', '$hashPassword', '$type')
        ";
        $isSuccessful = Database::$connect->query($insert);
        if (!$isSuccessful) {
            self::$error = Database::$connect->error;
            Database::$connect->rollback();
            return False;
        }
        $getId = "SELECT u_id FROM users WHERE email='$email'";
        $result = Database::$connect->query($getId);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $u_id = $row["u_id"];
        }
        if ($type === "customer") {
            $insert = "INSERT INTO customer(u_id, c_phone) VALUES($u_id, '$phone')";
        }
        else{
            $insert = "INSERT INTO merchant(u_id, m_phone) VALUES($u_id, '$phone')";
        }
        $isSuccessful = Database::$connect->query($insert);
        if ($isSuccessful) {
            Database::$connect->autocommit(True);
            return True;
        }
        self::$error = Database::$connect->error;
        Database::$connect->rollback();
        return False;
    }
}

?>