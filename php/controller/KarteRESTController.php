<?php

require_once("model/KartaDB.php");
require_once("controller/KarteController.php");
require_once("ViewHelper.php");

class KarteRESTController {
    
    public static function get($id) {
        try {
           echo ViewHelper::renderJSON(KartaDB::get(["id" => $id]));
        } catch(InvalidArgumentException $e) {
           echo ViewHelper::renderJSON($e->getMessage(), 404);
        }
    }

    public static function index() {
        $prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
                . $_SERVER["REQUEST_URI"];
        

        echo "\n";
        echo ViewHelper::renderJSON(KartaDB::getAllwithURI(["prefix" => $prefix]));
        /**if (isset($_GET["id"])) {
            ViewHelper::render("view/karta-detail.php", ["karta" => KartaDB::get($_GET["id"])]);
        } else {
            ViewHelper::render("view/karta-list.php", ["karte" => KartaDB::getAll()]);
        }**/

    }

    public static function add() {      
        $data = filter_input_array(INPUT_POST, KarteController::getRules());

        if (KarteController::checkValues($data)) {
            $id = KartaDB::insert($data);
            echo ViewHelper::renderJSON("", 201);
            ViewHelper::redirect(BASE_URL . "api/store/$id");
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
    }

    public static function edit($id) {
        // spremenljivka $_PUT ne obstaja, zato jo moremo narediti sami
        $_PUT = [];
        parse_str(file_get_contents("php://input"), $_PUT);
        $data = filter_var_array($_PUT, KarteController::getRules());

        if (KarteController::checkValues($data)) {
            $data["id"] = $id;
            KartaDB::update($data); 
            echo ViewHelper::renderJSON("", 200);
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
    }

    public static function delete($id) { 
        try {
            KartaDB::get(["id" => $id]); 
            KartaDB::delete(["id" => $id]);
            echo ViewHelper::renderJSON("", 204); 
        } catch (Exception $exc) {
            echo ViewHelper::renderJSON("Taka karta ne obstaja!", 404);
        }
    }
}
