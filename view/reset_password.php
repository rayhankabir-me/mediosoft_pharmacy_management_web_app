<?php
    session_start();
    if(isset($_SESSION['reset_password'])){
        echo $_SESSION['reset_password'];
    }


    
?>