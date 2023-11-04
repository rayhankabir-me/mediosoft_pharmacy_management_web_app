<?php


function check_session_cookie() {
    session_start();

    if (!isset($_SESSION["user_login"])) {
        if (!isset($_COOKIE['remember_user'])) {
            header("Location: ../view/login.php");
            exit();
        }
    }
}


?>
