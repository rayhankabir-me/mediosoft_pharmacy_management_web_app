<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/medicinesModel.php');

$action = $_POST['action'];

if($action == 'add_medicine'){

    $error_message = '';
    $image_url = $_FILES['image_url'];
    $medicine_title = $_POST['medicine_title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $company_id = $_POST['company_id'];
    $medicine_price = $_POST['medicine_price'];
    $medicine_quanity = $_POST['medicine_quanity'];
    $manufacturing_date = $_POST['manufacturing_date'];
    $expire_date = $_POST['expire_date'];
    $added_by = $_POST['added_by'];

 
 
    if($image_url == ''){
        $error_message .= '<p id="error_message">you must select an image!</p>';
    }
    if($medicine_title == ''){
        $error_message .= '<p id="error_message">you must fill medicine title!</p>';
    }
    if($description == ''){
        $error_message .= '<p id="error_message">you must fill medicine description!</p>';
    }
    if($category_id == ''){
        $error_message .= '<p id="error_message">you must select a category!</p>';
    }
    if($company_id == ''){
        $error_message .= '<p id="error_message">you must select a company!</p>';
    }
    if($medicine_price == ''){
        $error_message .= '<p id="error_message">you must fill medicine price!</p>';
    }
    if($medicine_quanity == ''){
        $error_message .= '<p id="error_message">you must fill medicine quantity!</p>';
    }
    if($manufacturing_date == ''){
        $error_message .= '<p id="error_message">you must full manufacturing date!</p>';
    }
    if($expire_date == ''){
        $error_message .= '<p id="error_message">you must full expire date!</p>';
    }
 
    // file info
    $source = $image_url['tmp_name'];
    $destination = '../assets/image/medicines/'.$image_url['name'];
 
 
    //data array
    $data = [
     'image_url' => $destination,
     'medicine_title' => $medicine_title,
     'description' => $description,
     'category_id'   => $category_id,
     'company_id'   => $company_id,
     'medicine_price'   => $medicine_price,
     'medicine_quanity'   => $medicine_quanity,
     'added_by'       => $added_by,
     'manufacturing_date'   => $manufacturing_date,
     'expire_date'       => $expire_date,
 
     ];
 
     if($error_message === ''){
 
         $result = add_medicine($data);
     
         if($result === true){
             
             if (!file_exists($destination)) {
                 if(move_uploaded_file($source, $destination)){
                 }
             }
             echo '<p id="success_message">medicine added successfully!</p>';
         }elseif ($result === false) {
            echo '<p id="error_message">medicine added failed... try again!</p>';
         }
         
        }else{
            echo $error_message;
        }

    // echo $image_url;
    // echo $medicine_title."<br>";
    // echo $description."<br>";
    // echo $category_id."<br>";
    // echo $company_id."<br>";
    // echo $medicine_price. "<br>";
    // echo $medicine_quantity."<br>";
    // echo $manufacturing_date."<br>";
    // echo $expire_date."<br>";
    // echo $added_by."<br>";
}








?>