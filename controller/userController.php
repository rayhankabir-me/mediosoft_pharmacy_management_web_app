<?php
//auth
include_once('../view/component/dashboard_sidebar.php');
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/usersModel.php');

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


?>