<?php
session_start();
include 'dbconnection.php';

?>

<!doctype html>
<html class="no-js" lang="en">
 <?php include("assets/headpart/head.php"); ?>
<body>
<?php include("assets/headpart/header.php"); ?>
 
<!-- Cart Overlay -->
<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">
        <div class="col-lg-12 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>My Order</h1>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">My Order</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- Page Banner Section End -->

<!-- Cart Page Start -->
<div class="page-section section mb-90">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form action="#">				
                    <div class="cart-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Order_id</th>
                                    <th class="pro-title">Product Name</th>
                                    <th class="pro-quantity">price</th>
                                    <th class="pro-subtotal">status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>	
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End --> 

<?php include("assets/headpart/footer.php"); ?>
</body>
</html>