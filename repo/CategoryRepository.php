<?php

require_once __DIR__."/../classes/Category.php";
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


    function getCategoriesByMatchId($match_id)
    {
        $query = 'select * from ticket_categorie where match_id = ?';
        $stmt = $this->con->prepare($query);
        $stmt->execute(array($match_id));
        $arrayOfCategories = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $category = Category::categoryMaker($row);
            $arrayOfCategories[] = $category;
        }
       return $arrayOfCategories;
    }

    function getMaxPerCategory($category_id)
    {
        $query = "select max_seats from ticket_categorie where id = ? ";
        $stmt = $this->con->prepare($query);
        $stmt->execute(array($category_id));
        $row = $stmt->fetchColumn();
        return $row;
    }



    public function getMaxSeats($category_id)
    {
        $query="select max_seats from ticket_categorie where id=?";
        $stmt = $this->con->prepare($query);
        $stmt->execute(array($category_id));
        return $stmt->fetchColumn();

    }
    public function getMatchId($category_id)
    {
        $query="select match_id from ticket_categorie where id=?";
        $stmt = $this->con->prepare($query);
        $stmt->execute(array($category_id));
        return $stmt->fetchColumn();
    }


    public function getCategoryById($category_id){
        $query="select * from ticket_categorie where id=?";
        $stmt = $this->con->prepare($query);
        $stmt->execute(array($category_id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return Category::categoryMaker($row);
    }

}