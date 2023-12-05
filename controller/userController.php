<?php

//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/usersModel.php');
require_once('../controller/functions.php');

$action = $_REQUEST['action'];

  //current data in udpate field
  if($action == 'current_data'){
    $user_id=  $_REQUEST['user_id'];
    $users_data = get_user($user_id);

    echo json_encode($users_data);

}

// update user data operations using ajax

if($action == 'update_user'){

    $user_id = $_REQUEST['user_id'];

    $error_message = '';
    $profile_photo = $_FILES['profile_photo'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];


    if($profile_photo == ''){
        $error_message .= '<p id="error_message">you must select an image!</p>';
    }
    if($email == ''){
        $error_message .= '<p id="error_message">you must fill your email!</p>';
    }
    if($full_name == ''){
        $error_message .= '<p id="error_message">you must fill full name!</p>';
    }
    if($date_of_birth == ''){
        $error_message .= '<p id="error_message">you must fill date of birth!</p>';
    }
 
    // file info
    $source = $profile_photo['tmp_name'];
    $destination = '../assets/image/users/'.$profile_photo['name'];
 
 
    //data array
    $data = [
     'profile_photo' => $destination,
     'email' => $email,
     'full_name' => $full_name,
     'gender' => $gender,
     'date_of_birth'   => $date_of_birth,
 
     ];
 
     if($error_message === ''){
 
         $result = edit_profile($user_id, $data);
     
         if($result === true){
             
             if (!file_exists($destination)) {
                 if(move_uploaded_file($source, $destination)){
                 }
             }
             echo '<p id="success_message">profile udpated successfully!</p>';
         }elseif ($result === false) {
            echo '<p id="error_message">profile updated failed... try again!</p>';
         }
         
        }else{
            echo $error_message;
        }
}

//change password using ajax
if($action == 'change_password'){
    $user_id = $_REQUEST['user_id'];

    $error_message = '';
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $c_password = $_POST['c_password'];

    if($password == ''){
        $error_message .= '<p id="error_message">your must enter your current password!</p>';
    }else if($new_password == ''){
        $error_message .= '<p id="error_message">you must enter new password!</p>';
    }else if($c_password == ''){
        $error_message .= '<p id="error_message">you must enter confirm password!</p>';
    }else if($new_password !== $c_password){
        $error_message .= '<p id="error_message">new password and confirm password don not match!</p>';
    }else if(password_validation($new_password) === false){
        $error_message .= '<p id="error_message">your password format is wrong!</p>';
    }
    else if($password !== get_password($user_id)){
        $error_message .= '<p id="error_message">your password don not match the current password!</p>';
    }

 
     if($error_message === ''){

        
        
         $result = update_password($user_id, $new_password);
     
         if($result === true){
            
             echo '<p id="success_message">password changed successfully!</p>';
         }elseif ($result === false) {
            echo '<p id="error_message">password change failed... try again!</p>';
         }
         
        }else{
            echo $error_message;
        }

}


?>