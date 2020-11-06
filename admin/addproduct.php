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
    
    $cat_id = $_POST['cat_id'];
    $subcat_name = $_POST['subcat_name'];
    $pro_name = $_POST['pro_name'];
    $pro_mrp = $_POST['pro_mrp'];
    $pro_dis = $_POST['pro_dis'];
    $shipping_charge = $_POST['shipping_charge'];
    $pro_unit = $_POST['pro_unit'];
    $type = $_POST['type'];
    $tot_unit = $_POST['tot_unit'];
    $pro_detail = $_POST['pro_detail'];
    $pro_life = $_POST['pro_life'];
    $tax = $_POST['tax'];
    $pro_type = $_POST['pro_type'];
    $pro_manufacture = $_POST['pro_manufacture'];
    $pro_disclaimer = $_POST['pro_disclaimer'];
    $pro_other_name = $_POST['pro_other_name'];
    $pro_image1 = $_FILES['pro_image1'];
    $pro_image2 = $_FILES['pro_image2'];
    $pro_image3 = $_FILES['pro_image3'];
    $pro_image4 = $_FILES['pro_image4'];
    
    
    
    $size1=$pro_image1['size'];
    $size2=$pro_image2['size'];
    $size3=$pro_image3['size'];
    $size4=$pro_image4['size'];
    
    if($size1>1000000 || $size2>1000000 || $size3>1000000 || $size4>1000000)
    {
        echo "<script>alert('Size is Too Long...')</script>";
    }
    	
    else
    {
    $file_tmp1 =$pro_image1['tmp_name'];
    $file_tmp2 =$pro_image2['tmp_name'];
    $file_tmp3 =$pro_image3['tmp_name'];
    $file_tmp4 =$pro_image4['tmp_name'];
    
    
    $target1 = "upload/".$pro_image1['name'];
    $target2 = "upload/".$pro_image2['name'];
    $target3 = "upload/".$pro_image3['name'];
    $target4 = "upload/".$pro_image4['name'];
    
    
    move_uploaded_file($file_tmp1, $target1);   //Tells you if its all ok	
    move_uploaded_file($file_tmp2, $target2);
    move_uploaded_file($file_tmp3, $target3);
    move_uploaded_file($file_tmp4, $target4);
    
    
    
    $pro_dis_price= $pro_mrp-($pro_dis*$pro_mrp/100);
        
       // $sql1="INSERT INTO product (cat_id,pro_name,pro_mrp,pro_dis,pro_dis_price,pro_unit,pro_detail,pro_other_name,pro_life,pro_manufacture,pro_disclaimer,pro_status,pro_image1,pro_image2,pro_image3,pro_image4,tax,type,tot_unit,pro_type) VALUES ('$cat_id','$pro_name','$pro_mrp','$pro_dis','$pro_dis_price','$pro_unit','$pro_detail','$pro_other_name','$pro_life','$pro_manufacture','$pro_disclaimer','1','$Filename1','$pro_image21','$pro_image31','$pro_image41','$tax','$type','$tot_unit','$pro_type')";
   // var_dump($sql1);
   //if(mysqli_query($conn,$sql1))
   
    $stmt=$conn->prepare("INSERT INTO `product`(`cat_id`,`subcat_name`, `pro_name`, `pro_mrp`, `pro_dis`, `pro_dis_price`,`shipping_charge`, `pro_unit`, `pro_detail`, `pro_other_name`, `pro_life`, `pro_manufacture`, `pro_disclaimer`, `pro_status`, `pro_image1`, `pro_image2`, `pro_image3`, `pro_image4`, `tax`, `type`, `tot_unit`) VALUES ('$cat_id','$subcat_name','$pro_name','$pro_mrp','$pro_dis','$pro_dis_price','$shipping_charge','$pro_unit','$pro_detail','$pro_other_name','$pro_life','$pro_manufacture','$pro_disclaimer',1,'$target1','$target2','$target3','$target4','$tax','$type','$pro_type')");
   
   if($stmt->execute())
	{
            echo "<script>alert('Product Inserted Successfully.....!');</script>";
            echo "<script>window.open('product.php','_self')</script>";
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
			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						Add Product
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
     <form action="" method="POST" enctype="multipart/form-data" name="form1" onSubmit="return check();">
    <div class="row">
    <div class="col-md-4">
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

<div class="col-md-4">
     <label> Select Sub  Category :</label>
    <select name="subcat_name" required="" class="form-control">
    <option value="">--Select Sub Category--</option>
      <?php
    
     $stmt=$conn->prepare("SELECT * FROM sub_category");
   $stmt->execute();
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
     {		
  $subcat_name=$row['subcat_name'];
  echo '<option>'.$row['subcat_name'].'</option>';
  }
  ?>
                                                            
 </select>
</div>
<!--<div class="col-md-4">
 <label>Product Type :</label>
<select name="pro_type" class="form-control">
 <option value="">--Select Type--</option>
<option value="seasoning">Seasoning</option>
<option value="bigsale">Big Sale</option>
    <option value="cookingoil">Cooking Oil</option>
 <option value="vegetables">Vegetables</option>
 </select>
 </div>-->
 
 </div>
 <div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
                 &nbsp;
</div>
 </div>
<div class="row">
 <div class="col-xs-6 col-sm-6 col-md-3">
            <label>Name :</label>
<input type="text" name="pro_name"  class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-2 col-sm-1 col-md-1">
                                                        <label>Price :</label>
                                                        <input type="text" id="myNumber" name="pro_mrp" class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                                        <label>Discount % :</label>
                                                        <input type="text" name="pro_dis" class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-2 col-sm-1 col-md-1">
                                                        <label>Unit :</label>
                                                        <input type="text" name="pro_unit"  class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                                        <label>Unit Type :</label>
                                                        <select name="type" class="form-control">
                                                            <option value="">--Select Unit Type--</option>
                                                            <option value="1">gram</option>
                                                            <option value="2">Kilogram</option>
                                                            <option value="3">Mili Litre</option>
                                                            <option value="4">Litre</option>
                                                            <option value="5">Others</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                                        <label>Total Unit :</label>
                                                        <input type="text" name="tot_unit"  class="form-control input-lg">
                                                    </div>
                                                    
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                                        <label>Detail / Featurs :</label>
                                                        <input type="text" name="pro_detail"  class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                                        <label>Select Tax :</label>
                                                        <select name="tax" class="form-control">
                                                            <option value="">--Select Tex--</option>
                                                            <option value="0">0%</option>
                                                            <option value="6">6%</option>
                                                            <option value="21">21%</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6 col-md-3">
                                                        <label>Other Language Name :</label>
                                                        <input type="text" name="pro_other_name"  class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-3">
                                                        <label>Product Life :</label>
                                                        <input type="text" name="pro_life"  class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-3">
                                                        <label>Manufacturing Place :</label>
                                                        <input type="text" name="pro_manufacture"  class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-3">
                                                        <label>Shipping Charge :</label>
                                                        <input type="text" name="shipping_charge"  class="form-control input-lg">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <label>Disclaimer :</label>
                                                        <input type="text" name="pro_disclaimer"  class="form-control input-lg">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6 col-md-3">
                                                        <label>Image 1 :</label>
                                                        <input type="file" name="pro_image1" >
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-3">
                                                        <label>Image 2 :</label>
                                                        <input type="file" name="pro_image2">
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-3">
                                                        <label>Image 3 :</label>
                                                        <input type="file" name="pro_image3">
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-3">
                                                        <label>Image 4 :</label>
                                                        <input type="file" name="pro_image4">
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
