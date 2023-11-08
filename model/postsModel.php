<?php
require_once('db.php');

//add post
function add_post($data){
    $conneciton = get_connection();
    $sql = "INSERT INTO posts (image, title, description, category, added_by, date)
    VALUES ('{$data['image']}', '{$data['title']}', '{$data['description']}', {$data['category']}, {$data['added_by']}, '{$data['date']}')";
    $result = mysqli_query($conneciton, $sql);
    return $result;
}
	
	
	

//update posts
function update_post($id, $data){
    $conneciton = get_connection();
    $sql = "UPDATE posts SET image='{$data['image']}', title='{$data['title']}', description='{$data['description']}', category={$data['category']} WHERE id = $id";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }

}

// //delete category
// function delete_category($id){
//     $conneciton = get_connection();
//     $sql = "DELETE FROM posts_category WHERE id={$id}";
//     $result = mysqli_query($conneciton, $sql);
//     if($result){
//         return true;
//     }else{
//         return false;
//     }
// }


//get post data by id
function get_post_data($id){
    $conneciton = get_connection();
    $sql = "select * from posts where id = {$id}";;
    $result = mysqli_query($conneciton, $sql);
    $data = $result->fetch_assoc();
    return $data;
}

//get all post data
function get_all_post_data(){
    $conneciton = get_connection();
    $sql = "SELECT * FROM posts";
    $result = mysqli_query($conneciton, $sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        array_push($data, $row);
    }

    return $data;

}
?>
