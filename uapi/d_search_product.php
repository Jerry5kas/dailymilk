<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';

header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

$cityid = $data['cityid'];
$uid = $data['uid'];
$keyword = $data['keyword'];
if($uid == '' or $cityid == '' or $keyword == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$counter = $mysqli->query("select * from tbl_product where cityid REGEXP  '[[:<:]]".$cityid."[[:>:]]' and ptitle like '%".$keyword."%' and status = 1");
    if($counter->num_rows != 0)
    {

	$plist = $mysqli->query("select * from tbl_product where cityid REGEXP  '[[:<:]]".$cityid."[[:>:]]' and ptitle like '%".$keyword."%' and status = 1");
	$products = array();
	$lp = array();
	while($rows = $plist->fetch_assoc())
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
$returnArr = array("SearchData"=>$lp,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Product List Get successfully!");
}
 else
    {
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Product List Not Found!");
    }
}
echo json_encode($returnArr);
mysqli_close($mysqli);	


