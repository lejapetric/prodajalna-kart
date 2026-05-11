<?php
class DB {
    private static $instance = null;
    
    private function __construct() {}
    
    public static function getInstance() {
        if (self::$instance === null) {
            try {
                // Povezava z bazo karte
                self::$instance = new PDO(
                    "mysql:host=localhost;dbname=karte;charset=utf8",
                    "root",  // uporabniško ime (privzeto root)
                    ""       // geslo (pustite prazno, če ni gesla)
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$instance->exec("SET NAMES utf8");
            } catch(PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}