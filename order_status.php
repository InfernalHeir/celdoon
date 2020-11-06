<?php ini_set('display_errors',1);
ob_start();
session_start();
include 'dbconnection.php';
if(empty($_SESSION['email_id']))
{
   header('location:login.php');
}
if(empty($_GET['order_id']) && empty($_COOKIE['charge']))
{
    //die("Page Not Found");
}
try
{
       $user_id=$_SESSION['user_id'];
       $select_all=$conn->prepare("SELECT * FROM `user` WHERE `user_id`='$user_id'");
       $select_all->execute();
       $all=$select_all->fetchAll();
       
       $btc_wallet=$conn->prepare("SELECT `btc_wallet` FROM `btc` WHERE `user_id`='$user_id'");
       $btc_wallet->execute();
       $btc=$btc_wallet->fetchAll();
       
       if(isset($_GET['order_id']))
       {
           $order_id=$_GET['order_id'];
           $check=$conn->prepare("SELECT * FROM `deposit` WHERE `order_id`='$order_id' and `user_id`='$user_id' and  `status`='PENDING'");
           $check->execute();
           $fet=$check->fetchAll();
           
           foreach($fet as $val){ $charge_id=$val['charge_id'];
             $code=$val['code'];
             $plan=$val['plan'];
           }
           
           ?>
           
            <?php
           
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, "https://api.commerce.coinbase.com/charges/$charge_id/");
           curl_setopt($ch, CURLOPT_POST, 1);
           curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
               

                    
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           $header=array(
                            'Content-Type: application/json',
                            'X-CC-Api-Key:76037cfc-7a80-4971-834c-985c36266eb8',
                            'X-CC-Version: 2018-03-22'
            ); 
          curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
          $response= curl_exec($ch);
          $data=json_decode($response);
          $json=$data->data;
          $payments=$json->payments;
          $address=$json->addresses;
          $value=$payments[0]->value;
          $timeline=$json->timeline;
          $timeline_status=$timeline['1']->status;
        
         
          /*usefull_payments_variables*/
          
          $network=$payments[0]->network;
          $transaction_id=$payments[0]->transaction_id;
          $status=$payments[0]->status;
          $value_paid=$value->crypto;
          $amount_paid=$value_paid->amount;
          $btc_address=$address->bitcoin;
          $block=$payments[0]->block;
          
          
          /*confirmations_variables*/
          if($timeline_status=="CANCELED")
          {
            $update_cancel=$conn->prepare("UPDATE `deposit` SET `status`='$timeline_status' WHERE `user_id`='$user_id' and `charge_id`='$charge_id'");
            if($update_cancel->execute())
            {
                 setcookie('order_id','',time()-10800,'/');
            header("location:https://bitbud.biz/bitbud_dir/fail.php?order_id=$order_id");
            }
            
           
          }
          else
          {
            if($timeline_status=="EXPIRED")
            {
                $update_cancel=$conn->prepare("UPDATE `deposit` SET `status`='$timeline_status' WHERE `user_id`='$user_id' and `charge_id`='$charge_id'");
            if($update_cancel->execute())
            {
                
                setcookie('order_id','',time()-10800,'/');
            header("location:https://bitbud.biz/bitbud_dir/link_expire.php?order_id=$order_id");
            }
            }
            else
            {
                  
          
          
          $confirmations_accmulated=$block->confirmations;
          $confirmations_required=$block->confirmations_required;
          $action="Unapproved";
         
          if($status=="CONFIRMED")
          {
              
              $select_rounds=$conn->prepare("SELECT `user_id`,`order_id` FROM `deposited_made` WHERE `user_id`='$user_id' and `order_id`='$order_id'");
              $select_rounds->execute();
              $select_rounds->fetchAll();
              if($select_rounds->rowCount()==0)
              {
              
              date_default_timezone_set('America/New_York');
              $currentTime = date( 'd-m-Y h:i:s A', time () );
              
              $enter_this_on=$conn->prepare("INSERT INTO `deposited_made`(`user_id`, `address`, `charge_id`, `order_id`,`code`, `network`, `transaction_id`,`plan`,`value_paid`, `deposited_time`, `status`,`admin_action`) VALUES (:user_id,:btc_address,:charge_id,:order_id,:code,:network,:transaction_id,:plan,:amount,:currentTime,:status,:action)");
               $enter_this_on->bindParam(':user_id',$user_id);
               $enter_this_on->bindParam(':btc_address',$btc_address);
               $enter_this_on->bindParam(':charge_id',$charge_id);
               $enter_this_on->bindParam(':order_id',$order_id);
               $enter_this_on->bindParam(':code',$code);
               $enter_this_on->bindParam(':network',$network);
               $enter_this_on->bindParam(':transaction_id',$transaction_id);
               $enter_this_on->bindParam(':plan',$plan);
               $enter_this_on->bindParam(':amount',$amount_paid);
               $enter_this_on->bindParam(':currentTime',$currentTime);
               $enter_this_on->bindParam(':status',$status);
               $enter_this_on->bindParam(':action',$action);
              
              if($enter_this_on->execute())
              {
                  $update=$conn->prepare("UPDATE `deposit` SET `status`='$status' WHERE `user_id`='$user_id' and `charge_id`='$charge_id'");
                  if($update->execute())
                  {
                     /*do_something_for_user*/
                     
                include '../bitbud_ext/PHP_mailer/phpmailer/class.phpmailer.php';
                include '../bitbud_ext/PHP_mailer/phpmailer/class.smtp.php';




                $mail = new PHPMailer;

                /*$mail->SMTPDebug = true;*/                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                ini_set('max_execution_time', 300);
                $mail->isSMTP();                                      // Set 
                Host: 'p3plcpnl1000.prod.phx3.secureserver.net';



                PORT: 25;

                              
                $mail->SMTPSecure = 'ssl';                            // Enable 
                $mail->Port = 465;
                $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
                );                                   // TCP port to connect to



		        foreach($fet as $ff)
		        {
		            $plan=$ff['plan'];
		            $amount=$ff['amount'];
		            $charge_id=$ff['charge_id'];
		           
		        }
     
            foreach($all as $ee)
            {
                $email=$ee['email'];
            }

                $mail->addAddress($email, 'BitBud Limited');  
            $mail->setFrom('bitbudlimited@gmail.com','BitBud Limited');
		
		

                //$mail->addAttachment($_FILES['file']['tmp_name'],$_FILES['file']['name']);    // Optional name
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = 'Payment Received!';


                $mail->Body="Hii Dear ".$user_id."<br>";
                $mail->Body.="<br>";
                
                
                $mail->Body.="Payment has been successfully Received.Now its a verifying stage to make sure the payable amount is accurate. this may be take Half & hour to confirm your payments. thankyou for purchasing. your plan information is below mentioned-"."<br>";
                
                $mail->Body.="<br>";
                
                
                $mail->Body.="Plan- ".$plan."<br>";
                $mail->Body.="Amount- ".$amount."<br>";
                $mail->Body.="Charge Id- ".$charge_id."<br>";
                
                $mail->Body.="<br>";
                $mail->Body.="<b>Important Notes<b>: Do not share this information to anyone!. For More Information please contact us immediately we will reply you within 24 hours. thankyou For Joining us.";
                
                $mail->Body.="<br>";
                $mail->Body.="<br>";
                
                
                $mail->Body.="<a href='https://bitbud.biz'><img src='https://bitbud.biz/bitbud_ext/images/logo/logo1.png' style='width:200px; height:40px;'></a>"."<br>";

                $mail->Body.="<p style='font-size:14px;'>Registered office Address<br>Dept 906, 196 High road,"."<br>"."Woodgreen,London"."<br>"."United Kingdom, N22 8HH"."</p>"."<br>";
                $mail->Body.="<p style='font-size:14px;'>Support"."<br>"."support@bitbud.biz</p>";



 


                //$mail->ClearAllRecipients();

if($mail->send()) {
    /*do_redirection*/
    
    setcookie('order_id','',time()-10800,'/');
    header("location:https://bitbud.biz/bitbud_dir/thankyou.php?order_id=$order_id");
} 

else {
	
	echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    
	
}
                  /*if_end*/}
                  else
                  {
                      setcookie('order_id','',time()-10800,'/');
                      header("location:https://bitbud.biz/bitbud_dir/thankyou.php?order_id=$order_id");
                  }
                  
                  }
              }
              
          }
          
          
          curl_close($ch);
            
           
            }  
           
       }
       
       
       }
       
       
       
       
    
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
    background: #20b2aa !important;
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
            <div class="row w-100">
            <h3 class="mt-2" style="font-size:16px;">Order Status</h3>
            <span class="ml-3 p-2">
            <div class="inner">
            <i class="fas fa-sync"></i>
            
            </div>    
            </span>
            <a href='<?php echo "https://celdoon.com/order_status.php" ?>' class="float-right ml-auto"><button class="btn btn-info btn-sm" style="height : 35px !important;">Refresh</button></a>
            </div>
            
            
            <!--container_end-->
            </div>
    
                
             <div class="row mt-5">
                 
            
            <div class="card w-100">
  <div class="card-header text-center"><?php foreach($fet as $val){ echo "Order For #".$val['order_id'];}  ?></div>
  <div class="card-body">

