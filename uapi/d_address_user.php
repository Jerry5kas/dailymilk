<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';
require dirname( dirname(__FILE__) ).'/include/Milkman.php';
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if($data['uid'] == '' or $data['address'] == '' or $data['name'] == '' or $data['mobile'] == '' or $data['pincode'] == '' or $data['houseno']==''  or $data['landmark'] == '' or $data['type'] == '' or $data['lat_map'] == '' or $data['long_map'] == '' or $data['aid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$uid = $data['uid'];
	$address = $data['address'];
	$pincode = $data['pincode'];
	$city = strtolower($data['city']);
	$houseno = $data['houseno'];
	$landmark = $data['landmark'];
	$type = $data['type'];
	$lat_map = $data['lat_map'];
	$long_map = $data['long_map'];
	$aid = $data['aid'];
	$name = $data['name'];
	$mobile = $data['mobile'];
	
	$count = $mysqli->query("select * from tbl_user where id=".$uid." and status = 1")->num_rows;
	if($count != 0)
	{
	if($aid == 0)
	{
		$pincheck = $mysqli->query("select * from tbl_city where title='".$city."'")->num_rows;	
	
		
		if($pincheck  != 0)
		{
	$table="tbl_address";
  $field_values=array("uid","address","pincode","houseno","landmark","type","lat_map","long_map","name","mobile","city");
  $data_values=array("$uid","$address","$pincode","$houseno","$landmark","$type","$lat_map","$long_map","$name","$mobile","$city");
  $h = new Milkman();
  $check = $h->Ins_milk_latest_Api($field_values,$data_values,$table);
   $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address Saved Successfully!!!");
		}
		else 
		{
	$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Not Deliver On This Location!!!");
		}
 
	
	
	}
	else 
	{
		$pincheck = $mysqli->query("select * from tbl_city where title='".strtolower($city)."'")->num_rows;	
	
		
		if($pincheck  != 0)
		{
		$table="tbl_address";
  $field = array('address'=>$address,'pincode'=>$pincode,'city'=>$city,'houseno'=>$houseno,'landmark'=>$landmark,'type'=>$type,'lat_map'=>$lat_map,'long_map'=>$long_map,'name'=>$name,'mobile'=>$mobile);
  $where = "where id=".$aid."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata_Api($field,$table,$where);
	  
		$adata = $mysqli->query("select * from tbl_address where id=".$aid."")->fetch_assoc();
		$p = array();
		$p['id'] = $adata['id'];
		$p['uid'] = $adata['uid'];
		$p['hno'] = $adata['houseno'];
		$p['address'] = $adata['address'];
		$p['lat_map'] = $adata['lat_map'];
		$p['long_map'] = $adata['long_map'];
		$p['pincode'] = $adata['pincode'];
		$p['landmark'] = $adata['landmark'];
		$p['type'] = $adata['type'];
		$p['name'] = $adata['name'];
		$p['mobile'] = $adata['mobile'];
		
		$returnArr = array("AddressData"=>$p,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address Updated Successfully!!!");
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Not Deliver On This Location!!!");
	}
	}
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Either Not Exit OR Deactivated From Admin!");
	}
	
}
echo json_encode($returnArr);