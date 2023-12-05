<?php

$page_title = "My Chat Lists - MedioSoft";
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
include_once('../model/usersModel.php');
include_once('../model/chatModel.php');

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
                                    <h3>My Chat Lists</h3>
                                </div>

                                <div class="all-medicines">
                                    <table class="table" border="1" width="100%">
                                        <tr>
                                            <td>Chat Title</td>
                                            <td>Created At</td>
                                            <td>Action</td>
                        
                                        </tr>
                                        <?php
                                        //get all chat data
                                        $chats = get_all_chats_data_for_customers($get_current_user_info['id']);
                                        
                                        foreach ($chats as $chat): ?>
                                            <tr>
                                                <td><?php echo $chat['chat_subject']; ?></td>
                                                <td><?php echo $chat['created_at']; ?></td>
                                                <td><a href="../view/live_chat.php?id=<?php echo $chat['id']; ?>">Live Chat</a></td>
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
