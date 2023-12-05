<?php
include_once('../controller/check_login_status.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo isset($page_title) ? $page_title : 'MedioSoft Pharmacy Management App'; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <header class="frontend_header">
        <div class="container">
            <div class="row align-items-center">
                <div class="column-twenty-five">
                    <div class="logo-area">
                        <a href="../view/home.php"><img src="../assets/image/mediosoft-logo.png" alt=""></a>
                    </div>
                </div>
                <div class="column-seventy-seven text-right">
                    <div class="frontend-menu-area">
                        <ul>
                            <li><a href="../view/home.php">Home</a></li>
                            <li><a href="../view/medicines.php">Medicines</a></li>
                            <li><a href="../view/blog.php">Blog</a></li>
                            <li><a href="../view/contact.php">Contact</a></li>
                            <li><a href="../view/request_support_ticket.php">Request Ticket</a></li>
                            <li><a href="../view/start_chat.php">Live Chat</a></li>
                            <?php 
                                if(!check_login_status()){
                                    echo '<li><a href="../view/registration.php">Register</a></li>';
                                }
                            ?>
                            <?php 
                                if(!check_login_status()){
                                    echo '<li><a href="../view/login.php">Login</a></li>';
                                }
                            ?>
                            
                            <?php 
                                if(check_login_status()){
                                    echo '<li><a href="../view/dashboard.php">Dashboard</a></li>';
                                }
                            ?>


                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </header>