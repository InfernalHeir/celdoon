<?php
    session_start();
    if($_SESSION['user']=='')
    {
        header('location:index.php');
        return $_SESSION['err']='You are not authorised user';
    }
    include ('include/database.php');
    $id=$_SESSION['id'];
    $page='dashboard';
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
    if((isset($_GET['act'])) and ($_GET['act']=='del'))
    {
        $id=$_GET['id'];
       $stmt=$conn->prepare("UPDATE  total SET order_status ='0' WHERE odr_id='$id'");
       $stmt->execute();
       
       $stmt=$conn->prepare("UPDATE  orderasign SET status ='0',dalivered_date_time='$date_time' WHERE orderid='$id'");
     if($stmt->execute())
	    {
        echo "<script>alert('Product Delivered....!');</script>";
        echo "<script>window.open('dashboard.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Product Not Disable');</script>";
        }
    }
    if((isset($_GET['act1'])) and ($_GET['act1']=='del1'))
    {
        $id=$_GET['id'];
    	$stmt=$conn->prepare("UPDATE  total SET order_status ='1' WHERE odr_id='$id'");
       $stmt->execute();
       
		$stmt=$conn->prepare("UPDATE  orderasign SET status ='1',dalivered_date_time='$date_time' WHERE orderid='$id'");
       if($stmt->execute())
        {
            echo "<script>alert('Product Un-Delivered.....!');</script>";
            echo "<script>window.open('dashboard.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Product Not Enabled');</script>";
        }
    }
    if((isset($_GET['act2'])) and ($_GET['act2']=='del2'))
    {
        $id=$_GET['id'];
        $stmt=$conn->prepare("DELETE FROM  product WHERE pro_id ='$id'");
       if($stmt->execute())
     	{
            echo "<script>alert('Product Delete Successfully');</script>";
            echo "<script>window.open('dashboard.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Product Not Delete');</script>";
        }
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
					<div class="panel-heading">
                                            Order
                                            
					<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
						<div class="article ">
                    <div class="col-xs-3">
                    <a href="#" class="btn btn-primary">Un-Delivered : </a>
                     </div>
                    <div class="col-xs-3">
                   <a href="#" class="btn btn-primary">Delivered : </a>                                                        
                     </div>
                  <div class="col-xs-3">
                <a href="#" class="btn btn-primary">All Order : </a>
                    </div>
					<div class="col-xs-3">
                    <input type="text"  class="form-control" id="from_date" value="<?php echo $from_date;?>" onchange="showUser(this.value)" /> 
                        </div>
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
                        <th class="cat_action_list">Action</th>
                                </tr>
                                </thead>
                    <tbody>
    <?php	
    //$quotes_qry="SELECT * FROM total WHERE fdate='$fdate' ORDER BY id DESC";
   // $result=mysqli_query($conn,$quotes_qry);
   $stmt=$conn->prepare("SELECT * FROM total  ");
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
            $stmt=$conn->prepare("SELECT * FROM user WHERE user_id='$user_id'");
            $stmt->execute();
            while($ro = $stmt->fetch(PDO::FETCH_ASSOC)){
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
                  <?php  if($row['order_status']=="1")
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
 
  $view=$conn->prepare("SELECT * FROM orderasign WHERE userid='$user_id' and orderid='$odr_id'");
  if($view->execute())
 {
  while($or2=$stmt->fetch(PDO::FETCH_ASSOC))

{

    $views=$conn->prepare("SELECT * FROM user WHERE user_id='".$or2['deliveryboyid']."'");
    $views->execute();
    $fetchAl=$stmt->fetchAll();
    
          ?>
    <a href="view-delivery-boy-order.php?id=<?php foreach( $fetchAl as $or212){ echo $or212['user_id'];}?>" class="btn btn-primary"><?php foreach( $fetchAl as $or212){ echo $or212['user_name']; }?></a>
 <?php
}   }
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
function showUser(str) {
    if (str == "") {
        document.getElementById("companies").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("companies.php");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("companies").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","dateproduct.php?q="+str,true);
        xmlhttp.send();
    }
}			

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