<div class="row w-100 text-center mt-3 mb-3">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#fff;display:block;" width="150px" height="150px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
<g transform="scale(-1,1) translate(-100,0)"><g transform="rotate(101.869 50 50)">
  <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" values="360 50 50;240 50 50;120 50 50;0 50 50" keyTimes="0;0.333;0.667;1" dur="1s" keySplines="0.7 0 0.3 1;0.7 0 0.3 1;0.7 0 0.3 1" calcMode="spline"></animateTransform>
  <path fill="#e15b64" d="M91,74.1C75.6,98,40.7,102.4,21.2,81c11,9.9,26.8,13.5,40.8,8.7c7.4-2.5,13.9-7.2,18.7-13.3 c1.8-2.3,3.5-7.6,6.7-8C90.5,67.9,92.7,71.5,91,74.1z"></path>
  <path fill="#f8b26a" d="M50.7,5c-4,0.2-4.9,5.9-1.1,7.3c1.8,0.6,4.1,0.1,5.9,0.3c2.1,0.1,4.3,0.5,6.4,0.9c5.8,1.4,11.3,4,16,7.8 C89.8,31.1,95.2,47,92,62c4.2-13.1,1.6-27.5-6.4-38.7c-3.4-4.7-7.8-8.7-12.7-11.7C66.6,7.8,58.2,4.6,50.7,5z"></path>
  <path fill="#abbd81" d="M30.9,13.4C12,22.7,2.1,44.2,7.6,64.8c0.8,3.2,3.8,14.9,9.3,10.5c2.4-2,1.1-4.4-0.2-6.6 c-1.7-3-3.1-6.2-4-9.5C10.6,51,11.1,41.9,14.4,34c4.7-11.5,14.1-19.7,25.8-23.8C37,11,33.9,11.9,30.9,13.4z"></path></g>
