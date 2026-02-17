<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';
require dirname( dirname(__FILE__) ).'/include/Milkman.php';
require dirname( dirname(__FILE__) ).'/app/Services/OrderService.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 0); ini_set('display_startup_errors', 0); error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

if($data['uid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	if($data['type'] == 'Normal')
	{
        list($oid, $wallet) = \App\Services\OrderService::createNormalOrder($mysqli, $set, $data);
        $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Placed Successfully!!!","wallet"=>$wallet);
	}
	else 
	{
        list($oid, $wallet) = \App\Services\OrderService::createSubscribeOrder($mysqli, $set, $data);
        $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Subscribe Order Placed Successfully!!!","wallet"=>$wallet);
	}
}

echo json_encode($returnArr);
