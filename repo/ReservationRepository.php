<?php

class ReservationRepository
{
private PDO $pdo;
public function __construct(PDO $pdo){ $this->pdo = $pdo; }

    public function createReservation(Reservation $reservation)
    {
        $query="insert into reservation (user_id,id_match,total_price) values(?,?,?)";
        $statement=$this->pdo->prepare($query);
      $statement->execute(array($reservation->getUserId(), $reservation->getIdMatch(), $reservation->getTotalPrice()));
       return $this->pdo->lastInsertId();
    }


    public function countTotalEarning(){
    $query = "select sum(total_price) from reservation";
    $statement=$this->pdo->prepare($query);
    $statement->execute();
    return $statement->fetchColumn();
    }
}