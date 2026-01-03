<?php


use classes\Utilisateur;


require_once __DIR__."/Utilisateur.php";
class Acheteur extends Utilisateur
{
//    public function __construct($name, $email, $password_hash, $phone, $status, $pic,?int $id = null)
//    {
//        parent::__construct($name, $email, $password_hash, $phone, $status, $pic,$id
//    }


    public function getRole(): string
    {
        return 'acheteur';
    }
}