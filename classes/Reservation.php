<?php

class Reservation
{
    private ?int $id;
    private int $user_id;
    private int $id_match;
    private int $total_price;

    public function __construct( int $user_id, int $id_match, int $total_price,?int $id = null )
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->id_match = $id_match;
        $this->total_price = $total_price;
    }
    public function getId(){ return $this->id; }
    public function getUserId(){ return $this->user_id; }
    public function getIdMatch(){ return $this->id_match; }
    public function getTotalPrice(){ return $this->total_price; }
    public function setId(int $id){ $this->id = $id; }


}