<?php
    session_start();
    include ('include/database.php');
    $id=$_SESSION['id'];
    $uid=$_GET['uid'];
    $oid=$_GET['oid'];
    $page='dashboard';
    
    if (!isset($_SESSION['user']))
    {
	echo "<br><h2 align='center'><div>You are not Logged On Please Login to Access this Page</div></h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
    }
    //$quot="SELECT * FROM total WHERE odr_id='$oid' and user_id='$uid'";
    //$resu=mysqli_query($conn,$quot);
    //$r= mysqli_fetch_array($resu);
    $quot=$conn->prepare("SELECT * FROM total WHERE odr_id='$oid' and user_id='$uid'");
    $quot->execute();
    $rr=$quot->fetchAll();
    
    
   
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
                                                                $quotes_qry=$conn->prepare("SELECT * FROM user where user_id='$uid'");
                                                                $quotes_qry->execute();
                                                                $result=$quotes_qry->fetchAll();
                                                                
		                                                            ?>
                                                                    <tr>
                                                                        <td><?php foreach($result as $row) {echo $row['user_id'];}?></td>
                                                                        <td><?php foreach($result as $row) { echo $row['user_name'];}?></td>
                                                                        <td><?php foreach($result as $row) { echo $row['email_id'];}?></td>
                                                                        <td><?php foreach($result as $row) { echo $row['mobile_number'];}?></td>
                                                                        <td><?php foreach($result as $row) { echo 'House No. '.$row['house_no'].' '.$row['street'].'<br>'.$row['locality'].'<br>'.$row['city'].'('.$row['pincode'].')';}?></td>
                                                                        
                                                                    </tr>
                                                                           
                                                            </tbody>
                                                        </table>
                                                        </div>
						                                	<div class="col-xs-12">
                                                            <h3  align="center"><b><u>Product Details</u></b></h3>
						                                   	<table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr bgcolor="#BCDAEF">
                                                                    <th>Product Id</th>
                                                                     <th>Product Name</th>
                                                                    <th>Product Image</th>
                                                                    <th>Product Price</th>
                                                                    <th>Product Quantity</th>
                                                                 
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                           	<?php
                                                           	  
                                                              $abc=$conn->prepare("SELECT * FROM add_product where `user_id`='$uid'");
                                                              $abc->execute();
                                                              $abcd=$abc->fetchAll();
                                                              
                                                              foreach($abcd as $ro)
                                                               {
                                                                $pro_id=$ro['pro_id'];
                                                                //echo "<script>alert('SELECT * FROM product where `pro_id`='$pro_id'')</script>";
                                                                $qtr=$conn->prepare("SELECT * FROM product where `pro_id`='$pro_id'");
                                                                $qtr->execute();
                                                                $stm=$qtr->fetchAll();
                                                                //print_r($stm);
                                                               foreach($stm as $str )
                                                                {
		                                                       ?>
                                                                    <tr>
                                                                        <td><?php echo $str['pro_id'];?></td>
                                                                        
                                                                        <td><?php echo $str['pro_name'];?></td>
                                                                        <td><img src="<?php echo $str['pro_image1'];?>" height="100px" width="100px"></td>
                                                                        <td>
                                                                          Price :<?php echo $str['pro_mrp'];?> Rs.
                                                                            <br>
                                                                            Discount :<?php echo $str['pro_dis'];?>%
                                                                            <br>
                                                                            Tax : <?php echo $str['tax'];?>%
                                                                            <br>
                                                                            Total Amount : <?php 
                                                                                                    if($str['tax']=='0')
                                                                                                    {
                                                                                                        echo $str['pro_dis_price'].' Rs.';
                                                                                                    }
                                                                                                    else 
                                                                                                    {
                                                                                                        echo number_format(($str['pro_dis_price']+($str['pro_dis_price']*$str['tax']/100)),2).' Rs.';
                                                                                                    }
                                                                                                    
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                        <?php
                                                                            echo $ro['pro_value'];
                                                                             ?>
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                  <?php
                                                                   }
                                                                   }
                                                                   
		                                                          ?> 
                                                                    <tr>
                                                                        <td colspan="3"><?php foreach($rr as $r) { echo 'Total Amount : '.$r['total'].' Rs.';}?></td>
                                                                        <td colspan="4"><?php foreach($rr as $r) { echo 'Delivery Time : '.$r['orderday'].' , '.$r['orderdate'].' , '.$r['ordertimeslot'];}?></td>
                                                                    </tr>
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
