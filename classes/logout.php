<?php


class Logout
{
    public static function logout(){
        if (isset($_GET['action']) && $_GET['action'] == 'logout'){
            session_unset();
            session_destroy();
            header('Location: /buymatch/pages/login.php');
        }
    }
}

