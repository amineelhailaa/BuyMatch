<?php

use classes\Utilisateur;

class UserMaker
{

    public static function rightPerson($row): Organisateur|Acheteur|Administrateur
    {

        if($row['role'] == 'administrateur'){
            return new Administrateur($row['name'], $row['email'], $row['password'], $row['phone'], $row['status'], $row['pic'],$row['id']);

        }
        elseif($row['role'] == 'acheteur'){
            return new Acheteur($row['name'], $row['email'], $row['password'], $row['phone'], $row['status'], $row['pic'],$row['id']);
        }
        elseif ($row['role'] == 'organisateur'){
            return new Organisateur($row['name'], $row['email'], $row['password'], $row['phone'], $row['status'], $row['pic'],$row['id']);
        }
        else{
            throw new Exception("role is not set verify db");
        }

    }
}