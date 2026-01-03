<?php

class CategoryRepository
{
    private PDO $con;
    public function __construct($con)
    {
        $this->con = $con;
    }

    function createCategory($match_id,$label,$price,$maxSeats): void
    {
        $query = 'insert into ticket_categorie (match_id,label,price,max_seats) values(?,?,?,?)';
        $stmt = $this->con->prepare($query);
        $stmt->execute(array($match_id,$label,$price,$maxSeats));
    }

}