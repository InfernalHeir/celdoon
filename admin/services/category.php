	
<?php

require_once 'config.php';

    $stmt = $DB->prepare("SELECT * FROM  category WHERE cat_status='1'");
    $stmt->execute();
    while($r = $stmt->fetch(PDO::FETCH_ASSOC))
    {
	 $res['cat_id']=$r['cat_id'];
         $res['cat_name']=$r['cat_name'];
         $res['cat_status']=$r['cat_status'];
         $res['cat_image']="http://homestuff.co.in/admin/upload/".$r['cat_image'];
         $result[]=$res;
    }
	header('content-type:application/json');
	echo json_encode($result);

?>
