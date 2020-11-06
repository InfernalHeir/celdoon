<?php
session_start();
include 'dbconnection.php';

?>



<!doctype html>
<html class="no-js" lang="en">
 <?php include("assets/headpart/head.php"); ?>
<body>
<style>
.cart-table .table thead tr th {
   
    font-size: 12px !important;
    
}
.cart-table td.pro-remove a {
    display: initial !important;
}
</style>
<?php include("assets/headpart/header.php"); ?>
 
<!-- Cart Overlay -->
<div class="cart-overlay"></div>
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">
        <div class="col-lg-12 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>Wishlist</h1>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">Wishlist</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- Page Banner Section End -->

<!-- Cart Page Start -->
<div class="page-section section mt-90 mb-90">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form action="#">				
                    <div class="cart-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Product Image</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-quantity">qty x price</th>
                                    <th class="pro-subtotal">discount</th>
                                    <th class="pro-subtotal">Total</th>
                                    <th class="pro-remove">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $select=$conn->prepare("SELECT * FROM `add_to_cart` WHERE `email`='$email' and `status`='Added'");
                                $select->execute();
                                $pro=$select->fetchAll();
                                
                                ?>
                                <?php
                                
                                foreach($pro as $pi)
                                {
                                $pro_id = $pi['pro_id'];
                                $cart_id = $pi['cart_id'];
                                $edit_url="https://www.celdoon.xyz/single-product-3.php?pro_id=$pro_id";
                                ?>
                                <tr>
                                    <td class="pro-thumbnail"><a href="#"><img src="<?php echo 'admin/'.$pi['pro_image'];  ?>" alt="Product"></a></td>
                                    <td class="pro-title"><a href="#"><?php echo $pi['pro_name'];  ?></a></td>
                                    <td class="pro-price"><span><?php echo $pi['qty'].' x $'.$pi['pro_mrp'];  ?></span></td>
                                    <td class="pro-quantity"><?php echo '$'.$pi['pro_discount'];  ?></td>
                                    <td class="pro-addtocart"><?php echo '$'.$pi['grand_total'];  ?></td>
                                    <td class="pro-remove"><a href="<?php echo $edit_url;  ?>"><i class="fa fa-edit mr-2"></i></a><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                <?php
                                }
                                ?>
                                
                                
                            </tbody>
                        </table>
                    </div>
                </form>	
            </div>
        </div>
        
        
        <div class="col-12 mb-60 text-right">
            <?php $checkout_url="checkout.php";  ?>
            <a href="<?php echo $checkout_url;  ?>"><button class="btn btn-warning" class="btn_proceed">Proceed Checkout</button></a>
        </div>
        
    </div>
</div>
<!-- Cart Page End --> 

<?php include("assets/headpart/footer.php"); ?>
</body>
</html>