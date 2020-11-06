<?php
ob_start();
session_start();
include 'dbconnection.php';

try
{
    if(isset($_POST['submit']))
    {
        $user_name=$_POST['user_name'];
        $email_id=$_POST['email_id'];
        $password=$_POST['password'];
        
        
            $insert=$conn->prepare("INSERT INTO `user`(`email_id`, `password`,`user_name`) VALUES (:email_id,:password,:user_name)");
            $insert->bindParam(':user_name',$user_name);
            $insert->bindParam(':email_id',$email_id);
            $insert->bindParam(':password',$password);
            if($insert->execute())
            {
                $_SESSION['email_id']=$_POST['email_id'];
                header('location: index.php');
                //echo "<script>alert('Registration Successfully')</script>";
               // echo "<script>window.open('index.php','_self')</script>";
            }
        }
    
}
catch(PDOException $e)
{
    "Connection Failed ".$e->getMessage();
}
?>

<?php


include 'dbconnection.php';

try
{
    if(isset($_POST['login']))
    {
    $stmt = $conn->prepare("Select * from user where email_id = :email_id and password = :password");
    $stmt->bindParam(':email_id', $_POST['email_id']);
    $stmt->bindParam(':password', $_POST['password']);
    $stmt->execute();
    $stmt->fetchAll();
    if($stmt->rowCount()==0)
    {
        //echo "Login Failed";
       echo "<script>alert('Wrong Username and Password....!');</script>";
       echo "<script>window.open('login.php','_self')</script>";
    }
    else
    {
       $_SESSION['email_id']=$_POST['email_id'];
        header('location: index.php');
    }
  }
}
catch(PDOException $e)
{
    "Connection Failed ".$e->getMessage();
}
$conn=null;
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
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-12 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <h1>MY ACCOUNT</h1>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">ACCOUNT</a></li>
                    </ul>
                </div>
            </div>
        </div>
</div>
</div><!-- Page Banner Section End -->


<!-- Feature Product Section Start -->
<div class="product-section section mb-70">
    <div class="container">
        <div class="row">
            <!-- Product Tab Filter Start 
            <div class="col-12 mb-30">
                
                    <ul class="nav">
                        <li><a class="active mr-3" data-toggle="tab" href="#tab-one" style="color: orange; font-size: 22px;">Login</a></li>
                        <li><a data-toggle="tab" href="#tab-two" style="font-size: 22px;">Register</a></li>
                     </ul>
                    
            </div>-->
        </div>
            <!-- Product Tab Content Start -->
        <div class="col-12">
            <div class="tab-content">
                <!-- Tab Pane Start -->
               <!-- <div class="tab-pane fade show active" id="tab-one">-->
                    <div class="row">
                        <div class="col-md-6 col-12 d-flex">
                            <div class="ee-login">
                                <h3 style="margin-top:50px!important;">Login to your account</h3>
                                <!-- Login Form -->
                                <form action="#" method="POST" style="margin-top:10px!important;">
                                    <div class="row">
                                        <div class="col-12 mb-30"><input type="text" name="email_id" required placeholder="Type your email address">
                                        </div>
                                        <div class="col-12 mb-20"><input type="password" name="password" required placeholder="Enter your passward">
                                        </div>
                                        <div class="col-12 mb-15">
                                        <input type="checkbox" id="remember_me">
                                        <label for="remember_me">Remember me</label>
                                        <a href="#">Forgotten pasward?</a>
                                        </div>
                                        <div class="col-12"><input type="submit" name="login" value="LOGIN">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                 <!--   </div>
                </div><!-- Tab Pane End -->
                <!-- Tab Pane Start ->
                <div class="tab-pane fade show active" id="tab-two">
                    <div class="row">
                        <div class="col-md-3 col-12 d-flex"></div>-->
                            <div class="col-md-6 col-12 d-flex">
                                <div class="ee-login">
                                    <h3 style="margin-top:50px!important;">Sign up to your account</h3>
                                    <form method="POST" style="margin-top:10px!important;">
                                        <div class="row">
                                            <div class="col-12 mb-30">
                                                <input type="text" name="user_name" required placeholder="username">
                                            </div>
                                            <div class="col-12 mb-30">
                                                <input type="text" name="email_id" required placeholder="email address">
                                            </div>
                                            <div class="col-12 mb-20"><input type="password" name="password" required placeholder="Enter your passward">
                                            </div>
                                            <div class="col-md-12 col-12 mb-20">
                                                <div class="check-box">
                                                <input type="checkbox" id="create_account">
                                                   <label for="create_account">I agree to with  <a href="terms-conditions.php" style="color:#ff8c00;">                 TERMS OF SERVICES</a>
                                                   </label>
                                                </div>
                                             </div>
                                             <div class="col-12"><input type="submit" name="submit" value ="REGISTER">
                                             </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div><!-- Tab Pane End -->
         </div>
    </div>
</div><!-- Feature Product Section End -->

   <?php include("assets/headpart/footer.php");
   ?>

</body>

</html>