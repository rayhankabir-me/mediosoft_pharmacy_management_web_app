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