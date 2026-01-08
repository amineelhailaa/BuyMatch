<?php

require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../repo/MatchRepository.php';
require_once __DIR__.'/../repo/TicketRepository.php';

class CommentRule
{


    public static function checkCanComment($userId,$matchId)
    {
        $ticketRepo = new TicketRepository(Database::getConnection());
        $count = $ticketRepo->getTicketsCountByUserInMatch($userId,$matchId);
        if ($count != 0){
            return true;
        }
        return false;
    }

    public static function matchCommentable($matchId) : bool
    {
        $matchRepo = new MatchRepository(Database::getConnection());
        $match = $matchRepo->getMatcheById($matchId);
        $date = $match->getDate();
        $time = $match->getTime();
        $matchDate = strtotime($date." ".$time);
        $now =time();
        if($now > $matchDate+(100*60)){
            return true;
        }
        return false;
    }

}