<?php
//requring database
require_once('db.php');

//add request
function add_request($data){
    $conneciton = get_connection();
    $sql = "INSERT INTO medicine_requests (medicine_name, medicine_category, company_name, medicine_country, name, email, message) VALUES ('{$data['medicine_name']}', '{$data['medicine_category']}', '{$data['company_name']}', '{$data['medicine_country']}', '{$data['name']}', '{$data['email']}', '{$data['message']}')";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}
?>