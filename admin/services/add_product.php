<?php
	require_once 'database.php';
 	
			$user_id = $_POST['user_id'];
			$product_id = $_POST['product_id'];
			$add_type = $_POST['add_type'];
                        $pro_value = $_POST['pro_value'];
			$bst ="select * from add_product where user_id='$user_id' and product_id='$product_id'";
                        $bs=mysqli_query($conn,$bst);
                        if (mysqli_num_rows($bs))
                        {
                            $sql = "UPDATE add_product SET add_type='$add_type',pro_value='$pro_value' WHERE user_id='$user_id' and product_id='$product_id'";
                            if ($conn->query($sql) === TRUE) 
                            {
                                    $ast ="select * from add_product where user_id='$user_id'";
                                    $as=mysqli_query($conn,$ast);
                                    while ($row=mysqli_fetch_array($as))
                                    {
                                        $res['user_id']=$row['user_id'];
                                        $res['product_id']=$row['product_id'];
                                        $res['add_type']=$row['add_type'];
                                        $res['pro_value']=$row['pro_value'];
                                        $result[] = array($res);
                                    }
                            }
                            else
                            {
                                $result = array('status'=>'0');
                            }
                        }
                        else
                        {
                            $st ="INSERT INTO add_product(user_id, product_id, add_type,pro_value) VALUES ('$user_id','$product_id','$add_type','$pro_value')";
				$s=mysqli_query($conn,$st);
				if ($s)
				{
                                    $ast ="select * from add_product where user_id='$user_id'";
                                    $as=mysqli_query($conn,$ast);
                                    while ($row=mysqli_fetch_array($as))
                                    {
                                        $res['user_id']=$row['user_id'];
                                        $res['product_id']=$row['product_id'];
                                        $res['add_type']=$row['add_type'];
                                        $res['pro_value']=$row['pro_value'];
                                        $result[] = array($res);
                                    }
				}
				else 
				{
                                    $result = array('status'=>'0');
				}
                        }
			header('content-type:application/json');
			echo json_encode($result);
	
?>