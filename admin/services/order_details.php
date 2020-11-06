	
<?php

require_once 'database.php';
    $user_id=$_POST['user_id'];
    $odr_id=$_POST['odr_id'];
    $sql1 = "SELECT * FROM  add_product where user_id='$user_id' and odr_id='$odr_id'";
    $result1 = mysqli_query($conn,$sql1);
    if (mysqli_num_rows($result1))
    {
        $res1['status']=1;
        while ($r1=mysqli_fetch_array($result1)) 
        {
            $product_id=$r1['product_id'];
            //var_dump($product_id);
            $sql = "SELECT * FROM  product WHERE pro_id='$product_id'";
            $result = mysqli_query($conn,$sql);
                while ($r=mysqli_fetch_array($result)) 
                {
                    //var_dump($r);
                    $res['pro_value']=$r1['pro_value'];
                    $res['pro_id']=$r['pro_id'];
                    $res['cat_id']=$r['cat_id'];
                    $res['pro_name']=$r['pro_name'];
                    $res['pro_mrp']=$r['pro_mrp'];
                    $res['pro_dis']=$r['pro_dis'];
                    $tax= $res['tax']=$r['tax'];
                    $amount='';
                    if($tax=='0')
                    {
                        $amount=$r['pro_dis_price'];
                    }
                    else
                    {
                        $amount= $r['pro_dis_price']+($r['pro_dis_price']*$r['tax']/100);
                    }
                    $res['pro_unit']=$r['pro_unit'];
                    $res['pro_detail']=$r['pro_detail'];
                    $res['pro_other_name']=$r['pro_other_name'];
                    $res['pro_life']=$r['pro_life'];
                    $res['pro_manufacture']=$r['pro_manufacture'];
                    $res['pro_disclaimer']=$r['pro_disclaimer'];
                    $res['pro_status']=$r['pro_status'];
                    $res['amount']=$amount;
                    $res['total_amount']=$amount*$r1['pro_value'];
                    $res['pro_image1']="http://homestuff.co.in/admin/upload/".$r['pro_image1'];
                    $res2[]=$res;
                    
                }
                //var_dump($res2);
        }
        $res1['products']=$res2;
        $result2[]=$res1;
    }
    else 
    {
        $result2[]=array('status'=>0);
    }
	 
	header('Content-type:application/json');
	echo json_encode($result2);

?>

