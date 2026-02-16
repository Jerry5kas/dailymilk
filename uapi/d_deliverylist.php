<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';

header('Content-type: text/json');
$sel = $mysqli->query("select * from tbl_delivery where status=1");
$myarray = array();
while($row = $sel->fetch_assoc())
{
			$myarray[] = $row;
}
$returnArr = array("Deliverylist"=>$myarray,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Deliveries List Founded!");
echo json_encode($returnArr);
?>