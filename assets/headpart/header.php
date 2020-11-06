<?php

include 'dbconnection.php';
$email=$_SESSION['email_id'];
$select = $conn->prepare("SELECT * FROM `user` WHERE `email_id`='$email'");
$select->execute();
$loop=$select->fetchAll();


                  

?>

<!-- Header Section Start -->
<div class="header-section section" id="headerpart">

    <!-- Header Top Start -->
    <div class="header-top header-top-one header-top-border">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-between">
                <div class="col">
                    
		        	<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
			        	<div class="top-navbar">
							<style type="text/css">
								<!--
									a.gflag {vertical-align:middle;font-size:15px;padding-top:0px;background-repeat:no-repeat;background-image:url(https://gtranslate.net/flags/32.png);}
									a.gflag img {border:0;}
									a.gflag:hover {background-image:url(https://gtranslate.net/flags/32a.png);}
									#goog-gt-tt {display:none !important;}
									.goog-te-banner-frame {display:none !important;}
									.goog-te-menu-value:hover {text-decoration:none !important;}
									body {top:0 !important;}
									#google_translate_element2 {display:none!important;}
									-->
							</style>
							<select onchange="doGTranslate(this);" style="height: 35px !important; margin: 5px; padding: 5px; background-color:#ff8c00; border-radius: 20px;"><option value="">Select Language</option><option value="en|af">Afrikaans</option><option value="en|ar">Arabic</option><option value="en|zh-CN">Chinese</option><option value="en|en">English</option><option value="en|fr">French</option><option value="en|hi">Hindi</option><option value="en|ru">Russian</option><option value="en|ur">Urdu</option></select><div id="google_translate_element2">
							</div>
						</div>
				</div>

              
                
               
                <div class="col order-12 order-xs-12 order-lg-2 mt-10 mb-10">
                    <div class="header-advance-search  text-center">
                        
                        
                 <?php
		     	        $cat_id = $_GET['cat_id'];
    		            $select=$conn->prepare("SELECT * FROM `product` WHERE `cat_id`='$cat_id'");
		                $select->execute();
		                $ok=$select->fetchAll();
                        foreach( $ok as $pro_id )
                        {
                        }
                        $subcat_name = $_GET['subcat_name'];
    		            $query=$conn->prepare("SELECT * FROM `product` WHERE `subcat_name`='$subcat_name'");
		                $query->execute();
		                $check=$query->fetchAll();
                        foreach( $check as $pro_id )
                        {
                        
                        
                        }
                        ?>
                
                        
                            <div class="input"><input type="text" id="user_query" placeholder="Search your product" required/ ></div>
                            <div class="select">
                                <select id="category" class="nice-select">
                                <option>All Categories</option>
								<?php
                                    $stmt=$conn->prepare("SELECT * FROM category");
                                    $stmt->execute();
                                    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                                {		
                                    $cat_id=$row['cat_id'];
                                    echo '<option value='.$cat_id.'>'.$row['cat_name'].'</option>';
                                }
                                ?>
                                </select>
                            </div>
                            <div class="submit"><button id="form_fire" class="icofont icofont-search-alt-1"></button></div>
                        
                        
                        <?php

?>
                    </div>
                </div>
                
                
                <script>
                  
                 $('#form_fire').click(function(){
                 var query = $('#user_query').val();
                 var cat_id =$('#category').val();
                 var url = "category-sidebar.php?query="+query+"&cat_id="+cat_id;
                 window.location.href=url;
                      
                 })   
                </script>
                
                <div class="col order-2 order-xs-2 order-lg-12 mt-10 mb-10">
                   
                    <?php
                        if(isset($_SESSION['email_id'])){
                    ?>
                    <ul class="navbar-nav">
                      <li class="nav-item dropdown d-xl-inline-block user-dropdown">
                            <a class="nav-link " id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <p value="user_name" style="font-style:bold; color: #000; font-size:16px;  font-weight: 600;"><?php foreach($loop as $emailac){ echo $emailac['user_name'];  }  ?> <i class='fa fa-angle-down' style='font-size:18px'></i></p>
                        <div class="dropdown-menu">
                            <a href="myaccount.php" class="dropdown-item">My Profile</a>
                            <a class="dropdown-item">Order Status</a>
                            <a class="dropdown-item">Checkout</a>
                            <a href="logout.php" class="dropdown-item">Logout <i class="dropdown-item-icon ti-power-off"></i></a>
                        </div>
                      </li>
                    </ul>
                        
                        
                    <?php
                    }else{
                    ?>
                       <div class="header-account-links">
                        <a href="login.php"><i class="icofont icofont-user-alt-7"></i> <span>My Account</span></a>
                       </div>
                    <?php
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div><!-- Header Top End -->

    <!-- Header Bottom Start -->
    <div class="header-bottom header-bottom-one header-sticky">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-between">

                <div class="col mt-15 mb-15">
                    <!-- Logo Start -->
                    <div class="header-logo">
                        <a href="index.php">
                            <img src="assets/images/output-onlinepngtools3.png" alt="celdoon logo">
                        </a>
                    </div><!-- Logo End -->
                </div>

                <div class="col order-10 order-lg-2 order-xl-2 d-none d-lg-block">
                    <!-- Main Menu Start -->
                    <div class="main-menu">
                        <nav>
                            <ul>
                                <li class="active"><a href="index.php">HOME</a></li>
                                <li class=""><a href="bulk-deal.php">Bulk Deal</a></li>
                                <li class=""><a href="crypto-news.php">Crypto News</a></li>
                                <li><a href="contact.php">CONTACT</a></li>
                            </ul>
                        </nav>
                    </div><!-- Main Menu End -->
                </div>

                <?php
                
                $check= $conn->prepare("SELECT * FROM `add_to_cart` WHERE `email`='$email' and `status`='Added'");
                $check->execute();
                $check->fetchAll();
                $num_rec=$check->rowCount();
                ?>
                <div class="col order-2 order-lg-12 order-xl-12">
                    <!-- Header Shop Links Start -->
                    <div class="header-shop-links">
                       <a class="header-cart"><i class="ti-shopping-cart"></i> <span class="number"><?php echo $num_rec;  ?></span></a>
                <!--    <a href="cart.html" class="header-cart"><i class="ti-shopping-cart"></i> <span class="number">3</span></a>
                -->    </div>
                </div>
                
                <!-- Mobile Menu -->
                <div class="mobile-menu order-12 d-block d-lg-none col"></div>

            </div>
        </div>
    </div><!-- Header Bottom End -->


</div><!-- Header Section End -->









<!-- Cart Overlay -->
<div class="cart-overlay"></div>


<!-- Mini Cart Wrap Start -->                      
<div class="mini-cart-wrap">

    <!-- Mini Cart Top -->
    <div class="mini-cart-top">    
    
        <button class="close-cart">Close Cart<i class="icofont icofont-close"></i></button>
        
    </div>

    <!-- Mini Cart Products -->
    <ul class="mini-cart-products">
        <li>
            <a class="image"><img src="assets/images/product/product-1.png" alt="Product"></a>
            <div class="content">
                <a href="single-product.html" class="title">Waxon Note Book Pro 5</a>
                <span class="price">Price: $295</span>
                <span class="qty">Qty: 02</span>
            </div>
            <button class="remove"><i class="fa fa-trash-o"></i></button>
        </li>
        <li>
            <a class="image"><img src="assets/images/product/product-2.png" alt="Product"></a>
            <div class="content">
                <a href="single-product.html" class="title">Aquet Drone D 420</a>
                <span class="price">Price: $275</span>
                <span class="qty">Qty: 01</span>
            </div>
            <button class="remove"><i class="fa fa-trash-o"></i></button>
        </li>
        <li>
            <a class="image"><img src="assets/images/product/product-3.png" alt="Product"></a>
            <div class="content">
                <a href="single-product.html" class="title">Game Station X 22</a>
                <span class="price">Price: $295</span>
                <span class="qty">Qty: 01</span>
            </div>
            <button class="remove"><i class="fa fa-trash-o"></i></button>
        </li>
    </ul>

    <!-- Mini Cart Bottom -->
    <div class="mini-cart-bottom">    
    
        <h4 class="sub-total">Total: <span>$1160</span></h4>

        <div class="button">
            <a href="checkout.html">CHECK OUT</a>
        </div>
        
    </div>

</div><!-- Mini Cart Wrap End --> 

<!-- Cart Overlay -->
<div class="cart-overlay"></div>




