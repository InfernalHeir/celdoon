	
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
  $subcat_id= trim($_GET["subcat_id"]);
  	//$cat_id=trim($_GET['cat_id']);
	$stmt = $DB->query("SELECT * FROM  nodes_text where subcat_id='$subcat_id'");
   // $stmt->bindValue(":leadId", $leadId);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       $subcat_id = $res['subcat_id'] = $row['subcat_id'];
	$nodes_text = $res['nodes_text']="http://homestuff.co.in/file/".$row['nodes_text'];
	$result[] =$res;
}

   	 
	header('content-type:application/json');
	echo json_encode($result);

?>
