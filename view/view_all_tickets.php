<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
require_once('../model/supportTicketsModel.php');

$get_current_user_info = get_current_user_info();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View All Tickets</title>
</head>
<body>

    <table border="1" width="100%">
    <tr>
        <td><a href="index.php"><h2>MedioSoft</h2></a></td>
        <td colspan="2">
            Welcome back! <strong><?php echo $get_current_user_info['full_name']; ?></strong>
             | Notifications 
             | <a href="../index.php">Visit Site</a>  
             | <a href="../controller/logout.php">Logout</a>
        </td>
    </tr>

    <tr>

        <td>
        <?php echo get_sidebar();?>
        </td>


        <td colspan="2">
            <br>
            <br>
                <h3>All Tickets</h3>
                <table border="1" width="100%">
                    <tr>
                        <td>Medicine Name</td>
                        <td>Ticket Title</td>
                        <td>Requested By</td>
                        <td>Action</td>
    
                    </tr>
                    <?php
                    //get all tickets data
                    $tickets = get_all_tickets_data_for_pharmacists($get_current_user_info['id']);
                    
                    foreach ($tickets as $ticket): ?>
                        <tr>
                            <td><?php echo $ticket['medicine_title']; ?></td>
                            <td><?php echo $ticket['ticket_subject']; ?></td>
                            <td><?php echo $ticket['requested_by_name']; ?></td>
                            <td><a href="../view/ticket_page.php?ticket_id=<?php echo $ticket['ticket_id']; ?>">Reply Ticket</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            <br>
            <br>

        </td>
    </tr>
    <tr>
        <td colspan="3">Copyright &copy; 2023 MedioSoft. All rights are reserved.</td>
    </tr>

    </table>

    
</body>
</html>
