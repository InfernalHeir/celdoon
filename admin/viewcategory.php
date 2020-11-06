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
    if((isset($_GET['act'])) and ($_GET['act']=='del'))
    {
        $id=$_GET['id'];
       // $sql1="UPDATE category SET cat_status ='0' WHERE cat_id='$id'";
       
       $stmt=$conn->prepare("UPDATE category SET cat_status ='0' WHERE cat_id='$id'");
        
       
	if($stmt->execute())
	{
            echo "<script>alert('Category Disable Successfully');</script>";
            echo "<script>window.open('viewcategory.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Category Not Disable');</script>";
        }
    }
    if((isset($_GET['act1'])) and ($_GET['act1']=='del1'))
    {
        $id=$_GET['id'];
       // $sql1="UPDATE category SET cat_status ='1' WHERE cat_id='$id'";
       
     $stmt=$conn->prepare("UPDATE category SET cat_status ='1' WHERE cat_id='$id'");
        
	if($stmt->execute())
	{
            echo "<script>alert('Category Enable Successfully');</script>";
            echo "<script>window.open('viewcategory.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Category Not Enabled');</script>";
        }
    }
    if((isset($_GET['act2'])) and ($_GET['act2']=='del2'))
    {
        $id=$_GET['id'];
       // $sql1="DELETE FROM category WHERE cat_id ='$id'";
       $stmt=$conn->prepare("DELETE FROM category WHERE cat_id ='$id'");
        
	if($stmt->execute())
      
	{
            echo "<script>alert('Category Delete Successfully');</script>";
            echo "<script>window.open('viewcategory.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Category Not Delete');</script>";
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
			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
                                            Category
                                            
					<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></di>
					<div class="panel-body articles-container">
						<div class="article ">
							<div class="col-xs-12">
                    <h4  align="right"><a type="submit" href="addcategory.php" class="btn btn-primary ">Add Category</a></h4>
                     <h4  align="right"><a type="submit" href="addsubcategory.php" class="btn btn-primary ">Add Sub Category</a></h4>
                   
                    
							<table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr bgcolor="#BCDAEF">                  
                                <th>Category Name</th>
                                <th>Category Image</th>   
                                <th>Status</th>   
                                <th class="cat_action_list">Action</th>
                            </tr>
                            </thead>
                    <tbody>
              	<?php	
                 //$quotes_qry="SELECT * FROM category ORDER BY cat_id DESC";
               // $result=mysqli_query($conn,$quotes_qry);
              $stmt=$conn->prepare("SELECT * FROM category ORDER BY cat_id DESC");
             $stmt->execute();
               while($row=$stmt->fetch(PDO::FETCH_ASSOC))
           {		
                 $news_id=$row['cat_id'];
                                                  
		?>
            <tr>
            <td><?php echo $row['cat_name'];?></td>
        <td> <img src="upload/<?php echo $row['cat_image'];?>" height="100px" width="100px"><td>
         <?php 
        if($row['cat_status']!="0")
         {
         ?>
         <a href="viewcategory.php?act=del&id=<?php echo $news_id;?>" class="btn btn-primary">Enable</a>

    <?php 
      }
         else
         {
    ?>
         <a href="viewcategory.php?act1=del1&id=<?php echo $news_id;?>" class="btn btn-primary" >Disable</a>
     <?php 
                                                                            }
       ?>
     </td>
      <td>
    <a href="editcategory.php?id=<?php echo $news_id;?>" class="btn btn-primary">Edit</a>
      <a href="viewcategory.php?act2=del2&id=<?php echo $news_id;?>" class="btn btn-default" onclick="return confirm('Are you sure you want to delete this quotes?');">Delete</a>
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
	
</body>
</html>
