<?php 
require dirname( dirname(__FILE__) ).'/include/milkprams.php';
require dirname( dirname(__FILE__) ).'/include/Milkman.php';
require dirname( dirname(__FILE__) ).'/app/Services/OrderService.php';
$getkey = $mysqli->query("select * from setting")->fetch_assoc();
define('ONE_KEY',$getkey['one_key']);
define('ONE_HASH',$getkey['one_hash']);
ini_set('display_errors', 0); ini_set('display_startup_errors', 0); error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
header( 'Content-Type: text/html; charset=utf-8' ); 
$data = json_decode(file_get_contents('php://input'), true);

$returnArr = \App\Services\OrderService::changeSubscribeOrderStatus($mysqli, $set, $data);
echo json_encode($returnArr);
mysqli_close($mysqli);
?>
