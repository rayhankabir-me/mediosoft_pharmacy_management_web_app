<?php
require_once('db.php');

//get all company data
function get_all_medicine_company_data(){
    $conneciton = get_connection();
    $sql = "SELECT * FROM medicines_company";
    $result = mysqli_query($conneciton, $sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        array_push($data, $row);
    }

    return $data;

}



//add company
function add_company($data){
    $conneciton = get_connection();
    $sql = "INSERT INTO medicines_company (company_name, description, added_by)
    VALUES ('{$data['company_name']}', '{$data['description']}', {$data['added_by']})";
    $result = mysqli_query($conneciton, $sql);
    return $result;
}

//get all company data
function get_all_company_data(){
    $conneciton = get_connection();
    $sql = "SELECT * FROM medicines_company";
    $result = mysqli_query($conneciton, $sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        array_push($data, $row);
    }

    return $data;

}


//delete company
function delete_compnay($id){
    $conneciton = get_connection();
    $sql = "DELETE FROM medicines_company WHERE id={$id}";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}

//get company data by id
function get_company_data($id){
    $conneciton = get_connection();
    $sql = "SELECT * FROM medicines_company WHERE id = {$id}";
    $result = mysqli_query($conneciton, $sql);
    $data = $result->fetch_assoc();
    return $data;
}


//update category
function update_company($id, $data){
    $conneciton = get_connection();
    $sql = "UPDATE medicines_company SET company_name='{$data['company_name']}', description='{$data['description']}' WHERE id = $id";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }

}


//count total medicine company
function count_total_medicine_company(){
    $conneciton = get_connection();
    $sql = "SELECT * from medicines_company";
    $result = mysqli_query($conneciton, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}

?>