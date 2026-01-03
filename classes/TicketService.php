<?php

class TicketService
{
    private PDO $pdo;
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function buyTicket($categori_id)
    {
        ............
    }
}