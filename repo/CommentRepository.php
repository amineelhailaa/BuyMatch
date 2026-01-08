<?php

require_once __DIR__.'/../classes/CommentMaker.php';

class CommentRepository
{

    private $pdo;
    public function __construct( $pdo){
        $this->pdo = $pdo;
    }

    public function addComment(Comment $comment): void{
        $query= "insert into commentaire (user_id,id_match,comment) values (?,?,?) ";
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($comment->getUserId(), $comment->getIdMatch(), $comment->getComment()));
    }


    public function getComments(int $idMatch){
        $query= "select *,u.nom as username from commentaire c join utilisateur u on c.user_id=u.id where id_match = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($idMatch));
        $rows = $statement->fetchAll();
        $comments = [];
        foreach ($rows as $row){
            $comment = CommentMaker::makeComment($row);
            $comments[] = $comment;
        }
        return $comments;
    }

}