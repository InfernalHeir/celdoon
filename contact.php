<?php
ob_start();
session_start();
include 'dbconnection.php';

try
{
    if(isset($_POST['send']))
    {
        $user_name=$_POST['user_name'];
        $email_id=$_POST['email_id'];
        $phone_no=$_POST['phone_no'];
        $subject=$_POST['subject'];
        $message=$_POST['message'];
        
        
            $insert=$conn->prepare("INSERT INTO `contact_us`(`user_name`, `email_id`,`phone_no`,`subject`,`message`) VALUES ('$user_name','$email_id','$phone_no','$subject','$message')");
            
            if($insert->execute())
            {
                //$_SESSION['email_id']=$_POST['email_id'];
                //header('location: index.php');
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
   
      <h1 style="text-align: center;">Contact Us</h1>
        
</div><!-- Page Banner Section End -->

<!-- Contact Section Start -->
<div class="contact-section section mt-90 mb-40">
    <div class="container">
        <div class="row">
            
            <!-- Contact Page Title -->
            <div class="contact-page-title col mb-40">
                <h1>Hi, Everyone <br>Let’s Connect us</h1>
            </div>
        </div>
        <div class="row">
            
            <!-- Contact Tab List -->
            <div class="col-lg-4 col-12 mb-50">
                <ul class="contact-tab-list nav">
                    <li><a class="active" data-toggle="tab" href="#contact-form-tab">Leave us a message</a></li>
                    <li><a data-toggle="tab" href="#contact-address">Contact us</a></li>
                </ul>
            </div>
            
            <!-- Contact Tab Content -->
            <div class="col-lg-8 col-12">
                <div class="tab-content">
                    
                    <!-- Contact Address Tab -->
                    <div class="tab-pane fade row d-flex" id="contact-address">
                       
                        <div class="col-lg-4 col-md-6 col-12 mb-50">
                            <div class="contact-information">
                                <h4>Address</h4>
                                <p>You address will be here Coming Soon</p>
                            </div>
                        </div>
                       
                        <div class="col-lg-4 col-md-6 col-12 mb-50">
                            <div class="contact-information">
                                <h4>Phone</h4>
                                <p><a href="tel:01234567890">01234 567 890</a><a href="tel:01234567891">01234 567 891</a></p>
                            </div>
                        </div>
                       
                        <div class="col-lg-4 col-md-6 col-12 mb-50">
                            <div class="contact-information">
                                <h4>Web</h4>
                                <p><a href="mailto:support@celdoon.com">support@celdoon.com</a><a href="#">www.celdoon.xyz</a></p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- Contact Form Tab -->
                    <div class="tab-pane fade show active row d-flex" id="contact-form-tab">
                        <div class="col">
                            
                            <form method="POST" class="contact-form mb-50">
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="first_name">User Name*</label>
                                        <input type="text" name="user_name" required/>
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="email_address">Email*</label>
                                        <input type="email" name="email_id">
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="phone_number">Phone</label>
                                        <input type="tel" name="phone_no">
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="last_name">Subject*</label>
                                        <input type="text" name="subject">
                                    </div>
                                    <div class="col-12 mb-25">
                                        <label for="message">Message*</label>
                                        <textarea name="message"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <input type="submit" name="send" value="SEND NOW">
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Contact Section End -->


<!-- Subscribe Section Start -->
<div class="subscribe-section section bg-gray pt-55 pb-55">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-12 mb-15 mt-15">
                <div class="subscribe-content">
                    <h2>SUBSCRIBE <span>OUR NEWSLETTER</span></h2>
                    <h2><span>TO GET LATEST</span> PRODUCT UPDATE</h2>
                </div>
            </div>
            <div class="col-lg-6 col-12 mb-15 mt-15">
                <form id="mc-form" class="mc-form subscribe-form" >
					<input id="mc-email" type="email" autocomplete="off" placeholder="Enter your email here" />
					<button id="mc-submit">subscribe</button>
				</form>
				<div class="mailchimp-alerts text-centre">
					<div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
					<div class="mailchimp-success"></div><!-- mailchimp-success end -->
					<div class="mailchimp-error"></div><!-- mailchimp-error end -->
				</div><!-- mailchimp-alerts end -->
            </div>
        </div>
    </div>
</div><!-- Subscribe Section End -->

   <?php include("assets/headpart/footer.php");
   ?>

</body>
</html>