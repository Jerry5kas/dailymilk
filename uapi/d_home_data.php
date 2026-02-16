<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';

header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
$uid = $data['uid'];
$cityid = $data['cityid'];
if($uid == '' or $cityid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$v = array();
	$cp = array(); 
	$d = array();
	$pop = array();
	$sec = array();
	
	
	
	$banner = $mysqli->query("select * from tbl_banner where status=1");
$vbanner = array();
while($row = $banner->fetch_assoc())
{
	$vbanner['id'] = $row['id'];
	$vbanner['img'] = $row['bimg'];
	
	if($row['cid'] == 0)
	{
		
	$vbanner['cat_id'] = 0;
	$vbanner['title'] = '';
	$vbanner['cat_img'] = '';	
	}
	else 
	{
		$cato = $mysqli->query("select * from tbl_cat where id=".$row['cid']."")->fetch_assoc();
		$vbanner['cat_id'] = $cato['id'];
	$vbanner['title'] = $cato['title'];
	$vbanner['cat_img'] = $cato['cimg'];
	}
    $v[] = $vbanner;
}

$cato = $mysqli->query("select * from tbl_cat where status=1");
$cat = array();
while($row = $cato->fetch_assoc())
{
	$cat['id'] = $row['id'];
	$cat['title'] = $row['title'];
	$cat['cat_img'] = $row['cimg'];
    $cp[] = $cat;
}

$stock = $mysqli->query("select * from tbl_product where cityid REGEXP  '[[:<:]]".$cityid."[[:>:]]' and status=1 order by id desc");
$product = array();
while($row = $stock->fetch_assoc())
{
	$mattributes = $mysqli->query("select * from tbl_product_attribute where pid=".$row['id']."");
      if($mattributes->num_rows != 0)
	  {
	$product['product_id'] = $row['id'];
	$product['cityid'] = $cityid;
	$product['catid'] = $row['catid'];
	$catname = $mysqli->query("select * from tbl_cat where id=".$row['catid']."")->fetch_assoc();
	$product['catname']= $catname['title'];
	$product['subcatid'] = $row['subcatid'];
	
	$product['product_title'] = $row['ptitle'];
	$product['product_img'] = $row['pimg'];
	$pattr = array();
	$k = array();
	while($rattr = $mattributes->fetch_assoc())
	{
		$pattr['attribute_id'] = $rattr['id'];
		$pattr['product_price'] = $rattr['price'];
		$pattr['product_sprice'] = $rattr['sprice'];
		
		$pattr['product_type'] = $rattr['title'];
		$pattr['product_discount'] = $rattr['discount'];
		$pattr['Product_Out_Stock'] = $rattr['ostock'];
		$pattr['sub_required'] = $rattr['sreq'];
		
		$k[] = $pattr;
		
	}
	$product['product_info'] = $k; 
    $d[] = $product;
	  }
}

$coll = $mysqli->query("select * from tbl_collection where cid=".$cityid." and status=1");
$collection = array();
while($row = $coll->fetch_assoc())
{
	$collection['id'] = $row['id'];
	$collection['title'] = $row['title'];
	$collection['image'] = $row['cimg'];
	$plist = $mysqli->query("select * from tbl_product where cityid=".$cityid." and id IN(".$row['pid'].") and status=1 order by id desc");
	$products = array();
	$lp = array();
	while($rows = $plist->fetch_assoc())
	{
		$mattributes = $mysqli->query("select * from tbl_product_attribute where pid=".$rows['id']."");
      if($mattributes->num_rows != 0)
	  {
	$products['product_id'] = $rows['id'];
	$products['cityid'] = $cityid;
	$products['catid'] = $rows['catid'];
	$catname = $mysqli->query("select * from tbl_cat where id=".$rows['catid']."")->fetch_assoc();
	$products['catname']= $catname['title'];
	$products['subcatid'] = $rows['subcatid'];
	
	$products['product_title'] = $rows['ptitle'];
	$products['product_img'] = $rows['pimg'];
	$pattr = array();
	$k = array();
	while($rattr = $mattributes->fetch_assoc())
	{
		$pattr['attribute_id'] = $rattr['id'];
		$pattr['product_price'] = $rattr['price'];
		$pattr['product_sprice'] = $rattr['sprice'];
		
		$pattr['product_type'] = $rattr['title'];
		$pattr['product_discount'] = $rattr['discount'];
		$pattr['Product_Out_Stock'] = $rattr['ostock'];
		$pattr['sub_required'] = $rattr['sreq'];
		
		$k[] = $pattr;
		
	}
	$products['product_info'] = $k; 
    $lp[] = $products;
	}
	}
	$collection['productdata'] = $lp;
	$pop[] = $collection;
}

$cato = $mysqli->query("select * from tbl_coupon where status=1");
$coupon = array();
$timestamp = date("Y-m-d");
while($row = $cato->fetch_assoc())
{
	if($row['cdate'] < $timestamp)
	{
		$mysqli->query("update tbl_coupon set status=0 where id=".$row['id']."");
	}
	else 
	{
	$coupon['id'] = $row['id'];
	$coupon['coupn_code'] = $row['c_title'];
	$coupon['coupon_img'] = $row['c_img'];
	$date=date_create($row['cdate']);
	$coupon['coupon_expire_date'] = date_format($date,"d M");
    $sec[] = $coupon;
	}
}


$main_data = $mysqli->query("select * from setting")->fetch_assoc();
$tbwallet = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();

$kp = array('Banner'=>$v,'Catlist'=>$cp,'f_stock'=>$d,"Collection"=>$pop,"Couponlist"=>$sec,"Main_Data"=>$main_data,"wallet"=>$tbwallet['wallet']);
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Home Data Get Successfully!","ResultData"=>$kp);
}
echo json_encode($returnArr);