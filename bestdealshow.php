<?php
session_start();
include 'dbconnection.php';

 
?>
<!doctype html>
<html class="no-js" lang="en">

   <?php include("assets/headpart/head.php");
   ?>
<body>
   <?php include("assets/headpart/header.php");
   ?>
   
<!-- Page Banner Section Start -->
<div class="page-banner-section section">
    <div class="col-lg-12 col-12 order-lg-2 d-flex align-items-center justify-content-center">
        <div class="page-banner w-100">
            <h1>Product Details</h1>
            <div class="breadcrumb">
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">Product Details</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page Banner Section End -->

<!-- Single Product Section Start -->
<div class="product-section section mt-90 mb-60">
    <div class="container">
        <div class="row mb-40">
            <div class="col-lg-6 col-12 mb-50">
                <h3 class="text-center">FREE</h3>
                <?php
                    $pro_id = $_GET['bestdeal_id'];
                    $pro_fetch = $conn->prepare("SELECT * from `bestdeal`");
                    $pro_fetch->execute();
                    $foreach=$pro_fetch->fetchAll();

                foreach ( $foreach as $pro_id ) 
				{
                ?>
                <div class="single-product-image">
                    <div class="tab-content">
                        <div id="single-image-1" class="tab-pane fade show active big-image-slider">
                            <div class="big-image"><img src="admin/<?php  echo $pro_id['2nd_pro_img1']; ?>" alt="Product Image"><a href="admin/<?php  echo $pro_id['2nd_pro_img1']; ?>" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                        </div>
                        <div id="single-image-2" class="tab-pane fade big-image-slider">
                            <div class="big-image"><img src="admin/<?php  echo $pro_id['2nd_pro_img2']; ?>" alt="Product Image"><a href="admin/<?php  echo $pro_id['2nd_pro_img2']; ?>" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                        </div>
                        <div id="single-image-3" class="tab-pane fade big-image-slider">
                            <div class="big-image"><img src="admin/<?php  echo $pro_id['2nd_pro_img3']; ?>" alt="Product Image"><a href="admin/<?php  echo $pro_id['2nd_pro_img3']; ?>" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                        </div>
                    </div>
                    <div class="thumb-image-slider nav">
                        <a class="thumb-image active" data-toggle="tab" href="#single-image-1"><img src="admin/<?php  echo $pro_id['2nd_pro_img1']; ?>" alt="Product Image"></a>
                        <a class="thumb-image" data-toggle="tab" href="#single-image-2"><img src="admin/<?php  echo $pro_id['2nd_pro_img2']; ?>" alt="Product Image"></a>
                        <a class="thumb-image" data-toggle="tab" href="#single-image-3"><img src="admin/<?php  echo $pro_id['pro_image3']; ?>" alt="Product Image"></a>
                    </div>
                </div>
                <?php
				}
                ?>

                <div class="single-product-content p-0">
                    <div class="head-content">
                        <div class="category-title">
                            <a href="#" class="cat"><?  echo $pro_id['subcat_name'] ?></a>
                            <h5 class="title"><?  echo $pro_id['2nd_pro_name'] ?></h5>
                        </div>
                    </div>
                    <div class="single-product-description">
                        <div class="desc">
                            <h3 class="mt-5">Description</h3>
                            <p><?  echo $pro_id['2nd_pro_desc'] ?></p>
                        </div>
                        <div class="specification">
                            <h5>Specifications</h5>
                            <ul>
                                <li>Product Discount: <?  echo $pro_id['pro_dis'] ?>%</li>
                                <li>Delievery 5-7 Working days.</li>
                                <li>10 Days Replacement Policy</li>
                                <li>Free Shipping</li>
                                <li>Payment:- BTC,BCH,ETH,LTC,USDC</li>
                            </ul>
                        </div>
                        <div class="price-ratting">
                            <h3 class="price">Price:- $ <span class="old" style="    text-decoration: line-through;
                                text-decoration-line: line-through;
                                text-decoration-style: initial;
                                text-decoration-color: initial;"> <?  echo $pro_id['2nd_pro_price'] ?></span> FREE
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 mb-50">
                <h3 class="text-center">OFFER</h3>
                <?php
                    $pro_id = $_GET['pro_id'];
                    $pro_fetch = $conn->prepare("SELECT * from `bestdeal`");
                    $pro_fetch->execute();
                    $foreach=$pro_fetch->fetchAll();

                foreach ( $foreach as $pro_id ) 
				{
                ?>
                <div class="single-product-image">
                    <div class="tab-content">
                        <div id="single-1" class="tab-pane fade show active big-image-slider">
                            <div class="big-image"><img src="admin/<?php  echo $pro_id['1st_pro_img1']; ?>" alt="Product Image"><a href="admin/<?php  echo $pro_id['1st_pro_img1']; ?>" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                        </div>
                        <div id="single-2" class="tab-pane fade big-image-slider">
                            <div class="big-image"><img src="admin/<?php  echo $pro_id['1st_pro_img2']; ?>" alt="Product Image"><a href="admin/<?php  echo $pro_id['1st_pro_img2']; ?>" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                        </div>
                        <div id="single-3" class="tab-pane fade big-image-slider">
                            <div class="big-image"><img src="admin/<?php  echo $pro_id['1st_pro_img3']; ?>" alt="Product Image"><a href="admin/<?php  echo $pro_id['1st_pro_img3']; ?>" class="big-image-popup"><i class="fa fa-search-plus"></i></a></div>
                        </div>
                    </div>
                    <div class="thumb-image-slider nav">
                        <a class="thumb-image active" data-toggle="tab" href="#single-1"><img src="admin/<?php  echo $pro_id['1st_pro_img1']; ?>" alt="Product Image"></a>
                        <a class="thumb-image" data-toggle="tab" href="#single-2"><img src="admin/<?php  echo $pro_id['1st_pro_img2']; ?>" alt="Product Image"></a>
                        <a class="thumb-image" data-toggle="tab" href="#single-3"><img src="admin/<?php  echo $pro_id['1st_pro_img3']; ?>" alt="Product Image"></a>
                    </div>
                </div>
                <?php
				}
                ?>
                    
                    
                <div class="single-product-content p-0">
                    <div class="head-content">
                        <div class="category-title">
                            <a href="#" class="cat"><?  echo $pro_id['subcat_name'] ?></a>
                            <h5 class="title">NAME:- <?  echo $pro_id['1st_pro_name'] ?></h5>
                        </div>
                    </div>
                    <div class="single-product-description">
                        <div class="desc">
                            <h3 class="mt-5">Description</h3>
                            <p><?  echo $pro_id['1st_pro_desc'] ?></p>
                        </div>
                        <span class="availability">Availability: <span>In Stock</span></span>
                        <div class="quantity-colors">
                            <div class="quantity">
                                <h5>Quantity</h5>
                                <div class="pro-qty"><input type="text" value="1">
                                </div>
                            </div>                            
                        </div> 
                        <div class="specification">
                            <h5>Specifications</h5>
                            <ul>
                                <li>Product Discount: <?  echo $pro_id['pro_dis'] ?>%</li>
                                <li>Delievery 5-7 Working days.</li>
                                <li>10 Days Replacement Policy</li>
                                <li>Free Shipping</li>
                                <li>Payment:- BTC,BCH,ETH,LTC,USDC</li>
                            </ul>
                        </div>
                        <div class="price-ratting">
                            <h3 class="price"><span class="old">PRICE: $<?  echo $pro_id['1st_pro_price'] ?></span>
                            </h3>
                        </div>
                        <div class="actions">
                            <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>
                        </div>
                        <div class="share">
                            <h5>Share: </h5>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Single Product Section End -->




