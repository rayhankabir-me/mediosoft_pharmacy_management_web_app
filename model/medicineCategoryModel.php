<?php
require_once('db.php');

//get all category data
function get_all_medicine_category_data(){
    $conneciton = get_connection();
    $sql = "SELECT * FROM medicines_category";
    $result = mysqli_query($conneciton, $sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        array_push($data, $row);
    }

    return $data;

}


//add category
function add_category($data){
    $conneciton = get_connection();
    $sql = "INSERT INTO medicines_category (category_title, description, added_by)
    VALUES ('{$data['category_title']}', '{$data['description']}', {$data['added_by']})";
    $result = mysqli_query($conneciton, $sql);
    return $result;
}


//get all category data
function get_all_category_data(){
    $conneciton = get_connection();
    $sql = "SELECT * FROM medicines_category";
    $result = mysqli_query($conneciton, $sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        array_push($data, $row);
    }

    return $data;

}

//delete category
function delete_category($id){
    $conneciton = get_connection();
    $sql = "DELETE FROM medicines_category WHERE id={$id}";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}

//get category data by id
function get_category_data($id){
    $conneciton = get_connection();
    $sql = "SELECT * FROM medicines_category WHERE id = {$id}";
    $result = mysqli_query($conneciton, $sql);
    $data = $result->fetch_assoc();
    return $data;
}


//update category
function update_category($id, $data){
    $conneciton = get_connection();
    $sql = "UPDATE medicines_category SET category_title='{$data['category_title']}', description='{$data['description']}' WHERE id = $id";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }

}


//count total medicine category
function count_total_medicine_category(){
    $conneciton = get_connection();
    $sql = "SELECT * FROM medicines_category";
    $result = mysqli_query($conneciton, $sql);
    $count = mysqli_num_rows($result);
    return $count;
}

?>