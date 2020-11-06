<?php
session_start();
include ('include/database.php');
$id=$_GET['id'];
if(isset($_POST['submit']))
{
    $heading=$_POST['heading'];
    $description=$_POST['description'];
    if($heading=='' && $description=='')
    {
        echo "<script>alert('Evry Field is Required');</script>";
    }
    else 
    {
        $sql1="UPDATE tbl_news SET news_heading ='$heading', news_description = '$description' WHERE nid='$id'";
	if(mysqli_query($conn,$sql1))
	{
            echo "<script>alert('Data Updated Successfully');</script>";
            echo "<script>window.open('dashboard.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Data Not Inserted');</script>";
        }
    }
}
$quotes_qry="SELECT * FROM tbl_news WHERE nid='$id'";
$result=mysqli_query($conn,$quotes_qry);
$row=mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GK Questions</title>
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
						Add GK Questions
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
                                            <form action="" method="POST" >
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <label> Heading Title :</label>
                                                        <input type="text" name="heading"  class="form-control input-lg" value="<?php echo $row['news_heading'];?>">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <label>Description :</label><?php echo isset($error['news_description']) ? $error['news_description'] : '';?>
                                                        <textarea name="description" id="news_description" class="form-control" rows="16"><?php echo $row['news_description'];?></textarea>
                                                        <script type="text/javascript" src="css/js/ckeditor/ckeditor.js"></script>
                                                        <script type="text/javascript">                        
                                                            CKEDITOR.replace( 'news_description' );
                                                        </script>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                                        <input type="submit" name="submit" value="Submit"class="btn btn-primary btn-block btn-lg">
                                                    </div>
<!--                                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                                        <input type="submit" name="reset" value="Reset"class="btn btn-primary btn-block btn-lg">
                                                    </div>-->
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
	
</body>
</html>
