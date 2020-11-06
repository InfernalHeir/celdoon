<?php
    session_start();
    include ('include/database.php');
    $page='user';
    if (!isset($_SESSION['user']))
    {
	echo "<br><h2 align='center'><div>You are not Logged On Please Login to Access this Page</div></h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
    }

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
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
                <br>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
                                            Category
                                            
					<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
						<div class="article ">
							<div class="col-xs-12">
                                                       <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr bgcolor="#BCDAEF">                  
                                                                    <th>Id</th>
                                                                    <th>Name</th>
                                                                    <th>Mobile</th>   
                                                                    <th>Email</th>
                                                                    <th>Address </th>
                                                                    <th class="cat_action_list">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
              	<?php	
    // $quotes_qry="SELECT * FROM user ORDER BY user_id DESC";
    // $result=mysqli_query($conn,$quotes_qry);
   //  while($row=mysqli_fetch_array($result))
   
   $stmt=$conn->prepare("SELECT * FROM user ORDER BY user_id DESC");
   $stmt->execute();
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {		
$news_id=$row['user_id'];
                                                    
		?>
 <tr>
<td><?php echo $row['user_id'];?></td>
<td><?php echo $row['user_name'];?></td>
<td><?php echo $row['mobile_number'];?></td>
  <td><?php echo $row['email_id'];?></td>
  <td><?php echo 'House No. '.$row['house_no'].' '.$row['street'].'<br>'.$row['locality'].'<br>'.$row['city'].'('.$row['pincode'].')';?></td>
                  
 <td>
  <a href="userorder.php?id=<?php echo $news_id;?>" class="btn btn-primary">View Order</a>
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
