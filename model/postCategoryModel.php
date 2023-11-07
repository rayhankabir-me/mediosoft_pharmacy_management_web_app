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
function update_category($data){

}

//delete category
function delete_category(){

}
?>
