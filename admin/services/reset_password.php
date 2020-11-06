<?php

        require_once 'database.php';
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            require 'phpmailer1/PHPMailerAutoload.php';
            $otp = $_POST['otp'];
            $password = $_POST['password'];
            $password1 = md5($password); 
            //$conn = mysqli_connect(HOST,USER,PASS,DB) or die('unable to connect to database');
            $sql ="SELECT * FROM user where otp = '$otp'";
            $res = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($res);
            $Name = $row['user_name'];
            $Email = $row['email_id'];
            if ($row=='')
            {
                $result = array("status"=>"false");
            }
            else 
            {
		$sql = "UPDATE user SET password='$password1', otp='' WHERE email_id='$Email'";
		if(mysqli_query($conn, $sql))
                {
                    $result = array("status"=>"true");
                    $message = 'Hi ' .$Name . '  Thanks For Register.!';
                    $mail = new PHPMailer;
                    $mail->setFrom('info@saraswatishree.com', 'SSAcademy');
                    $mail->addAddress($Email);
                    $mail->Subject  = 'E-Commerce Updated Password';
                    $mail->Body     = 'Hi ' .$Name . ' Your Updaed Password is '.$password;
                    if(!$mail->send()) 
                    {
                        echo 'Mailer error: ' . $mail->ErrorInfo;
                    } 
                    else 
                    {
                        
                    }
		}
            }	

            header('Content-type: Application/json');
            echo json_encode($result);
        }


?>


