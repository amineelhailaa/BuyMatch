<?php
require_once __DIR__."/../config/database.php";
class TicketRepository
{
    private PDO $pdo;
    public function __construct($pdo){
        $this->pdo = $pdo;
    }



    public function getTicketsCountByUserInMatch($userId,$matchId){
        $query = "SELECT COUNT(*) FROM ticket t join reservation r on t.id_reservation=r.id where r.user_id=? and r.id_match=?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($userId, $matchId));
        return $stmt->fetchColumn();
    }
    public function getCount($category_id){
        $query = "select count(*) from ticket where id_category=?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($category_id));
        return $stmt->fetchColumn();
    }
}