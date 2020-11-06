<?php
                        require_once 'database.php';
                        
                        $id=$_POST['id'];
                        $update_type=$_POST['update_type'];
                        $house_no = $_POST['house_no'];
                        $street = $_POST['street'];
                        $locality = $_POST['locality'];
                        $city = $_POST['city'];
                        $pincode = $_POST['pincode'];
                        
                        if($id>0)
                        {
                            if($update_type>0)
                            {
                                $user_name = $_POST['user_name'];
                                $user_mobile = $_POST['user_mobile'];
                                $user_email = $_POST['user_email'];
                                $sql = "UPDATE user SET mobile_number='$user_email', email_id='$user_mobile', user_name='$user_name', house_no='$house_no',street='$street',locality='$locality',city='$city',pincode='$pincode' WHERE user_id='$id'";
                                if ($conn->query($sql) === TRUE) 
                                {
                                    $st ="select * from user where user_id='$id'";
                                    $s=mysqli_query($conn,$st);
                                    if (mysqli_num_rows($s))
                                    {
                                        $row=mysqli_fetch_array($s);
                                        $result = array('status'=>'1','user_id'=>$row['user_id'],'mobile_number'=>$row['mobile_number'],'email_id'=>$row['email_id'],'user_name'=>$row['user_name'],'house_no'=>$row['house_no'],'street'=>$row['street'],'locality'=>$row['locality'],'city'=>$row['city'],'pincode'=>$row['pincode']); 
                                    }
                                }
                                else
                                {
                                    $result = array('status'=>'User Details Not Updated..');
                                }
                            }
                            else
                            {
                                $sql="SELECT * FROM user where user_id='$id'";
                                $sa=mysqli_query($conn,$sql);
                                if(mysqli_num_rows($sa))
                                {
                                    $sql = "UPDATE user SET house_no='$house_no',street='$street',locality='$locality',city='$city',pincode='$pincode' WHERE user_id='$id'";
                                    if ($conn->query($sql) === TRUE) 
                                    {
                                        $st ="select * from user where user_id='$id'";
                                        $s=mysqli_query($conn,$st);
                                        if ($a=mysqli_num_rows($s))
                                        {
                                            $row=mysqli_fetch_array($s);
                                            $result = array('status'=>'1','user_id'=>$row['user_id'],'mobile_number'=>$row['mobile_number'],'email_id'=>$row['email_id'],'user_name'=>$row['user_name'],'house_no'=>$row['house_no'],'street'=>$row['street'],'locality'=>$row['locality'],'city'=>$row['city'],'pincode'=>$row['pincode']); 
                                        }
                                    }
                                    else
                                    {
                                        $result = array('status'=>'Address Not Updated...');
                                    }
                                }
                            }
                        }
                        else
                        {
                            $user_name = $_POST['user_name'];
                            $user_mobile = $_POST['user_mobile'];
                            function rand_string( $length ) 
                            {
                                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                                return substr(str_shuffle($chars),0,$length);
                            }
                            $password = rand_string(8);
                            $user_password = md5($password);
                            $user_email = $_POST['user_email'];
                            $sql="SELECT * FROM user where mobile_number='$user_mobile' or email_id='$user_email'";
                            $sa=mysqli_query($conn,$sql);
                            if(mysqli_num_rows($sa))
                            {
				$result = array('status'=>'User Already exist');
                            }
                            else
                            {
				$st ="INSERT INTO user(mobile_number, email_id, password, user_name ,house_no,street,locality,city,pincode) VALUES ('$user_mobile','$user_email','$user_password','$user_name','$house_no','$street','$locality','$city','$pincode')";
				$s=mysqli_query($conn,$st);
				//var_dump($st);
				if ($s)
                                {
                                    require 'phpmailer1/PHPMailerAutoload.php';		
                                    $mail = new PHPMailer;
                                    $mail->setFrom('contact@homestuff.co.in');
                                    $mail->addAddress($user_email);
                                    $mail->addCC("");
                                    $mail->IsHTML(true);
                                    $mail->Subject = "HomeStuff";
                                    $msg='<html>
                                            <body bgcolor="#F8F8F8"> 
                                                <p>Hi '.$user_name.',</p><br>
                                                <p>Your password is '.$password.'</p>
                                            </body>
                                          </html>';
                                    $mail->Body = $msg;
                                    //var_dump($mail);
                                    if(!$mail->send()) 
                                    {
                                        $result = array('status'=>'0');
                                    } 
                                    else 
                                    {
                                        $result = array('status'=>'1');
                                    }
                 
                                }
                                else 
                                {
                                    $result = array('status'=>'0');
                                }

                            }
                        }
			header('content-type:application/json');
			echo json_encode($result);
	
?>