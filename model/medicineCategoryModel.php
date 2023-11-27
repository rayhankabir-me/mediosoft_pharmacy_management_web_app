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

?>