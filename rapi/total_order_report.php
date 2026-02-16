<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';

$data = json_decode(file_get_contents('php://input'), true);


$rid = $data['rid'];
if ($rid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$pok = array();
	$p =0 ;
	$ps = 0;
	$riderdata = $mysqli->query("select * from tbl_rider where id=".$rid."")->fetch_assoc();
	$pok['total_complete_order'] = $riderdata['complete'];
	$pok['total_normalreceive_order'] = $mysqli->query("select * from tbl_normal_order where rid=".$riderdata['id']."")->num_rows;
	$pok['total_subreceive_order'] = $mysqli->query("select * from tbl_subscribe_order where rid=".$riderdata['id']."")->num_rows;
	
	$pok['total_reject_order'] = $riderdata['reject'];
	$sale = $mysqli->query("select sum(`d_charge`) as total_earn from tbl_normal_order where rid=".$rid." and status='completed'")->fetch_assoc();
     if($sale['total_earn'] == '')
	 {
		 $p =0;
	 }
	 else 
	 {
		$p = number_format((float)$sale['total_earn'], 2, '.', '');
	 }
	 
	 $sales = $mysqli->query("select sum(`d_charge`) as total_earns from tbl_subscribe_order where rid=".$rid." and status='completed'")->fetch_assoc();
     if($sales['total_earns'] == '')
	 {
		 $ps =0;
	 }
	 else 
	 {
		$ps = number_format((float)$sales['total_earns'], 2, '.', '');
	 }
	 
	 
	 $pok['total_sale'] = $p + $ps;
	 $pok['current_status'] = $riderdata['a_status'];
	 $returnArr = array("report_data"=>$pok,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Report Get Successfully!!!!!");    
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>
