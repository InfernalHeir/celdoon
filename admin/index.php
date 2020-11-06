<?php
session_start();
include ('include/database.php');

try {
    if($_SESSION['err'])
    {
        echo($_SESSION['err']);
        unset($_SESSION['err']);
    }
    
    if(isset($_POST['submit']))
    {
   
    $stmt = $conn->prepare("Select * from login where user_name = :user and password = :pass");
    $stmt->bindParam(':user', $_POST['emailid']);
    $stmt->bindParam(':pass', $_POST['password']);
    $stmt->execute();
    
    $stmt->fetchAll();
    if($stmt->rowCount()==0)
    {
        echo "Login Failed";
    }
    else
    {
        $_SESSION['user']=$_POST['emailid'];
        header('location:dashboard.php');
    }
    
    
}
    
}
catch(PDOException $e) {
    echo 'Error in PDO: ' . $e->getMessage();
}

$conn=null;


?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Celdoon Ltd</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body class="photo">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
                                    <form role="form" method="POST" action="">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="emailid" type="email" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
                                                    <input type="submit" name="submit" value="Login" class="btn btn-primary">
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
