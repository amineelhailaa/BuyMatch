<?php

class GuardAuth
{


    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    private static array $dashboard = [
        'acheteur' => 'Location: /buymatch/pages/tickets.php',
        'administrateur' => 'Location: /buymatch/pages/admin/dashboard.php',
        'organisateur' => 'Location: /buymatch/pages/organizer/dashboard.php',
    ];

    public static function getUserId(): ?int
    {
        if(isset($_SESSION["id"])){
            return $_SESSION["id"];
        }
        return null;
    }

    public static function getRole(): ?string
    {
        return $_SESSION['role'] ?? null;
    }

    public static function isLoggedIn()
    {
        if (!self::getUserId()) {
            header("Location: /buymatch/pages/login.php");
            exit();
        }
    }

    public static function requireRole($role): void
    {
        self::isLoggedIn();
        if (self::getRole() != $role) {
            self::redirectToDashboard();
        }
    }

    public static function redirectToDashboard()
    {
        if(self::getUserId()){
            $role = self::getRole();
            header(self::$dashboard[$role]);
            exit();
        }

    }


    public function haveAccess($ticket_id)
    {
        self::requireRole("acheteur");
        $repoTicket = new TicketRepository($this->pdo);
        if ($repoTicket->UserHaveTicket(self::getUserId(), $ticket_id)) {
            return true;
        }
        return false;
    }
}