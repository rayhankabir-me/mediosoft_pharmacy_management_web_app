<?php
require_once('db.php');

//get all current data
function get_all_current_data(){
    $conneciton = get_connection();
    $sql = "SELECT * FROM pages_options";
    $result = mysqli_query($conneciton, $sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        array_push($data, $row);
    }

    return $data;

}

//update landing pages options
function update_landing_pages_options($data){
    $conneciton = get_connection();
    $sql = "UPDATE pages_options SET banner_title='{$data['banner_title']}', banner_description='{$data['banner_description']}', btn_text='{$data['btn_text']}', button_url='{$data['button_url']}'";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }

}

//update landing pages options
function update_contact_pages_options($data){
    $conneciton = get_connection();
    $sql = "UPDATE pages_options SET map_link='{$data['map_link']}', facebook_link='{$data['facebook_link']}', twitter_link='{$data['twitter_link']}', linkedin_link='{$data['linkedin_link']}', phone_number='{$data['phone_number']}', office_address='{$data['office_address']}'";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }

}

?>