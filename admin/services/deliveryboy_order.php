	
<?php

require_once 'database.php';
    $deliveryboyid=$_POST['deliveryboyid'];
    $sql = "SELECT * FROM  orderasign where deliveryboyid='$deliveryboyid' and status='1'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result))
    {
        $res['status']=1;
        while ($r=mysqli_fetch_array($result)) 
        {
            $orderid= $r['orderid'];
            $userid= $r['userid'];
            
            $sql1 = "SELECT * FROM  user where user_id='$userid'";
            $result11 = mysqli_query($conn,$sql1);
            $r1=mysqli_fetch_array($result11);
            
            $sql2 = "SELECT * FROM  total where user_id='$userid' and odr_id='$orderid'";
            $result2 = mysqli_query($conn,$sql2);
            $r2=mysqli_fetch_array($result2);
            
            
            $res1['user_id']=$r2['user_id'];
            $res1['odr_id']=$r2['odr_id'];
            $res1['mobile_number']=$r1['mobile_number'];
            $res1['email_id']=$r1['email_id'];
            $res1['user_name']=$r1['user_name'];
            $res1['house_no']=$r1['house_no'];
            $res1['street']=$r1['street'];
            $res1['locality']=$r1['locality'];
            $res1['city']=$r1['city'];
            $res1['pincode']=$r1['pincode'];
            $res1['total']=$r2['total'];
            $res1['orderday']=$r2['orderday'];
            $res1['orderdate']=$r2['orderdate'];
            $res1['ordertimeslot']=$r2['ordertimeslot'];
            $res2[]=$res1;
        }
        $res['orders']=$res2;
        $result1[]=$res;
    }
    else 
    {
        $result1[]=array('status'=>0);
    }
	 
	header('Content-type:application/json');
	echo json_encode($result1);

?>

