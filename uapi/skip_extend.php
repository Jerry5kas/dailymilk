<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';
require dirname( dirname(__FILE__) ).'/include/Milkman.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

if($data['uid'] == '' or $data['status'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $status = strip_tags(mysqli_real_escape_string($mysqli,$data['status']));
$uid =  strip_tags(mysqli_real_escape_string($mysqli,$data['uid']));
$checkimei = mysqli_num_rows(mysqli_query($mysqli,"select * from tbl_user where  `id`=".$uid.""));

if($checkimei != 0)
    {
		
		
      if($status == 'skip')
	  {
		  $jsonobj = json_decode($data['sday']);
		  $arr1 = []; $arr2=[];
		  foreach ($jsonobj as $val){
    $Arrval = (array) $val;
    foreach ($Arrval as $k=>$v){
        $arr1[]=$k;     
        $arr2[]=$v;
    }
}
 $json_object1 = implode(",",$arr2);
		  $skip_day =  explode(',',$json_object1);
		  
		  $item_id = $data['item_id'];
		  $order_id = $data['order_id'];
		  $sel = $mysqli->query("select * from tbl_subscribe_order_product where id=".$item_id."")->fetch_assoc();
		  $selorder = $mysqli->query("select * from tbl_subscribe_order where id=".$order_id."")->fetch_assoc();
		  $totaldates = explode(',',$sel['totaldates']);
		  $selectday = explode(',',$sel['selectday']);
		  $final = array_diff($totaldates,$skip_day);
		  $totalday = count($skip_day);
		  $totalamt = $data['total'] * $totalday;
		  $subtotal = $selorder['subtotal'] - $totalamt;
		  if($selorder['p_method_id'] == 5)
		  {
			  $total = ($subtotal + $selorder['d_charge']) - $selorder['cou_amt'];
		  $remaindelivery = $sel['totaldelivery'] - $totalday;
		  $final = implode(',',$final);
		  $table="tbl_subscribe_order_product";
  $field = array('totaldates'=>$final,'totaldelivery'=>$remaindelivery);
  $where = "where id=".$item_id."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata_Api($field,$table,$where);
	  
	  
	  $table="tbl_subscribe_order";
  $field = array('subtotal'=>$subtotal,'wall_amt'=>$total);
  $where = "where id=".$order_id."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata_Api($field,$table,$where);
		  }
		  else 
		  {
		  $total = ($subtotal + $selorder['d_charge']) - ($selorder['cou_amt'] + $selorder['wall_amt']);
		  $remaindelivery = $sel['totaldelivery'] - $totalday;
		  $final = implode(',',$final);
		  $table="tbl_subscribe_order_product";
  $field = array('totaldates'=>$final,'totaldelivery'=>$remaindelivery);
  $where = "where id=".$item_id."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata_Api($field,$table,$where);
	  
	  
	  $table="tbl_subscribe_order";
  $field = array('subtotal'=>$subtotal,'o_total'=>$total);
  $where = "where id=".$order_id."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata_Api($field,$table,$where);
		  }
		  
	  $vp = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	  $table="tbl_user";
  $field = array('wallet'=>$vp['wallet']+$totalamt);
  $where = "where id=".$uid."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata_Api($field,$table,$where);
	  
	  $table="wallet_report";
  $field_values=array("uid","message","status","amt");
  $data_values=array("$uid",'Refund Amount Order ID#'.$order_id,'Credit',"$totalamt");
  $h = new Milkman();
	  $checks = $h->Ins_milk_latest_Api($field_values,$data_values,$table);
	  $wallet = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Skipped Successfully!!!!","wallet"=>$wallet['wallet']);  
	  }
	  else if($status == 'extended')
	  {
		  $jsonobj = json_decode($data['sday']);
		  $arr1 = []; $arr2=[];
		  foreach ($jsonobj as $val){
    $Arrval = (array) $val;
    foreach ($Arrval as $k=>$v){
        $arr1[]=$k;     
        $arr2[]=$v;
    }
}
 $json_object1 = implode(",",$arr2);
		  $skip_day =  explode(',',$json_object1);
		  
		  $item_id = $data['item_id'];
		  $sel = $mysqli->query("select * from tbl_subscribe_order_product where id=".$item_id."")->fetch_assoc();
		  $totaldates = explode(',',$sel['totaldates']);
		  $selectday = explode(',',$sel['selectday']);
		  $final = array_diff($totaldates,$skip_day);
		  $start_date = end($totaldates);
		  $dates = array();
$pol = array();
$date = new DateTime($start_date);
for($ip=0;$ip<count($selectday);$ip++)
{
	$pol[] = $selectday[$ip] + 1; 
}

while (count($dates)< count($skip_day))
{
    $date->add(new DateInterval('P1D'));
    if (in_array($date->format('N'),$pol)) 
        $dates[]=$date->format('Y-m-d');
}
$final = array_merge($final, $dates);
$final = implode(',',$final);
$table="tbl_subscribe_order_product";
  $field = array('totaldates'=>$final);
  $where = "where id=".$item_id."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata_Api($field,$table,$where);
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Extended Successfully!!!!");  
	  }
	  else 
	  {
	  }
	}
    else
    {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Deactivate By Admin!!!!");  
    }
    
}

echo json_encode($returnArr);