	
<?php

require_once 'database.php';
    $cat_id=$_GET['cat_id'];
    $sql = "SELECT * FROM  product where cat_id='$cat_id' and pro_status='1'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result))
    {
        while ($r=mysqli_fetch_array($result)) 
        {
            $pro_id= $res['pro_id']=$r['pro_id'];
            $cat_id= $res['cat_id']=$r['cat_id'];
            $pro_name= $res['pro_name']=$r['pro_name'];
            $pro_mrp= $res['pro_mrp']=$r['pro_mrp'];
            $pro_dis= $res['pro_dis']=$r['pro_dis'];
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
            //$pro_dis_price= $res['pro_dis_price']=$r['pro_dis_price'];
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
            $result1[]=array('pro_id'=>$pro_id,'cat_id'=>$cat_id,'pro_name'=>$pro_name,'pro_mrp'=>$pro_mrp,'pro_dis'=>$pro_dis,
                 'tax'=>$tax,'amount'=>$amount,'pro_unit'=>$pro_unit,'pro_detail'=>$pro_detail,'pro_other_name'=>$pro_other_name,
                 'pro_life'=>$pro_life,'pro_manufacture'=>$pro_manufacture,'pro_disclaimer'=>$pro_disclaimer,'pro_status'=>$pro_status,
                 'pro_image1'=>$pro_image1,'pro_image2'=>$pro_image2,'pro_image3'=>$pro_image3,'pro_image4'=>$pro_image4);
        }
    }
    else 
    {
        $result1[]=array('status'=>0);
    }
	 
	header('Content-type:application/json');
	echo json_encode($result1);

?>
