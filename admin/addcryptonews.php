<?php
    session_start();
    include ('include/database.php');
    $page='product';
    if (!isset($_SESSION['user']))
    {
	echo "<br><h2 align='center'><div>You are not Logged On Please Login to Access this Page</div></h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
    }
if(isset($_POST['submit']))
{
    
    $news_title	 = $_POST['news_title'];
    $news_details = $_POST['news_details'];
    $news_image = $_FILES['news_image'];
    
    
    
    $size1=$news_image['size'];
    
    if($size1>1000000)
    {
        echo "<script>alert('Size is Too Long...')</script>";
    }
    	
    else
    {
    $file_tmp1 =$news_image['tmp_name'];
    
    
    $target1 = "upload/".$news_image['name'];
   
    
    
    move_uploaded_file($file_tmp1, $target1);   //Tells you if its all ok	
    $stmt=$conn->prepare("INSERT INTO `crypto_news`( `news_title`, `news_details`, `news_image`) VALUES ('$news_title','$news_details','$target1')");
    if($stmt->execute())
	{
            echo "<script>alert('News Inserted Successfully.....!');</script>";
            echo "<script>window.open('cryptonews.php','_self')</script>";
        }
        else
        {
            echo "<script>alert(' Not Inserted');</script>";
        }
    
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
						Add News
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
     <form action="" method="POST" enctype="multipart/form-data" name="form1" onSubmit="return check();">
    
 </div>
 <div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
                 &nbsp;
</div>
 </div>
<div class="row">
 <div class="col-xs-6 col-sm-6 col-md-3">
            <label>News Title :</label>
<input type="text" name="news_title"  class="form-control input-lg">
                                                    </div>
                                                    
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <label>News Details  :</label>
                                                        <input type="textarea" name="news_details"  class="form-control input-lg">
                                                    </div>
                                                    
                                               
                                                   
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6 col-md-3">
                                                        <label>Image 1 :</label>
                                                        <input type="file" name="news_image" >
                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <input type="submit" name="submit" value="Submit"class="btn btn-primary btn-block btn-lg">
                                                    </div>

                                                </div>
                                            </form>
					</div>
				</div><!--End .articles-->
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
<SCRIPT LANGUAGE="JavaScript">
function check() {

a1=document.form1.cat_id.value;
if (a1.length<1) {
alert("Please Select Category....!");
document.form1.cat_id.focus();
return false;
}
a=document.form1.pro_name.value;
if (a.length<1) {
alert("Please Enter Product....!");
document.form1.pro_name.focus();
return false;
}
b=document.form1.pro_mrp.value;
if (b.length<1) {
alert("Please Enter Product Price....!");
document.form1.pro_mrp.focus();
return false;
}
c=document.form1.pro_dis.value;
if (c.length<1) {
alert("Please Enter Product Discount....!");
document.form1.pro_dis.focus();
return false;
}
mt=document.form1.pro_unit.value;
if (mt.length<1) {
alert("Please Enter Product Unit....!");
document.form1.pro_unit.focus();
return false;
}
mt1=document.form1.type.value;
if (mt1.length<1) {
alert("Please Select Unit Type....!");
document.form1.type.focus();
return false;
}
mt2=document.form1.tot_unit.value;
if (mt2.length<1) {
alert("Please Enter Product Total Unit....!");
document.form1.tot_unit.focus();
return false;
}
mt3=document.form1.pro_detail.value;
if (mt3.length<1) {
alert("Please Enter Product Details....!");
document.form1.pro_detail.focus();
return false;
}
mt4=document.form1.tax.value;
if (mt4.length<1) {
alert("Please Select Tax....!");
document.form1.tax.focus();
return false;
}
mt5=document.form1.file.value;
if (mt5.length<1) {
alert("Please Select Photo 1....!");
document.form1.file.focus();
return false;
}
return true;
}

var x = document.getElementById("myNumber");
x.setAttribute("type", "number");
</SCRIPT>

</body>
</html>
