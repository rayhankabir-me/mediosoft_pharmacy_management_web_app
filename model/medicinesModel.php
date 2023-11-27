<?php
//requiring files
require_once('db.php');

//get all medicines data
function get_all_medicines_data(){
    $connection = get_connection();
    $sql = "SELECT m.id, m.image_url, m.medicine_title, m.description, m.medicine_price, m.medicine_quanity, m.added_by, m.manufacturing_date, m.expire_date, c.category_title, com.company_name FROM medicines m JOIN medicines_category c ON m.category_id = c.id JOIN medicines_company com ON m.company_id = com.id";

    $result = mysqli_query($connection, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $post = [
            'id'    => $row['id'],
            'image_url' => $row['image_url'],
            'medicine_title' => $row['medicine_title'],
            'description' => $row['description'],
            'medicine_price' => $row['medicine_price'],
            'medicine_quanity' => $row['medicine_quanity'],
            'added_by' => $row['added_by'],
            'manufacturing_date' => $row['manufacturing_date'],
            'expire_date' => $row['expire_date'],
            'category_title' => $row['category_title'],
            'company_name' => $row['company_name'],

        ];
        array_push($data, $post);
    }

    return $data;
}



?>
