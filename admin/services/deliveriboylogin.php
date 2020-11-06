<?php
	require_once 'database.php';
 	
			$user_name = $_POST['user_name'];
			$user_password = $_POST['user_password'];
			$st ="select * from deliveryboy where email='$user_name' and pass='$user_password' or mobile='$user_name' and pass='$user_password'";
			$s=mysqli_query($conn,$st);
			if ($a=mysqli_num_rows($s))
                        {
                            $row=mysqli_fetch_array($s);
                            $result = array('status'=>'1','id'=>$row['id'],'name'=>$row['name'],'mobile'=>$row['mobile'],'email'=>$row['email'],'houseno'=>$row['houseno'],'locality'=>$row['locality'],'city'=>$row['city'],'district'=>$row['district'],'state'=>$row['state'],'pin'=>$row['pin']); 
			}
			else 
                        {
                            $result = array('status'=>'0');
			}
			header('content-type:application/json');
			echo json_encode($result);
	
?>