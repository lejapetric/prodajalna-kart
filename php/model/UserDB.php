<?php

require_once ("DB.php");

class UserDB {
#vrne vse uporabnike
    public static function getALl() {
        $db = DB::getInstance();
        $statement = $db->prepare("SELECT * FROM users");
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public static function getBuyers() {
        $type = "BUYER";
        $db = DB::getInstance();
        $statement = $db->prepare("SELECT * FROM users WHERE type = :type");
        $statement->bindParam(":type", $type);
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public static function getSellers($onlyActive = true) {
        $type = "SELLER";
        $db = DB::getInstance();

        if ($onlyActive) {
            // Vrni samo aktivirane prodajalce
            $statement = $db->prepare("SELECT * FROM users WHERE type = :type AND aktiviran = 1");
        } else {
            // Vrni vse prodajalce (za admin prikaz)
            $statement = $db->prepare("SELECT * FROM users WHERE type = :type");
        }

        $statement->bindParam(":type", $type);
        $statement->execute();
        return $statement->fetchAll();
    }
      
    public static function emailExists($email) {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch() !== false;
    }
    
    public static function insert($name, $surname, $email, $password, $address_street = '', $address_number = '', $address_post = '', $address_zip = '', $type = 'BUYER', $aktiviran = 1) {
    $db = DB::getInstance();
    
    // Hash geslo
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    try {
        $stmt = $db->prepare("INSERT INTO users 
            (name, surname, email, password, address_street, address_number, address_post, address_zip, type, aktiviran) 
            VALUES (:name, :surname, :email, :password, :address_street, :address_number, :address_post, :address_zip, :type, :aktiviran)");
        
        $result = $stmt->execute([
            ':name' => $name, 
            ':surname' => $surname, 
            ':email' => $email, 
            ':password' => $hashed_password, 
            ':address_street' => $address_street, 
            ':address_number' => $address_number, 
            ':address_post' => $address_post, 
            ':address_zip' => $address_zip, 
            ':type' => $type, 
            ':aktiviran' => $aktiviran
        ]);
        
        return $result !== false;
        
    } catch (PDOException $e) {
        error_log("Database error in insert: " . $e->getMessage());
        return false;
    }
}

    public static function addBuyer($name, $surname, $email, $password, $address_street, $address_number, $address_post, $address_zip, $aktiviran = 1) {
        $db = DB::getInstance();

        // Hash geslo
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = $db->prepare("INSERT INTO users 
            (name, surname, email, password, address_street, address_number, address_post, address_zip, type, aktiviran) 
            VALUES (:name, :surname, :email, :password, :address_street, :address_number, :address_post, :address_zip, 'BUYER', :aktiviran)");

        $sql->bindParam(':name', $name);
        $sql->bindParam(':surname', $surname);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':password', $hashed_password);
        $sql->bindParam(':address_street', $address_street);
        $sql->bindParam(':address_number', $address_number);
        $sql->bindParam(':address_post', $address_post);
        $sql->bindParam(':address_zip', $address_zip);
        $sql->bindParam(':aktiviran', $aktiviran, PDO::PARAM_INT);

        return $sql->execute();
    }

    public static function addSeller($name, $surname, $email, $password) {
    $db = DB::getInstance();
    $sql = $db->prepare("INSERT INTO users (name, surname, email, password, type, aktiviran) VALUES (:name, :surname, :email, :password, 'SELLER', 1)");
    $sql->bindParam(':name', $name);
    $sql->bindParam(':surname', $surname);
    $sql->bindParam(':email' , $email);
    $sql->bindParam(':password', $password);
    $sql->execute();
    }
    
    public static function getUserInfo($email) {
        $db = DB::getInstance();
        $sql = $db->prepare("SELECT * FROM users WHERE email=:email");
        $sql->bindParam(":email", $email);
        $sql->execute();
        $user = $sql->fetch();

        if ($user) {
            unset($user["password"]); // ODSTRANIMO GESLO!
            return $user;
        }

        return false;
    }
    
    public static function getUser($email, $password) {
        $db = DB::getInstance();

        $sql = $db->prepare("SELECT * FROM users WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();
        $user = $sql->fetch();

        if($user != null) {    
            $stored_password = $user["password"];

            // Poseben primer za admin@karte.si
            if ($email === 'admin@karte.si') {
                // Admin vedno uporablja plain text comparison
                if ($password === $stored_password) {
                    unset($user["password"]);
                    return $user;
                }
            } 
            // Za vse ostale uporabnike
            else {
                // Najprej poskusi password_verify
                if (password_verify($password, $stored_password)) {
                    unset($user["password"]);
                    return $user;
                }

                // Če še vedno plain text (backward compatibility)
                if ($password === $stored_password) {
                    // Auto-hash za naslednjič
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $update_stmt = $db->prepare("UPDATE users SET password = :new_password WHERE email = :email");
                    $update_stmt->execute([
                        ':new_password' => $hashed_password,
                        ':email' => $email
                    ]);

                    unset($user["password"]);
                    return $user;
                }
            }

            return false;
        } else {
            return false;
        }
    }
    
    
    public static function update($id, $name, $surname, $email, $type, $aktiviran = 1) {
    $db = DB::getInstance();
    $sql = $db->prepare("UPDATE users SET 
        name = :name, 
        surname = :surname, 
        email = :email, 
        type = :type, 
        aktiviran = :aktiviran 
        WHERE id = :id");
    
    $sql->bindParam(':name', $name);
    $sql->bindParam(':surname', $surname);
    $sql->bindParam(':email', $email);
    $sql->bindParam(':type', $type);
    $sql->bindParam(':aktiviran', $aktiviran);
    $sql->bindParam(':id', $id);
    
    return $sql->execute();
}
    
    public static function updateBuyer($id, $name, $surname, $email, $address_street, $address_number, $address_post, $address_zip, $aktiviran = 1) {
    $db = DB::getInstance();
    $sql = $db->prepare("UPDATE users SET 
        name = :name, 
        surname = :surname, 
        email = :email, 
        address_street = :address_street,
        address_number = :address_number,
        address_post = :address_post,
        address_zip = :address_zip,
        aktiviran = :aktiviran 
        WHERE id = :id AND type = 'BUYER'");
    
    $sql->bindParam(':name', $name);
    $sql->bindParam(':surname', $surname);
    $sql->bindParam(':email', $email);
    $sql->bindParam(':address_street', $address_street);
    $sql->bindParam(':address_number', $address_number);
    $sql->bindParam(':address_post', $address_post);
    $sql->bindParam(':address_zip', $address_zip);
    $sql->bindParam(':aktiviran', $aktiviran);
    $sql->bindParam(':id', $id);
    
    return $sql->execute();
}

    public static function updateSeller($id, $name, $surname, $email, $aktiviran = 1, $password = null) {
    $db = DB::getInstance();
    
    // Če je podano novo geslo
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = $db->prepare("UPDATE users SET 
            name = :name, 
            surname = :surname, 
            email = :email, 
            password = :password,
            aktiviran = :aktiviran 
            WHERE id = :id AND type = 'SELLER'");
        $sql->bindParam(':password', $hashed_password);
    } else {
        $sql = $db->prepare("UPDATE users SET 
            name = :name, 
            surname = :surname, 
            email = :email, 
            aktiviran = :aktiviran 
            WHERE id = :id AND type = 'SELLER'");
    }
    
    $sql->bindParam(':name', $name);
    $sql->bindParam(':surname', $surname);
    $sql->bindParam(':email', $email);
    $sql->bindParam(':aktiviran', $aktiviran, PDO::PARAM_INT);
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    
    return $sql->execute();
}
    
    public static function delete($email) {
        $db = DB::getInstance();
        $sql = $db->prepare("DELETE FROM users WHERE email = :email");
        $sql->bindParam($email);
        $sql->execute();
    }
    
    public static function getUserByEmail($email) {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            unset($user["password"]); // Varnostno odstranimo geslo
            return $user;
        }

        return false;
    }
    
    public static function getBuyerById($id) {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id AND type = 'BUYER'");
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();

        if ($user) {
            unset($user["password"]);
            return $user;
        }

        return false;
    }

}
