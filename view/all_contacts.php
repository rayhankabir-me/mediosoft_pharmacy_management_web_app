<?php
$page_title = 'All Contacts - MedioSoft';
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}

include_once('../model/contactModel.php');




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
                                    <h3>All Contacts</h3>
                                </div>

                                <div class="all-medicines">
                                    <table class="table" id="show_contacts">

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
        showContacts();
        function showContacts(){

            let action = 'get_contacts';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/contactController.php?action='+action, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('show_contacts').innerHTML = this.responseText;
                }
            }

        }
        //delete operation using ajax
        function deleteContact(event){
            event.preventDefault();

            alert('are you sure to delete this contact?');

            let contact_id = event.target.getAttribute('data-contact-id');
            contact_id = parseInt(contact_id);

            let action = 'delete_contact';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/contactController.php?action='+action+'&contact_id='+contact_id, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){

                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('status_messages').innerHTML = this.responseText;
                    showContacts();
                }
            }

        }
    </script>


<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>