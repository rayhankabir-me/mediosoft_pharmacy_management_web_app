<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/medicineCategoryModel.php');
$action = $_REQUEST['action'];
if($action == 'add_category'){

    $error_message = '';

    $category_title = $_REQUEST['category_title'];
    $description = $_REQUEST['description'];
    $added_by = $_REQUEST['added_by'];


    if($category_title == ''){
        $error_message .= '<p id="error_message">you must fill category name!</p>';
    }
    if($description == ''){
        $error_message .= '<p id="error_message">you must fill category decription!</p>';
    }

    //data array
   $data = [
    'category_title' => $category_title,
    'description' => $description,
    'added_by' => $added_by,
    ];

     if($error_message === ''){

         $result = add_category($data);
     
         if($result === true){
             echo '<p id="success_message">Category created successfully!</p>';
         }elseif ($result === false) {
             echo '<p id="error_message">Category created failed... try again!</p>';
         }
         
    }else{
        echo $error_message;
    }
 
 
 
    
 }


?>