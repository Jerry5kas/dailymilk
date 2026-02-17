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
 
 function create_city($title,$image,$status,$d_charge){
$table="tbl_city";
$field_values=array("title","cimg","status","d_charge");
$data_values=array($title,$image,$status,$d_charge);
return $this->Ins_milk_latest($field_values,$data_values,$table);
 }
 
 function update_city($id,$title,$status,$d_charge,$image=null){
$table="tbl_city";
if($image !== null){
$field = array('title'=>$title,'status'=>$status,'cimg'=>$image,'d_charge'=>$d_charge);
}else{
$field = array('title'=>$title,'status'=>$status,'d_charge'=>$d_charge);
}
$where = "where id=".$id;
return $this->Ins_milk_updata($field,$table,$where);
 }
 
 function create_banner($image,$status,$cid){
$table="tbl_banner";
$field_values=array("bimg","status","cid");
$data_values=array($image,$status,$cid);
return $this->Ins_milk_latest($field_values,$data_values,$table);
 }
 
 function update_banner($id,$status,$cid,$image=null){
$table="tbl_banner";
if($image !== null){
$field = array('status'=>$status,'bimg'=>$image,'cid'=>$cid);
}else{
$field = array('status'=>$status,'cid'=>$cid);
}
$where = "where id=".$id;
return $this->Ins_milk_updata($field,$table,$where);
 }
 
 function create_category($title,$image,$status){
$table="tbl_cat";
$field_values=array("title","cimg","status");
$data_values=array($title,$image,$status);
return $this->Ins_milk_latest($field_values,$data_values,$table);
 }
 
 function update_category($id,$title,$status,$image=null){
$table="tbl_cat";
if($image !== null){
$field = array('title'=>$title,'status'=>$status,'cimg'=>$image);
}else{
$field = array('title'=>$title,'status'=>$status);
}
$where = "where id=".$id;
return $this->Ins_milk_updata($field,$table,$where);
 }
 
 function create_subcategory($cid,$title,$image,$status){
$table="tbl_subcat";
$field_values=array("cid","title","cimg","status");
$data_values=array($cid,$title,$image,$status);
return $this->Ins_milk_latest($field_values,$data_values,$table);
 }
 
 function update_subcategory($id,$cid,$title,$status,$image=null){
$table="tbl_subcat";
if($image !== null){
$field = array('title'=>$title,'status'=>$status,'cimg'=>$image,'cid'=>$cid);
}else{
$field = array('title'=>$title,'status'=>$status,'cid'=>$cid);
}
$where = "where id=".$id;
return $this->Ins_milk_updata($field,$table,$where);
 }
 
 function create_collection($title,$image,$status,$city,$product){
$table="tbl_collection";
$field_values=array("title","cimg","status","cid","pid");
$data_values=array($title,$image,$status,$city,$product);
return $this->Ins_milk_latest($field_values,$data_values,$table);
 }
 
 function update_collection($id,$title,$status,$city,$product,$image=null){
$table="tbl_collection";
if($image !== null){
$field = array('title'=>$title,'status'=>$status,'cimg'=>$image,'cid'=>$city,'pid'=>$product);
}else{
$field = array('title'=>$title,'status'=>$status,'cid'=>$city,'pid'=>$product);
}
$where = "where id=".$id;
return $this->Ins_milk_updata($field,$table,$where);
 }
 
 function create_coupon($image,$cdesc,$cvalue,$ccode,$cstatus,$cdate,$ctitle,$minamt){
$table="tbl_coupon";
$field_values=array("c_img","c_desc","c_value","c_title","status","cdate","ctitle","min_amt");
$data_values=array($image,$cdesc,$cvalue,$ccode,$cstatus,$cdate,$ctitle,$minamt);
return $this->Ins_milk_latest($field_values,$data_values,$table);
 }
 
 function update_coupon($id,$cdesc,$cvalue,$ccode,$cstatus,$cdate,$ctitle,$minamt,$image=null){
$table="tbl_coupon";
if($image !== null){
$field = array('c_img'=>$image,'c_desc'=>$cdesc,'c_value'=>$cvalue,'c_title'=>$ccode,'status'=>$cstatus,'cdate'=>$cdate,'ctitle'=>$ctitle,'min_amt'=>$minamt);
}else{
$field = array('c_desc'=>$cdesc,'c_value'=>$cvalue,'c_title'=>$ccode,'status'=>$cstatus,'cdate'=>$cdate,'ctitle'=>$ctitle,'min_amt'=>$minamt);
}
$where = "where id=".$id;
return $this->Ins_milk_updata($field,$table,$where);
 }
 
 function create_product($image,$city,$cat,$subcat,$status,$ptitle){
$table="tbl_product";
$field_values=array("pimg","cityid","catid","subcatid","status","ptitle");
$data_values=array($image,$city,$cat,$subcat,$status,$ptitle);
return $this->Ins_milk_latest($field_values,$data_values,$table);
 }
 
 function update_product($id,$city,$cat,$subcat,$status,$ptitle,$image=null){
$table="tbl_product";
if($image !== null){
$field=array('pimg'=>$image,'cityid'=>$city,'catid'=>$cat,'subcatid'=>$subcat,'status'=>$status,'ptitle'=>$ptitle);
}else{
$field=array('cityid'=>$city,'catid'=>$cat,'subcatid'=>$subcat,'status'=>$status,'ptitle'=>$ptitle);
}
$where = "where id=".$id;
return $this->Ins_milk_updata($field,$table,$where);
 }
 
 function update_payment($id,$title,$subtitle,$attributes,$status,$p_show,$image=null){
$table="tbl_payment_list";
if($image !== null){
$field = array('title'=>$title,'status'=>$status,'img'=>$image,'attributes'=>$attributes,'subtitle'=>$subtitle,'p_show'=>$p_show);
}else{
$field = array('title'=>$title,'status'=>$status,'attributes'=>$attributes,'subtitle'=>$subtitle,'p_show'=>$p_show);
}
$where = "where id=".$id;
return $this->Ins_milk_updata($field,$table,$where);
 }
 
 function update_setting($field,$id=1){
$table="setting";
$where = "where id=".$id;
return $this->Ins_milk_updata($field,$table,$where);
 }
 
 function cdn_upload($tmp,$fileName,$folder){
$private = config('imagekit.private_key');
if(!$private){return false;}
if(!$folder){$folder = '/';}
else if(substr($folder,0,1) != '/'){ $folder = '/'.$folder; }
if(!is_readable($tmp)){return false;}
$url = "https://upload.imagekit.io/api/v1/files/upload";
$attempts = 0;
while($attempts < 2){
$attempts++;
$cfile = new CURLFile($tmp, mime_content_type($tmp), $fileName);
$data = array(
  'file' => $cfile,
  'fileName' => $fileName,
  'folder' => $folder,
  'useUniqueFileName' => 'true'
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $private.":");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$response = curl_exec($ch);
if(curl_errno($ch)){
curl_close($ch);
if($attempts >= 2){return false;}
continue;
}
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if($code >= 200 && $code < 300){
$j = json_decode($response,true);
if(isset($j['url']) && $j['url'] != ''){return $j['url'];}
if($attempts >= 2){return false;}
}else{
if($code >= 500 && $attempts < 2){continue;}
return false;
}
}
return false;
}

function upload_image($file,$dir,$folder){
if(!isset($file['tmp_name']) || $file['tmp_name'] === ''){return false;}
if(!is_dir($dir)){mkdir($dir,0777,true);}
$original = isset($file['name']) ? $file['name'] : '';
$ext = '';
$base = '';
if($original !== ''){
$ext = strtolower(pathinfo($original,PATHINFO_EXTENSION));
$base = pathinfo($original,PATHINFO_FILENAME);
}
if($base === ''){$base = 'file';}
$base = strtolower($base);
$base = str_replace(' ','-',$base);
$base = preg_replace('/[^a-z0-9_\-]/','',$base);
if($base === ''){$base = 'file';}
$base = substr($base,0,40);
$unique = uniqid();
if($ext !== ''){
$newfilename = $base.'_'.$unique.'.'.$ext;
}else{
$newfilename = $base.'_'.$unique;
}
$target_file = $dir . $newfilename;
$cdn = $this->cdn_upload($file['tmp_name'],$newfilename,$folder);
if($cdn){return $cdn;}
move_uploaded_file($file['tmp_name'],$target_file);
return $target_file;
}

function upload_product_image($file){
return $this->upload_image($file,'product/','/product');
}
 
}
?>
