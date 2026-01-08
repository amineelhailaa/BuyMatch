<?php


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


    public function getUsersByRole($role)
    {
        $query = "select * from utilisateur where role = ?";
        $stmt = $this->con->prepare($query);
        $stmt->execute(array($role));
        if ($rows = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            $users = [];
            try {
                foreach ($rows as $row){
                    $users[] = UserMaker::rightPerson($row);
                }

            }catch (Throwable $exception){
                echo $exception->getMessage();
            }
            return $users;
        }
        return null;
    }

    public function countUsers($role) {
        $query = "select count(*) from utilisateur where role = ?";
        $stmt = $this->con->prepare($query);
        $stmt->execute(array($role));
        return $stmt->fetchColumn();
    }








    public function getUserById(int $id)
    {
        $query = "select * from utilisateur where id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->execute(array($id));
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return UserMaker::rightPerson($row);
        }
        return null;
    }


    public function updateUser(Utilisateur $user){
        $query = "UPDATE utilisateur set nom = ?, email = ?, password = ?,phone=? , status=? where id = ?";
        $stmt = $this->con->prepare($query);
        $stmt->execute(array($user->getName(),$user->getEmail(),$user->getPasswordHash(),$user->getPhone(),$user->getStatus(),$user->getId()));
    }

}
