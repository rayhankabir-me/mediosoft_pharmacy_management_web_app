<?php
$page_title = "Contact Us - MedioSoft";
include_once('../view/component/dashboard_sidebar.php');

//requiring page options model
require_once('../model/pagesoptionsModel.php');

$all_data = get_all_current_data();




?>

<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>

<section class="banner-section">
    <div class="container">
        <div class="banner-title">
            <h2>Contact Us</h2>
        </div>
    </div>
</section>
<section class="main-section">
    <div class="container">
        <div class="row">
            <div class="column-fifty">
                <div class="map-container">
                    <iframe src="<?php echo $all_data[0]['map_link']; ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="column-fifty">
            <div class="form-container">

                <div class="medio-form">
                    <form action="#" method="post" onsubmit="sendContact()">
                        <label for="name">Your Name</label>
                        <input type="text" name="name" id="name">
                        <label for="contact_subject">Subject</label>
                        <input type="text" name="contact_subject" id="contact_subject">
                        <label for="email">Enter Your Email</label>
                        <input type="email" name="email" id="email">
                        <label for="">Message</label>

                        <textarea name="message" id="message" cols="20" rows="10"></textarea>

                        <input type="submit" value="Send">
                        
                        <div id="status_messages"></div>
                    </form>
                </div>
                <div id="status_messages"></div>
                </div>


                <div class="social-icons">
                    <h3>Follow Us On</h3>
                    <p><a href="<?php echo $all_data[0]['facebook_link'];?>">Facebook</a></p>
                    <p><a href="<?php echo $all_data[0]['linkedin_link'];?>">LinkedIin</a></p>
                    <p><a href="<?php echo $all_data[0]['twitter_link'];?>">Twitter</a></p>
                </div>
                <div class="address-and-phone">
                    <h2>Our Office Address</h2>
                    <p><?php echo $all_data[0]['office_address'];?></p>
                </div>
            </div>

        </div>
    </div>
</section>



    <!-- javascript validation -->
    <script>
        function sendContact(){
            event.preventDefault();
            let name = document.getElementById('name').value;
            let contact_subject = document.getElementById('contact_subject').value;
            let email = document.getElementById('email').value;
            let message = document.getElementById('message').value;

            if(name === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must enter your name!</p>';
            }else if(contact_subject === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must enter contact subject!</p>';
            }
            else if(email === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must enter your email!</p>';
            }else if(message === ""){
                document.getElementById('status_messages').innerHTML = '<p id="error_message">you must enter message!</p>';
            }
            else{

                let action = 'send_contact';
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../controller/contactController.php', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('action=' + action + '&name='+name + '&contact_subject='+contact_subject + '&email='+email + '&message='+message);
                xhttp.onreadystatechange = function(){

                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById('status_messages').innerHTML = this.responseText;

                        document.getElementById('name').value = '';
                        document.getElementById('contact_subject').value = '';
                        document.getElementById('email').value = '';
                        document.getElementById('message').value = '';
                    }
                }
            }
        }
        



    </script>
    
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>