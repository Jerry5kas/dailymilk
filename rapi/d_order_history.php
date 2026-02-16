<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['rid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	$rid =  $mysqli->real_escape_string($data['rid']);
	$status  =  $mysqli->real_escape_string($data['status']);
  $sel = $mysqli->query("select * from tbl_normal_order where rid=".$rid." and status='".$status."' order by id desc "); 
  $g=array();
  $po= array();
  if($sel->num_rows != 0)
  {
  while($row = $sel->fetch_assoc())
  {
      $g['id'] = $row['id'];
	  $g['total_product'] = $mysqli->query("select * from tbl_normal_order_product where oid=".$row['id']."")->num_rows;
	   
	  $pname = $mysqli->query("select * from tbl_payment_list where id=".$row['p_method_id']."")->fetch_assoc();
		
		$g['p_method_name'] = $pname['title'];
	  
      $g['status'] = $row['status'];
	  $g['date'] = $row['odate'];
	  $g['customer_name'] = $row['name'];
	  $g['total'] = $row['o_total'];
      $po[] = $g;
	  
      
  }
  $returnArr = array("OrderHistory"=>$po,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order History  Get Successfully!!!");
  }
  else 
  {
	  $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Order  Not Found!!!");
  }
}
echo json_encode($returnArr);
?>