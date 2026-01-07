<?php
require_once __DIR__."/../config/database.php";
class TicketRepository
{
    private PDO $pdo;
    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function createTicket(Ticket $ticket)
    {
        $query="insert into ticket (id_reservation,id_category,price) values (?,?,?)";
        $statement=$this->pdo->prepare($query);
         $statement->execute(array($ticket->getIdReservation(),$ticket->getIdCategory(),$ticket->getPrice()));
         return $this->pdo->lastInsertId();
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

    public function getTicketById($id): ?Ticket
    {
        $query = "select * from ticket where id=?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Ticket($row['id_reservation'],$row['id_category'],$row['price'],$row['id']);
    }

}