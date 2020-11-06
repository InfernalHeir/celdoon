<?php
//include('../in.php');
require_once 'config.php';
function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}	
$password = random_password(8);
//var_dump($password);
  require_once "../phpmailer/class.phpmailer.php";

  $email = trim($_POST["email"]);
  
  $sql = "SELECT * from signup where user_email ='$email'";
    $stmt = $DB->prepare($sql);
     $stmt->execute();
    if($stmt=='')
    {
        $result = array("Status"=>"false");
    }
    else
    {
		$row = $stmt->fetch();
		
		$name=$row['user_name'];
		
		//var_dump($name);
        $sqle = "UPDATE signup SET otp='$password' WHERE user_email='$email'";
        $stm= $DB->prepare($sqle);
        $stm->execute();
        
        $message = '<html><head>
                <title>Email Verification</title>
                </head>
                <body>';
        $message .= '<h1>Hi ' . $name . '!</h1>';
		$message .= '<p>username:  ' . $email . '<br></p>';
		$message .= '<p>OTP:  ' . $password . '<br></p>';
        $message .= "</body></html>";
        

        // php mailer code starts
        $mail = new PHPMailer(true);
        $mail->IsSMTP(); // telling the class to use SMTP

        $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host = "smtpout.asia.secureserver.net";      // sets GMAIL as the SMTP server
        $mail->Port = 465;                   // set the SMTP port for the GMAIL server

        $mail->Username = 'contact@mobikan.com';
        $mail->Password = 'Singh@2018';

        $mail->SetFrom('contact@mobikan.com', 'Mobikan Software Solutions');
        $mail->AddAddress($email);

        $mail->Subject = trim("Email Verifcation");
        $mail->MsgHTML($message);

        try {
          $mail->send();
          $msg = "An email has been sent for verfication.";
          $msgType = "success";
        } catch (Exception $ex) {
          $msg = $ex->getMessage();
          $msgType = "warning";
        }
        
        $result = array("Status"=>"True");
		
    } 
 header('Content-type: Application/json');
 echo json_encode($result);

?>