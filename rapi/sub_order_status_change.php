<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';
require dirname( dirname(__FILE__) ).'/include/Milkman.php';
$getkey = $mysqli->query("select * from setting")->fetch_assoc();
define('ONE_KEY',$getkey['one_key']);
define('ONE_HASH',$getkey['one_hash']);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
 header( 'Content-Type: text/html; charset=utf-8' ); 
$data = json_decode(file_get_contents('php://input'), true);

$oid = $data['oid'];
$status = $data['status'];
$rid = $data['rid'];

function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

if ($oid =='' or $status =='' or $rid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
    
    $oid = strip_tags(mysqli_real_escape_string($mysqli,$oid));
	$rid = strip_tags(mysqli_real_escape_string($mysqli,$rid));
    $status = strip_tags(mysqli_real_escape_string($mysqli,$status));
	
	$checks = $mysqli->query("select * from tbl_subscribe_order where id=".$oid."")->fetch_assoc();
	
            $udata = $mysqli->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];			
		
		$uid = $checks['uid'];
		
	$check = $mysqli->query("select *  from tbl_subscribe_order where rid=".$rid." and id=".$oid."")->num_rows;
	if($check != 0)
	{
if($status == 'accept')
{
	
	
	$tbl_riderdata = $mysqli->query("select * from tbl_rider where id=".$rid."")->fetch_assoc();
	$accept = $tbl_riderdata['accept'] + 1;
	$table="tbl_subscribe_order";
  $field = array('status'=>'Processing');
  $where = "where id=".$oid."";
$h = new Milkman();
	  $h->Ins_milk_updata_Api($field,$table,$where);
	  
	  $table="tbl_rider";
  $field = array('accept'=>$accept);
  $where = "where id=".$rid."";
$h = new Milkman();
	  $h->Ins_milk_updata_Api($field,$table,$where);
	  
	
		

$timestamp = date("Y-m-d H:i:s");

$title_main = "Order Processed!!";
$description = $name.', Your Order #'.$oid.' Has Been Processed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Milkman();
	   $h->Ins_milk_latest_Api($field_values,$data_values,$table);
	   
	   

$content = array(
       "en" => $name.', Your Order #'.$oid.' Has Been Processed.'
   );
$heading = array(
   "en" => "Order Processed!!"
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/order_process_img/process.png'
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['one_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);




	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Accepted Successfully!!!!!");    
	
}
else if($status == 'reject')
{
	
	$tbl_riderdata = $mysqli->query("select * from tbl_rider where id=".$rid."")->fetch_assoc();
	$reject = $tbl_riderdata['reject'] + 1;
	$rids = 0;
	$table="tbl_subscribe_order";
  $field = array('rid'=>"$rids");
  $where = "where id=".$oid."";
$h = new Milkman();
	  $h->Ins_milk_updata_Api($field,$table,$where);
	  
	   $table="tbl_rider";
  $field = array('reject'=>$reject);
  $where = "where id=".$rid."";
$h = new Milkman();
	  $h->Ins_milk_updata_Api($field,$table,$where);
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Order Rejected Successfully!!!!!");    
}
else if($status == 'date_complete')
{
	$date = $data['date_com'];
	$product_id = $data['porderid'];
	$timestamp = date("Y-m-d");
	
	
		$jpro = $mysqli->query("select * from tbl_subscribe_order_product where oid=".$oid." and id=".$product_id."")->fetch_assoc();
		$in = explode(',',$jpro['completedates']);
		if (in_array($date,$in))
				 {
				$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Already Completed Selected Date!!!!!");	 
				 }
				 else 
				 {
					 if($jpro['completedates'] == '')
					 {
						 $completedate = $date;
					 }
					 else 
					 {
					 $completedate = $jpro['completedates'].','.$date;
					 }
					  $table="tbl_subscribe_order_product";
  $field = array('completedates'=>$completedate);
  $where = "where id=".$product_id."";
$h = new Milkman();
	  $h->Ins_milk_updata_Api($field,$table,$where);			
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Date Completed Successfully!!!!!"); 	  
				 }
	  
}
else if($status == 'complete')
{
	
	$jpro = $mysqli->query("select * from tbl_subscribe_order_product where oid=".$oid."");
$pops = array();
while($row = $jpro->fetch_assoc())
{
	$checks = explode(',',$row['totaldates']);
			$in = explode(',',$row['completedates']);
			
			if(count($checks) == count($in))
			{
				$ps = 1;
			}
			else 
			{
				$ps = 0;
			}
$pops[] = $ps;
}

if (in_array(0,$pops))
				 {
					 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Please Complete All Delivery Date First!!");
				 }
				 else 
				 {
					 
				 
				 
	$tbl_riderdata = $mysqli->query("select * from tbl_rider where id=".$rid."")->fetch_assoc();
	$complete = $tbl_riderdata['complete'] + 1;
	
	
	
	
	
	$table="tbl_subscribe_order";
  $field = array('status'=>'Completed');
  $where = "where id=".$oid."";
$h = new Milkman();
	  $h->Ins_milk_updata_Api($field,$table,$where);
	  
	  $checkcomplete = $mysqli->query("select * from tbl_subscribe_order where uid=".$uid." and status='Completed'")->num_rows;
	if($checkcomplete == 1)
	{
	    $checkin = $mysqli->query("select * from tbl_normal_order where uid=".$uid." and status='Completed'")->num_rows;
	    
	    if($checkin >= 1)
	    {
	        
	    }
	    else 
	    {
	$wallet = $mysqli->query("select * from setting")->fetch_assoc();
		$fin = $wallet['refercredit'];
	$uinfo = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	$refercode = $uinfo['refercode'];
	if($refercode != 0)
	{
		$getm = $mysqli->query("select * from tbl_user where code=".$refercode."")->fetch_assoc();
		$fuid = $getm['id'];
		$mysqli->query("insert into wallet_report(`uid`,`message`,`status`,`amt`)values(".$fuid.",'Refer User Credit Added!!','Credit',".$fin.")");
		$mysqli->query("update tbl_user set wallet= wallet+".$fin." where code=".$refercode."");
	}
	}
	}
	
	  $table="tbl_rider";
  $field = array('complete'=>$complete);
  $where = "where id=".$rid."";
$h = new Milkman();
	  $h->Ins_milk_updata_Api($field,$table,$where);
	  
	  
	    $timestamp = date("Y-m-d H:i:s");

$title_main = "Order Delivered!!";
$description = $name.', Your Order #'.$oid.' Has Been Delivered.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Milkman();
	   $h->Ins_milk_latest_Api($field_values,$data_values,$table);
	   
	   
	 $content = array(
       "en" => $name.', Your Order #'.$oid.' Has Been Delivered.'
   );
$heading = array(
   "en" => "Order Delivered!!"
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $uid)),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/order_process_img/complete.png'
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['one_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch); 
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Delivered Successfully!!!!!");    
}
}
else 
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Sorry This Order Assign to Other rider Or Cancelled!");
	}
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>