</g></svg>    
    
</div>

<div class="blink_me text-center w-100"><h3>Processing!</h3></div>

    <div class="text-center w-100 mt-3 mb-2"><h4 style="font-size:18px !important;">Confirmations Accumulated-<?php echo $confirmations_accmulated;  ?></h4></div>
<div class="text-center w-100 mt-2"><h4 style="font-size:18px !important;">Confirmations Needed-<?php echo $confirmations_required;  ?></h4>
<a href='<?php  echo "https://www.blockchain.com/btc/tx/$transaction_id"; ?>' target='_blank'><?php echo $transaction_id;  ?></a>
</div>
  

<div class="mt-3 mb-3">
<p style=" font-size: 15px !important;">Please do not close this tab until the fully confirmation of payment. if you forget your link please use this payment links <a href='<?php foreach($fet as $v){ echo $v['hosted_url'];}  ?>' target="_blank"><?php foreach($fet as $v){ echo $v['hosted_url'];}  ?></a>. <b>If you Paid. dont worry please wait for 5 minutes and click the refresh button .its just a processing to ensure your payments accuracy only. We will sent you invoice via email after successfull confirmation of payment. Thankyou for your patience. if any issue regarding payments. please contact us on or you can raise a ticket from support section also. we will reply you within 24 hours.</b></p>    
    
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

