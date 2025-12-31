<?php

class Database
{
    private static $instance = null;
    private PDO $pdo;


    private function __construct($dsn,$username,$password)
    {
        try {
            $this->pdo= new PDO($dsn,$username,$password);
        }catch (Throwable $e){
            echo $e->getMessage();
        }
    }

    public static function getInstance($dsn=null,$username=null,$passowrd= null)
    {
     if (self::$instance===null){
         self::$instance = new Database(
             $dsn ?? 'mysql:host=localhost;dbname=buyticket',
             $username ?? 'root',
             $passowrd ?? '281102');
     }
     return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}