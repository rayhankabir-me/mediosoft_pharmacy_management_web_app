<?php
//auth
require_once('../controller/check_login_status.php');
if(!check_login_status()){
    header('location: login.php');
}
require_once('../model/medicinesModel.php');
require_once('../model/usersModel.php');
$action = $_REQUEST['action'];


//for get data action, show medicines by ajax
 if($action == 'get_data'){

    //get all medicines data
    $medicines = get_all_medicines_data();
    foreach($medicines as $medicine){
                            
        ?>
            <div class="medicine_box">
                <a href="single_medicines.php?id=<?php echo $medicine['id']; ?>"><img width="200px" src="<?php echo $medicine['image_url']; ?>" alt=""></a>
                <h2><a href="single_medicines.php?id=<?php echo $medicine['id']; ?>"><?php echo $medicine['medicine_title']; ?></a></h2>
                
                <p>Category: <strong><?php echo $medicine['category_title']; ?></strong></p>   
                <p>Company: <strong><?php echo $medicine['company_name']; ?></strong></p>
                <p>Price: <strong><?php echo $medicine['medicine_price']; ?></strong></p>
                <a href="single_medicines.php?id=<?php echo $medicine['id']; ?>">Details</a>


            </div>
        <?php
    }

 }


?>
