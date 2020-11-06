<?php 
    require_once 'database.php';
    header('Content-type: application/json');
    date_default_timezone_set("Asia/Calcutta");
    $fdate=date("Y-m-d");
    $ftime=date("H:i:s");
    $date_time=date("Y-m-d H:i:s");
    //$Filename = "gps_data.json";
    //var_dump($Filename);
    //$json = file_get_contents($Filename);
    $json = file_get_contents("php://input");
    $array = json_decode($json,true);
    $user_id='';
    $total=0;
    $odr_id='';
    $orderday='';
    $orderdate='';
    $ordertimeslot='';
        $ast ="select * from add_product ORDER BY odr_id DESC";
        $as=mysqli_query($conn,$ast);
        if(mysqli_num_rows($as))
        {
            $re=mysqli_fetch_array($as);
            $odr_id=1+$re['odr_id'];
        }
        else 
        {
            $odr_id=1;
        }
    foreach ($array as $row)
    {
        $orderday=$row['orderday'];
        $orderdate=$row['orderdate'];
        $ordertimeslot=$row['ordertimeslot'];
        $user_id=$row['user_id'];
        $t ="select * from product where pro_id='".$row['product_id']."'";
        $ta=mysqli_query($conn,$t);
        $tex=mysqli_fetch_array($ta);
        if($tex['tax']=='0')
        {
            $total=$total+($tex['pro_dis_price']*$row["pro_value"]);
        }
        else
        {
            $total=$total+(($tex['pro_dis_price']+($tex['pro_dis_price']*$tex['tax']/100))*$row["pro_value"]);
        }
        
        $sql = "INSERT into add_product (user_id,product_id,add_type,pro_value,date_time,fdate,ftime,odr_id,pro_price) VALUES ('".$row["user_id"]."','".$row["product_id"]."','".$row["add_type"]."','".$row["pro_value"]."','$date_time','$fdate','$ftime','$odr_id','".$row['pro_price']."')";
        $result =  mysqli_query ($conn,$sql);
        
    }
    if ($result ==1)
    {
        $t = "INSERT INTO total (user_id,odr_id,total,fdate,ftime,date_time,orderday,orderdate,ordertimeslot ) VALUES ('$user_id','$odr_id','$total','$fdate','$ftime','$date_time','$orderday','$orderdate','$ordertimeslot ')";
        if( mysqli_query ($conn,$t))
        {
            $response = array ("status"=> 1,"odr_id"=>$odr_id);
        }
        else 
        {
            $response = array ("status"=> 0);
        }
    }
    else 
    {
	$response = array ("status"=> 0);
    }
    echo json_encode($response);
?>