<!-- Feature Product Section Start -->
<div class="product-section section mb-70">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-40">
                <div class="section-title-one" data-title="RELATED PRODUCTS"><h1>RELATED PRODUCTS</h1></div>
            </div>
           
            <div class="col-12">
                        <div class="product-slider-wrap product-slider-arrow-one">
                            <div class="product-slider product-slider-4">
                                <?php
                                   
                                    $stmt=$conn->prepare("SELECT * FROM `product`");
                                    $stmt->execute();
                                    $fea_info=$stmt->fetchAll();
                                foreach($fea_info as $feavalue)
                                {
                                    
                                    $fea_id=$value['pro_id'];
                                    $stmt=$conn->prepare("SELECT * FROM `product`");
                                    $stmt->execute();
                                    $fea_in=$stmt->fetchAll();
                                foreach($fea_in as $feaval)
                                {
                                ?>
                                <div class="col pb-20 pt-10">
                                    <div class="ee-product">
                                        <div class="image" style="height: 260px;">
                                            <div class="zoom">
                                            <a href="single-product-3.php?pro_id=<? echo $feaval['pro_id']?>" class="img"><img src="admin/<?php  echo $feaval['pro_image1']; ?>" alt="Product Image" style="height:250px; margin:auto !important;"></a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="category-title" style="height: 60px;">
                                                <h5 class="title"><a href="single-product-3.php?pro_id=<?  echo $feaval['pro_id']?>"><?php  echo $feaval['pro_name']; ?></a></h5>
                                            </div>
                                            <div class="price-ratting">
                                                <h5 class="price"><span class="old">$ <?php  echo $feaval['pro_mrp']; ?></span>
                                                </h5>
                                                <div class="ratting">
                                                    <h5 class="price">$ <?php  echo $feaval['pro_dis_price']; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                }
                                ?>
                                
                            </div>
                        </div>
                    
            </div>
        </div>
    </div>
</div><!-- Feature Product Section End -->




   <?php include("assets/headpart/footer.php");
   ?>
</body>
</html>