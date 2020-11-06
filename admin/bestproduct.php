<?php
    session_start();
    include ('include/database.php');
    $page='bestproduct';
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
       // $sql1="UPDATE  product SET pro_status ='0' WHERE pro_id='$id'";
        $stmt=$conn->prepare("UPDATE  bestdeal SET pro_status ='0' WHERE bestdeal_id='$id'");
   
	if($stmt->execute())
	{
            echo "<script>alert('Product Desable Successfully');</script>";
            echo "<script>window.open('bestproduct.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Product Not Disable');</script>";
        }
    }
    if((isset($_GET['act1'])) and ($_GET['act1']=='del1'))
    {
        $id=$_GET['id'];
        //$sql1="UPDATE  product SET pro_status ='1' WHERE pro_id='$id'";
         $stmt=$conn->prepare("UPDATE  bestdeal SET pro_status ='1' WHERE bestdeal_id='$id'");
   
	if($stmt->execute())
	{
            echo "<script>alert('Product Enable Successfully');</script>";
            echo "<script>window.open('bestproduct.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Product Not Enabled');</script>";
        }
    }
    if((isset($_GET['act2'])) and ($_GET['act2']=='del2'))
    {
        $id=$_GET['id'];
       // $sql1="DELETE FROM  product WHERE pro_id ='$id'";
        $stmt=$conn->prepare("DELETE FROM  bestdeal WHERE bestdeal_id ='$id'");
   
	if($stmt->execute())
	{
            echo "<script>alert('Product Delete Successfully');</script>";
            echo "<script>window.open('bestproduct.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Product Not Delete');</script>";
        }
    }
   // $insql = "SELECT * FROM `category`";
   // $inresult = mysqli_query($conn,$insql);
   
   // $stmt=$conn->prepare("SELECT * FROM `category`");
  // $stmt->execute();
    
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Celdoon ltd</title>
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
					<div class="panel-heading"> BestProducts
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
					 <div class="article ">
                      <div class="col-xs-6"></div>
						
                <div class="col-xs-2">
                 <a type="submit" href="add_best_product.php" style="margin-top: 10px;" class="btn btn-primary">Add Best Product</a></h4>
                </div>
				<div class="col-xs-12 ">
                    <table class="table table-responsive table-bordered table-hover" id="companies">
                        <thead>
                        <tr bgcolor="#BCDAEF">                  
                          <th> Best Product Id</th>
                          <th>First Product Name</th>   
                           <th>First Product Image</th>
                           <th>First Product Price</th>
                           <th>Second Product Name</th>   
                           <th>Second Product Image</th>
                           <th>Second Product Price</th>
                            <th>Status</th>
                             <th class="cat_action_list">Action</th>
                         </tr>
                    </thead>
                <tbody>
              	<?php	
                //$quotes_qry="SELECT * FROM product ORDER BY pro_id DESC";
                 //$result=mysqli_query($conn,$quotes_qry);
                // while($row=mysqli_fetch_array($result))
                
            $stmt=$conn->prepare("SELECT * FROM bestdeal ORDER BY bestdeal_id DESC");
           $stmt->execute();
           while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {	
                $news_id=$row['bestdeal_id'];
                ?>
         <tr>
           <td><?php echo $row['bestdeal_id'];?></td>
           <td><?php echo $row['1st_pro_name'];?></td>
           <td><img src="<?php echo $row['1st_pro_img1'];?>" height="100px" width="100px"></td>
           <td>
               Price :<?php echo $row['1st_pro_price'];?> Rs.
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
       <td><?php echo $row['2nd_pro_name'];?></td>
        <td><img src="<?php echo $row['2nd_pro_img1'];?>" height="100px" width="100px"></td>
        <td>
         Price :<?php echo $row['2nd_pro_price	'];?> Rs.
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
        <?php   if($row['pro_status']!="0")
         {
         ?>
      <a href="bestproduct.php?act=del&id=<?php echo $news_id;?>" class="btn btn-primary">Enable</a>
      <?php 
       }
       else
       {
      ?>
      <a href="bestproduct.php?act1=del1&id=<?php echo $news_id;?>" class="btn btn-primary">Disable</a>
      <?php 
       }
       ?>
     </td>
      <td>
     <a href="editbestproduct.php?id=<?php echo $news_id;?>" class="btn btn-primary">Edit</a>
     <a href="bestproduct.php?act2=del2&id=<?php echo $news_id;?>" class="btn btn-default" onclick="return confirm('Are you sure you want to delete this quotes?');">Delete</a>
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
