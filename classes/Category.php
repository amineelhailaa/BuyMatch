<?php

class Category
{
    private int $id;
    private $label;
    private $price;
    private $max_seats;

    public function __construct(int $id,$label, int $price, int $max_seats){
        $this->id = $id;
        $this->label = $label;
        $this->price = $price;
        $this->max_seats = $max_seats;
    }

    public function getId() : int {
        return $this->id;
    }
    public function getLabel() : string {
        return $this->label;
    }
    public function getPrice() : int {
        return $this->price;
    }
    public function getMaxSeats() : int {
        return $this->max_seats;
    }

    public static function categoryMaker($row)
    {
        return new self($row['id'],$row['label'],$row['price'],$row['max_seats']);
    }
    


}