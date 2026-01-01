<?php

class MatchRepository
{
    private PDO $pdo;
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }


    public function getMatches():array {

        $query = "select * from list_match where status='validated'";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        public function getMatcheById(int $id){
        $query = "select * from list_match where match_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row===false? null:$row;
        }

}