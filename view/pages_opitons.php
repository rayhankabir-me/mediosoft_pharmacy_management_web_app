<?php
$page_title = "Pages Options - MedioSoft";
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
require_once('../model/usersModel.php');
if(!check_login_status()){
    header('location: login.php');
}



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
                                <div class="form-title">
                                    <h3>Pages Options</h3>
                                </div>

                                <!-- landing pages options form -->
                                <div class="medio-form page-options-form">
                                    <form action="#" method="post" onsubmit="landingPage()">
                                        <fieldset>
                                            <legend>Landing Page Options</legend>
                                            <label for="banner_title">Banner Title</label>
                                            <input type="text" name="banner_title" id="banner_title" value="">
                                            <label for="banner_description">Banner Description </label>
                                            <textarea name="banner_description" id="banner_description"></textarea>
                                            <label for="btn_text">Button Text</label>
                                            <input type="text" name="btn_text" id="btn_text">
                                            <label for="button_url">Button Url</label>
                                            <input type="text" name="button_url" id="button_url">
                                            <input type="submit" value="Save Changes" name="submit">
                                        </fieldset>


                                    </form>
                                </div>
                                <!-- contat pages options form -->
                                <div class="medio-form page-options-form">
                                    <form action="#" method="post" onsubmit="contactPage()">
                                        <fieldset>
                                            <legend>Contact Page Options</legend>
                                            <label for="map_link">Map Link</label>
                                            <input type="text" name="map_link" id="map_link" value="">
                                            <label for="facebook_link">Facebook Url </label>
                                            <input type="text" name="facebook_link" id="facebook_link">
                                            <label for="twitter_link">Twitter Link</label>
                                            <input type="text" name="twitter_link" id="twitter_link">
                                            <label for="linkedin_link">Linkedin Link</label>
                                            <input type="text" name="linkedin_link" id="linkedin_link">
                                            <label for="phone_number">Help Line</label>
                                            <input type="text" name="phone_number" id="phone_number">
                                            <label for="office_address">Office Address</label>
                                            <input type="text" name="office_address" id="office_address">
                                            <input type="submit" value="Save Changes" name="submit">
                                        </fieldset>


                                    </form>
                                </div>
                                <div id="status_messages"></div>
                        </div>
                    </div>
                </div>
            </div>


    
    <script>

        showData();
        //fetch current data using ajax
        function showData(){
            let action = 'current_data';
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/pagesoptionsController.php?action='+action, true);
            xhttp.send();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    let data = JSON.parse(this.responseText);
                    document.getElementById('banner_title').value = data[0].banner_title;
                    document.getElementById('banner_description').value = data[0].banner_description;
                    document.getElementById('btn_text').value = data[0].btn_text;
                    document.getElementById('button_url').value = data[0].button_url;
                    document.getElementById('map_link').value = data[0].map_link;
                    document.getElementById('facebook_link').value = data[0].facebook_link;
                    document.getElementById('twitter_link').value = data[0].twitter_link;
                    document.getElementById('linkedin_link').value = data[0].linkedin_link;
                    document.getElementById('phone_number').value = data[0].phone_number;
                    document.getElementById('office_address').value = data[0].office_address;
                }
            }


        }


        //update home landing page options by ajax
        function landingPage(){
            event.preventDefault();

            let banner_title = document.getElementById('banner_title').value;
            let banner_description = document.getElementById('banner_description').value;
            let btn_text = document.getElementById('btn_text').value;
            let button_url = document.getElementById('button_url').value;


            let action = 'landing_page_options';

            let xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../controller/pagesoptionsController.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('action=' + action + '&banner_title='+banner_title + '&banner_description='+banner_description + '&btn_text='+btn_text + '&button_url='+button_url);
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('status_messages').innerHTML = this.responseText;
                    showData();
                }
            }




        }

        //update contact page options by ajax
        function contactPage(){
            event.preventDefault();

            let map_link = document.getElementById('map_link').value;
            let facebook_link = document.getElementById('facebook_link').value;
            let twitter_link = document.getElementById('twitter_link').value;
            let linkedin_link = document.getElementById('linkedin_link').value;
            let phone_number = document.getElementById('phone_number').value;
            let office_address = document.getElementById('office_address').value;


            let action = 'contact_page_options';

            let xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../controller/pagesoptionsController.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('action=' + action + '&map_link='+map_link + '&facebook_link='+facebook_link + '&twitter_link='+twitter_link + '&linkedin_link='+linkedin_link + '&phone_number='+phone_number + '&office_address='+office_address);
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById('status_messages').innerHTML = this.responseText;
                    showData();
                }
            }




        }
    </script>
<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>