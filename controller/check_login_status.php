<?php

//check login status with session cookie
function check_login_status() {
    session_start();
    if (isset($_SESSION['user_login'])) {
        return true; 
    } elseif (isset($_COOKIE['remember_user'])) {
        $_SESSION['user_login'] = $_COOKIE['remember_user'];
        return true; 
    } 
    // else {
    //     session_destroy();
    //     header("Location: ../view/home.php");
    //     exit();

    // }
}





?>
