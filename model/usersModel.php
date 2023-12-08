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

    if(isset($_SESSION['user_login'])){
        $session_username = $_SESSION['user_login'];
    }

    $conneciton = get_connection();
    $sql = "SELECT id FROM users WHERE user_name = '{$session_username}'";
    $result = mysqli_query($conneciton, $sql);
    $data = $result->fetch_assoc();
    return $data['id'];
}

//get current user type
function get_current_user_type(){
    session_start();
    $session_username = '';

    if(isset($_SESSION['user_login'])){
        $session_username = $_SESSION['user_login'];
    }

    $conneciton = get_connection();
    $sql = "SELECT user_type FROM users WHERE user_name = '{$session_username}'";
    $result = mysqli_query($conneciton, $sql);
    $data = $result->fetch_assoc();
    return $data['user_type'];
}


function get_all_users(){

    $connection = get_connection();
    $sql = "SELECT * FROM users";

    $result = mysqli_query($connection, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users = [
            'id'    => $row['id'],
            'user_name' => $row['user_name'],
            'full_name' => $row['full_name'],
            'email' => $row['email'],
            'gender' => $row['gender'],
            'date_of_birth' => $row['date_of_birth'],
            'profile_photo' => $row['profile_photo'],
            'password' => $row['password'],
            'user_type' => $row['user_type'],
            'user_status' => $row['user_status'],

        ];
        array_push($data, $users);
    }

    return $data;

}

//get user data by id
function get_user($id){
    $conneciton = get_connection();
    $sql = "SELECT * FROM users WHERE id = {$id}";
    $result = mysqli_query($conneciton, $sql);
    $data = $result->fetch_assoc();
    return $data;

}
//register user
function create_user($user_data){
    $conneciton = get_connection();
    $sql = "INSERT INTO users (user_name, full_name, email, gender, date_of_birth, password, user_type)
    VALUES ('{$user_data['user_name']}', '{$user_data['full_name']}', '{$user_data['email']}', '{$user_data['gender']}', '{$user_data['date_of_birth']}', '{$user_data['password']}', '{$user_data['user_type']}')";
    $result = mysqli_query($conneciton, $sql);
    return $result;
}
//add user
function add_user($user_data){
    $conneciton = get_connection();
    $sql = "INSERT INTO users (user_name, email, full_name, password, gender, date_of_birth, user_type)
    VALUES ('{$user_data['username']}', '{$user_data['email']}', '{$user_data['full_name']}', '{$user_data['password']}', '{$user_data['gender']}', '{$user_data['date_of_birth']}', '{$user_data['user_type']}')";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}

function update_user($id, $data){
    $conneciton = get_connection();
    $sql = "UPDATE users SET user_name='{$data['username']}', full_name='{$data['full_name']}', email='{$data['email']}', gender='{$data['gender']}', date_of_birth='{$data['date_of_birth']}', profile_photo='{$data['profile_photo']}', password='{$data['password']}', user_type='{$data['user_type']}', user_status='{$data['user_status']}' WHERE id = $id";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}

//delete user
function delete_user($id){
    $conneciton = get_connection();
    $sql = "DELETE FROM users WHERE id={$id}";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
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
//get password by user id
function get_password($id){
    $conneciton = get_connection();
    $sql = "SELECT password FROM users WHERE id = {$id}";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        return $password;
    }
    
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
//get user data by username
function get_current_user_info(){
    session_start();
    $session_username = '';

    if(isset($_SESSION['user_login'])){
        $session_username = $_SESSION['user_login'];
    }
    $conneciton = get_connection();
    $sql = "SELECT * FROM users WHERE user_name = '{$session_username}'";
    $result = mysqli_query($conneciton, $sql);
    $user_data = $result->fetch_assoc();
    return $user_data;
}

//edit profile
function edit_profile($user_id, $data){
    $conneciton = get_connection();
    $sql = "UPDATE users SET full_name='{$data['full_name']}', email='{$data['email']}', gender='{$data['gender']}', date_of_birth='{$data['date_of_birth']}', profile_photo='{$data['profile_photo']}' WHERE id = $user_id";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}

//change password
function update_password($id, $password){
    $conneciton = get_connection();
    $sql = "UPDATE users SET password='{$password}' WHERE id = $id";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}


//count total users
function count_total_users(){
    $conneciton = get_connection();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conneciton, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}
//count total pharmacists
function count_total_pharmacists(){
    $conneciton = get_connection();
    $sql = "SELECT * FROM users WHERE user_type = 'Pharmacist'";
    $result = mysqli_query($conneciton, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}
//count total customers
function count_total_customers(){
    $conneciton = get_connection();
    $sql = "SELECT * FROM users WHERE user_type = 'Customer'";
    $result = mysqli_query($conneciton, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}
?>