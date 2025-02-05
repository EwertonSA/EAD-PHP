<?php
if(!function_exists("protect")){
function protect($admin = 0) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario'])) {
        die("<script>location.href='login.php';</script>");
        exit;
    }

    if ($admin == 1 && (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1)) {
        die("<script>location.href='login.php';</script>");
        exit;
    }
}
}