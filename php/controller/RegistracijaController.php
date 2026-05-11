<?php
// controller/RegistracijaController.php

require_once("ViewHelper.php");
require_once("model/UserDB.php");
require_once("model/User.php");

class RegistracijaController {
    
    public static function registrationForm() {
        // Preberi podatke iz seje, če obstajajo (za ohranjanje pri napaki)
        $data = [
            'type' => isset($_SESSION['form_data']['type']) ? $_SESSION['form_data']['type'] : 'BUYER',
            'name' => isset($_SESSION['form_data']['name']) ? $_SESSION['form_data']['name'] : '',
            'surname' => isset($_SESSION['form_data']['surname']) ? $_SESSION['form_data']['surname'] : '',
            'email' => isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : '',
            'address_street' => isset($_SESSION['form_data']['address_street']) ? $_SESSION['form_data']['address_street'] : '',
            'address_number' => isset($_SESSION['form_data']['address_number']) ? $_SESSION['form_data']['address_number'] : '',
            'address_post' => isset($_SESSION['form_data']['address_post']) ? $_SESSION['form_data']['address_post'] : '',
            'address_zip' => isset($_SESSION['form_data']['address_zip']) ? $_SESSION['form_data']['address_zip'] : ''
        ];
        
        // Počisti začasne podatke iz seje
        unset($_SESSION['form_data']);
        
        ViewHelper::render("view/registracija.php", $data);
    }
    
    public static function index() {
        $data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
        unset($_SESSION['form_data']);
        ViewHelper::render("view/registracija.php", $data);
    }

