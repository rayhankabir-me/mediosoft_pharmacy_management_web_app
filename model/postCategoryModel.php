<?php
require_once('db.php');
//add category
function add_category($data){
    $conneciton = get_connection();
    $sql = "INSERT INTO posts_category (category_name, short_description, added_by)
    VALUES ('{$data['category_name']}', '{$data['short_description']}', {$data['user_id']})";
    $result = mysqli_query($conneciton, $sql);
    return $result;
}
//update category
function update_category($id, $data){
    $conneciton = get_connection();
    $sql = "UPDATE posts_category SET category_name='{$data['category_name']}', short_description='{$data['short_description']}' WHERE id = $id";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }

}

//delete category
function delete_category($id){
    $conneciton = get_connection();
    $sql = "DELETE FROM posts_category WHERE id={$id}";
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
    $sql = "SELECT * FROM posts_category WHERE id = {$id}";
    $result = mysqli_query($conneciton, $sql);
    $data = $result->fetch_assoc();
    return $data;
}

//get all category data
function get_all_category_data(){
    $conneciton = get_connection();
    $sql = "SELECT * FROM posts_category";
    $result = mysqli_query($conneciton, $sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        array_push($data, $row);
    }

    return $data;

}


?>
