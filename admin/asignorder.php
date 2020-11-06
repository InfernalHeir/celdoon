<?php
    session_start();
    include ('include/database.php');
    $page='delivery';
    $id=$_SESSION['id'];
    if (!isset($_SESSION['alogin']))
    {
	echo "<br><h2 align='center'><div>You are not Logged On Please Login to Access this Page</div></h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
    }
    if(isset($_POST['submit']))
    {
    
        $order = $_POST['order'];
        $orderid = $_POST['orderid'];
        $userid = $_POST['userid'];
        $quo="SELECT * FROM orderasign WHERE userid='".$userid."' and orderid='".$orderid."'";
        if(mysqli_num_rows(mysqli_query($conn,$quo)))
        {
            echo "<script>alert('This Order Already Asign.....!');</script>";
            echo "<script>window.open('dashboard.php','_self')</script>";
        }
        else 
        {
            $sql1="INSERT INTO orderasign (deliveryboyid,orderid,userid) VALUES ('$order','$orderid','$userid')";
            if(mysqli_query($conn,$sql1))
            {
                echo "<script>alert('Order Asign Successfully.....!');</script>";
                echo "<script>window.open('dashboard.php','_self')</script>";
            }
            else
            {
                echo "<script>alert('Order Not Asign');</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>E-Commerce</title>
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
	<?php include('include/header.php');?>
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
                                           Select Delivery Boy
                                            
					<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
						<div class="article ">
                                                     <form action="" method="POST" enctype="multipart/form-data" name="form1" onSubmit="return check();">   
                                                        <div class="col-xs-12 col-lg-12">&nbsp;</div>
						<div class="col-xs-12">
                                                        <table class="table table-striped table-bordered table-hover" id="companies">
                                                            <thead>
                                                                <tr bgcolor="#BCDAEF">                  
                                                                    <th></th>
                                                                    <th>Name</th>
                                                                    <th>Mobile Number</th>   
                                                                    <th>Email Id</th>
                                                                    <th>Address</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
              	<?php	
                                                                 $quotes_qry="SELECT * FROM user WHERE logintype='deliveryboy'";
                                                                 $result=mysqli_query($conn,$quotes_qry);
                                                                 while($row=mysqli_fetch_array($result))
                                                                 {		
                                                                    $news_id=$row['user_id'];
                                                    
		?>
                                                                    <tr>
                                                                        <td> 
                                                                            <input type="radio" name="order" value="<?php echo $news_id;?>" />
                                                                            <input type="hidden" name="orderid" value="<?php echo $_GET['oid'];?>" />
                                                                            <input type="hidden" name="userid" value="<?php echo $_GET['uid'];?>" />
                                                                        </td>
                                                                        <td><?php echo $row['user_name'];?></td>
                                                                        <td><?php echo $row['mobile_number'];?></td>
                                                                        <td><?php echo $row['email_id'];?></td>
                                                                        <td>
                                                                          <?php echo $row['house_no'].' '.$row['street'].','.$row['locality'].','.$row['city'].','.$row['pincode'];?>
                                                                        </td>
                                                                    </tr>
                <?php
                                                                }
		?> 
                                                            </tbody>
                                                        </table>
                                                        </div>
                                                        <div class="col-xs-12 col-lg-12">
                                                            <input type="submit" name="submit" value="Submit"class="btn btn-primary">
                                                        </div>
                                                     </form>
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
	<script>
        window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};

 </script>
 <SCRIPT LANGUAGE="JavaScript">
function check() {

a1=document.form1.order.value;
if (a1.length<1) {
alert("Please Select Delivery Boy....!");
document.form1.order.focus();
return false;
}
return true;
}
</SCRIPT>

</body>
</html>
