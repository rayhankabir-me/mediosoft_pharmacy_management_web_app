<?php
//requring database
require_once('db.php');

//add request
function add_contact($data){
    $conneciton = get_connection();
    $sql = "INSERT INTO contacts (name, contact_subject, email, message) VALUES ('{$data['name']}', '{$data['contact_subject']}', '{$data['email']}', '{$data['message']}')";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}


//get all contacts
function get_all_contacts(){
    $conneciton = get_connection();
    $sql = "SELECT * FROM contacts";
    $result = mysqli_query($conneciton, $sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        array_push($data, $row);
    }

    return $data;
}


//delete rquest
function delete_contact($id){
    $conneciton = get_connection();
    $sql = "DELETE FROM contacts WHERE id={$id}";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}
?>