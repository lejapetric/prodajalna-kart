<?php
// controller/OrderController.php

require_once("ViewHelper.php");
require_once("model/KartaDB.php");
require_once("model/Cart.php");
require_once("model/OrderDB.php");
require_once("model/User.php");
require_once("model/UserDB.php");  // DODAJTE TO LINIJO - BILA MANJKA!

class OrderController {
    
    public static function index() {
        $vars = [
            "karte" => KartaDB::getAll(),
            "cart" => Cart::getAll(),
            "total" => Cart::total()
        ];
        ViewHelper::render("view/order.php", $vars);
    }
    
    public static function allOrders() {
        if (!User::isLoggedIn()) {
            ViewHelper::redirect(BASE_URL . "prijava");
            return;
        }
        
        $orders = [];
        
        if (User::isBuyer()) {
            // Pridobi ID trenutnega uporabnika
            $current_user = UserDB::getUserInfo($_SESSION["user"]["email"]);
            $user_id = $current_user["id"];
            $orders = OrderDB::getOrdersByUser($user_id);
        }
        
        if (User::isSeller() || User::isAdmin()) {
            $orders = OrderDB::getAllOrders();
        }
        
        ViewHelper::render("view/orders.php", ["orders" => $orders]);
    }
    
    // Dodajte metodo za oddajo naročila
    public static function submitOrder() {
        if (!User::isLoggedIn()) {
            ViewHelper::redirect(BASE_URL . "prijava");
            return;
        }
        
        $cart = Cart::getAll();
        
        if (empty($cart)) {
            $_SESSION['error'] = "Košarica je prazna!";
            ViewHelper::redirect(BASE_URL . "store");
            return;
        }
        
        // Pridobi uporabnika
        $current_user = UserDB::getUserInfo($_SESSION["user"]["email"]);
        $user_id = $current_user["id"];
        
        // Pripravi naslov za dostavo (če je kupec)
        $shipping_address = '';
        if (User::isBuyer()) {
            // Sestavi naslov iz posameznih delov
            $address_parts = array();
            if (isset($_SESSION["user"]["address_street"]) && !empty($_SESSION["user"]["address_street"])) {
                $address_parts[] = $_SESSION["user"]["address_street"];
            }
            if (isset($_SESSION["user"]["address_number"]) && !empty($_SESSION["user"]["address_number"])) {
                $address_parts[] = $_SESSION["user"]["address_number"];
            }
            if (isset($_SESSION["user"]["address_post"]) && !empty($_SESSION["user"]["address_post"])) {
                $address_parts[] = $_SESSION["user"]["address_post"];
            }
            if (isset($_SESSION["user"]["address_zip"]) && !empty($_SESSION["user"]["address_zip"])) {
                $address_parts[] = $_SESSION["user"]["address_zip"];
            }
            $shipping_address = implode(' ', $address_parts);
        }
        
        try {
            // Ustvari naročilo
            $order_id = OrderDB::createOrder($user_id, $cart, $shipping_address);
            
            // Počisti košarico
            Cart::purge();
            
            $_SESSION['success'] = "Naročilo #$order_id uspešno oddano! Sedaj čaka na potrditev prodajalca.";
            ViewHelper::redirect(BASE_URL . "orders");
            
        } catch (Exception $e) {
            $_SESSION['error'] = "Napaka pri oddaji naročila: " . $e->getMessage();
            ViewHelper::redirect(BASE_URL . "store/order");
        }
    }
    
    // Prikaži podrobnosti naročila
    public static function orderDetails($order_id) {
        if (!User::isLoggedIn()) {
            ViewHelper::redirect(BASE_URL . "prijava");
            return;
        }
        
        $order = OrderDB::getOrder($order_id);
        $items = OrderDB::getOrderItems($order_id);
        
        ViewHelper::render("view/order-details.php", [
            "order" => $order,
            "items" => $items
        ]);
    }
    
    // Posodobi status naročila (za prodajalce)
    public static function updateStatus() {
       if (!User::isSeller() && !User::isAdmin()) {
           $_SESSION['error'] = "Nimate pravic za spreminjanje statusa naročila.";
           ViewHelper::redirect(BASE_URL . "orders");
           return;
       }

       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $order_id = isset($_POST['order_id']) ? $_POST['order_id'] : null;
           $status = isset($_POST['status']) ? $_POST['status'] : null;

           if ($order_id && $status) {
               // Pridobite email trenutnega prodajalca/admina
               $seller_email = $_SESSION["user"]["email"];

               OrderDB::updateOrderStatus($order_id, $status, $seller_email);
               $_SESSION['success'] = "Status naročila uspešno posodobljen.";
           } else {
               $_SESSION['error'] = "Manjkajoči podatki.";
           }
       }

       ViewHelper::redirect(BASE_URL . "orders");
   }

   
}