<?php
    session_start();
    include ('include/database.php');
    $id=$_SESSION['id'];
    $page='dashboard';
    $dat=$_GET['q'];
    //var_dump($date);
    $date = date("Y-m-d", strtotime($dat));
   
?>
                                        <table class="table table-striped table-bordered table-hover" id="companies">
                                                            <thead>
                                                                <tr bgcolor="#BCDAEF">                  
                                                                    <th>Order Id</th>
                                                                    <th>Customer Id</th>
                                                                    <th>Customer Name</th>
                                                                    <th>Order Delivery Time</th>
                                                                    <th>Date & Time</th>
                                                                    <th>Status</th>
                                                                    <th class="cat_action_list">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
              	<?php	
    // $quotes_qry="SELECT * FROM total WHERE fdate='$date' ORDER BY odr_id DESC";
     // $result=mysqli_query($conn,$quotes_qry);
      $stmt=$conn->prepare("SELECT * FROM total WHERE fdate='$date' ORDER BY odr_id DESC");
   $stmt->execute();
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
  
     //while($row=mysqli_fetch_array($result))
     
     {		
$total=$row['total'];
$date_time=$row['date_time'];
$user_id=$row['user_id'];
$odr_id=$row['odr_id'];
                                                    
		?>
                                                                    <tr>
                                                                        <td><?php echo $odr_id;?></td>
                                                                        
                                                                        <td><?php echo $user_id;?></td>
                                                                        <td>
              <?php 
                                                                            $quo="SELECT * FROM user WHERE user_id='$user_id'";
                                                                            $res=mysqli_query($conn,$quo);
                                                                            $ro=mysqli_fetch_array($res);
                                                                            //var_dump($ro);
                                                                            echo $ro['user_name'];
             ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $row['orderday'].'<br>'.$row['orderdate'].'<br>'.$row['ordertimeslot'];?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $date_time;?>
                                                                        </td>
                                                                        <td>
                  <?php                                                     if($row['order_status']=="1")
                                                                            {
                      ?>
                                                                                <a href="dashboard.php?act=del&id=<?php echo $odr_id;?>" class="btn btn-primary">
                                                                                    Un-Delivered
                                                                                </a>
                  <?php 
                                                                            }
                                                                            else 
                                                                            {
                                                                                ?>
                                                                                <a href="dashboard.php?act1=del1&id=<?php echo $odr_id;?>" class="btn btn-primary">
                                                                                   Delivered
                                                                                </a>
                                                                                <?php
                                                                            }
                  ?>
                                                                        </td>
                                                                        <td>
                                                                            <a href="details.php?oid=<?php echo $odr_id;?>&uid=<?php echo $user_id;?>" class="btn btn-primary">View Details</a>
                                                                        <?php
                                                                            $or="SELECT * FROM orderasign WHERE userid='$user_id' and orderid='$odr_id'";
                                                                            $or1=mysqli_query($conn,$or);
                                                                            if(mysqli_num_rows($or1))
                                                                            {
                                                                                while($or2=mysqli_fetch_array($or1))
                                                                                {
                                                                                    $or12="SELECT * FROM user WHERE user_id='".$or2['deliveryboyid']."'";
                                                                                    $or112=mysqli_query($conn,$or12);
                                                                                    $or212=mysqli_fetch_array($or112);
                                                                  ?>
                                                                            <a href="view-delivery-boy-order.php?id=<?php echo $or212['user_id'];?>" class="btn btn-primary"><?php echo $or212['user_name']; ?></a>
                                                                  <?php
                                                                                }
                                                                            }
                                                                            else
                                                                            {
                                                                   ?>
                                                                                <a href="asignorder.php?oid=<?php echo $odr_id;?>&uid=<?php echo $user_id;?>" class="btn btn-primary">Asign Order</a>
                                                                   <?php
                                                                            }
                                                                   ?>
                                                                        </td>
                                                                    </tr>
                <?php
                                                                }
		?> 
                                                            </tbody>
                                                        </table>
       