	
<?php

        require_once 'config.php';
        $user_id= $_GET['user_id'];
  	$stmt = $DB->query("SELECT * FROM  total where user_id='$user_id'");
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
                $total = $re1['total']=$row['total'];
                $odr_id = $re1['odr_id']=$row['odr_id'];
                $fdate = $re1['fdate']=$row['fdate'];
                $ftime = $re1['ftime']=$row['ftime'];
        	$sa = $DB->query("select * from add_product where odr_id='$odr_id'");
	        while($ra = $sa->fetch(PDO::FETCH_ASSOC))
		{
                            $product_id = $res['product_id']=$ra['product_id'];
                            $s = $DB->query("SELECT * FROM  product where pro_id='$product_id'");
                            $r = $s->fetch(PDO::FETCH_ASSOC);
                            
                            $cat_id= $res['cat_id']=$r['cat_id'];
                            $pro_name= $res['pro_name']=$r['pro_name'];
                            $pro_mrp= $res['pro_mrp']=$r['pro_mrp'];
                            $pro_dis= $res['pro_dis']=$r['pro_dis'];
                            $pro_dis_price= $res['pro_dis_price']=$r['pro_dis_price'];
                            $pro_unit=$res['pro_unit']=$r['pro_unit'];
                            $pro_detail= $res['pro_detail']=$r['pro_detail'];
                            $pro_other_name= $res['pro_other_name']=$r['pro_other_name'];
                            $pro_life= $res['pro_life']=$r['pro_life'];
                            $pro_manufacture= $res['pro_manufacture']=$r['pro_manufacture'];
                            $pro_disclaimer= $res['pro_disclaimer']=$r['pro_disclaimer'];
                            $pro_status= $res['pro_status']=$r['pro_status'];
         
                            $pro_image1= $res['pro_image1']="http://homestuff.co.in/admin/upload/".$r['pro_image1'];
                            $pro_image2= $res['pro_image2']="http://homestuff.co.in/admin/upload/".$r['pro_image2'];
                            $pro_image3= $res['pro_image3']="http://homestuff.co.in/admin/upload/".$r['pro_image3'];
                            $pro_image4= $res['pro_image4']="http://homestuff.co.in/admin/upload/".$r['pro_image4'];
                            
                            $pro_value = $res['pro_value']=$ra['pro_value'];
                            $tot_price = $res['tot_price']=$ra['pro_price'];
                            $re[]=$res;
                }
                $red=$re1['products']=$re;
                $result[]=$re1;
                unset($re);
        }
	header('content-type:application/json');
	echo json_encode($result);

?>
