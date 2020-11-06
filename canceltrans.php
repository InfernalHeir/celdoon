<?php ini_set('display_errors',1);
session_start();
include 'dbconnection.php';
if(empty($_SESSION['email_id']))
{
    header('location:login.php');
}
if(empty($_GET['order_id']))
{
   // die("Page Not Found");
}
try
{
       $user_id=$_SESSION['user_id'];
       $select_all=$conn->prepare("SELECT * FROM `user` WHERE `user_id`='$user_id'");
       $select_all->execute();
       $all=$select_all->fetchAll();
       
       /*if(isset($_GET['order_id']))
       {
           $check_all=$conn->prepare("SELECT * FROM `deposit` WHERE `order_id`='$order_id' and `user_id`='$user_id'");
           $check_all->execute();
           $check_all->fetchAll();
       }*/
       
       
    
}
catch(PDOException $e)
{
    echo "Connection Failed ".$e->getMessage();
}
$conn=null;
?>

<!DOCTYPE html>
<html lang="en">
    <?php include("assets/headpart/head.php");
   ?>

<body>
 
  <style>
    h3
    {
        color:#283a5e !important;
    }
    span.ml-3.p-2 {
    background: #283a5e;
    width: 40px;
    text-align: center;
    border-radius: 10px;
    color: white;
    height:40px;
}
.flex-container {
    display: flex;
    padding-top: 1.5em;
    padding-bottom: 1.5em;
}

.flex-item {
  flex: 1;
  width: 0;
}

.flex-item:not(:last-child) {
  margin-right: 1em;
}

.package {
  border: 1px solid #eee;
  list-style-type: none;
  margin: 0;
  padding: 0;
  transition: 0.25s;
}

.package:hover {
  box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.2);
  transform: scale(1.025);
}

.package .header {
    background-color: #283a5e;
    color: #fff;
    font-size: 1.5em;
}

.package .highlight {
  background-color: #29b6f6;
}

.package li {
  background-color: #fff;
  border-bottom: 1px solid #eee;
  padding: 1.2em;
  text-align: center;
}

.package .gray {
  background-color: #eee;
  font-size: 1.25em;
}

button {
  background-color: #29b6f6;
  border: none;
  border-radius: .15em;
  color: #fff;
  cursor: pointer;
  padding: .75em 1.5em;
  font-size: 1em;
}

@media only screen and (max-width: 700px) {
  button {
    padding: .75em;
  }
}

@media only screen and (max-width: 600px) {
  .flex-container {
    flex-wrap: wrap;
  }

  .flex-item {
    flex: 0 0 100%;
    margin-bottom: 1em;
    width: 100%;
  }

  .package:hover {
    box-shadow: none;
    transform: none;
  }

  button {
    padding: .75em 1.5em;
  }
}
.package .header2 {
    background-color: #004e7c;
    color: #fff;
    font-size: 1.5em;
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}


.card .card-header {
    background: #d41e1e !important;
    color: white;
    font-size: 20px;
}
.blink_me {
    -webkit-animation-name: blinker;
    -webkit-animation-duration: 1s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-iteration-count: infinite;

    -moz-animation-name: blinker;
    -moz-animation-duration: 1s;
    -moz-animation-timing-function: linear;
    -moz-animation-iteration-count: infinite;

    animation-name: blinker;
    animation-duration: 1s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}

@-moz-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}
img.img-fluid.tt {
    display: block;
    margin: 0 auto;
}

  </style>
  <body onload="stop()">
     
    <!-- start per-loader -->
<div class="loader-container">
    <div class="lds-ripple">
        <div></div>
        <div></div>
    </div>
</div>  
     <script>
function stop()
{
    $('.loader-container').hide('fade',2000);
}
</script> 

    
      
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      
      
      
      <div class="container-fluid page-body-wrapper">
               
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="container-fluid mt-5">
            <div class="row">
            <h3 class="mt-2" style="font-size:20px;">Order Cancel</h3>
            <span class="ml-3 p-2">
            <div class="inner">
            <i class="fab fa-first-order-alt mt-1"></i>    
            </div>    
            </span>
            </div>
            
            
            <!--container_end-->
            </div>
    
                
             <div class="row mt-5">
                 
            
            <div class="card w-100">
  <div class="card-header text-center"><?php  echo "Order Cancel # ".$_GET['order_id'];  ?></div>
  <div class="card-body">

<div class="row w-100 text-center mt-3 mb-3">
  <img src="https://bitbud.biz/bitbud_dir/assets/images/crying_face.gif" class="img-fluid tt">
    
</div>


<div class="mt-3 mb-3">
<p style=" font-size: 15px !important;"><b>OOPS</b> Transaction is failed Due to order cancellation. if you want to purchase with us you can Regenerate the link again. if any kind of help you want please contact with us we are open 24 hours. Thankyou be with us. </p>    
    
</div>
    </div>    
    </div>   
                
            
            <!--row_end-->
            
            </div>
            
         
         
        
          
          <!-- partial -->
        </div>
        
        
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
  
  </body>
</html>