    public static function register() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            ViewHelper::redirect(BASE_URL . "registracija");
            return;
        }

        // ---- VARNO ZA STAREJŠI PHP ----
        $type    = isset($_POST['type']) ? $_POST['type'] : 'BUYER';
        $name    = isset($_POST['name']) ? trim($_POST['name']) : '';
        $surname = isset($_POST['surname']) ? trim($_POST['surname']) : '';
        $email   = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

        $address_street = isset($_POST['address_street']) ? $_POST['address_street'] : '';
        $address_number = isset($_POST['address_number']) ? $_POST['address_number'] : '';
        $address_post   = isset($_POST['address_post']) ? $_POST['address_post'] : '';
        $address_zip    = isset($_POST['address_zip']) ? $_POST['address_zip'] : '';

        // ---- VALIDACIJA ----
        $errors = [];

        if ($name === '') $errors[] = "Ime je obvezno.";
        if ($surname === '') $errors[] = "Priimek je obvezen.";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Neveljaven e-poštni naslov.";
        }

        if (strlen($password) < 8 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[@$!%*?&]/', $password)) {
            $errors[] = "Geslo ne izpolnjuje varnostnih zahtev.";
        }

        if ($password !== $confirm_password) {
            $errors[] = "Gesli se ne ujemata.";
        }

        if (UserDB::emailExists($email)) {
            $errors[] = "Ta e-pošta je že registrirana.";
        }

        if (!empty($errors)) {
            $_SESSION['error'] = implode("<br>", $errors);
            $_SESSION['form_data'] = $_POST;
            ViewHelper::redirect(BASE_URL . "registracija");
            return;
        }

        // ---- VSTAVITEV V BAZO ----
        $ok = UserDB::insert(
            $name,
            $surname,
            $email,
            $password,
            $address_street,
            $address_number,
            $address_post,
            $address_zip,
            $type
        );

        if (!$ok) {
            $_SESSION['error'] = "Napaka pri registraciji.";
            ViewHelper::redirect(BASE_URL . "registracija");
            return;
        }

        // ---- PRAVILNA PRIJAVA ----
        $user = UserDB::getUserByEmail($email);

        if ($user === false) {
            $_SESSION['error'] = "Napaka pri prijavi po registraciji.";
            ViewHelper::redirect(BASE_URL . "prijava");
            return;
        }

        User::login($user);

        $_SESSION['success'] = "Uspešno ste registrirani!";
        ViewHelper::redirect(BASE_URL . "store");
    }
    
     public static function add() {
        // Preveri, ali je forma oddana
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            ViewHelper::redirect(BASE_URL . "registracija");
            return;
        }
        
        // Pridobi in prečisti podatke
        $type = isset($_POST['type']) ? $_POST['type'] : 'BUYER';
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Naslovni podatki (samo za kupce)
        $address_street = isset($_POST['address_street']) ? filter_input(INPUT_POST, 'address_street', FILTER_SANITIZE_STRING) : '';
        $address_number = isset($_POST['address_number']) ? filter_input(INPUT_POST, 'address_number', FILTER_SANITIZE_STRING) : '';
        $address_post = isset($_POST['address_post']) ? filter_input(INPUT_POST, 'address_post', FILTER_SANITIZE_STRING) : '';
        $address_zip = isset($_POST['address_zip']) ? filter_input(INPUT_POST, 'address_zip', FILTER_SANITIZE_STRING) : '';
        
        // Validacija
        $errors = [];
        
        // Preveri, ali so vsa obvezna polja izpolnjena
        if (empty($name)) {
            $errors[] = "Ime je obvezno polje.";
        }
        if (empty($surname)) {
            $errors[] = "Priimek je obvezno polje.";
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Vnesite veljaven e-poštni naslov.";
        }
        if (empty($password)) {
            $errors[] = "Geslo je obvezno polje.";
        } elseif (strlen($password) < 8) {
            $errors[] = "Geslo mora vsebovati vsaj 8 znakov.";
        } elseif (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Geslo mora vsebovati vsaj eno veliko črko.";
        } elseif (!preg_match('/[a-z]/', $password)) {
            $errors[] = "Geslo mora vsebovati vsaj eno malo črko.";
        } elseif (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Geslo mora vsebovati vsaj eno številko.";
        } elseif (!preg_match('/[@$!%*?&]/', $password)) {
            $errors[] = "Geslo mora vsebovati vsaj en poseben znak (@$!%*?&).";
        }
        
        // Preveri ujemanje gesel
        if ($password !== $confirm_password) {
            $errors[] = "Gesli se ne ujemata.";
        }
        
        // Preveri, ali email že obstaja
        if (UserDB::emailExists($email)) {
            $errors[] = "Ta e-poštni naslov je že registriran.";
        }
        
        // Če imamo napake, jih prikažemo
        if (!empty($errors)) {
            // Shrani vnešene podatke v sejo za ohranjanje
            $_SESSION['form_data'] = [
                'type' => $type,
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
                'address_street' => $address_street,
                'address_number' => $address_number,
                'address_post' => $address_post,
                'address_zip' => $address_zip
            ];
            
            $_SESSION['error'] = implode("<br>", $errors);
            ViewHelper::redirect(BASE_URL . "registracija");
            return;
        }
        
        try {
        // Vstavi uporabnika v bazo
        $success = UserDB::insert(
            $name, 
            $surname, 
            $email, 
            $password, 
            $address_street, 
            $address_number, 
            $address_post, 
            $address_zip, 
            $type
        );
        
        if ($success) {
            // Počisti začasne podatke
            unset($_SESSION['form_data']);
            
            // Preveri, če je seller dodajal kupca
            if (isset($_POST['added_by_seller']) && $_POST['added_by_seller'] == 'true') {
                // Seller je dodal kupca - prikaži sporočilo in ostani na strani
                $_SESSION['success'] = "Kupec je bil uspešno dodan!";
                
                // Ohrani podatke za prikaz
                $_SESSION['form_data'] = [
                    'name' => $name,
                    'surname' => $surname,
                    'email' => $email,
                    'address_street' => $address_street,
                    'address_number' => $address_number,
                    'address_post' => $address_post,
                    'address_zip' => $address_zip
                ];
                
                ViewHelper::redirect(BASE_URL . "registracija");
            } else {
                // Navaden uporabnik se registrira - avtomatska prijava
                $user = UserDB::getUserInfo($email);
                
                if ($user && isset($user['id'])) {
                    // Odstrani geslo, če obstaja
                    if (isset($user['password'])) {
                        unset($user['password']);
                    }
                    
                    // Prijavimo uporabnika
                    User::login($user);
                    
                    $_SESSION['success'] = "Uspešno ste se registrirali in prijavili!";
                    ViewHelper::redirect(BASE_URL . "store");
                } else {
                    $_SESSION['success'] = "Uspešno ste se registrirali! Sedaj se lahko prijavite.";
                    ViewHelper::redirect(BASE_URL . "prijava");
                }
            }
        } else {
            $_SESSION['error'] = "Napaka pri registraciji. Poskusite znova.";
            ViewHelper::redirect(BASE_URL . "registracija");
        }
        
    } catch (Exception $e) {
        $_SESSION['error'] = "Napaka pri registraciji: " . $e->getMessage();
        ViewHelper::redirect(BASE_URL . "registracija");
    }

    }
}