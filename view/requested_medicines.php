<?php
$page_title = 'All Medicine Category';
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}

include_once('../model/requestModel.php');




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
                            <div class="table-data">
                                <div class="form-title">
                                    <h3>All Medicine Requests</h3>
                                </div>

                                <div class="all-medicines">
                                    <table class="table" id="show_requests">

                                    </table>
                                </div>
                                <div id="status_messages"></div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>



    
    <script>
        //showing category with ajax
        showRequests();
        function showRequests(){

            let action = 'get_request';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/requestController.php?action='+action, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('show_requests').innerHTML = this.responseText;
                }
            }

        }
        //delete operation using ajax
        function deleteRequest(event){
            event.preventDefault();
            alert('are you sure to delete this request?');
            let request_id = event.target.getAttribute('data-request-id');
            request_id = parseInt(request_id);

            let action = 'delete_request';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/requestController.php?action='+action+'&request_id='+request_id, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){

                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('status_messages').innerHTML = this.responseText;
                    showRequests();
                }
            }

        }
    </script>


<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>