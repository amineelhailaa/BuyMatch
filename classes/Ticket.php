<?php

class Ticket
{
    private ?int $id;
    private $id_reservation;
    private $id_category;
    private $price;

    public function __construct($id_reservation, $id_category, $price, ?int $id = null)
    {
        $this->id = $id;
        $this->id_reservation = $id_reservation;
        $this->id_category = $id_category;
        $this->price = $price;
    }
    public function getId(){ return $this->id; }
    public function getIdReservation(){ return $this->id_reservation; }
    public function getIdCategory(){ return $this->id_category; }
    public function getPrice(){ return $this->price; }
    public function setId($id): void
    {
        $this->id = $id;
    }
}