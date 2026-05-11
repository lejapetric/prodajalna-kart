<?php

require_once("model/KartaDB.php");
require_once("ViewHelper.php");

class KarteController {

    public static function index() {
        if (isset($_GET["id"])) {
            ViewHelper::render("view/karta-detail.php", ["karta" => KartaDB::get($_GET["id"])]);
        } else {
            ViewHelper::render("view/karta-list.php", ["karte" => KartaDB::getAll()]);
        }
    }

    public static function showAddForm($values = ["naziv" => "", "cena" => ""]) {
    // Preveri, če je uporabnik prijavljen kot prodajalec
    if (!User::isSeller()) {
        $_SESSION['error'] = "Samo prodajalci lahko dodajajo karte!";
        ViewHelper::redirect(BASE_URL . "karte");
        return;
    }
    
    ViewHelper::render("view/karta-add.php", $values);
}

    // V KarteController.php
    public static function add() {
    // Preveri, če je uporabnik prijavljen kot prodajalec
    if (!User::isSeller()) {
        $_SESSION['error'] = "Samo prodajalci lahko dodajajo karte!";
        ViewHelper::redirect(BASE_URL . "karte");
        return;
    }

    $naziv = $_POST["naziv"];
    $cena = $_POST["cena"];
    
    // Karta je vedno aktivna (1) ob dodajanju
    $aktiviran = 1;

    // Pridobi email trenutno prijavljenega prodajalca
    $seller_email = $_SESSION["user"]["email"];
    
    // Pridobi user_id trenutno prijavljenega uporabnika
    $user_id = $_SESSION["user"]["id"];

    // Preveri, če sta oba parametra na voljo
    if (empty($seller_email) || empty($user_id)) {
        $_SESSION['error'] = "Manjkajo podatki prodajalca!";
        ViewHelper::redirect(BASE_URL . "karte");
        return;
    }

    // Dodaj karto z emailom prodajalca in user_id
    $success = KartaDB::insert($naziv, $cena, $seller_email, $aktiviran, $user_id);

    if ($success) {
        $_SESSION['success'] = "Karta uspešno dodana!";
        ViewHelper::redirect(BASE_URL . "karte");
    } else {
        // Shrani vrednosti za ponoven vnos
        $_SESSION['error'] = "Napaka pri dodajanju karte!";
        $values = [
            'naziv' => $naziv,
            'cena' => $cena
        ];
        ViewHelper::render("view/karta-add.php", $values);
    }
}

    public static function showEditForm($karta = []) {
        if (empty($karta)) {
            $karta = KartaDB::get($_GET["id"]);
        }

        ViewHelper::render("view/karta-edit.php", ["karta" => $karta]);
    }

    public static function edit() {
        $validData = isset($_POST["naziv"]) && !empty($_POST["naziv"]) &&
                isset($_POST["cena"]) && !empty($_POST["cena"]) &&
                isset($_POST["id"]) && !empty($_POST["id"]);

        if ($validData) {
            KartaDB::update($_POST["id"], $_POST["naziv"], $_POST["cena"], $_POST["aktiviran"]);
            ViewHelper::redirect(BASE_URL . "karte?id=" . $_POST["id"]);
        } else {
            self::showEditForm($_POST);
        }
    }
    
    public static function editList() {
        ViewHelper::render("view/edit-list.php", ["karte" => KartaDB::getAll()]);
    }

    public static function deactivate() {
        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $karta = KartaDB::get($_POST["id"]);

            // Deaktiviraj karto (nastavi aktiviran na 0)
            KartaDB::update($_POST["id"], $karta["naziv"], $karta["cena"], 0);

            // Preusmeri na seznam kart namesto na posamezno karto
            ViewHelper::redirect(BASE_URL . "karte");
        } else {
            ViewHelper::redirect(BASE_URL . "karte");
        }
    }

public static function activate() {
    if (isset($_POST["id"]) && !empty($_POST["id"])) {
        $karta = KartaDB::get($_POST["id"]);
        
        // Aktiviraj karto (nastavi aktiviran na 1)
        KartaDB::update($_POST["id"], $karta["naziv"], $karta["cena"], 1);
        
        ViewHelper::redirect(BASE_URL . "karte?id=" . $_POST["id"]);
    } else {
        ViewHelper::redirect(BASE_URL . "karte");
    }
}
    
    /**
     * Returns TRUE if given $input array contains no FALSE values
     * @param type $input
     * @return type
     */
    public static function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }

        return $result;
    }

    /**
     * Returns an array of filtering rules for manipulation books
     * @return type
     */
    public static function getRules() {
        return [
            'naziv' => FILTER_SANITIZE_SPECIAL_CHARS,
            'cena' => FILTER_VALIDATE_FLOAT
            /**'year' => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => [
                    'min_range' => 1800,
                    'max_range' => date("Y")
                ]
            ]**/
        ];
    }

}
