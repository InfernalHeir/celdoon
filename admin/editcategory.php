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
    
    //$quotes_qry="SELECT * FROM category WHERE cat_id = '".$_GE['id']."'T";
   // $result=mysqli_query($conn,$quotes_qry);
  //$row=mysqli_fetch_array($result);
$stmt=$conn->prepare("SELECT * FROM category WHERE cat_id = '".$_GE['id']."'T");
 // $stmt->execute();   
if(isset($_POST['submit']))
{
    $catname=$_POST['catname'];
    $pro_image1 = $_FILES['pro_image1']['name'];
    if($pro_image1=='')
    {
        $sql1="UPDATE category SET cat_name='$catname',cat_image='".$row['cat_image']."' WHERE cat_id='".$_GET['id']."'";
	if(mysqli_query($conn,$sql1))
	{
            echo "<script>alert('Category Edit Successfully');</script>";
            echo "<script>window.open('viewcategory.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Category Not Inserted');</script>";
        }
    }
    else 
    {
        $Filename1=date('dmyhis').basename($pro_image1);	
	//$file_size =$_FILES['photo']['size'];
	$file_tmp1 =$_FILES['pro_image1']['tmp_name'];
	$file_type1=$_FILES['pro_image1']['type'];
	//$posted_data['photo']=$Filename;
	$target1 = "upload/".$Filename1;
	move_uploaded_file($_FILES['pro_image1']['tmp_name'], $target1);   //Tells you if its all ok	
        
        //$sql1="UPDATE category SET cat_name='$catname',cat_image='$Filename1' WHERE cat_id='".$_GET['id']."'";
         $stmt=$conn->prepare("UPDATE category SET cat_name='$catname',cat_image='$Filename1' WHERE cat_id='".$_GET['id']."'");
   
	if($stmt->execute())
	{
            echo "<script>alert('Category Edit Successfully');</script>";
            echo "<script>window.open('viewcategory.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Category Not Inserted');</script>";
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
			<div class="col-md-6">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						Add Category
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
                                            <form action="editcategory.php?id=<?php echo $_GET['id'];?>" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <label> Category Name :</label>
                                                        <input type="text" name="catname" value="<?php echo $row['cat_name'];?>"  class="form-control input-lg">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                                        <label>Category Image :</label>
                                                        <input type="file" name="pro_image1" >
                                                    </div>
                                                    <div class="col-xs-6 col-md-6 col-sm-6">
                                                        <img src="upload/<?php echo $row['cat_image'];?>" height="100px" width="100px">
                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
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
