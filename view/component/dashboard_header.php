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
                <div class="column-three">
                    <div class="logo-area">
                        <a href="../view/dashboard.php"><img src="../assets/image/mediosoft-logo.png" alt=""></a>
                    </div>
                </div>
                <div class="column-seven text-right">
                    <div class="menu-area">
                        <p>Welcome back! <strong><?php echo $get_current_user_info['full_name']; ?></strong>
                        | Notifications 
                        | <a href="../index.php">Visit Site</a>  
                        | <a href="../controller/logout.php">Logout</a>
                        </p>
                    </div>
                </div>
            </div>


        </div>
    </header>

    <table border="1" width="100%">
    <tr>
        <td><a href="index.php"><h2>MedioSoft</h2></a></td>
        <td colspan="2">

        </td>
    </tr>


    <div class="col-xl-4">

    </div>
    <div class="col-xl-8">

    </div>


