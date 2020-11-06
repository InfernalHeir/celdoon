<?php
    session_start();
    include ('include/database.php');
    $id=$_GET['q'];
?>
<table class="table table-striped table-bordered table-hover" id="companies">
<thead>
      <tr bgcolor="#BCDAEF">                  
      <th>Product Id</th>
     <th>Product Name</th>   
        <th>Product Image</th>
        <th>Product Price</th>
        <th>Status</th>
      <th class="cat_action_list">Action</th>
      </tr>
    </thead>
        <tbody>
              	<?php                                           
                $quotes_qry='';
                 if($id=='all')
             {
              $quotes_qry="SELECT * FROM product ORDER BY pro_id DESC";
            }
            else 
            {
         $quotes_qry="SELECT * FROM product WHERE cat_id='$id' ORDER BY pro_id DESC";
      }
         $result=mysqli_query($conn,$quotes_qry);
        while($row=mysqli_fetch_array($result))
     {		
     $news_id=$row['pro_id'];
                                                    
		?>
             <tr>
            <td><?php echo $row['pro_id'];?></td>
         <td><?php echo $row['pro_name'];?></td>
          <td><img src="upload/<?php echo $row['pro_image1'];?>" height="100px" width="100px"></td>
               <td>
            Price :<?php echo $row['pro_mrp'];?> Rs.
                <br>
            Discount :<?php echo $row['pro_dis'];?>%
                      <br>
             Tax : <?php echo $row['tax'];?>%
                 <br>
                  Total Amount : <?php 
               if($row['tax']=='0')
              {
              echo $row['pro_dis_price'].' Rs.';
                                                                                                    }
                                                                                                    else 
                                                                                                    {
                                                                                                        echo number_format(($row['pro_dis_price']+($row['pro_dis_price']*$row['tax']/100)),2).' Rs.';
                                                                                                    }
                                                                                                    
                                                                            ?>
                                                                        </td>
                                                                        <td>
                  <?php                                                     if($row['pro_status']!="0")
                                                                            {
                      ?>
                                                                            <a href="product.php?act=del&id=<?php echo $news_id;?>" title="Change Status">
                                                                                    <span class="badge badge-success badge-icon">
                                                                                        <i class="fa fa-check" aria-hidden="true"></i><span>Enable</span>
                                                                                    </span>
                                                                                </a>

                  <?php 
                                                                            }
                                                                            else
                                                                            {
                  ?>
                                                                            <a href="product.php?act1=del1&id=<?php echo $news_id;?>" title="Change Status">
                                                                                    <span class="badge badge-danger badge-icon">
                                                                                        <i class="fa fa-check" aria-hidden="true"></i><span>Disable </span>
                                                                                    </span>
                                                                                </a>
                  <?php 
                                                                            }
                  ?>
                                                                        </td>
                                                                        <td>
                                                                            <a href="editproduct.php?id=<?php echo $news_id;?>" class="btn btn-primary">Edit</a>
                                                                            <a href="product.php?act2=del2&id=<?php echo $news_id;?>" class="btn btn-default" onclick="return confirm('Are you sure you want to delete this quotes?');">Delete</a>
                                                                        </td>
                                                                    </tr>
                <?php
                                                                }
		?> 
                                                            </tbody>
                                                        </table>
          
