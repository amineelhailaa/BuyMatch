<?php

require_once __DIR__."/../config/database.php";

class userRepository
{
    public static function findByEmail($email){ //looking for email and return user or null
        $con = database::getConnection();
        $sql = "SELECT * FROM utilisateur WHERE email = ?";
        $stmt = $con->prepare($sql);
        $stmt->execute(array($email));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public static function createUser($nom, $email,$password,$pic,$phone, $role): bool
    {
        $con = Database::getConnection();
        try {
            $sql = "INSERT INTO utilisateur (nom, email, password, pic, phone, role)";
            $sql .= " VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            return $stmt->execute(array($nom, $email, $password, $pic, $phone, $role));
        }catch (Throwable $exception){
        echo $exception->getMessage();
           return false;
        }
    }

}
