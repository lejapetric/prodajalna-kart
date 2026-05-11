<?php
require_once ("ViewHelper.php");
require_once ("model/UserDB.php");
require_once ("model/User.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");

class ProfileController {
    
    
    public static function show() {
        $user=UserDB::getUserInfo($_SESSION["user"]["email"]);
        ViewHelper::render("view/profile.php", $user);
    }
    public static function edit() {
        $user=UserDB::getUserInfo($_SESSION["user"]["email"]);
        if ($_POST["oldPassword"] == $user["password"]) {
            UserDB::update($_POST["name"], $_POST["surname"], $_SESSION["user"]["email"], $_POST["newPassword"], $_SESSION["user"]["address"], $_SESSION["user"]["type"]);
        }
        
        
        $newUserData = UserDB::getUserInfo($_SESSION["user"]["email"]);
        User::login($newUserData);
        ViewHelper::redirect(BASE_URL . "store");
    }
    
    
    public static function showBuyers() {
        if (isset($_GET["email"])) {
            ViewHelper::render("view/buyer-detail.php", ["user" => UserDB::getUserInfo($_GET["email"])]);
        } else {
            ViewHelper::render("view/buyer-list.php", ["users" => UserDB::getBuyers()]);
        }
    }
    public static function editBuyer() {
    $aktiviran = isset($_POST["aktiviran"]) ? (int)$_POST["aktiviran"] : 0;

    UserDB::updateBuyer(
        (int) $_POST["id"],
        $_POST["name"],
        $_POST["surname"],
        $_POST["email"],
        $_POST["address_street"],
        $_POST["address_number"],
        $_POST["address_post"],
        $_POST["address_zip"],
        $aktiviran
    );

    ViewHelper::redirect(BASE_URL . "buyers");
}

    public static function addBuyer() {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $address_street = $_POST["address_street"];
        $address_number = $_POST["address_number"];
        $address_post = $_POST["address_post"];
        $address_zip = $_POST["address_zip"];
        $aktiviran = isset($_POST["aktiviran"]) ? (int)$_POST["aktiviran"] : 1;

        // Preveri, če email že obstaja
        if (UserDB::emailExists($email)) {
            $_SESSION['error'] = "Email že obstaja!";

            // Shrani vrednosti za ponoven vnos
            $values = [
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
                'address_street' => $address_street,
                'address_number' => $address_number,
                'address_post' => $address_post,
                'address_zip' => $address_zip,
                'aktiviran' => $aktiviran
            ];

            ViewHelper::render("view/buyer-add.php", $values);
            return;
        }

        // Dodaj kupca z novo metodo
        $success = UserDB::addBuyer($name, $surname, $email, $password, 
                                    $address_street, $address_number, 
                                    $address_post, $address_zip, $aktiviran);

        if ($success) {
            $_SESSION['success'] = "Kupec uspešno dodan!";
            ViewHelper::redirect(BASE_URL . "buyers");
        } else {
            $_SESSION['error'] = "Napaka pri dodajanju kupca!";

            // Shrani vrednosti za ponoven vnos
            $values = [
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
                'address_street' => $address_street,
                'address_number' => $address_number,
                'address_post' => $address_post,
                'address_zip' => $address_zip,
                'aktiviran' => $aktiviran
            ];

            ViewHelper::render("view/buyer-add.php", $values);
        }
    }

    public static function showBuyerAdd($values = [
        'name' => '', 
        'surname' => '', 
        'email' => '', 
        'address_street' => '', 
        'address_number' => '', 
        'address_post' => '', 
        'address_zip' => '',
        'aktiviran' => 1
    ]) {
        ViewHelper::render("view/buyer-add.php", $values);
    }
    

    public static function showSellers() {
        if (isset($_GET["email"])) {
            // Prikaži podrobnosti posameznega prodajalca
            ViewHelper::render("view/seller-detail.php", ["user" => UserDB::getUserInfo($_GET["email"])]);
        } else {
            // Administrator vidi VSE prodajalce (tudi deaktivirane)
            $sellers = UserDB::getSellers(false); // false = vsi prodajalci

            ViewHelper::render("view/seller-list.php", ["users" => $sellers]);
        }
    }

    public static function editSeller() {
    // Preverite, ali je uporabnik administrator
    if (!User::isAdmin()) {
        ViewHelper::redirect(BASE_URL . "store");
        return;
    }
    
    $id = (int) $_POST["id"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $old_email = $_POST["old_email"];
    $aktiviran = isset($_POST["aktiviran"]) ? (int)$_POST["aktiviran"] : 0;
    $password = !empty($_POST["password"]) ? $_POST["password"] : null;
    
    // Preveri, če se email spremeni in če novi email že obstaja
    if ($email !== $old_email && UserDB::emailExists($email)) {
        // Email že obstaja - prikaži napako
        $user = UserDB::getUserInfo($old_email);
        $user["error"] = "Email že obstaja!";
        ViewHelper::render("view/seller-detail.php", ["user" => $user]);
        return;
    }
    
    // Posodobi prodajalca v bazi
    $success = UserDB::updateSeller($id, $name, $surname, $email, $aktiviran, $password);
    
    if ($success) {
        // Preusmeritev na seznam prodajalcev
        ViewHelper::redirect(BASE_URL . "sellers");
    } else {
        // Prikaži napako
        $user = UserDB::getUserInfo($old_email);
        $user["error"] = "Posodobitev ni uspela!";
        ViewHelper::render("view/seller-detail.php", ["user" => $user]);
    }
}
    public static function addSeller() {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Prodajalec je vedno aktiviran (status = 1)
        $status = 1;

        // Preveri ujemanje gesel
        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Gesli se ne ujemata!";
            $values = [
                'name' => $name,
                'surname' => $surname,
                'email' => $email
            ];
            ViewHelper::render("view/seller-add.php", $values);
            return;
        }

        // Preveri, če email že obstaja
        if (UserDB::emailExists($email)) {
            $_SESSION['error'] = "Email že obstaja!";

            // Shrani vrednosti za ponoven vnos
            $values = [
                'name' => $name,
                'surname' => $surname,
                'email' => $email
            ];

            ViewHelper::render("view/seller-add.php", $values);
            return;
        }

        // Dodaj prodajalca
        $success = UserDB::addSeller($name, $surname, $email, $password, $status);

        if ($success) {
            $_SESSION['success'] = "Prodajalec uspešno dodan!";
            ViewHelper::redirect(BASE_URL . "sellers");
        } else {
            $_SESSION['error'] = "Napaka pri dodajanju prodajalca!";

            // Shrani vrednosti za ponoven vnos
            $values = [
                'name' => $name,
                'surname' => $surname,
                'email' => $email
            ];

            ViewHelper::render("view/seller-add.php", $values);
        }
    }
    public static function showSellerAdd($values = [
        'name' => '', 
        'surname' => '', 
        'email' => ''
    ]) {
        ViewHelper::render("view/seller-add.php", $values);
    }
}

