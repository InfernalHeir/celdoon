<?php
    session_start();
    include ('include/database.php');
    $page='delivery';
    $id=$_SESSION['id'];
    if (!isset($_SESSION['user']))
    {
	echo "<br><h2 align='center'><div>You are not Logged On Please Login to Access this Page</div></h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
    }
    if((isset($_GET['act'])) and ($_GET['act']=='del'))
    {
        $id=$_GET['id'];
        $sql1="UPDATE  product SET pro_status ='0' WHERE pro_id='$id'";
	if(mysqli_query($conn,$sql1))
	{
            echo "<script>alert('Product Desable Successfully');</script>";
            echo "<script>window.open('product.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Product Not Disable');</script>";
        }
    }
    if((isset($_GET['act1'])) and ($_GET['act1']=='del1'))
    {
        $id=$_GET['id'];
        $sql1="UPDATE  product SET pro_status ='1' WHERE pro_id='$id'";
	if(mysqli_query($conn,$sql1))
	{
            echo "<script>alert('Product Enable Successfully');</script>";
            echo "<script>window.open('product.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Product Not Enabled');</script>";
        }
    }
    if((isset($_GET['act2'])) and ($_GET['act2']=='del2'))
    {
        $id=$_GET['id'];
        $sql1="DELETE FROM  product WHERE pro_id ='$id'";
	if(mysqli_query($conn,$sql1))
	{
            echo "<script>alert('Product Delete Successfully');</script>";
            echo "<script>window.open('product.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Product Not Delete');</script>";
        }
    }
    //$insql = "SELECT * FROM `category`";
    //$inresult = mysqli_query($conn,$insql);
      $stmt=$conn->prepare("SELECT * FROM `category`");
   $stmt->execute();
 
    
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
                                            Delivery Boy
                                            
					<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
						<div class="article ">
                                                        <div class="col-xs-6"></div>
							<div class="col-xs-4">
                                                            <h4  align="right">
<!--                                                                <select name="category" id="category" class="form-control" onchange="showUser(this.value)">
                                                                    <option value="all">--Select Category--</option>
              <?php
                                                                        
                                                                        while($inrow = mysqli_fetch_array($inresult))
                                                                        {
                                                                            $id=$inrow['cat_id'];
                                                                            $name=$inrow['cat_name'];
                                                                            
                                                                            echo '<option value="'.$id.'">'.$name.'</option>';
                                                                        }
              ?>
                                                                </select>-->
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <a type="submit" href="add-deliveryboy.php" style="margin-top: 10px;" class="btn btn-primary">Add Delivery Boy</a></h4>
                                                        </div>
                                                        <div class="col-xs-12 col-lg-12">&nbsp;</div>
						<div class="col-xs-12">
                                                        <table class="table table-striped table-bordered table-hover" id="companies">
                                                            <thead>
                                                                <tr bgcolor="#BCDAEF">                  
                                                                    <th>Name</th>
                                                                    <th>Mobile Number</th>   
                                                                    <th>Email Id</th>
                                                                    <th>Address</th>
                                                                    <th class="cat_action_list">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
              	<?php	
      // $quotes_qry="SELECT * FROM user WHERE logintype='deliveryboy'";
      //  $result=mysqli_query($conn,$quotes_qry);
     // while($row=mysqli_fetch_array($result))
       $stmt=$conn->prepare("SELECT * FROM deliveryboy");
       $stmt->execute();
     while($row=$stmt->fetch(PDO::FETCH_ASSOC))

                                                                 {		
     $news_id=$row['user_id'];
                                                    
		?>
                                                                    <tr>
                                                                        <td><?php echo $row['name'];?></td>
                                                                        <td><?php echo $row['mobile'];?></td>
                                                                        <td><?php echo $row['email'];?></td>
                                                                        <td>
                                                                          <?php echo $row['houseno'].' '.$row['street'].','.$row['locality'].','.$row['city'].','.$row['pin'];?>
                                                                        </td>
                                                                        <td>
                                                                            <a href="view-delivery-boy-order.php?id=<?php echo $news_id;?>" class="btn btn-primary">View Order</a>
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
        xmlhttp.open("GET","categoryproduct.php?q="+str,true);
        xmlhttp.send();
    }
}			

 </script>
</body>
</html>
