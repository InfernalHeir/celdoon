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
   
  <!-- Feature Product Section Start -->
  <div class="product-section section mt-40 mb-40">
    <div class="container-fluid">
        <div class="row">
           <div class="shop-sidebar-wrap col-xl-3 col-lg-4 col-12 order-lg-1 mb-15">
                <div class="hero-section section mb-10">
                <div class="hero-side-category">
                    <div class="category-toggle-wrap">
                        <button class="category-toggle">Categories <i class="ti-menu"></i></button>
                    </div>
                    <nav class="category-menu">
                        <?php
                             $select_cat_id=$conn->prepare('SELECT * FROM `category`');
                             $select_cat_id->execute();
                             $foreach=$select_cat_id->fetchAll();
                        foreach($foreach as $value_cat)
                        {
                        ?>
                        <ul>
                           <li class="menu-item-has-children">
                            <a href="#"><?php echo $value_cat['cat_name']; ?></a>
                              <ul class="category-mega-menu">
                                <?php
                                  $cat_id=$value_cat['cat_id'];
                                  $query=$conn->prepare("SELECT * FROM `sub_category` WHERE `cat_id`='$cat_id'");
                                  $query->execute();
                                  $run=$query->fetchAll();
                                foreach($run as $value_sub) 
                                {
                                  $subcat_name=$value_sub['subcat_name'];
                                ?>
                                  <li><a href="category-sidebar.php?subcat_name=<?php echo $subcat_name; ?>"><?php echo $value_sub['subcat_name']; ?></a></li>
                                <?php
                                }
                                ?>
                              </ul>
                            </li>
                        </ul>
                        <?php
                        }
                        ?>
                    </nav>
                </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-12 order-lg-2 mb-50">
                <div class="row mb-50">
                    <div class="col">
                       <div class="shop-top-bar with-sidebar">
                            <div class="product-view-mode">
                                <a class="active" href="#" data-target="grid"><i class="fa fa-th"></i></a>
                                <a href="#" data-target="list"><i class="fa fa-list"></i></a>
                            </div>
                            <div class="product-short">
                                <p>Short by</p>
                                <select name="sortby" class="nice-select">
                                    <option value="date">Newest items</option>
                                    <option value="price-asc">Price: low to high</option>
                                    <option value="price-desc">Price: high to low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Shop Product Wrap Start -->
                <div class="shop-product-wrap grid with-sidebar row">
                    <?php
		     	            $subcat_name = $_GET['subcat_name'];
    		                $select=$conn->prepare("SELECT `pro_id` FROM `product` WHERE `subcat_name`='$subcat_name'");
		                    $select->execute();
		                    $ok=$select->fetchAll();
                        foreach($ok as $value)
                        {
                            $pro_id=$value['pro_id']; 
                            $query=$conn->prepare("SELECT * FROM `product` WHERE `pro_id` ='$pro_id' ORDER BY pro_id ASC");
				            $query->execute();
                            $now = $query->fetchAll();
		                foreach ( $now as $catid ) 
				        {  
				        ?>
                    <div class="col-xl-4 col-md-6 col-12 pb-30 pt-10">
                        <div class="ee-product">
                            <div class="image" style="height:260px;">
                                <div class="zoom">
                                <a href="single-product-3.php?pro_id=<?=$catid['pro_id']?>" class="img"><img src="admin/<?php  echo $catid['pro_image1']; ?>" alt="Product Image" style="height:250px;"></a>
                                </div>
                            </div>
                            <div class="content">
                                <div class="category-title"  style="height:60px;">
                                    <h5 class="title"><a href="single-product-3.php?pro_id=<?=$catid['pro_id']?>"><?  echo $catid['pro_name'] ?></a>
                                    </h5>
                                </div>
                                <div class="price-ratting">
                                    <h5 class="price"><span class="old">$ <?  echo $catid['pro_mrp'] ?></span></h5>
                                    <div class="ratting">
                                        <h5 class="price">$ <?  echo $catid['pro_dis_price'] ?></h5>
                                    </div>
                                 </div>
                            </div>
                        </div><!-- Product End -->
                    </div>
                    <?php
					}
                    }
                    ?>
                    <div class="ee-product-list">
                        <div class="image">
                            <div class="zoom">
                            <a href="single-product-3.php?pro_id=<?=$catid['pro_id']?>" class="img"><img src="admin/<?php  echo $catid['pro_image1']; ?>" alt="Product Image"></a>
                            </div>
                        </div>
                        <div class="content">
                                <div class="head-content">
                                    <div class="category-title">
                                        <a href="#" class="cat"><?  echo $catid['subcat_name'] ?></a>
                                        <h5 class="title"><a href="single-product-3.php?pro_id=<?=$catid['pro_id']?>"><?  echo $catid['pro_name'] ?></a></h5>
                                    </div>
                                    <h5 class="price">$<?  echo $catid['pro_dis_price'] ?>
                                    </h5>
                                </div>
                                <div class="left-content">
                                    <div class="desc">
                                        <p><?  echo $catid['pro_detail'] ?></p>
                                    </div>
                                </div>
                                <div class="right-content">
                                    <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>Product Discount: <?  echo $catid['pro_dis'] ?>%</li>
                                            <li>Delievery 5-7 Working days.</li>
                                            <li>10 Days Replacement Policy</li>
                                            <li>Free Shipping</li>
                                            <li>Payment:- BTC,BCH,ETH,LTC,USDC</li>
                                        </ul>
                                    </div>
                                    <span class="availability">Availability: <span>In Stock</span></span>
                                </div>
                            </div>
                        </div>
                </div><!-- Shop Product Wrap End -->
                
                <div class="row mt-30">
                    <div class="col">
                        <ul class="pagination">
                            <li><a href="#"><i class="fa fa-angle-left"></i>Back</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li> - - - - - </li>
                            <li><a href="#">8</a></li>
                            <li><a href="#">9</a></li>
                            <li><a href="#">10</a></li>
                            <li><a href="#">Next<i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Feature Product Section End -->

<?php include("assets/headpart/footer.php"); ?>
</body>
</html>