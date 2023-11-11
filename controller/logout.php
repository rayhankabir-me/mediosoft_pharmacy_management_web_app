<?php
session_start();
session_destroy();
unset($_SESSION['user_login']);


if (isset($_COOKIE["remember_user"])) {
    setcookie("remember_user", "", time() - 3600, "/");
}


header("location: ../view/login.php");
exit();
?>
