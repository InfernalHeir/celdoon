<?php
	require_once 'database.php';
 	
			$user_name = $_POST['user_name'];
			$user_password = md5($_POST['user_password']);
			$st ="select * from user where mobile_number='$user_name' and password='$user_password' or email_id='$user_name' and password='$user_password'";
			$s=mysqli_query($conn,$st);
			if ($a=mysqli_num_rows($s))
                        {
                            $row=mysqli_fetch_array($s);
                            $result = array('status'=>'1','user_id'=>$row['user_id'],'mobile_number'=>$row['mobile_number'],'email_id'=>$row['email_id'],'user_name'=>$row['user_name'],'house_no'=>$row['house_no'],'street'=>$row['street'],'locality'=>$row['locality'],'city'=>$row['city'],'pincode'=>$row['pincode'],'logintype'=>$row['logintype']); 
			}
			else 
                        {
                            $result = array('status'=>'0');
			}
			header('content-type:application/json');
			echo json_encode($result);
	
?>