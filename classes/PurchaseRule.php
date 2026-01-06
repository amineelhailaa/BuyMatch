<?php
require_once __DIR__ . "/../repo/TicketRepository.php";
require_once __DIR__ . "/../repo/CategoryRepository.php";

class PurchaseRule
{
    private static int $max_per_user = 4;

    public static function check($category_id, $quantity)
    {
        $user_id = $_SESSION["user_id"];
        $pdo = Database::getConnection();
        $repoTicket = new TicketRepository($pdo);
        $repoCategory = new CategoryRepository($pdo);
        $match_id = $repoCategory->getMatchId($category_id);
        $categorymax = $repoCategory->getMaxSeats($category_id);
        $userTickets = $repoTicket->getTicketsCountByUserInMatch($_SESSION["user_id"], $match_id);
        $existingTicket = $repoTicket->getCount($category_id);
        if ($userTickets + $quantity <= self::$max_per_user && $categorymax - $existingTicket >= $quantity) {
            return true;
        }
        return false;
    }


}