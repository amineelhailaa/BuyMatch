<?php

require_once "../classes/CommentSummary.php";
class CommentMaker
{

    public static function makeComment($row)
    {
        return new CommentSummary($row['user_id'],$row['id_match'],$row['comment'],$row['date'],$row['username'],$row['id']);

    }

}