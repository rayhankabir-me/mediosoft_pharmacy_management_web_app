<?php

require_once('../model/medicinesModel.php');
require_once('../model/usersModel.php');
$action = $_REQUEST['action'];


//for get data action, show medicines by ajax
 if($action == 'get_data'){

    //get all medicines data
    $medicines = get_medicines();
    foreach($medicines as $medicine){
                            
        ?>
            <div class="medicine_box column-thirty-three">
                <div class="medicine-content">
                    <a href="single_medicines.php?id=<?php echo $medicine['id']; ?>"><img width="200px" src="<?php echo $medicine['image_url']; ?>" alt=""></a>
                    <div class="medicine-description">
                        <h2><a href="single_medicines.php?id=<?php echo $medicine['id']; ?>"><?php echo $medicine['medicine_title']; ?></a></h2>
                        
                        <p>Category: <strong><?php echo $medicine['category_title']; ?></strong></p>   
                        <p>Company: <strong><?php echo $medicine['company_name']; ?></strong></p>
                        <p>Price: <strong><?php echo $medicine['medicine_price']." $"; ?></strong></p>
                        <a class="medio-btn" href="single_medicines.php?id=<?php echo $medicine['id']; ?>">Details</a>
                    </div>
                </div>


            </div>
        <?php
    }

 }


//for get data action, show medicines by ajax
 if($action == 'get_data_for_homepage'){

    //get all medicines data
    $medicines = get_medicines();
    foreach($medicines as $medicine){
                            
        ?>
            <div class="medicine_box column-twenty-five ">
                <div class="medicine-content">
                    <a href="single_medicines.php?id=<?php echo $medicine['id']; ?>"><img width="200px" src="<?php echo $medicine['image_url']; ?>" alt=""></a>
                    <div class="medicine-description">
                        <h2><a href="single_medicines.php?id=<?php echo $medicine['id']; ?>"><?php echo $medicine['medicine_title']; ?></a></h2>
                        
                        <p>Category: <strong><?php echo $medicine['category_title']; ?></strong></p>   
                        <p>Company: <strong><?php echo $medicine['company_name']; ?></strong></p>
                        <p>Price: <strong><?php echo $medicine['medicine_price']." $"; ?></strong></p>
                        <a class="medio-btn" href="single_medicines.php?id=<?php echo $medicine['id']; ?>">Details</a>
                    </div>
                </div>


            </div>
        <?php
    }

 }

 //for search medicine action, search medicine by ajax
 if($action == 'search_medicine'){

    $medicine_name = $_REQUEST['medicine_name'];
    //get all medicines data by medicine name
    $medicines = get_medicine_data_by_name($medicine_name);

    if(isset($medicines['no_item'])){
        echo "<p>".$medicines['no_item']."</p>";
    }else{
        foreach($medicines as $medicine){
                            
            ?>
                <div class="medicine_box column-thirty-three">
                    <div class="medicine-content">
                        <a href="single_medicines.php?id=<?php echo $medicine['id']; ?>"><img width="200px" src="<?php echo $medicine['image_url']; ?>" alt=""></a>
                        <div class="medicine-description">
                            <h2><a href="single_medicines.php?id=<?php echo $medicine['id']; ?>"><?php echo $medicine['medicine_title']; ?></a></h2>
                            
                            <p>Category: <strong><?php echo $medicine['category_title']; ?></strong></p>   
                            <p>Company: <strong><?php echo $medicine['company_name']; ?></strong></p>
                            <p>Price: <strong><?php echo $medicine['medicine_price']." $"; ?></strong></p>
                            <a class="medio-btn" href="single_medicines.php?id=<?php echo $medicine['id']; ?>">Details</a>
                        </div>
                    </div>
    
                </div>
            <?php
        }
    }

 }


 //filter by medicine category
 if($action == "category_filter"){

    $category_id = $_REQUEST['category_id'];

    //get all medicines data by category id
    $medicines = get_medicine_data_by_category_id($category_id);

    if(isset($medicines['no_item'])){
        echo "<p>".$medicines['no_item']."</p>";
    }else{
        foreach($medicines as $medicine){
                            
            ?>
                <div class="medicine_box column-thirty-three">
                    <div class="medicine-content">
                        <a href="single_medicines.php?id=<?php echo $medicine['id']; ?>"><img width="200px" src="<?php echo $medicine['image_url']; ?>" alt=""></a>
                        <div class="medicine-description">
                            <h2><a href="single_medicines.php?id=<?php echo $medicine['id']; ?>"><?php echo $medicine['medicine_title']; ?></a></h2>
                            
                            <p>Category: <strong><?php echo $medicine['category_title']; ?></strong></p>   
                            <p>Company: <strong><?php echo $medicine['company_name']; ?></strong></p>
                            <p>Price: <strong><?php echo $medicine['medicine_price']." $"; ?></strong></p>
                            <a class="medio-btn" href="single_medicines.php?id=<?php echo $medicine['id']; ?>">Details</a>
                        </div>
                    </div>
    
                </div>
            <?php
        }
    }
 }

 //filter by medicine company
 if($action == "company_filter"){

    $company_id = $_REQUEST['company_id'];

    //get all medicines data by company id
    $medicines = get_medicine_data_by_company_id($company_id);

    if(isset($medicines['no_item'])){
        echo "<p>".$medicines['no_item']."</p>";
    }else{
        foreach($medicines as $medicine){
                            
            ?>
                <div class="medicine_box column-thirty-three">
                    <div class="medicine-content">
                        <a href="single_medicines.php?id=<?php echo $medicine['id']; ?>"><img width="200px" src="<?php echo $medicine['image_url']; ?>" alt=""></a>
                        <div class="medicine-description">
                            <h2><a href="single_medicines.php?id=<?php echo $medicine['id']; ?>"><?php echo $medicine['medicine_title']; ?></a></h2>
                            
                            <p>Category: <strong><?php echo $medicine['category_title']; ?></strong></p>   
                            <p>Company: <strong><?php echo $medicine['company_name']; ?></strong></p>
                            <p>Price: <strong><?php echo $medicine['medicine_price']." $"; ?></strong></p>
                            <a class="medio-btn" href="single_medicines.php?id=<?php echo $medicine['id']; ?>">Details</a>
                        </div>
                    </div>
    
                </div>
            <?php
        }
    }
 }


?>
