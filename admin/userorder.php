<?php
    session_start();
    include ('include/database.php');
    $id=$_SESSION['id'];
    $uid=$_GET['id'];
    $oid=$_GET['oid'];
    $page='user';
    
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Celdoon Ltd</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	
	<?php include('include/sidebar.php');?>	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Orders Details</li>
			</ol>
		</div><!--/.row-->
                <br>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
                                          Orders Details
					<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
					<div class="article ">
                    <div class="col-xs-12">
                    <h3  align="center"><b><u>Customer Details</u></b></h3>
					<table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr bgcolor="#BCDAEF">
                   <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Address</th>
                    </tr>
                    </thead>
                    <tbody>
              	<?php	
                                                            
    //$quotes_qr="SELECT * FROM user where user_id='$uid'";
   // $resul=mysqli_query($conn,$quotes_qr);
   // $row1=mysqli_fetch_array($resul);
   
    $stmt=$conn->prepare("SELECT * FROM user where user_id='$uid'");
   $stmt->execute();
   //$stmt->fetchAll();
   $row1=$stmt->fetch(PDO::FETCH_ASSOC);
     
    
                                                                
		?>
        <tr>
        <td><?php echo $row1['user_id'];?></td>
     <td><?php echo $row1['user_name'];?></td>
     <td><?php echo $row1['email_id'];?></td>
    <td><?php echo $row1['mobile_number'];?></td>
  <td><?php echo 'House No. '.$row1['house_no'].' '.$row1['street'].'<br>'.$row1['locality'].'<br>'.$row1['city'].'('.$row1['pincode'].')';?></td>
    </tr>

                <?php
                                                            
		?> 
        </tbody>
        </table>
        </div>
		<div class="col-xs-12">
        <h3  align="center"><b><u>Order Details</u></b></h3>
		<table class="table table-striped table-bordered table-hover">
        <thead>
        <tr bgcolor="#BCDAEF">                  
        <th>Order Id</th>
        <th>Customer Id</th>
        <th>Customer Name</th>
        <th>Date & Time</th>
        <th>Status</th>
        <th class="cat_action_list">Action</th>
        </tr>
        </thead>
        <tbody>
              	<?php	
         //$quotes_qry="SELECT * FROM total WHERE user_id='$uid' ORDER BY odr_id DESC";
          //   $result=mysqli_query($conn,$quotes_qry);
          //while($row=mysqli_fetch_array($result))
          
          $stmt=$conn->prepare("SELECT * FROM total WHERE user_id='$uid' ORDER BY odr_id DESC");
         $stmt->execute();
          while($row=$stmt->fetch(PDO::FETCH_ASSOC))
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
        // $quo="SELECT * FROM user WHERE user_id='$user_id'";
            // $res=mysqli_query($conn,$quo);
            // $ro=mysqli_fetch_array($res);
            //var_dump($ro);
            
     $stmt=$conn->prepare("SELECT * FROM user WHERE user_id='$user_id'");
         $stmt->execute();
         //$sth->fetchAll();
            $ro=$stmt->fetch(PDO::FETCH_ASSOC);

        
           echo $ro['user_name'];
             ?>
             </td>
                                                                        
            <td>
            <?php echo $date_time;?>
             </td>
             <td>
             <?php 
             if($row['order_status']=="0")
             {
                      ?>
            <a href="#" class="btn btn-primary">Un-Delivered</a>

                  <?php 
                           }
                         else
                     {
                  ?>
                <a href="#" class="btn btn-primary">Delivered</a>
                  <?php 
                  }
                  ?>
                </td>
                 <td>
  <a href="userorderdetails.php?oid=<?php echo $odr_id;?>&uid=<?php echo $uid;?>" class="btn btn-primary">View Details</a>
         </td>
          </tr>
                <?php
           }
		?> 
      </tbody>
 </table>
 </div>
                                                    
</div><!--End .article-->
					</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	  

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
