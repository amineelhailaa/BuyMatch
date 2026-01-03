<?php

class TeamRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }
    public function createTeam($name,$logoPath): int
    {
        $query= "insert into team (name,logo) values (?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($name,$logoPath));
        return $this->pdo->lastInsertId();
    }
}