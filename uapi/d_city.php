<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';

header('Content-type: text/json');
$sel = $mysqli->query("select * from tbl_city where status=1");
$myarray = array();
$pop = array();
while($row = $sel->fetch_assoc())
{
	$pop['id'] = $row['id'];
	$pop['title'] = $row['title'];
	$pop['cimg'] = $row['cimg'];
	$pop['d_charge'] = $row['d_charge'];
	$pop['status'] = $row['status'];
	$pop['total_product'] = $mysqli->query("select * from tbl_product where cityid=".$row['id']."")->num_rows;
			$myarray[] = $pop;
}
$returnArr = array("Cityitem"=>$myarray,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"City List Founded!");
echo json_encode($returnArr);
?>