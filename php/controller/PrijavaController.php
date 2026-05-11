<?php

require_once ("ViewHelper.php");
require_once ("model/UserDB.php");
require_once ("model/User.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");

class PrijavaController {
    public static function loginForm() {
        ViewHelper::render("view/prijava.php", ["deactivatedNotice" => "", "formAction" => "prijava"]);
    }
    
    public static function login() {
        //session_start();
        $rules = [
            "email" => FILTER_SANITIZE_EMAIL,
            "password" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
            //"email" => htmlspecialchars($_POST["email"]),
            //"password" => htmlspecialchars($_POST["password"])
        ];
        
        /*$validData = isset($_POST["email"]) && !empty($_POST["email"]) &&
        isset($_POST["password"]) && !empty($_POST["password"]);*/
        
        //$validData = filter_input_array(INPUT_POST, $rules);
        //$user = UserDB::getUser($validData["email"], $validData["password"]);
        
        $validData = filter_input_array(INPUT_POST, $rules);
        $user = UserDB::getUser($validData["email"], $validData["password"]);
       
        $errorMessage =  empty($validData["email"]) || empty($validData["password"]) || $user == null ? "Invalid username or password." : "";
        //$user = UserDB::getUser($_POST["email"], $_POST["password"]);
        $deactivatedNotice = "";
        if ($user != null) {
            $deactivatedNotice = ($user["aktiviran"] != 1) ? "Vaš račun je bil deaktiviran" : "";
        }
        
       
        /* if ($user) {
            User::login($user);

            $vars = [
                "email" => htmlspecialchars($_POST["email"]),
                "password" => htmlspecialchars($_POST["password"])
            ];
            //var_dump($vars);
            echo "<p>Bravo" ;
            var_dump($user);
            //ViewHelper::render("view/user-login-success.php", $vars);
        } else {
            /*ViewHelper::render("view/user-login-form.php", [
                "errorMessage" => "Invalid username or password.",
                "formAction" => "login-insecure"
            ]);
            echo "<p> $user";
            echo "<p>Jebi se:" ;
        }*/
        
          
        if (empty($errorMessage) && empty($deactivatedNotice)) {
            User::login($user);
            

            $vars = [
                "email" => $validData["email"],
                "password" => $validData["password"]
            ];
            //echo "<p> $vars";
            //var_dump($vars);
            echo "<p>Uspešna prijava!";
            //echo "<p>Pozdravljeni "+ User::getName();
            //ViewHelper::render("", $vars);  //pošlji vars v store php da jih uporabi

            # AVTORIZACIJA CERTIFIKATA
            # Avtorizirani uporabnik (to navadno pride iz podatkovne baze)
            $authorized_user = ["Admin, Ana, Berta"];

            $clients_certificate = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
            # preberemo odjemačev certifikat
            //$client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
            # Celotna vsebina certifikata.
            $certificate_data = openssl_x509_parse($clients_certificate);
            #echo "<p>Vsebina certifikata: ";
            #var_dump($certificate_data);
            # shranimo podatke x.509 certifikata

            $certificate_data = openssl_x509_parse($clients_certificate);

            # preberemo ime uporabnika (polje "common name") ALI name?
            $commonname = $certificate_data['subject']['CN'];

            # TODO Če se uporabnik nahaja na seznamu avtoriziranih uporabnikov prikažemo košarico
            if (in_array($commonname, $authorized_user)) {
                echo "<p>Dobrodošli $commonname!";
                if (!empty($cart)) {
                    echo "<p>Tvoja košarica je:";
                }
            } else {
                echo "<p> $commonname ni avtoriziran uporabnik.";
            }
  
            ViewHelper::redirect(BASE_URL . "store");
        } else {
            //echo "<p> $user";
            //var_dump($validData);
            
            echo "<p> $errorMessage";
            ViewHelper::render("view/prijava.php", [
                "errorMessage" => $errorMessage,
                "deactivatedNotice" => $deactivatedNotice,
                "formAction" => "prijava"
            ]);
        }
        
        /*if ($validData) {
            $uporabnik=UserDB::getOne($_POST["email"], $_POST["password"]);
            setcookie('uporabnik', serialize($uporabnik));
            return $uporabnik;
        } else {
            echo "Invalid login data";
        }*/
        
    }
    
    public static function logout() {
        User::logout();
        ViewHelper::redirect(BASE_URL . "store");
    }
    
    /*public static function loginForm() {
        ViewHelper::render("view/user-login-form.php", ["formAction" => "login"]);
    }

    public static function login() {
        $rules = [
            "username" => ["filter" => FILTER_SANITIZE_SPECIAL_CHARS],
            "password" => ["filter" => FILTER_SANITIZE_SPECIAL_CHARS]
        ];

        $data = filter_input_array(INPUT_POST, $rules);
        $user = UserDB::getUser($data["username"], $data["password"]);

        $errorMessage =  empty($data["username"]) || empty($data["password"]) || $user == null ? "Invalid username or password." : "";

        if (empty($errorMessage)) {
            User::login($user);

            $vars = [
                "username" => $data["username"],
                "password" => $data["password"]
            ];

            ViewHelper::render("view/user-login-success.php", $vars);
        } else {
            ViewHelper::render("view/user-login-form.php", [
                "errorMessage" => $errorMessage,
                "formAction" => "login"
            ]);
        }
    }

    public static function logout() {
        User::logout();

        ViewHelper::redirect(BASE_URL . "joke");
    }*/
    
    
}
