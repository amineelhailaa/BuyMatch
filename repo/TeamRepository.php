<?php
require_once __DIR__."/../classes/Team.php";
class TeamRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }
    public function createTeam(Team $team): int
    {
        $query= "insert into team (name,logo) values (?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($team->getName(),$team->getLogo()));
        return $this->pdo->lastInsertId();
    }
}