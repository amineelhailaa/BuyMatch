<?php


require_once __DIR__. "/Utilisateur.php";
class Acheteur extends Utilisateur
{
    public function getRole(): string
    {
        return 'acheteur';
    }
    public function dashboardPath()
    {
        echo "yoyoa";
    }
}