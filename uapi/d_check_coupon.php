<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if(!is_array($data))
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else 
{
	$uid  = isset($data['uid']) ? trim($data['uid']) : '';
	$cid  = isset($data['cid']) ? trim($data['cid']) : '';
	if($uid == '' or $cid == '' or !is_numeric($uid) or !is_numeric($cid))
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
	}
	else 
	{
		$uid = strip_tags(mysqli_real_escape_string($mysqli,$uid));
		$cid = strip_tags(mysqli_real_escape_string($mysqli,$cid));
	$getcinfo = $mysqli->query("select * from tbl_coupon where id=".$cid."");
	$cinfo = $getcinfo->num_rows;
	
		if($cinfo !=0)
		{
			$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Coupon Applied Successfully!!");
		}
		else 
		{
			$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Coupon Not Exist!!");
		}
	}
}

echo json_encode($returnArr);
