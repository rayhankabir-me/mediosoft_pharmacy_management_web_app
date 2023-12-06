<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/pagesoptionsModel.php');
$action = $_REQUEST['action'];





 //current data in udpate field
if($action == 'current_data'){
    $current_data = get_all_current_data();

    echo json_encode($current_data);
}




//update landing page options
if($action == 'landing_page_options'){

    $banner_title = $_REQUEST['banner_title'];
    $banner_description = $_REQUEST['banner_description'];
    $btn_text = $_REQUEST['btn_text'];
    $button_url = $_REQUEST['button_url'];
    //data array
    $data = [
     'banner_title' => $banner_title,
     'banner_description' => $banner_description,
     'btn_text' => $btn_text,
     'button_url' => $button_url,
 
     ];
 
    $result = update_landing_pages_options($data);

    if($result === true){
        echo '<p id="success_message">landing page optios are saved successfully!</p>';
    }elseif ($result === false) {
        echo '<p id="error_message">landing page options save failed... try again!</p>';
    }
         

}


//update contact page options
if($action == 'contact_page_options'){

    $map_link = $_REQUEST['map_link'];
    $facebook_link = $_REQUEST['facebook_link'];
    $twitter_link = $_REQUEST['twitter_link'];
    $linkedin_link = $_REQUEST['linkedin_link'];
    $phone_number = $_REQUEST['phone_number'];
    $office_address = $_REQUEST['office_address'];

    //data array
    $data = [
     'map_link' => $map_link,
     'facebook_link' => $facebook_link,
     'twitter_link' => $twitter_link,
     'linkedin_link' => $linkedin_link,
     'phone_number' => $phone_number,
     'office_address' => $office_address
 
     ];
 
    $result = update_contact_pages_options($data);

    if($result === true){
        echo '<p id="success_message">contact page optios are saved successfully!</p>';
    }elseif ($result === false) {
        echo '<p id="error_message">contact page options save failed... try again!</p>';
    }
         

}



?>