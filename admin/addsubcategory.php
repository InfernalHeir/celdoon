<?php
    session_start();
    include ('include/database.php');
    $page='viewcategory';
    if (!isset($_SESSION['user']))
    {
	    echo "<br><h2 align='center'><div>You are not Logged On Please Login to Access this Page</div></h2>";
	    echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
    }
    if(isset($_POST['submit']))
    {
        $cat_id=$_POST['cat_id'];
        $subcatname =$_POST['subcatname']; 
    if($cat_id=='' && $subcatname=='')
    {
        echo "<script>alert('Enter Category Name And Select sub category.');</script>";
    }
    else 
    {
        $stmt=$conn->prepare("INSERT INTO sub_category (subcat_name,cat_id,subcat_status) VALUES ('$subcatname','$cat_id','1')");
       
       
	if($stmt->execute())
	{
        echo "<script>alert('Sub Category Inserted');</script>";
        echo "<script>window.open('addsubcategory.php','_self')</script>";
    }
    else
    {
        echo "<script>alert('Sub Category Not Inserted');</script>";
    }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
			<div class="col-md-6">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						Add Sub Category
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
					</div>
					    <div class="panel-body articles-container">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <label> Select Category :</label>
                                        <select name="cat_id" required="" class="form-control">
                                        <option value="">--Select Category--</option>
                                            <?php
                                                $stmt=$conn->prepare("SELECT * FROM category");
                                                $stmt->execute();
                                            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                                            {		
                                                $cat_id=$row['cat_id'];
                                                echo '<option value='.$cat_id.'>'.$row['cat_name'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label>Sub Category Name :</label>
                                        <input type="text" name="subcatname"  class="form-control input-lg">
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
	
</body>
</html>
