<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';
require dirname( dirname(__FILE__) ).'/include/Milkman.php';
require dirname( dirname(__FILE__) ).'/app/Services/UserService.php';
header('Content-type: text/json');
ini_set('display_errors', 0); ini_set('display_startup_errors', 0); error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$data = json_decode(file_get_contents('php://input'), true);

if(!is_array($data))
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $uid = isset($data['uid']) ? trim($data['uid']) : '';
$wallet = isset($data['wallet']) ? trim($data['wallet']) : '';
if($uid == '' or $wallet == '' or !is_numeric($uid) or !is_numeric($wallet) or $wallet <= 0)
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $wallet = strip_tags(mysqli_real_escape_string($mysqli,$wallet));
    $uid =  strip_tags(mysqli_real_escape_string($mysqli,$uid));
    $checkimei = mysqli_num_rows(mysqli_query($mysqli,"select * from tbl_user where  `id`=".$uid.""));

    if($checkimei != 0)
    {
        $newWallet = \App\Services\UserService::addWalletAmount($mysqli, $uid, $wallet);
        if ($newWallet === null) {
            $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Deactivate By Admin!!!!");
        } else {
            $returnArr = array("wallet"=>$newWallet,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Wallet Update successfully!");
        }
    }
    else
    {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Deactivate By Admin!!!!");  
    }
}
}
echo json_encode($returnArr);
