<?php
include ('dbconnection.php');
?>


<!doctype html>
<html class="no-js" lang="en">
   
   <?php include("assets/headpart/head.php");
   ?>
<body>
   <?php include("assets/headpart/header.php");
   ?>
  
  <style>
      
      
.cta-100 {
  margin-top: 100px;
  padding-left: 8%;
  padding-top: 7%;
}
.col-md-4{
    padding-bottom:20px;
}

.white {
  color: #fff !important;
}
.mt{float: left;margin-top: -20px;padding-top: 20px;}
.bg-blue-ui {
  background-color: #708198 !important;
}
figure img{width:300px;}

#blogCarousel {
  padding-bottom: 100px;
}

.blog .carousel-indicators {
  left: 0;
  top: -50px;
  height: 50%;
}


/* The colour of the indicators */

.blog .carousel-indicators li {
  background: #708198;
  border-radius: 50%;
  width: 8px;
  height: 8px;
}

.blog .carousel-indicators .active {
  background: #ff8c00;
}




.item-carousel-blog-block {
  outline: medium none;
  padding: 15px;
}

.item-box-blog {
  border: 1px solid #dadada;
  text-align: center;
  z-index: 4;
  padding: 20px;
}

.item-box-blog-image {
  position: relative;
}

.item-box-blog-image figure img {
  width: 100%;
  height: auto;
}

.item-box-blog-date {
  position: absolute;
  z-index: 5;
  padding: 4px 20px;
  top: -20px;
  right: 8px;
  background-color: #ff8c00;
}

.item-box-blog-date span {
  color: #fff;
  display: block;
  text-align: center;
  line-height: 1.2;
}

.item-box-blog-date span.mon {
  font-size: 18px;
}

.item-box-blog-date span.day {
  font-size: 16px;
}

.item-box-blog-body {
  padding: 10px;
}

.item-heading-blog a h5 {
  margin: 0;
  line-height: 1;
  text-decoration:none;
  transition: color 0.3s;
}

.item-box-blog-heading a {
    text-decoration: none;
}

.item-box-blog-data p {
  font-size: 13px;
}

.item-box-blog-data p i {
  font-size: 12px;
}

.item-box-blog-text {
  max-height: 100px;
  overflow: hidden;
}

.mt-10 {
  float: left;
  margin-top: -10px;
  padding-top: 10px;
}

.btn.bg-blue-ui.white.read {
  cursor: pointer;
  padding: 4px 20px;
  float: left;
  margin-top: 10px;
}

.btn.bg-blue-ui.white.read:hover {
  box-shadow: 0px 5px 15px inset #4d5f77;
}

  </style>
  
  
<!-- Feature Product Section Start -->
<div class="product-section section mb-70">
    <div class="container">
        <div class="row">
            
           
            <!-- Product Tab Filter Start -->
            <div class="col-12 mb-30">
                <div class="roduct-tab-filter">
                    
                    <!-- Tab Filter Toggle -->
                    <button class="product-tab-filter-toggle">showing: <span></span><i class="icofont icofont-simple-down"></i></button>
                    
                    <!-- Product Tab List -->
                    <ul class="nav product-tab-list">
                        <li><a class="active" data-toggle="tab" href="#tab-one">Recent</a></li>
                        <li><a data-toggle="tab" href="#tab-two">Top News</a></li>
                        
                    </ul>
                    
                </div>
            </div><!-- Product Tab Filter End -->
            
            
          
                                

            <div class="col-md-12">
              <?php
                             $stmt=$conn->prepare("SELECT * FROM crypto_news ORDER BY news_id DESC");
                             $stmt->execute();
                             $news=$stmt->fetchAll();
                              foreach($news as $row){ 
                              ?>
                <!-- Carousel items -->
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div class="row">
                      <div class="col-md-4" >
                          
                        <div class="item-box-blog">
                            
                          <div class="item-box-blog-image">
                              
                            <!--Image-->
                            <figure><img src="admin/<?php echo $row['news_image']; ?>" height="100px" width="100px"></figure>
                          </div>
                          <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h5><?php  echo $row['news_title'];?></h5>
                              </a>
                            </div>
                             <!--Text-->
                            <div class="item-box-blog-text">
                              <p><?php echo $row['news_details'];?></p>
                             </div>
                            <!--  <div class="mt"> <a href="#" tabindex="0" class="btn btn-warning">read more</a> </div>   -->
                            <!--Read More Button-->
                            
                          </div>
                        </div>
                         
                      </div>
                     
                     
                    </div>
                    <!--.row-->
                  </div>
                
                  <!--.item-->
                </div>
                <?php
                          }
                          ?>
                <!--.carousel-inner-->
              </div>
              <!--.Carousel-->
            </div>
          </div>
        </div>
     
   


          
   <?php include("assets/headpart/footer.php");
   ?>
</body>


</html>