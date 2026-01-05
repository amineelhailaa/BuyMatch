<?php

use classes\Utilisateur;
require_once "Utilisateur.php";
require_once "Acheteur.php";
require_once "Organisateur.php";
require_once "Administrateur.php";

class UserMaker
{

    public static function rightPerson($row): Organisateur|Acheteur|Administrateur
    {

        if($row['role'] == 'administrateur'){
            return new Administrateur($row['nom'], $row['email'], $row['password'], $row['phone'], $row['status'], $row['pic'],$row['id']);

        }
        elseif($row['role'] == 'acheteur'){
            return new Acheteur($row['nom'], $row['email'], $row['password'], $row['phone'], $row['status'], $row['pic'],$row['id']);
        }
        elseif ($row['role'] == 'organisateur'){
            return new Organisateur($row['nom'], $row['email'], $row['password'], $row['phone'], $row['status'], $row['pic'],$row['id']);
        }
        else{
            throw new Exception("role is not set verify db");
        }

    }
}