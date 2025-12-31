<?php

class Database
{
    private static ?PDO $pdo = null;
    public static function getConnection(): PDO{
        if(is_null(self::$pdo)){
            self::$pdo = new PDO('mysql:host=localhost;dbname=buyticket', 'root', '281102');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}