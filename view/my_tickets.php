<?php

$page_title = "My Tickets";
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

<!-- including header -->
<?php include_once('../view/component/dashboard_header.php'); ?>


<div class="main-section">
                <div class="container">
                    <div class="row">
                        <div class="column-thirty-three">
                            <div class="dashboard-sidebar">
                                <?php echo get_sidebar();?>
                            </div>
                        </div>
                        <div class="column-sixty-six">
                            <div class="medicines-container">
                                <div class="form-title">
                                    <h3>My All Tickets</h3>
                                </div>

                                <div class="all-medicines">
                                    <table class="table" border="1" width="100%">
                                        <tr>
                                            <td>Medicine Name</td>
                                            <td>Ticket Title</td>
                                            <td>Action</td>
                        
                                        </tr>
                                        <?php
                                        //get all tickets data
                                        $tickets = get_all_tickets_data_for_customers($get_current_user_info['id']);
                                        
                                        foreach ($tickets as $ticket): ?>
                                            <tr>
                                                <td><?php echo $ticket['medicine_title']; ?></td>
                                                <td><?php echo $ticket['ticket_subject']; ?></td>
                                                <td><a href="../view/ticket_page.php?ticket_id=<?php echo $ticket['ticket_id']; ?>">Reply Ticket</a></td>
                                            </tr>
                                    <?php endforeach; ?>
                                </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
    </div>


    
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>
