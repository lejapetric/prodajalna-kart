<?php
class User {
    
    public static function login($user) {
        $_SESSION["user"] = $user;
    }

    public static function logout() {
        session_destroy();
    }

    public static function isLoggedIn() {
        return isset($_SESSION["user"]) && is_array($_SESSION["user"]);
    }

    public static function getName() {
        if (!self::isLoggedIn()) {
            return "Gost";
        }
        
        $name = isset($_SESSION["user"]["name"]) ? $_SESSION["user"]["name"] : "";
        $surname = isset($_SESSION["user"]["surname"]) ? $_SESSION["user"]["surname"] : "";
        
        if ($name && $surname) {
            return $name . " " . $surname;
        } elseif ($name) {
            return $name;
        } elseif ($surname) {
            return $surname;
        } else {
            return "Uporabnik";
        }
    }
    
    public static function isBuyer() {
        if (!self::isLoggedIn()) {
            return false;
        }
        
        return isset($_SESSION["user"]["type"]) && $_SESSION["user"]["type"] == "BUYER";
    }
    
    public static function isSeller() {
        if (!self::isLoggedIn()) {
            return false;
        }
        
        return isset($_SESSION["user"]["type"]) && $_SESSION["user"]["type"] == "SELLER";
    }
    
    public static function isAdmin() {
        if (!self::isLoggedIn()) {
            return false;
        }
        
        return isset($_SESSION["user"]["type"]) && $_SESSION["user"]["type"] == "ADMIN";
    }
    
    public static function getUserWithPassword() {
        if (!self::isLoggedIn()) {
            return null;
        }
        
        if (!isset($_SESSION["user"]["id"])) {
            return null;
        }
        
        $user_id = $_SESSION["user"]["id"];
        require_once("DB.php");
        
        try {
            $db = DB::getInstance();
            $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error in User::getUserWithPassword(): " . $e->getMessage());
            return null;
        }
    }
    
    public static function getUser($email, $password) {
        $db = DB::getInstance();
        
        $sql = $db->prepare("SELECT * FROM users WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();
        $user = $sql->fetch();
        
        if($user != null) {    
            if (password_verify($password, $user["password"])) {
                unset($user["password"]);
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}