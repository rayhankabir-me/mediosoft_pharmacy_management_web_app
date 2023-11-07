<?php
session_start();
session_unset();
session_destroy();

if (isset($_COOKIE["remember_user"])) {
    setcookie("remember_user", "", time() - 3600, "/");
}
if (isset($_COOKIE["user_type"])) {
    setcookie("user_type", "", time() - 3600, "/");
}

header("location: ../view/login.php");
exit();
?>
