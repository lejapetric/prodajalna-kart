<?php

class SSLAuth {
    
    // Preveri ali je uporabnik prijavljen preko SSL certifikata
    public static function checkSSLClient() {
        if (!isset($_SERVER['SSL_CLIENT_VERIFY']) || $_SERVER['SSL_CLIENT_VERIFY'] !== 'SUCCESS') {
            return false;
        }
        
        if (!isset($_SERVER['SSL_CLIENT_S_DN_CN'])) {
            return false;
        }
        
        return true;
    }
    
    // Pridobi Common Name iz certifikata
    public static function getClientCN() {
        return $_SERVER['SSL_CLIENT_S_DN_CN'] ?? null;
    }
    
    // Preveri ali je certifikat veljaven za admin dostop
    public static function requireAdminSSL() {
        if (!self::checkSSLClient()) {
            header('HTTP/1.0 403 Forbidden');
            die('Dostop zahtevan s SSL certifikatom');
        }
        
        $cn = self::getClientCN();
        if (!$cn || $cn !== 'admin@karte.si') {
            header('HTTP/1.0 403 Forbidden');
            die('Nepravilen certifikat za admin dostop');
        }
    }
    
    // Preveri ali je certifikat veljaven za prodajalca
    public static function requireSellerSSL() {
        if (!self::checkSSLClient()) {
            header('HTTP/1.0 403 Forbidden');
            die('Dostop zahtevan s SSL certifikatom');
        }
        
        $cn = self::getClientCN();
        $allowed_cns = ['admin@karte.si', 'berta@karte.si'];
        
        if (!$cn || !in_array($cn, $allowed_cns)) {
            header('HTTP/1.0 403 Forbidden');
            die('Nepravilen certifikat za dostop prodajalca');
        }
    }
}