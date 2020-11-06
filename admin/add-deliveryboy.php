<?php
    session_start();
    include ('include/database.php');
    $page='delivery';
    if (!isset($_SESSION['user']))
    {
	echo "<br><h2 align='center'><div>You are not Logged On Please Login to Access this Page</div></h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
    }
if(isset($_POST['submit']))
{
    
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $houseno = $_POST['houseno'];
    $locality = $_POST['locality'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $state = $_POST['state'];
    $pin = $_POST['pin'];
    //$sql="SELECT * FROM user where mobile_number='$mobile' or email_id='$email'";
    //$sa=mysqli_query($conn,$sql);
    
      $stmt=$conn->prepare("SELECT * FROM user where mobile_number='$mobile' or email_id='$email'");
      $stmt->execute();
    if($stmt->fetch(PDO::FETCH_ASSOC))
    {

        echo "<script>alert('Delivery Boy Already exist.....!');</script>";
        echo "<script>window.open('deliveryboy.php','_self')</script>";
    }
    else
    {
       
        
  //$stmt=$conn->prepare("INSERT INTO deliveryboy(mobile_number,email_id,password,user_name,house_no,street,locality,city,pincode,logintype) VALUES ('$mobile','$email','".md5($mobile)."','$name','$houseno','$locality','$city','$district','".$state."(".$pin.")','deliveryboy')");
  $stmt=$conn->prepare("INSERT INTO `deliveryboy`( `name`, `mobile`, `email`, `houseno`, `locality`, `city`, `district`, `state`, `pin`) VALUES ('$name','$mobile','$email','$houseno','$locality','$city','$district','$state','$pin')");
  
  
    if($stmt->execute())
        
        {
            echo "<script>alert('Delivery Boy Registered Successfully.....!');</script>";
            echo "<script>window.open('deliveryboy.php','_self')</script>";
        }
        else
        {
        echo "<script>alert('Delivery Boy Not Inserted');</script>";
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
						Add Delivery Boy
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
                                            <form action="" method="POST" enctype="multipart/form-data" name="form1" onSubmit="return check();">
                                                
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-4 col-md-4">
                                                        <label>Name :</label>
                                                        <input type="text" name="name"  class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-6 col-sm-4 col-md-4">
                                                        <label>Mobile Number :</label>
                                                        <input type="text" name="mobile"  class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-6 col-sm-4 col-md-4">
                                                        <label>Email ID :</label>
                                                        <input type="text" name="email"  class="form-control input-lg">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-4 col-md-4">
                                                        <label>House No :</label>
                                                        <input type="text" name="houseno"  class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-6 col-sm-4 col-md-4">
                                                        <label>Localiy :</label>
                                                        <input type="text" name="locality"  class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-6 col-sm-4 col-md-4">
                                                        <label>City :</label>
                                                        <input type="text" name="city"  class="form-control input-lg">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-4 col-md-4">
                                                        <label>District :</label>
                                                        <input type="text" name="district"  class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-6 col-sm-4 col-md-4">
                                                        <label>State :</label>
                                                        <input type="text" name="state"  class="form-control input-lg">
                                                    </div>
                                                    <div class="col-xs-6 col-sm-4 col-md-4">
                                                        <label>Pin Code :</label>
                                                        <input type="text" name="pin"  class="form-control input-lg">
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

a1=document.form1.name.value;
if (a1.length<1) {
alert("Please Enter Name....!");
document.form1.name.focus();
return false;
}
a=document.form1.mobile.value;
if (a.length<1) {
alert("Please Enter Mobile Number....!");
document.form1.mobile.focus();
return false;
}
b=document.form1.email.value;
if (b.length<1) {
alert("Please Enter Email ID....!");
document.form1.email.focus();
return false;
}
c=document.form1.locality.value;
if (c.length<1) {
alert("Please Enter Locality....!");
document.form1.locality.focus();
return false;
}
mt=document.form1.city.value;
if (mt.length<1) {
alert("Please Enter City....!");
document.form1.city.focus();
return false;
}
mt1=document.form1.district.value;
if (mt1.length<1) {
alert("Please Enter District....!");
document.form1.district.focus();
return false;
}
mt2=document.form1.state.value;
if (mt2.length<1) {
alert("Please Enter State....!");
document.form1.state.focus();
return false;
}
mt3=document.form1.pin.value;
if (mt3.length<1) {
alert("Please Enter Pin Code....!");
document.form1.pin.focus();
return false;
}
return true;
}
</SCRIPT>

</body>
</html>
