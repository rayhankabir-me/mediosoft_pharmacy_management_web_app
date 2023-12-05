<?php
//requiring files
require_once('db.php');
require_once('../model/usersModel.php');


//get all medicines data
function get_all_medicines_data(){
    $connection = get_connection();
    
    //sql for pharmacists
    $get_current_user_info = get_current_user_info();
    $get_current_user_type = get_current_user_type();
    if($get_current_user_type == "Pharmacist"){
        $sql = "SELECT m.id, m.image_url, m.medicine_title, m.description, m.medicine_price, m.medicine_quanity, m.added_by, m.manufacturing_date, m.expire_date, c.category_title, com.company_name, u.full_name FROM medicines m JOIN medicines_category c ON m.category_id = c.id JOIN medicines_company com ON m.company_id = com.id JOIN users u ON m.added_by = u.id WHERE m.added_by= {$get_current_user_info['id']}";
    }else{
        $sql = "SELECT m.id, m.image_url, m.medicine_title, m.description, m.medicine_price, m.medicine_quanity, m.added_by, m.manufacturing_date, m.expire_date, c.category_title, com.company_name, u.full_name FROM medicines m JOIN medicines_category c ON m.category_id = c.id JOIN medicines_company com ON m.company_id = com.id JOIN users u ON m.added_by = u.id";
    }


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
            'full_name' => $row['full_name'],

        ];
        array_push($data, $post);
    }

    return $data;
}

//get medicines
function get_medicines(){
    $connection = get_connection();
    
    $sql = "SELECT m.id, m.image_url, m.medicine_title, m.description, m.medicine_price, m.medicine_quanity, m.added_by, m.manufacturing_date, m.expire_date, c.category_title, com.company_name, u.full_name FROM medicines m JOIN medicines_category c ON m.category_id = c.id JOIN medicines_company com ON m.company_id = com.id JOIN users u ON m.added_by = u.id";


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
            'full_name' => $row['full_name'],

        ];
        array_push($data, $post);
    }

    return $data;
}

//get all medicines datab by id
function get_all_medicines_data_by_id($id){
    $connection = get_connection();
    $sql = "SELECT m.id, m.image_url, m.medicine_title, m.description, m.medicine_price, m.medicine_quanity, m.added_by, m.manufacturing_date, m.expire_date, m.category_id, m.company_id, c.category_title, com.company_name, u.full_name FROM medicines m JOIN medicines_category c ON m.category_id = c.id JOIN medicines_company com ON m.company_id = com.id JOIN users u ON m.added_by = u.id WHERE m.id = $id";

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
            'category_id' => $row['category_id'],
            'company_id' => $row['company_id'],
            'category_title' => $row['category_title'],
            'company_name' => $row['company_name'],
            'full_name' => $row['full_name'],

        ];
        array_push($data, $post);
    }

    return $data;
}


//get medicine data by medicine name
function get_medicine_data_by_name($medicine_name){
    $connection = get_connection();
    $sql = "SELECT m.id, m.image_url, m.medicine_title, m.description, m.medicine_price, m.medicine_quanity, m.added_by, m.manufacturing_date, m.expire_date, c.category_title, com.company_name FROM medicines m JOIN medicines_category c ON m.category_id = c.id JOIN medicines_company com ON m.company_id = com.id WHERE m.medicine_title LIKE '%$medicine_name%'";

    $result = mysqli_query($connection, $sql);
    $data = [];
    if(mysqli_num_rows($result) > 0){
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
    }else{
        $data = ['no_item' => 'No results found....!'];
    }


    return $data;
}


//get medicne data by category id
function get_medicine_data_by_category_id($category_id){
    $connection = get_connection();
    $sql = "SELECT m.id, m.image_url, m.medicine_title, m.description, m.medicine_price, m.medicine_quanity, m.added_by, m.manufacturing_date, m.expire_date, c.category_title, com.company_name FROM medicines m JOIN medicines_category c ON m.category_id = c.id JOIN medicines_company com ON m.company_id = com.id WHERE m.category_id = $category_id";

    $result = mysqli_query($connection, $sql);
    $data = [];
    if(mysqli_num_rows($result) > 0){
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
    }else{
        $data = ['no_item' => 'No results found....!'];
    }


    return $data;
}

//get medicne data by company id
function get_medicine_data_by_company_id($company_id){
    $connection = get_connection();
    $sql = "SELECT m.id, m.image_url, m.medicine_title, m.description, m.medicine_price, m.medicine_quanity, m.added_by, m.manufacturing_date, m.expire_date, c.category_title, com.company_name FROM medicines m JOIN medicines_category c ON m.category_id = c.id JOIN medicines_company com ON m.company_id = com.id WHERE m.company_id = $company_id";

    $result = mysqli_query($connection, $sql);
    $data = [];
    if(mysqli_num_rows($result) > 0){
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
    }else{
        $data = ['no_item' => 'No results found....!'];
    }


    return $data;
}



//add medicine
function add_medicine($data){
    $conneciton = get_connection();
    $sql = "INSERT INTO medicines (image_url, medicine_title, description, category_id, company_id, medicine_price, medicine_quanity, added_by, manufacturing_date, expire_date) VALUES ('{$data['image_url']}', '{$data['medicine_title']}', '{$data['description']}', {$data['category_id']}, {$data['company_id']}, {$data['medicine_price']}, {$data['medicine_quanity']}, {$data['added_by']}, '{$data['manufacturing_date']}', '{$data['expire_date']}')";
    $result = mysqli_query($conneciton, $sql);
    return $result;
}


//delete medicines
function delete_medicine($id){
    $conneciton = get_connection();
    $sql = "DELETE FROM medicines WHERE id={$id}";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}


//updating medicines

function update_medicine($id, $data){
    $conneciton = get_connection();
    $sql = "UPDATE medicines SET image_url='{$data['image_url']}', medicine_title='{$data['medicine_title']}', description='{$data['description']}', category_id={$data['category_id']}, company_id={$data['company_id']}, medicine_price={$data['medicine_price']}, medicine_quanity={$data['medicine_quanity']}, manufacturing_date='{$data['manufacturing_date']}', expire_date='{$data['expire_date']}' WHERE id = $id";
    $result = mysqli_query($conneciton, $sql);
    if($result){
        return true;
    }else{
        return false;
    }

}




?>

