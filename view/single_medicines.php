<?php

require_once('../model/medicinesModel.php');

if(isset($_GET['id'])){
    $medicine_id = $_GET['id'];
}

$medicines = get_all_medicines_data_by_id($medicine_id);

$page_title = $medicines[0]['medicine_title']." - MedioSoft";



?>

<!-- including header -->
<?php include_once('../view/component/frontend_header.php'); ?>

<section class="banner-section">
    <div class="container">
        <div class="banner-title">
            <h2><?php echo $medicines[0]['medicine_title'];?></h2>
        </div>
    </div>
</section>


<section class="main-section">
    <div class="container">
        <div class="row">
            <div class="column-fifty">
                <div class="medicine-img-desc">
                    <img src="<?php echo $medicines[0]['image_url'];?>" alt="">
                    <div class="medicine-desc">
                        <p><strong>About this Medicine: </strong><?php echo $medicines[0]['description']; ?></p>
                    </div>
                    <div class="medicine-extra-info">
                        <p>Manufacturing Date: <strong><?php echo $medicines[0]['manufacturing_date']; ?></strong></p>
                        <p>Expire Date: <strong><?php echo $medicines[0]['expire_date']; ?></strong></p>
                        <p>Seller: <strong><?php echo $medicines[0]['full_name']; ?></strong></p>
                    </div>
                    
                </div>
            </div>
            <div class="column-fifty">
                <div class="medicine-buy-area">
                    <h2><?php echo $medicines[0]['medicine_title'];?></h2>
                    <p>Category: <strong><?php echo $medicines[0]['category_title'];?></strong></p>
                    <p>Company: <strong><?php echo $medicines[0]['company_name'];?></strong></p>
                    <p>Stock: <strong><?php echo $medicines[0]['medicine_quanity'];?></strong></p>
                    <p>Price: <strong><?php echo $medicines[0]['medicine_price']." $";?></strong></p>

                    <div class="buy-now-form">
                        <form action="">
                            <label for="quantity">Quantity: </label><input value="1" id="quantity" name="quantity" type="number">
                            <input class="medio-btn" type="submit" value="Buy Now">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- including footer -->
<?php include_once('../view/component/footer.php'); ?>

