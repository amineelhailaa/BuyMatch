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


    public function getAllComment(): array
    {
        $query= "select *,u.nom as username,c.id as id from commentaire c join utilisateur u on c.user_id=u.id";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $comments = [];
        foreach ($rows as $row){
            $comment = CommentMaker::makeComment($row);
            $comments[] = $comment;
        }
        return $comments;
    }

    public function getCommentByOrganizer($organizer){
        $query = "select *,u.nom as username, c.id as id from commentaire c join utilisateur u on c.user_id=u.id join matches m on m.id=c.id_match where m.organizer_id=?";
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($organizer));
        $rows = $statement->fetchAll();
        $comments = [];
        foreach ($rows as $row){
            $comment = CommentMaker::makeComment($row);
            $comments[] = $comment;
        }
        return $comments;
    }
    public function deleteComment($commentID){
        $query= "delete from commentaire where id = ?";
        $statement = $this->pdo->prepare($query);
        return $statement->execute(array($commentID));
    }
}