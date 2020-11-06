	
<?php

require_once 'config.php';


  //$name = trim($_POST["name"]);
 // $email = trim($_POST["email"]);
 // $managerId = trim($_POST["managerId"]); 
  //$managerContact = trim($_POST["managerContact"]);
  //$empAddress = trim($_POST["empAddress"]);
  //$comcode = trim($_POST["comcode"]);
  //$password = trim($_POST["password"]);
  //$type= trim($_GET["type"]);
  $cat_id= trim($_GET["cat_id"]);
	$stmt = $DB->prepare("SELECT * FROM  add_category where cat_id='$cat_id'");
   // $stmt->bindValue(":leadId", $leadId);
		
    $stmt->execute();
    $result = $stmt->fetchAll();
	 
	header('content-type:application/json');
	echo json_encode($result);

?>
