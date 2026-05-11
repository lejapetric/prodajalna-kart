<?php

require_once("model/KartaDB.php");

class Cart {

    //vsi artikli s kolicinami
    public static function getAll() {
        if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
            return [];
        }

        $ids = array_keys($_SESSION["cart"]);
        $cart = KartaDB::getForIds($ids);


        $counter = 0;
        foreach ($cart as $karta) {
            $cart[$counter++]["quantity"] = $_SESSION["cart"][$karta["id"]];
        }

        return $cart;
    }

    public static function add($id) {
        $karta = KartaDB::get($id);

        if ($karta != null) {
            if (isset($_SESSION["cart"][$id])) {
                $_SESSION["cart"][$id] += 1;
            } else {
                $_SESSION["cart"][$id] = 1;
            }            
        }
    }

    public static function update($id, $quantity) {
        $karta = KartaDB::get($id);
        $quantity = intval($quantity);

        if ($karta != null) {
            if ($quantity <= 0) {
                unset($_SESSION["cart"][$id]);
            } else {
                $_SESSION["cart"][$id] = $quantity;
            }
        }
    }

    //izprazne kosarice
    public static function purge() {
        unset($_SESSION["cart"]);
    }

    //skupni znesek
    public static function total() {
        return array_reduce(self::getAll(), function ($total, $karta) {
            return $total + $karta["cena"] * $karta["quantity"];
        }, 0);
    }
}
