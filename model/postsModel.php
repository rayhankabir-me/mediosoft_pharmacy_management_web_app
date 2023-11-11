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

//get all posts data
function get_all_posts_data() {
    $connection = get_connection();
    $sql = "SELECT p.id, p.image, p.title, p.description, c.category_name, p.added_by, p.date FROM posts p JOIN posts_category c ON p.category = c.id";
    $result = mysqli_query($connection, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $post = [
            'id'    => $row['id'],
            'image' => $row['image'],
            'title' => $row['title'],
            'description' => $row['description'],
            'category_name' => $row['category_name'],
            'added_by' => $row['added_by'],
            'date' => $row['date']
        ];
        array_push($data, $post);
    }

    return $data;
}




//get all posts by author
function get_all_posts_by_author($username){

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


//delete post
function delete_post($id){
    $conneciton = get_connection();
    $sql = "DELETE FROM posts WHERE id={$id}";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}


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
