<?php ini_set('display_errors',1);
session_start();
include 'dbconnection.php';
if(empty($_SESSION['email_id']))
{
    header('location:login.php');
}
try
{
       $user_id=$_SESSION['email_id'];
       
       $select_all=$conn->prepare("SELECT * FROM `user` WHERE `user_id`='$user_id'");
       $select_all->execute();
       $all=$select_all->fetchAll();
     
}
catch(PDOException $e)
{
    echo "Connection Failed ".$e->getMessage();
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
<style>
.col-12.mb-60.now {
    text-align: right !important;
}    
</style>

<!-- Page Banner Section Start -->
<div class="page-banner-section section">
              <h1 style="text-align: center; width: 100%;">Checkout</h1>
       
</div><!-- Page Banner Section End -->


<!-- Checkout Page Start -->
<div class="page-section section mt-90 mb-30">
    <div class="container">
        <div class="row">
            <div class="col-12">
                
                <!-- Checkout Form s-->
                <div class="checkout-form">
                   <div class="row row-40">
                       
                       <div class="col-lg-6 mb-20">
                          
                           <!-- Billing Address -->
                           <div id="billing-form" class="mb-40">
                               <h4 class="checkout-title">Billing Address</h4>

                               <div class="row">

                                    <div class="col-md-6 col-12 mb-20">
                                       <label>First Name*</label>
                                       <input type="text" placeholder="First Name" id="first_name" auto-complete="off">
                                    </div>
                                    <div class="col-md-6 col-12 mb-20">
                                       <label>Last Name*</label>
                                       <input type="text" placeholder="Last Name" id="last_name" auto-complete="off">
                                    </div>
                                    <div class="col-md-6 col-12 mb-20">
                                       <label>Email Address*</label>
                                       <input type="email" placeholder="Email Address" id="email" auto-complete="off">
                                    </div>
                                    <div class="col-md-6 col-12 mb-20">
                                       <label>Phone no*</label>
                                       <input type="number" placeholder="Phone number" id="phone_no" auto-complete="off">
                                    </div>
                                    
                                   <div class="col-12 mb-20">
                                       <label>Address*</label>
                                       <input type="text" placeholder="Address line 1" id="address" auto-complete="off">
                                       <input type="text" placeholder="Address line 2 Optional" id="address2" auto-complete="off">
                                   </div>
                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Country*</label>
                                       <select class="nice-select" id="country">
                                            <option>---Select Country---</option>
                                            <option>India</option>
                                            <option>China</option>
                                            <option>USA</option>
                                            <option>UK</option>
                                            <option>Japan</option>
                                       </select>
                                   </div>
                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Town/City*</label>
                                       <input type="text" placeholder="Town/City" id="town" auto-complete="off">
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>State*</label>
                                       <input type="text" placeholder="State" id="state" auto-complete="off">
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Zip Code*</label>
                                       <input type="text" placeholder="Zip Code" id="zip_code" auto-complete="off">
                                   </div>

                                   
                                </div>

                           </div>
                           
                           <!-- Shipping Address -->
                           
                           
                       </div>
                       
                       
                       
                       
                       <div class="col-lg-6">
                           <div class="row">
                               
                               <?php
                               $cart_id=$_GET['cart_id'];
                               $select_from_add=$conn->prepare("SELECT * FROM `add_to_cart` WHERE `email`='$email' and `status`='Added'");
                               $select_from_add->execute();
                               $pro_added=$select_from_add->fetchAll();
                               ?>
                               <!-- Cart Total -->
                               <div class="col-12 mb-60">
                               
                                   <h4 class="checkout-title">Cart Total</h4>
                           
                                   <div class="checkout-cart-total">

                                       <h4>Product <span>Total</span></h4>
                                       
                                       <ul>
                                        <?php
                                           foreach($pro_added as $values)
                                           {
                                            ?>   
                                           <li><?php echo $values['pro_name'].' X '.$values['quantity']; ?><span><?php echo "$".$values['subtotal'];    ?></span></li>
                                           <?php
                                           }
                                           ?>   
                                       </ul>
                                       
                                       <?php
                                        $email=$_SESSION['email_id'];
                                        $select_sum=$conn->prepare("SELECT SUM(subtotal),SUM(pro_discount),SUM(grand_total) FROM `add_to_cart` WHERE `email`='$email' and `status`='Added'");
                                        $select_sum->execute();
                                        $sums=$select_sum->fetchAll();
        
        
        ?>
                        
                    
                        
                                       
                                    <p>Sub Total <span><?php foreach($sums as $sum){ echo "$".$sum['SUM(subtotal)'];}  ?></span></p>
                                    <p>Discount <span><?php foreach($sums as $sum){ echo "$".round($sum['SUM(pro_discount)']);}  ?></span></p>
                                    <p>Affliate Program <span>$0.00</span></p>
                                    <p>Shipping Fee <span><?php foreach($sums as $sum){ echo '$'."0.00";}  ?></span></p>
                                       
                                    <h4>Grand Total <span><?php foreach($sums as $sum){ echo "$".round($sum['SUM(grand_total)']);}  ?></span></h4>
                                       
                                   </div>
                                   
                               </div>
                               
                               <!-- Payment Method -->
                               <div class="col-12 mb-60 now">
                                  <button class="btn btn-warning" class="btn_proceed" onclick="place()">Place Order</button>
                               </div>
                               
                           </div>
                       </div>
                       
                   </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>

function place()
{
    var firstname = $('#first_name').val();
    var lastname = $('#last_name').val();
    var email = $('#email').val();
    var address = $('#address').val();
    var address2 = $('#address2').val();
    var country = $('#country').val();
    var town = $('#town').val();
    var state = $('#state').val();
    var zip_code = $('#zip_code').val();
    
    if(firstname==0 || lastname==0 || email==0 || address ==0 || country=="---Select Country---" || town==0 || state==0 || zip_code==0)
    {
       alert('Please fill required fields');
    }
    else
    {
         $.ajax({
        url:'coinbaseApi.php',
        type:'POST',
        data:{firstname:firstname,lastname:lastname,email:email,address:address,address2:address2,country:country,town:town,state:state,zip_code:zip_code},
        dataType:'JSON',
        success:function(callback)
        {
            
        }
             
         }) 
    }    
}
</script>



<!-- Checkout Page End --> 

 <?php include("assets/headpart/footer.php");?>

  

</body>

</html>