<?php
    @session_start();
    error_reporting(0);
    if(!isset($_SESSION['email']) || $_SESSION["status"] != TRUE){

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit();
    }