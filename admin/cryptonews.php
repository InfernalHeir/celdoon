<?php
    session_start();
    include ('include/database.php');
    $page='news';
    $id=$_SESSION['id'];
    if (!isset($_SESSION['user']))
    {
	echo "<br><h2 align='center'><div>You are not Logged On Please Login to Access this Page</div></h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
    }
   
    
    if((isset($_GET['act2'])) and ($_GET['act2']=='del2'))
    {
        $id=$_GET['id'];

        $stmt=$conn->prepare("DELETE FROM  crypto_news WHERE news_id ='$id'");
   
	if($stmt->execute())
	{
            echo "<script>alert('News Delete Successfully');</script>";
            echo "<script>window.open('cryptonews.php','_self')</script>";
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
					<div class="panel-heading">Crypto News
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
					 <div class="article ">
                      <div class="col-xs-6"></div>
						
                <div class="col-xs-2">
                 <a type="submit" href="addcryptonews.php" style="margin-top: 10px;" class="btn btn-primary">Add News</a></h4>
                </div>
				<div class="col-xs-12">
                    <table class="table table-striped table-bordered table-hover" id="companies">
                        <thead>
                        <tr bgcolor="#BCDAEF">                  
                          <th>News Id</th>
                          <th>News Title</th>   
                           <th>News Image</th>
                           <th>News Details</th>
                            
                             <th class="cat_action_list">Action</th>
                         </tr>
                    </thead>
                <tbody>
              	<?php	
                
                
           $stmt=$conn->prepare("SELECT * FROM crypto_news ORDER BY news_id DESC");
           $stmt->execute();
           while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {	
                $news_id=$row['news_id'];
                ?>
         <tr>
          <td><?php echo $row['news_id'];?></td>
         <td><?php echo $row['news_title'];?></td>
         <td><img src="<?php echo $row['news_image'];?>" height="100px" width="100px"></td>
        <td><?php echo $row['news_details'];?></td>
     
        <td><a href="cryptonews.php?act2=del2&id=<?php echo $news_id;?>" class="btn btn-default" onclick="return confirm('Are you sure you want to delete this quotes?');">Delete</a></td>
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
