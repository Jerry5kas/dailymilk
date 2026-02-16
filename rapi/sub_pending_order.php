<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';

$data = json_decode(file_get_contents('php://input'), true);
if($data['rid'] == '')
{ 
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
 $rid =  strip_tags(mysqli_real_escape_string($mysqli,$data['rid']));
  $order_id =  strip_tags(mysqli_real_escape_string($mysqli,$data['order_id']));
  
 
  $sel = $mysqli->query("select * from tbl_subscribe_order where rid=".$rid." and id=".$order_id."  order by id desc");
  
  if($sel->num_rows != 0)
  {
   $result = array();
  $pp = array();
  while($row = $sel->fetch_assoc())
    {
		$pp['order_id'] = $row['id'];
		
		$pname = $mysqli->query("select * from tbl_payment_list where id=".$row['p_method_id']."")->fetch_assoc();
		
		$pp['p_method_name'] = $pname['title'];
		$pp['customer_address'] = $row['address'];
		$pp['customer_name'] = $row['name'];
		$pp['customer_mobile'] = $row['mobile'];
		$pp['Delivery_charge'] = $row['d_charge'];
		$pp['Coupon_Amount'] = $row['cou_amt'];
		$pp['Wallet_Amount'] = $row['wall_amt'];
		$pp['Order_Total'] = $row['o_total'];
		$pp['Order_SubTotal'] = $row['subtotal'];
		$pp['Order_Transaction_id'] = $row['trans_id'];
		$pp['Additional_Note'] = $row['a_note'];
		$pp['Order_Status'] = $row['status'];
	
		$fetchpro = $mysqli->query("select *  from tbl_subscribe_order_product where oid=".$row['id']."");
		$kop = array();
		$pdata = array();
		while($jpro = $fetchpro->fetch_assoc())
		{
			$kop['product_order_id'] = $jpro['id'];
			$kop['Product_quantity'] = $jpro['pquantity'];
			$kop['Product_name'] = $jpro['ptitle'];
			$kop['Product_discount'] = $jpro['pdiscount'];
			$kop['Product_image'] = $jpro['pimg'];
			$kop['Product_price'] = $jpro['pprice'];
			$kop['Product_variation'] = $jpro['ptype'];
			$kop['Delivery_Timeslot'] = $jpro['tslot'];
			$discount = $jpro['pprice'] * $jpro['pdiscount']*$jpro['pquantity'] /100;
			
			$kop['Product_total'] = ($jpro['pprice'] * $jpro['pquantity']) - $discount;
			$kop['totaldelivery'] = $jpro['totaldelivery'];
			$kop['startdate'] = $jpro['startdate'];
			$checks = explode(',',$jpro['totaldates']);
			$in = explode(',',$jpro['completedates']);
			$prem = array();
			for($i=0;$i<count($checks);$i++)
			{
				 if (in_array($checks[$i],$in))
				 {
					 $date=date_create($checks[$i]);
 $fdate = date_format($date,"D d");

					 $prem[] = array("date"=>$checks[$i],"is_complete"=>1,"format_date"=>$fdate);
				 }
else 
{
	$date=date_create($checks[$i]);
 $fdate = date_format($date,"D d");
	$prem[] = array("date"=>$checks[$i],"is_complete"=>0,"format_date"=>$fdate);
}	
			}
			$kop['totaldates'] = $prem;
			$pdata[] = $kop;
		}
		$pp['Order_Product_Data'] = $pdata;
		
	}
   
   
      
            
    $returnArr = array("order_data"=>$pp,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Subscribe Order Get successfully!");
  }
  else 
  {
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"No Pending Order Found!");   
  }
}
echo json_encode($returnArr);