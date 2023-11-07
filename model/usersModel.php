<?php
require_once('db.php');

function user_login($username, $password){
    $conneciton = get_connection();
    $sql = "SELECT * FROM users WHERE user_name = '{$username}' AND password = '{$password}'";
    $result = mysqli_query($conneciton, $sql);
    $count = mysqli_num_rows($result);

    if($count == 1){
        return true;
    }else{
        return false;
    }
}
//get current user
function get_current_user_id(){
    session_start();
    $session_username = '';
    $user_id = '';
    if(isset($_SESSION['user_login'])){
        $session_username = $_SESSION['user_login'];
    }

    $conneciton = get_connection();
    $sql = "SELECT id FROM users WHERE user_name = '{$session_username}'";
    $result = mysqli_query($conneciton, $sql);
    $data = $result->fetch_assoc();
    return $data['id'];
}


function get_all_users(){


}

function get_user($id){


}

function create_user($user_data){
    $conneciton = get_connection();
    $sql = "INSERT INTO users (user_name, full_name, email, gender, date_of_birth, password, user_type)
    VALUES ('{$user_data['user_name']}', '{$user_data['full_name']}', '{$user_data['email']}', '{$user_data['gender']}', '{$user_data['date_of_birth']}', '{$user_data['password']}', '{$user_data['user_type']}')";
    $result = mysqli_query($conneciton, $sql);
    return $result;
}

function update_user($id){


}

function delete_user($id){


}
//update using token
function update_password_by_token($new_password, $token){
    $conneciton = get_connection();
    $sql = "UPDATE users SET password = '{$new_password}' WHERE reset_token = $token";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true; 
    }else{
        return false;
    }
}
//update token for password reset
function update_token($email, $token){
    $conneciton = get_connection();
    $sql = "UPDATE users SET reset_token = ".$token." WHERE email = '{$email}'";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true; 
    }else{
        return false;
    }
}
//check reset token
function check_reset_token($token){
    $conneciton = get_connection();
    $sql = "SELECT reset_token FROM users WHERE reset_token = $token";
    $result = mysqli_query($conneciton, $sql);
    $count = mysqli_num_rows($result);
    if($count == 1){
        return true;
    }else{
        return false;
    }
}
//check whether email exists or not
function check_user_email($email){
    $conneciton = get_connection();
    $sql = "SELECT email FROM users WHERE email = '{$email}'";
    $result = mysqli_query($conneciton, $sql);
    $count = mysqli_num_rows($result);
    if($count == 1){
        return true;
    }else{
        return false;
    }
}
//get user type by user name
function get_user_type($username){
    $conneciton = get_connection();
    $sql = "SELECT user_type FROM users WHERE user_name = '{$username}'";
    $result = mysqli_query($conneciton, $sql);
    return $result;
    
}
//check whether username already exists
function user_name_exists($username){

    $conneciton = get_connection();
    $sql = "SELECT user_name FROM users WHERE user_name = '{$username}'";
    $result = mysqli_query($conneciton, $sql);
    $count = mysqli_num_rows($result);
    if($count == 1){
        return true;
    }else{
        return false;
    }

}

?>