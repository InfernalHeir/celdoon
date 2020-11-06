<?php
    session_start();
    include ('include/database.php');
    $id=$_SESSION['id'];
    $page='delivery';
    date_default_timezone_set("Asia/Calcutta");
    $fdate=date("Y-m-d");
    $ftime=date("H:i:s");
    $date_time=date("Y-m-d H:i:s");
    $from_date = date("m/d/Y", strtotime($fdate));
    //var_dump($from_date);
    
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
					<div class="panel-heading">Order's
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
						<div class="article ">
                        <div class="col-xs-12">&nbsp;</div>
						<div class="col-xs-12">
                            <table class="table table-striped table-bordered table-hover" id="companies">
                                <thead>
                                    <tr bgcolor="#BCDAEF">                  
                                     <th>Order Id</th>
                                     <th>Customer Id</th>
                                     <th>Customer Name</th>
                                     <th>Order Delivery Time</th>
                                     <th>Date & Time</th>
                                     <th>Status</th>
                                  </tr>
                                </thead>
                            <tbody>
              	             <?php                                      
                              $ord=$conn->prepare("SELECT * FROM orderasign");
                              $ord->execute();
                              while($order=$ord->fetch(PDO::FETCH_ASSOC))
                               {     
                                $quotes_qry=$conn->prepare("SELECT * FROM total WHERE odr_id='".$order['orderid']."'");
                                $quotes_qry->execute();
                                while($row=$quotes_qry->fetch(PDO::FETCH_ASSOC))
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
                                $quo=$conn->prepare("SELECT * FROM user WHERE user_id='$user_id'");
                                $quo->execute();
                                $res=$quo->fetchAll();
                                foreach($res as $ro)
                                {
                                echo $ro['user_name'];
                                }
                                ?>
                               </td>
                                <td>
                                 <?php echo $row['orderday'].'<br>'.$row['orderdate'].'<br>'.$row['ordertimeslot'];?>
                                </td>
                                <td>
                                <?php echo $date_time;?>
                                </td>
                                <td>
                                <?php                                                     
                                if($row['order_status']=="1")
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
                            </tr>
                                <?php
                                }
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
</body>
</html>
<script> 
 
      $(document).ready(function(){  
            $(function(){  
     			$("#from_date").datepicker({ endDate: "today"});
	 });  
      });  
 </script>