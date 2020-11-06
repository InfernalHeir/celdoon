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

    $id=$_GET['id'];
     
    $stmt=$conn->prepare("SELECT * FROM bestdeal WHERE bestdeal_id = '$id'");
    $stmt->execute();
    $fetchAl=$stmt->fetchAll();
   
   
   if(isset($_POST['submit']))
{
    $_1st_pro_name = $_POST['1st_pro_name'];  
    $_2nd_pro_name = $_POST['2nd_pro_name'];   
    $_1st_pro_price = $_POST['1st_pro_price'];
    $_2nd_pro_price = $_POST['2nd_pro_price'];

    $pro_dis = $_POST['pro_dis'];
    $shipping_charge = $_POST['shipping_charge'];
    $_1st_pro_brand = $_POST['1st_pro_brand'];
    $_1st_pro_model = $_POST['1st_pro_model'];
    $_2nd_pro_brand = $_POST['2nd_pro_brand'];
    $_2nd_pro_model = $_POST['2nd_pro_model'];
    $total_unit = $_POST['total_unit'];
    $_1st_pro_desc = $_POST['1st_pro_desc'];  
    $pro_life = $_POST['pro_life'];
    $_2nd_pro_desc = $_POST['2nd_pro_desc'];
    $tax = $_POST['tax'];
    //$pro_type = $_POST['pro_type'];
    //$pro_manufacture = $_POST['pro_manufacture'];
    $pro_disclaimer = $_POST['pro_disclaimer'];
    //$pro_other_name = $_POST['pro_other_name'];
    $_1st_pro_img1 = $_FILES['1st_pro_img1'];
    $_1st_pro_img2 = $_FILES['1st_pro_img2'];
    $_1st_pro_img3 = $_FILES['1st_pro_img3'];
    $_2nd_pro_img1 = $_FILES['2nd_pro_img1'];
    $_2nd_pro_img2 = $_FILES['2nd_pro_img2'];
    $_2nd_pro_img3 = $_FILES['2nd_pro_img3'];
   // $pro_image4 = $_FILES['pro_image4'];
    
    
    
    $size1=$_1st_pro_img1['size'];
    $size2=$_1st_pro_img2['size'];
    $size3=$_1st_pro_img3['size'];
    
    $size4=$_2nd_pro_img1['size'];
    $size5=$_2nd_pro_img2['size'];
    $size6=$_2nd_pro_img3['size'];
    
    
    if($size1>1000000 || $size2>1000000 || $size3>1000000 || $size4>1000000 || $size5>1000000 || $size6>1000000)
    {
        echo "<script>alert('Size is Too Long...')</script>";
    }
    	
    else
    {
    $file_tmp1 =$_1st_pro_img1['tmp_name'];
    $file_tmp2 =$_1st_pro_img2['tmp_name'];
    $file_tmp3 =$_1st_pro_img3['tmp_name'];
    
    $file_tmp4 =$_2nd_pro_img1['tmp_name'];
    $file_tmp5 =$_2nd_pro_img2['tmp_name'];
    $file_tmp6 =$_2nd_pro_img3['tmp_name'];
    
    
    
    
    $target1 = "upload1/".$_1st_pro_img1['name'];
    $target2 = "upload1/".$_1st_pro_img2['name'];
    $target3 = "upload1/".$_1st_pro_img3['name'];
    
    
    $target4 = "upload1/".$_2nd_pro_img1['name'];
    $target5 = "upload1/".$_2nd_pro_img2['name'];
    $target6 = "upload1/".$_2nd_pro_img3['name'];
    
    
    
    move_uploaded_file($file_tmp1, $target1);   //Tells you if its all ok	
    move_uploaded_file($file_tmp2, $target2);
    move_uploaded_file($file_tmp3, $target3);
    move_uploaded_file($file_tmp4, $target4);   //Tells you if its all ok	
    move_uploaded_file($file_tmp5, $target5);
    move_uploaded_file($file_tmp6, $target6);

    
    
    
    $pro_dis_price= $_1st_pro_price-($pro_dis*$_1st_pro_price/100);
        
    
  
	
	//$stmt=$conn->prepare("UPDATE product SET cat_id='$cat_id',subcat_name='$subcat_name',pro_name='$pro_name',pro_mrp='$pro_mrp',pro_dis='$pro_dis',pro_dis_price='$pro_dis_price',shipping_charge='$shipping_charge',pro_unit='$pro_unit',pro_detail='$pro_detail',pro_other_name='$pro_other_name',pro_life='$pro_life',pro_manufacture='$pro_manufacture',pro_disclaimer='$pro_disclaimer',pro_image1='$pro_image11',pro_image2='$pro_image21',pro_image3='$pro_image31',pro_image4='$pro_image41',tax='$tax',type='$type',tot_unit='$tot_unit' WHERE pro_id='".$_GET['id']."'");
   $stmt=$conn->prepare("UPDATE `bestdeal`SET 1st_pro_name ='$_1st_pro_name',2nd_pro_name ='$_2nd_pro_name',1st_pro_price ='$_1st_pro_price',2nd_pro_price ='$_2nd_pro_price',1st_pro_img1='$target1',1st_pro_img2='$target2',1st_pro_img3='$target3',2nd_pro_img1='$target4',2nd_pro_img2='$target5',2nd_pro_img3='$target6',pro_status=1,pro_dis='$pro_dis',pro_dis_price='$pro_dis_price',shipping_charge='$shipping_charge',pro_unit=5,1st_pro_desc='$_1st_pro_desc',2nd_pro_desc='$_2nd_pro_desc',tax='$tax',pro_life='$pro_life',total_unit='$_total_unit',1st_pro_brand='$_1st_pro_brand',2nd_pro_brand='$_2nd_pro_brand',1st_pro_model='$_1st_pro_model',2nd_pro_model='$_2nd_pro_model',pro_disclaimer='$pro_disclaimer' WHERE bestdeal_id='$id'");
   if($stmt->execute())

	{
            echo "<script>alert('Product Edit Successfully.....!');</script>";
            echo "<script>window.open('bestproduct.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Category Not Inserted');</script>";
        }
    
}}
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
						Update First Best Product
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
                    <form action="" method="POST" enctype="multipart/form-data" name="form1" onSubmit="return check();">
                      <div class="row">
                       <div class="col-xs-12 col-sm-12 col-md-12">
                         &nbsp;
                      </div>
                      </div>
                     <div class="row">
                       <div class="col-xs-6 col-sm-6 col-md-3">
                           <label>  Name :</label>
                                  <input type="text" name="1st_pro_name" value="<?php foreach( $fetchAl as $fet){ echo $fet['1st_pro_name']; } ?>"  class="form-control input-lg">
                        </div>
                                 <div class="col-xs-2 col-sm-2 col-md-3">
                                    <label>Price :</label>
                                        <input type="text" id="myNumber" name="1st_pro_price" value="<?php foreach( $fetchAl as $fet){ echo $fet['1st_pro_price']; } ?>" class="form-control input-lg">
                                         </div>
                                         <div class="col-xs-2 col-sm-2 col-md-3">
                                         <label>Discount % :</label>
                                         <input type="text" name="pro_dis" value="<?php foreach( $fetchAl as $fet){ echo $fet['pro_dis']; } ?>" class="form-control input-lg">
                                          </div>
                                        <div class="col-xs-2 col-sm-2 col-md-3">
                                        <label>Total Unit :</label>
                                        <input type="text" name="total_unit" value="<?php foreach( $fetchAl as $fet){ echo $fet['total_unit']; } ?>" class="form-control input-lg">
                                        </div>
                                    </div>
                                    <div class="row">
                                     <div class="col-xs-10 col-sm-10 col-md-10">
                                        <label>Detail / Featurs :</label>
                                            <input type="text" name="1st_pro_desc" value="<?php foreach( $fetchAl as $fet){ echo $fet['1st_pro_desc']; } ?>" class="form-control input-lg">
                                         </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                        <label>Select Tax :</label>
                                         <select name="tax" value="<?php foreach( $fetchAl as $fet){ echo $fet['tax']; } ?>" class="form-control" required>
                                            <option value="">--Select Tex--</option>
                                            <option value="0">0%</option>
                                            <option value="6">6%</option>
                                            <option value="21">21%</option>
                                         </select>
                                    </div>
                                </div>
                                <div class="row">
                                
                                
                                <div class="col-xs-6 col-sm-6 col-md-4">
                                  <label>Product Life :</label>
                                  <input type="text" name="pro_life" value="<?php foreach( $fetchAl as $fet){ echo $fet['pro_life']; } ?>" class="form-control input-lg">
                                </div>
                            
                                <div class="col-xs-6 col-sm-6 col-md-4">
                                <label>Shipping Charge :</label>
                                <input type="text" name="shipping_charge" value="<?php foreach( $fetchAl as $fet){ echo $fet['shipping_charge']; } ?>" class="form-control input-lg">
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-4">
                                <label>Disclaimer :</label>
                                <input type="text" name="pro_disclaimer" value="<?php foreach( $fetchAl as $fet){ echo $fet['pro_disclaimer']; } ?>" class="form-control input-lg">
                                </div>
                                </div>
                                
                                <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                  <label>Product Brand :</label>
                                  <input type="text" name="1st_pro_brand" value="<?php foreach( $fetchAl as $fet){ echo $fet['1st_pro_brand']; } ?>"  class="form-control input-lg">
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                <label>Product Model :</label>
                                <input type="text" name="1st_pro_model" value="<?php foreach( $fetchAl as $fet){ echo $fet['1st_pro_model']; } ?>" class="form-control input-lg">
                                </div>
                                </div>
                                                
                                <div class="row">
                                 <div class="col-xs-6 col-sm-6 col-md-4">
                                    <label>Image 1 :</label>
                                      <input type="file" name="1st_pro_img1" <?php foreach( $fetchAl as $fet){ echo $fet['1st_pro_img1']; } ?>">
                                 </div>
                                 <div class="col-xs-6 col-sm-6 col-md-4">
                                   <label>Image 2 :</label>
                                    <input type="file" name="1st_pro_img2">
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-4">
                                  <label>Image 3 :</label>
                                    <input type="file" name="1st_pro_img3">
                                      </div>
                                
                            </div>
                            <br>
                            <br>
                            
                        <div class="panel-heading">
						Update Second Best Product
						</div>
                              <div class="row">
                       <div class="col-xs-12 col-sm-12 col-md-12">
                         &nbsp;
                      </div>
                      </div>
                     <div class="row">
                       <div class="col-xs-6 col-sm-6 col-md-3">
                           <label>  Name :</label>
                                  <input type="text" name="2nd_pro_name" value="<?php foreach( $fetchAl as $fet){ echo $fet['2nd_pro_name']; } ?>"  class="form-control input-lg">
                        </div>
                                 <div class="col-xs-2 col-sm-2 col-md-3">
                                    <label>Price :</label>
                                        <input type="text" id="myNumber" name="2nd_pro_price" value="<?php foreach( $fetchAl as $fet){ echo $fet['2nd_pro_price']; } ?>" class="form-control input-lg">
                                         </div>
                                    </div>
                                    <div class="row">
                                     <div class="col-xs-10 col-sm-10 col-md-10">
                                        <label>Detail / Featurs :</label>
                                            <input type="text" name="2nd_pro_desc" value="<?php foreach( $fetchAl as $fet){ echo $fet['2nd_pro_desc']; } ?>" class="form-control input-lg">
                                         </div>
                                       
                                </div>
                                <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                  <label>Product Brand :</label>
                                  <input type="text" name="2nd_pro_brand" value="<?php foreach( $fetchAl as $fet){ echo $fet['2nd_pro_brand']; } ?>" class="form-control input-lg">
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                <label>Product Model :</label>
                                <input type="text" name="2nd_pro_model" value="<?php foreach( $fetchAl as $fet){ echo $fet['2nd_pro_model']; } ?>"  class="form-control input-lg">
                                </div>
                                </div>
                                                
                                <div class="row">
                                 <div class="col-xs-6 col-sm-6 col-md-4">
                                    <label>Image 1 :</label>
                                      <input type="file" name="2nd_pro_img1" >
                                 </div>
                                 <div class="col-xs-6 col-sm-6 col-md-4">
                                   <label>Image 2 :</label>
                                    <input type="file" name="2nd_pro_img2">
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-4">
                                  <label>Image 3 :</label>
                                    <input type="file" name="2nd_pro_img3">
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
