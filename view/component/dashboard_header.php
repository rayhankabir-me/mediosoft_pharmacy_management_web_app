<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo isset($page_title) ? $page_title : 'MedioSoft Pharmacy Management App'; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <header class="dashboard_header">
        <div class="container">
            <div class="row align-items-center">
                <div class="column-twenty-five">
                    <div class="logo-area">
                        <a href="../view/dashboard.php"><img src="../assets/image/mediosoft-logo.png" alt=""></a>
                    </div>
                </div>
                <div class="column-seventy-seven text-right">
                    <div class="menu-area">
                        <p>Welcome back! <strong><?php echo $get_current_user_info['full_name']; ?></strong>
                        | <a href="#">Notifications</a> 
                        | <a href="../index.php">Visit Site</a>  
                        | <a href="../controller/logout.php">Logout</a>
                        </p>
                    </div>
                </div>
            </div>


        </div>
    </header>





