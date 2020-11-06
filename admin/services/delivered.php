<?php 
    require_once 'database.php';
    header('Content-type: application/json');
    date_default_timezone_set("Asia/Calcutta");
    $fdate=date("Y-m-d");
    $ftime=date("H:i:s");
    $date_time=date("Y-m-d H:i:s");
    $user_id=$_POST['user_id'];
    $order_id=$_POST['order_id'];
    $deliveryboyid=$_POST['deliveryboyid'];
    
    $sql="UPDATE  orderasign SET status ='0',dalivered_date_time='$date_time' WHERE deliveryboyid='$deliveryboyid' and userid='$user_id' and orderid='$order_id'";
    mysqli_query($conn,$sql);
    
    $sql1="UPDATE  total SET order_status ='0' WHERE user_id='$user_id' and odr_id='$order_id'";
    if(mysqli_query($conn,$sql1))
    {
        $response=array('status'=>1);
    }
    else 
    {
        $response=array('status'=>0);
    }
    echo json_encode($response);
?>
