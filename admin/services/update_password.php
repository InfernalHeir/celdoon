<?php
    
    require_once 'database.php';
    require_once 'function.php';
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
	require 'phpmailer1/PHPMailerAutoload.php';
	$Email = $_POST['email'];
	//$conn = mysqli_connect(HOST,USER,PASS,DB) or die('unable to connect to database');
	$sql ="SELECT * FROM user where email_id='$Email'";
 	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($res);
 	$Name = $row['user_name'];
	if ($row=='')
        {
            $result = array("status"=>"false");
	}
	else 
        {
	    $password = random_password(8);
	    $sql = "UPDATE user SET otp='$password' WHERE email_id='$Email'";
	    if(mysqli_query($conn, $sql))
            {
                $message = 'Hi ' .$Name . '  Thanks For Register.!';
		$mail = new PHPMailer;
                $mail->setFrom('info@saraswatishree.com', 'SSAcademy');
                $mail->addAddress($Email);
                $mail->Subject  = 'E-Commerce OTP';
                $mail->Body     = 'Hi ' .$Name . ' Your OTP is '.$password;
                if(!$mail->send()) 
                {
                    echo 'Mailer error: ' . $mail->ErrorInfo;
                }
                else
                {
                    
                }
		$result = array("status"=>"true","otp"=>$password);
            }
        }	
        header('Content-type: Application/json');
        echo json_encode($result);
    }
?>


