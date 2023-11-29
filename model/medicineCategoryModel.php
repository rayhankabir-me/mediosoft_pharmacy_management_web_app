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

?>