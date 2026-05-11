<?php
// controller/ProfileEditController.php

require_once("ViewHelper.php");
require_once("model/UserDB.php");
require_once("model/User.php");
require_once("model/DB.php");

class ProfileEditController {
    
    public static function editProfile() {
        // Preveri če je uporabnik prijavljen
        if (!User::isLoggedIn()) {
            ViewHelper::redirect(BASE_URL . "prijava");
            return;
        }
        
        // Če je bil obrazec poslan (POST zahteva)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validacija podatkov
                $name = isset($_POST['name']) ? filter_var($_POST['name'], FILTER_SANITIZE_STRING) : '';
                $surname = isset($_POST['surname']) ? filter_var($_POST['surname'], FILTER_SANITIZE_STRING) : '';
                $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
                $address_street = isset($_POST['address_street']) ? filter_var($_POST['address_street'], FILTER_SANITIZE_STRING) : '';
                $address_number = isset($_POST['address_number']) ? filter_var($_POST['address_number'], FILTER_SANITIZE_STRING) : '';
                $address_post = isset($_POST['address_post']) ? filter_var($_POST['address_post'], FILTER_SANITIZE_STRING) : '';
                $address_zip = isset($_POST['address_zip']) ? filter_var($_POST['address_zip'], FILTER_SANITIZE_STRING) : '';
                
                // Validacija
                if (empty($name) || empty($surname) || empty($email)) {
                    throw new Exception("Ime, priimek in email so obvezni.");
                }
                
                // Pridobi trenutnega uporabnika za ID
                $current_user = UserDB::getUserInfo($_SESSION["user"]["email"]);
                $user_id = $current_user["id"];
                
                // Posodobi podatke v bazi
                $db = DB::getInstance();
                $stmt = $db->prepare("UPDATE users SET 
                    name = :name, 
                    surname = :surname, 
                    email = :email, 
                    address_street = :address_street, 
                    address_number = :address_number, 
                    address_post = :address_post, 
                    address_zip = :address_zip 
                    WHERE id = :id");
                
                $stmt->execute(array(
                    ':name' => $name,
                    ':surname' => $surname,
                    ':email' => $email,
                    ':address_street' => $address_street,
                    ':address_number' => $address_number,
                    ':address_post' => $address_post,
                    ':address_zip' => $address_zip,
                    ':id' => $user_id
                ));
                
                // Posodobi podatke v seji
                $_SESSION['user']['name'] = $name;
                $_SESSION['user']['surname'] = $surname;
                $_SESSION['user']['email'] = $email;
                
                // Samo za kupce posodobi naslov
                if (User::isBuyer()) {
                    $_SESSION['user']['address_street'] = $address_street;
                    $_SESSION['user']['address_number'] = $address_number;
                    $_SESSION['user']['address_post'] = $address_post;
                    $_SESSION['user']['address_zip'] = $address_zip;
                    
                    // Posodobi tudi address polje za nazajno združljivost
                    $address_parts = array();
                    if (!empty($address_street)) $address_parts[] = $address_street;
                    if (!empty($address_number)) $address_parts[] = $address_number;
                    if (!empty($address_post)) $address_parts[] = $address_post;
                    if (!empty($address_zip)) $address_parts[] = $address_zip;
                    $_SESSION['user']['address'] = implode(' ', $address_parts);
                }
                
                $_SESSION['success'] = "Profil uspešno posodobljen!";
                ViewHelper::redirect(BASE_URL . "profile");
                
            } catch (Exception $e) {
                $_SESSION['error'] = "Napaka pri posodabljanju profila: " . $e->getMessage();
                ViewHelper::redirect(BASE_URL . "profile/edit");
            }
            return;
        }
        
        // Če je GET zahteva - prikaži obrazec
        // Pridobi trenutne podatke uporabnika
        $user = UserDB::getUserInfo($_SESSION["user"]["email"]);
        
        // Preveri če $user obstaja
        if (!$user) {
            $_SESSION['error'] = "Uporabnik ne obstaja.";
            ViewHelper::redirect(BASE_URL . "profile");
            return;
        }
        
        // Prikaži obrazec za urejanje
        ViewHelper::render("view/edit.php", array("user" => $user));
    }
    
    // Dodatna metoda za spremembo gesla
    public static function changePassword() {
        if (!User::isLoggedIn()) {
            ViewHelper::redirect(BASE_URL . "prijava");
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oldPassword = isset($_POST['oldPassword']) ? $_POST['oldPassword'] : '';
            $newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : '';
            $confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';
            
            // Preveri prazna polja
            if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
                $_SESSION['error'] = "Vsa polja so obvezna.";
                ViewHelper::redirect(BASE_URL . "profile");
                return;
            }
            
            // Preveri če se nova gesla ujemata
            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = "Novi gesli se ne ujemata.";
                ViewHelper::redirect(BASE_URL . "profile");
                return;
            }
            
            // Pridobi trenutnega uporabnika
            $current_user = UserDB::getUserInfo($_SESSION["user"]["email"]);
            
            // Preveri staro geslo (POZOR: trenutno uporablja strcmp, ne hash!)
            if (strcmp($oldPassword, $current_user["password"]) !== 0) {
                $_SESSION['error'] = "Staro geslo ni pravilno.";
                ViewHelper::redirect(BASE_URL . "profile");
                return;
            }
            
            // Posodobi geslo
            $db = DB::getInstance();
            $stmt = $db->prepare("UPDATE users SET password = :password WHERE email = :email");
            $stmt->execute(array(
                ':password' => $newPassword, // POZOR: Še vedno ni hashirano!
                ':email' => $_SESSION["user"]["email"]
            ));
            
            $_SESSION['success'] = "Geslo uspešno spremenjeno!";
            ViewHelper::redirect(BASE_URL . "profile");
        }
    }
    
}