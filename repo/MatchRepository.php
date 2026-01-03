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



        public function createMatch($id1,$id2,$banner,$date,$time,$lieu,$maxSeats,$myId){

        $query = "insert into match(id_team1,id_team2,banner,match_date,match_hour,lieu,placesMax,status,organizer_id) values(?,?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($id1,$id2,$banner,$date,$time,$lieu,$maxSeats,'in progress',$myId));
        return $this->pdo->lastInsertId();
        }

}