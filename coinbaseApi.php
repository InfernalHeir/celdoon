<?php ini_set('display_errors',1);
session_start();
if($_SESSION['email_id'] == "")
{
    echo "login";
}

include 'dbconnection.php';
extract($_POST);
if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['country']) && isset($_POST['town']) && isset($_POST['state']) && isset($_POST['zip_code']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $fullname = $firstname.' '.$lastname;
    $email_posted = $_POST['email'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $town = $_POST['town'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip_code'];
    $email = $_SESSION['email_id'];
    $full_array = array();
    $address_scema = array(
        'address' => $address,
        'country' => $country,
        'town'   => $town,
        'state'  => $state,
        'zip_code' => $zip_code
        );
        
    $json_address = json_encode($address_scema);
    
    $check=$conn->prepare("SELECT * FROM `add_to_cart` WHERE `email`='$email' and `status` = 'Added'");
    $check->execute();
    $products_info=$check->fetchAll();
    if($check->rowCount() == 0)
    {
        echo "No Longer Access.. Your Cart is empty";
    }
    else
    {
        foreach($products_info as $data)
        {
            $pro_id = $data['pro_id'];
            //again_query
            
           
            
            
            $select=$conn->prepare("SELECT * FROM `add_to_cart` WHERE `email`='$email' and `status` = 'Added' and `pro_id`='$pro_id'");
            $select->execute();
            $res=$select->fetchAll();
            foreach($res as $ok)
            {
                $pro_id=$ok['pro_id'];
                $qty = $ok['qty'];
                $pro_name = $ok['pro_name'];
                $pro_image = $ok['pro_image'];
                $pro_mrp = $ok['pro_mrp'];
                $pro_discount = $ok['pro_discount'];
                $subtotal = $ok['subtotal'];
                $grand_total = $ok['grand_total'];
                
                $pro_data = array(
                    'pro_id' => $pro_id,
                    'qty' => $qty,
                    'pro_name' => $pro_name,
                    'pro_image' => $pro_image,
                    'pro_mrp' => $pro_mrp,
                    'pro_discount' => $pro_discount,
                    'subtotal' => $subtotal,
                    'grand_total' => $grand_total,
                   ).",";
                 
                  $arraykeys = json_encode($pro_data);
                  $array = [$arraykeys];
                  print_r($array);
            }  
                
                
                $query_sum=$conn->prepare("SELECT SUM(grand_total) FROM `add_to_cart` WHERE `email` = '$email' and `status`='Added'");
                $query_sum->execute();
                $amt=$query_sum->fetchAll();
                foreach($amt as $gamt)
                {
                    $grand_total_all = $gamt['SUM(grand_total)'];
                }
                
                 $ch = curl_init();
                    
                    $header=array(
                            'Content-Type: application/json',
                            'X-CC-Api-Key: 7e55dfc0-338d-455b-9abb-5444c027e2b7',
                            'X-CC-Version: 2018-03-22'
                    ); 
                    $json_encode = [
                            'name' => 'Celdoon Limited',
                            'description' => 'Mining Ecommrece Platform',
                            
                            'local_price' => ['amount' => $grand_total_all,'currency' => 'USD'],
                            
                            'pricing_type' => 'fixed_price',
                           
                            'metadata'  => ['customer_id' =>$email,'customer_name' => $fullname],
                          
                            'redirect_url' => 'https://www.celdoon.xyz/myorder.php',
                            'cancel_url' => 'https://www.celdoon.xyz/index.php'
                         ];
                         
                            $data=json_encode($json_encode);         
                    
                            curl_setopt($ch,CURLOPT_URL, $url);
	                        curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                   
                            $result = curl_exec($ch);
                            $json_decoded = json_decode($result);
                            print_r($json_decoded);

                            curl_close($ch);
                
                
                
                
              
                
            }
        
    }
    
}

?>