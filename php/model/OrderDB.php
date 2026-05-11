<?php
// model/OrderDB.php

require_once 'DB.php';

class OrderDB {
    
    // Ustvari novo naročilo
    public static function createOrder($user_id, $cart, $shipping_address = '') {
        $db = DB::getInstance();

        // Izračunaj skupni znesek
        $total = 0;
        $seller_emails = [];

        foreach ($cart as $item) {
            $total += $item['cena'] * $item['quantity'];
            // Dodajte logiko za pridobitev prodajalčevega emaila, če je potrebno
            // Na primer: $seller_emails[] = $item['seller_email'];
        }

        // Določite seller_email (če je potrebno)
        $seller_email = NULL; // ali pa pridobite iz seje ali drugje

        // Ustvari naročilo
        $stmt = $db->prepare("INSERT INTO orders (user_id, total_amount, shipping_address, status, seller_email) 
                              VALUES (:user_id, :total_amount, :shipping_address, 'pending', :seller_email)");
        $stmt->execute([
            ':user_id' => $user_id,
            ':total_amount' => $total,
            ':shipping_address' => $shipping_address,
            ':seller_email' => $seller_email  // DODAJTE
        ]);

        $order_id = $db->lastInsertId();

        // Dodaj artikle v naročilo
        foreach ($cart as $item) {
            $stmt = $db->prepare("INSERT INTO order_items (order_id, karta_id, quantity, price) 
                                  VALUES (:order_id, :karta_id, :quantity, :price)");
            $stmt->execute([
                ':order_id' => $order_id,
                ':karta_id' => $item['id'],
                ':quantity' => $item['quantity'],
                ':price' => $item['cena']
            ]);
        }

        return $order_id;
    }
    
    // Pridobi vsa naročila uporabnika
    public static function getOrdersByUser($user_id) {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM orders WHERE user_id = :user_id ORDER BY order_date DESC");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll();
    }
    
    // Pridobi vsa naročila (za prodajalce/admine)
    public static function getAllOrders() {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT o.*, u.name, u.surname, u.email 
                              FROM orders o 
                              JOIN users u ON o.user_id = u.id 
                              ORDER BY o.order_date DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    // Pridobi naročila po statusu
    public static function getOrdersByStatus($status) {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT o.*, u.name, u.surname, u.email 
                              FROM orders o 
                              JOIN users u ON o.user_id = u.id 
                              WHERE o.status = :status 
                              ORDER BY o.order_date DESC");
        $stmt->execute([':status' => $status]);
        return $stmt->fetchAll();
    }
    
    // Pridobi artikle v naročilu
    public static function getOrderItems($order_id) {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT oi.*, k.naziv 
                              FROM order_items oi 
                              JOIN karte k ON oi.karta_id = k.id 
                              WHERE oi.order_id = :order_id");
        $stmt->execute([':order_id' => $order_id]);
        return $stmt->fetchAll();
    }
    
    // Posodobi status naročila
    public static function updateOrderStatus($order_id, $status, $seller_email = NULL) {
        $db = DB::getInstance();

        if ($seller_email) {
            $stmt = $db->prepare("UPDATE orders SET status = :status, seller_email = :seller_email WHERE id = :order_id");
            $stmt->execute([
                ':status' => $status,
                ':seller_email' => $seller_email,
                ':order_id' => $order_id
            ]);
        } else {
            $stmt = $db->prepare("UPDATE orders SET status = :status WHERE id = :order_id");
            $stmt->execute([
                ':status' => $status,
                ':order_id' => $order_id
            ]);
        }
    }
    
    // Pridobi podrobnosti naročila
    public static function getOrder($order_id) {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT o.*, u.name, u.surname, u.email 
                              FROM orders o 
                              JOIN users u ON o.user_id = u.id 
                              WHERE o.id = :order_id");
        $stmt->execute([':order_id' => $order_id]);
        return $stmt->fetch();
    }
}