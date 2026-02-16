<?php 
require 'milkprams.php';
$GLOBALS['mysqli'] = $mysqli;
class Milkman {
 

	function lg_v_ub($username,$password,$tblname) {
		
		
		$q = "select * from ".$tblname." where username='".$username."' and password='".$password."'";
	return $GLOBALS['mysqli']->query($q)->num_rows;
		
	}
	
	function Ins_milk_latest($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['mysqli']->query($sql);
  return $result;
  }
  
  function Ins_Milk_id($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['mysqli']->query($sql);
  return $GLOBALS['mysqli']->insert_id;
  }
  
  function Ins_milk_latest_Api($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['mysqli']->query($sql);
  return $result;
  }
  
  function Ins_Milk_Api_id($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['mysqli']->query($sql);
  return $GLOBALS['mysqli']->insert_id;
  }
  
  function Ins_milk_updata($field,$table,$where){
$cols = array();

    foreach($field as $key=>$val) {
        if($val != NULL) // check if value is not null then only add that colunm to array
        {
           $cols[] = "$key = '$val'"; 
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
$result=$GLOBALS['mysqli']->query($sql);
    return $result;
  }
  
   function Ins_milk_updata_Api($field,$table,$where){
$cols = array();

    foreach($field as $key=>$val) {
        if($val != NULL) // check if value is not null then only add that colunm to array
        {
           $cols[] = "$key = '$val'"; 
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
$result=$GLOBALS['mysqli']->query($sql);
    return $result;
  }
  
  
  
  
  function Ins_milk_updatasingle($field,$table,$where){
$query = "UPDATE $table SET $field";

$sql =  $query.' '.$where;
$result=$GLOBALS['mysqli']->query($sql);
  return $result;
  }
  
  function Ins_milk_deldata($where,$table){

    $sql = "Delete From $table $where";
    $result=$GLOBALS['mysqli']->query($sql);
  return $result;
  }
 
}
?>