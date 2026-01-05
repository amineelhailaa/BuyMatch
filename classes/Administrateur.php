<?php


require_once __DIR__."/Utilisateur.php";
class Administrateur extends Utilisateur
{
    public function getRole(): string
    {
        return 'administrateur';
    }


    public function dashboardPath()
    {
        echo "yowa";
    }
}