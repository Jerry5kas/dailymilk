<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';
require dirname( dirname(__FILE__) ).'/include/Milkman.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '' or $data['order_id'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	 $order_id = $mysqli->real_escape_string($data['order_id']);
 $uid =  $mysqli->real_escape_string($data['uid']);
 
 
 
 $table="tbl_normal_order";
  $field = array('status'=>'Cancelled');
  $where = "where uid=".$uid." and id=".$order_id."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata_Api($field,$table,$where);
	  $fetch = $mysqli->query("select * from tbl_normal_order where id=".$order_id."")->fetch_assoc();
 if($fetch['p_method_id'] == '2' and $fetch['wal_amt'] == 0)
	{
	}
	else if($fetch['p_method_id'] == '2' and $fetch['wal_amt'] != 0)
	{
		$wallet = $fetch['wal_amt'];
		 $mysqli->query("update tbl_user set wallet = wallet+".$wallet." where id=".$uid."");
		 $mysqli->query("insert into wallet_report(`uid`,`message`,`status`,`amt`)values(".$uid.",'Refund Order ".$order_id." Amount To Wallet!!','Credit',".$wallet.")");
	}
	else 
	{
		$wallet = $fetch['total'];
		$mysqli->query("update tbl_user set wallet = wallet+".$wallet." where id=".$uid."");
		 $mysqli->query("insert into wallet_report(`uid`,`message`,`status`,`amt`)values(".$uid.",'Refund Order ".$order_id." Amount To Wallet!!','Credit',".$wallet.")");
	}
 $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Product Cancelled successfully!");
}
echo json_encode($returnArr);
?>