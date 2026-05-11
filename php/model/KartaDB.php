<?php

require_once 'DB.php';

class KartaDB {
   
    //vrne stevilo kart (za kosarico)
    public static function getForIds($ids) {
        $db = DB::getInstance();

        $id_placeholders = implode(",", array_fill(0, count($ids), "?"));

        $statement = $db->prepare("SELECT id, naziv, cena FROM karte 
            WHERE id IN (" . $id_placeholders . ")");
        $statement->execute($ids);

        return $statement->fetchAll();
    }
    
    //vrne vse karte
    public static function getAll() {
        $db = DB::getInstance();
        $statement = $db->prepare("SELECT id, naziv, cena, aktiviran, seller_email, user_id FROM karte");        $statement->execute();

        return $statement->fetchAll();
    }

    //vrne kzahtevano karto
    public static function get($id) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT * FROM karte 
            WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $karta = $statement->fetch();

        if ($karta != null) {
            return $karta;
        } else {
            throw new InvalidArgumentException("No record with id $id");
        }
    }
    
    public static function insert($naziv, $cena, $seller_email, $user_id, $aktiviran = 1) {
        $db = DB::getInstance();

        // Preveri, če sta oba zahtevana parametra podana
        if (empty($seller_email) || empty($user_id)) {
            throw new Exception("Potrebna sta tako seller_email kot user_id!");
        }

        $statement = $db->prepare("INSERT INTO karte (naziv, cena, seller_email, aktiviran, user_id) 
                                   VALUES (:naziv, :cena, :seller_email, :aktiviran, :user_id)");
        $statement->bindParam(":naziv", $naziv);
        $statement->bindParam(":cena", $cena);
        $statement->bindParam(":seller_email", $seller_email);
        $statement->bindParam(":aktiviran", $aktiviran, PDO::PARAM_INT);
        $statement->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        return $statement->execute();
    }
    
    public static function update($id, $naziv, $cena, $aktiviran) {
        $db = DB::getInstance();


        $aktiviran_value = ($aktiviran == 1) ? 1 : 0;

        $statement = $db->prepare("UPDATE karte SET naziv = :naziv, cena = :cena, aktiviran = :aktiviran WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->bindParam(":naziv", $naziv);
        $statement->bindParam(":cena", $cena);
        $statement->bindParam(":aktiviran", $aktiviran_value);

        $statement->execute();
    }

    public static function delete($id) {
        $db = DB::getInstance();
        $statement = $db->prepare("DELETE FROM karte WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function search($query) {
        $db = DB::getInstance();

        $statement = $db->prepare("SELECT id, naziv, cena FROM karte 
            WHERE naziv LIKE :query");
        $statement->bindValue(":query", '%' . $query . '%');
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public static function getAllwithURI(array $prefix) {
    $db = DB::getInstance();
    $statement = $db->prepare("SELECT id, naziv, cena, aktiviran, seller_email, user_id "
                    . "FROM karte "
                    . "ORDER BY id ASC");
    
    $statement->execute();
    return $statement->fetchAll();
}
}
