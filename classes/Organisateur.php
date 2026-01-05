<?php


require_once __DIR__.'/Utilisateur.php';
class Organisateur extends Utilisateur
{
//    public function __construct($name, $email, $password_hash, $phone, $status, $pic)
//    {
//        parent::__construct($name, $email, $password_hash, $phone, $status, $pic);
//    }
    public function getRole(): string
    {
        return 'organisateur';
    }
    public function dashboardPath()
    {
    }
}