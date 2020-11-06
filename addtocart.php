<?php ini_set('display_errors',1);
session_start();
if(empty($_SESSION['email_id']))
{
    echo 'login';
}

else
{
include 'dbconnection.php';
extract($_POST);
try
{
   if(isset($_POST['pro_id']) && isset($_POST['qty']))
    {
      
            $pro_id=$_POST['pro_id'];
            $email=$_SESSION['email_id'];
            //unset($_SESSION['cart']);
            
            $big_array = array();
            
            $select_product_details=$conn->prepare("SELECT * FROM `product` WHERE `pro_id`='$pro_id'");
            $select_product_details->execute();
            $fetch=$select_product_details->fetchAll();
            foreach($fetch as $value)
            {
                $pro_name = $value['pro_name'];
                $pro_mrp = $value['pro_mrp'];
                $pro_dis = $value['pro_dis'];
                $pro_image1 = $value['pro_image1'];
                $discount = $pro_mrp*$pro_dis/100;
                
                $sub_total=$pro_mrp*$qty;
                $grand_total=$sub_total-$discount;
                
                
            }
            $cart_id = uniqid();
            
            
            $array_element = array(
                'pro_id' => $pro_id,
                'pro_name' => $pro_name,
                'pro_mrp' => round($pro_mrp),
                'pro_discount' => round($discount),
                'pro_sub' =>round($sub_total),
                'pro_grand_total' =>round($grand_total)
                
                );
            
            if(isset($_SESSION['cart']))
            {
                array_push($_SESSION['cart'],$array_element);
                $product_schema = json_encode($_SESSION['cart']);
                
            }
            else
            {
            array_push($big_array,$array_element);
            $_SESSION['cart']  = $big_array;
            $product_schema = json_encode($big_array);
                
            }
            
             
            
            $insert_on_add_to_cart = $conn->prepare("SELECT * FROM `add_to_cart` WHERE `email`='$email' and `status` = 'Added'");
            $insert_on_add_to_cart->execute();
            $insert_on_add_to_cart->fetchAll();
            if($insert_on_add_to_cart->rowCount()==0)
            {
                $insert=$conn->prepare("INSERT INTO `add_to_cart`(`email`, `cart_id`, `product_scema`, `shipping_charge`, `subtotal`, `grand_total`, `status`) VALUES ('$email','$cart_id','$product_schema',0,'$sub_total','$grand_total','Added')");
                if($insert->execute())
                {
                   echo sizeof($_SESSION['cart']); 
                }
            }
            else
            {
                    $cart_products = $_SESSION['cart'];
                    $encoded = json_encode($cart_products);
                    for($i=0; $i<=sizeof($cart_products); $i++)
                    {
                          $sub_total_from_session += json_decode($cart_products[$i])->pro_sub;
                          $grand_total_from_session += json_decode($cart_products[$i])->pro_grand_total;
                    }
                    
                    $update=$conn->prepare("UPDATE `add_to_cart` SET `product_scema` = '$encoded', `subtotal`='$sub_total_from_session',`grand_total`='$grand_total_from_session' WHERE `email`='$email' and `status`='Added'");
                    if($update->execute())
                    {
                        echo sizeof($_SESSION['cart']);
                    }
            
            }
            
                
            
            
            
            
    

}    
}
catch(PDOException $err)
{
    echo "Connection Failed ".$err->getMessage();
}
}
?>