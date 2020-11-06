<?php
//ob_start();
session_start();
include 'dbconnection.php';

try
{
    if(isset($_POST['submit']))
    {
        $user_name=$_POST['user_name'];
        $email_id=$_POST['email_id'];
        $product=$_POST['product'];
        $qty=$_POST['qty'];
        $message=$_POST['message'];
        
        
        $insert=$conn->prepare("INSERT INTO `bulk_deal`(`user_name`, `email_id`,`product`,`qty`,`message`) VALUES ('$user_name','$email_id','$product','$qty','$message')");
            
       
            if($insert->execute())
            {
               echo "<script>alert('Send Successfully')</script>";
               echo "<script>window.open('index.php','_self')</script>";
            }
            else{
                echo "<script>alert(' Unsuccessfully')</script>";
               echo "<script>window.open('index.php','_self')</script>";
            }
        }
   
}
catch(PDOException $e)
{
    "Connection Failed ".$e->getMessage();
}
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
   
                <h1 style="text-align: center;">Bulk Deal With Us</h1>
        
</div><!-- Page Banner Section End -->

<!-- Contact Section Start -->
<div class="contact-section section mt-90 mb-40">
    <div class="container">
     
        <div class="row">
            
           
            
            <!-- Contact Tab Content -->
            <div class="col-lg-12 col-12">
                   <div class="col">
                            
                            <form method="POST" class="contact-form mb-50">
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="User Name">User Name*</label>
                                        <input type="text" name="user_name" required/>
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="email_address">Email*</label>
                                        <input type="email" name="email_id" required/>
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="Products">Products*</label>
                                        <input  type="text" name="product" required/>
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="Quantity">Model*</label>
                                        <input  type="text" name="qty" required/>
                                    </div>
                                    
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="Quantity">Quantity*</label>
                                        <input  type="number" name="qty" required/>
                                    </div>
                                    
                                    <div class="col-12 mb-25">
                                        <label for="message">Message*</label>
                                        <textarea  name="message" required/></textarea>
                                    </div>
                                    <div class="col-12">
                                        <input type="submit" name="submit" value="SEND NOW">
                                    </div>
                                </div>
                            </form>
                           <p class="form-messege"></p>
                          
                        </div>
                   
            </div>
        </div>
    </div>
</div><!-- Contact Section End -->

<!-- Subscribe Section Start -->
<div class="subscribe-section section bg-gray pt-55 pb-55">
    <div class="container">
        <div class="row align-items-center">
            
            <!-- Mailchimp Subscribe Content Start -->
            <div class="col-lg-6 col-12 mb-15 mt-15">
                <div class="subscribe-content">
                    <h2>SUBSCRIBE <span>OUR NEWSLETTER</span></h2>
                    <h2><span>TO GET LATEST</span> PRODUCT UPDATE</h2>
                </div>
            </div><!-- Mailchimp Subscribe Content End -->
            
            
            <!-- Mailchimp Subscribe Form Start -->
            <div class="col-lg-6 col-12 mb-15 mt-15">
                
				<form id="mc-form" class="mc-form subscribe-form" >
					<input id="mc-email" type="email" autocomplete="off" placeholder="Enter your email here" />
					<button id="mc-submit">subscribe</button>
				</form>
				<!-- mailchimp-alerts Start -->
				<div class="mailchimp-alerts text-centre">
					<div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
					<div class="mailchimp-success"></div><!-- mailchimp-success end -->
					<div class="mailchimp-error"></div><!-- mailchimp-error end -->
				</div><!-- mailchimp-alerts end -->
                
            </div><!-- Mailchimp Subscribe Form End -->
            
        </div>
    </div>
</div><!-- Subscribe Section End -->

   <?php include("assets/headpart/footer.php");
   ?>

</body>


</html>