<?php

use classes\Utilisateur;

require_once __DIR__."/../config/database.php";
require_once __DIR__."/../classes/Utilisateur.php";
require_once __DIR__."/../classes/UserMaker.php";

class userRepository
{
    private PDO $con;

    public function __construct(PDO $con)
    {
        $this->con = $con;
    }
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

    public function findUserById(int $id)
    {
        $query = "select * from utilisateur where id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->execute(array($id));
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return UserMaker::rightPerson($row);
        }
    }

}
