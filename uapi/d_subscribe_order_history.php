<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';

$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['uid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	$uid =  $mysqli->real_escape_string($data['uid']);
  $sel = $mysqli->query("select * from tbl_subscribe_order where uid=".$uid." order by id desc "); 
  $g=array();
  $po= array();
  if($sel->num_rows != 0)
  {
  while($row = $sel->fetch_assoc())
  {
      $g['id'] = $row['id'];
	  $g['total_product'] = $mysqli->query("select * from tbl_subscribe_order_product where oid=".$row['id']."")->num_rows;
	  
	  $grid = $mysqli->query("select * from tbl_rider where id=".$row['rid']."")->fetch_assoc();
	  if($row['rid'] == 0)
	  {
		  $ridername = 'Not Assigned';
	  }
  else 
  {
	  $ridername = 'Assigned';
  }
	  $g['Delivery_name'] = $ridername;
      $g['status'] = $row['status'];
	  $g['date'] = $row['odate'];
	  $g['total'] = $row['o_total'];
      $po[] = $g;
	  
      
  }
  $returnArr = array("OrderHistory"=>$po,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Subscribe Order History  Get Successfully!!!");
  }
  else 
  {
	  $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Order  Not Found!!!");
  }
}
echo json_encode($returnArr);
?>