<!DOCTYPE html>
<html lang="en">

<?php require 'include/header.php';
function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}
?>
<body class="vertical-layout">    
    <!-- Start Infobar Setting Sidebar -->
    
    <div class="infobar-settings-sidebar-overlay"></div>
    <!-- End Infobar Setting Sidebar -->
    <!-- Start Containerbar -->
    <div id="containerbar">
        <!-- Start Leftbar -->
       <?php require 'include/sidebar.php';?>
        <!-- End Leftbar -->
        <!-- Start Rightbar -->
        <div class="rightbar">
            <!-- Start Topbar Mobile -->
            
            <!-- Start Topbar -->
            <?php require 'include/navbar.php';?>
            <!-- End Topbar -->
            <!-- Start Breadcrumbbar -->                    
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title"><?php echo $set['d_title'];?></h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pending Order</a></li>
                               
                            </ol>
                        </div>
                    </div>
					
					
                   
                </div>          
            </div>
            <!-- End Breadcrumbbar -->
            <!-- Start Contentbar -->    
            <div class="contentbar">              
                <div class="row">
			<div class="col-lg-12">
                        <div class="card m-b-30">
                            
                            <div class="card-body">
                                 <?php
							   if(isset($_GET['oid']))
				{
							   ?>
							   <form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">
								

							<?php 
							$odata = $mysqli->query("select * from tbl_normal_order where id=".$_GET['oid']."")->fetch_assoc();
							?>

								<div class="form-group">
									<label for="cname">Select Delivery Boy</label>
									<select name="srider" class="form-control">
									<option value="">select a Delivery Boy</option>
									<?php 
									$rid = $mysqli->query("select * from tbl_rider where a_status=1 and status=1");
									while($ro = $rid->fetch_assoc())
									{
									?>
									<option value="<?php echo $ro['id'];?>" <?php if($odata['rid'] == $ro['id']) {echo 'selected';}?>><?php echo $ro['name'];?></option>
									<?php } ?>
									</select>
								</div>
                                
								
								
								<div class=" text-left">
                                        <button name="assign_rider" class="btn btn-primary">Assign Rider</button>
                                    </div>
								</div>
								</form>
								
								<?php 
					if(isset($_POST['assign_rider']))
					{
						
						$rid = $_POST['srider'];
						
						$id = $_GET['oid'];
						$check = $mysqli->query("select * from tbl_normal_order where id=".$id."")->fetch_assoc();
						if($check['rid'] == 0)
						{
							
						$table="tbl_normal_order";
  $field = array('rid'=>$rid);
  $where = "where id=".$id."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
	  
	  
	  $timestamp = date("Y-m-d H:i:s");
						


 $table="tbl_rnoti";
  $field_values=array("rid","msg","date");
  $data_values=array("$rid",'You have an order assigned to you.',"$timestamp");
  
$hs = new Milkman();
	   $hs->Ins_milk_latest($field_values,$data_values,$table);
	  
											$content = array(
"en" => 'You have an order assigned to you.'//mesaj burasi
);
$fields = array(
'app_id' => $set['r_key'],
'included_segments' =>  array("Active Users"),
'filters' => array(array('field' => 'tag', 'key' => 'rider_id', 'relation' => '=', 'value' => $rid)),
'contents' => $content
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['r_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 

curl_close($ch);


if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Delivery Boy Section!!',
    message: 'Delivery Boy Assigned Successfully!!',
    position: 'topRight'
  });
  setTimeout(function(){ window.location.href="porder.php";}, 3000);
  </script>
  
<?php 
}

						}
						else 
						{
							?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Delivery Boy Section!!',
    message: 'Assign Delivery Boy Already Accepted Order So Can not Change Delivery Boy!!',
    position: 'topRight'
  });
  setTimeout(function(){ window.location.href="porder.php";}, 3000);
  </script>
							<?php 
						}
					}
					?>
								
							   <?php } else { ?>
                                <div class="table-responsive">
                                    <div id="default-datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row">
									<div class="col-sm-12 col-md-12">
									<div class="row">
									<div class="col-sm-12">
									<table id="data" class="display table table-bordered dataTable dtr-inline" role="grid" aria-describedby="default-datatable_info">
                                       <thead>
                                                <tr>
                                               <th>#</th>
												 <th>Order Id</th>
                                                 <th>Order Date </th>
												 <th>Delivery Boy Name</th>
                                                 <th>Current Status</th>
												
                                                 <th>Preview Data</th>
												 <th>Order Assign?</th>
												 <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											$i=0;
											 $stmt = $mysqli->query("SELECT * FROM `tbl_normal_order` where status!='Cancelled' and status!='Completed'  order by id desc");

while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
												
												<td><?php echo $i; ?> </td>
												
												<td> <?php echo $row['id']; ?> </td>
                                                
                                                
                                               <td> <?php 
											   $date=date_create($row['odate']);
echo date_format($date,"d-m-Y");
											   ?></td>
											   <td><?php $rdata = $mysqli->query("select * from tbl_rider where id=".$row['rid']."")->fetch_assoc(); if($rdata['name'] == '') {echo '';}else {echo $rdata['name'];}?></td>
											   <td> <?php echo $row['status']; ?></td>
											   
												 <td> <button class="preview_d btn btn-primary" data-id="<?php echo $row['id'];?>" data-toggle="modal" data-target="#myModal">Preview</button></td>
                                                <td>
												<a href="?oid=<?php echo $row['id']; ?>"   class="btn btn-info <?php if($row['status'] == 'Cancelled' or $row['a_status'] == 0 or $row['rid'] != 0){ echo 'disabled'; } ?>"><?php if($row['rid'] != 0){?>Reassign Delivery Boy<?php } else { ?>Assign Delivery Boy<?php } ?></a>
												</td>
												<td>
												<?php if($row['a_status'] == 0){?>
												<a href="?dsid=<?php echo $row['id']; ?>&status=1"  class="btn btn-success">Accept</a>
												<a href="?dsid=<?php echo $row['id']; ?>&status=2"  class="btn btn-danger">Reject</a>
												<?php }else if($row['a_status'] == 1) {?>
												<span class="text text-success">Accepted</span>
												<?php } else { ?>
												<span class="text text-danger"> Rejected </span>
												<?php } ?>
												
												</td>
                                                </tr>
<?php } ?>                                           
                                            </tbody>
                                        
                                    </table></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
							   <?php } ?>
				</div>
            </div>
			</div>
            <!-- End Contentbar -->
            <!-- Start Footerbar -->
           
            <!-- End Footerbar -->
        </div>
        <!-- End Rightbar -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->        
    <?php require 'include/milklife.php';?>
	<script>
	$("#data").dataTable();
	</script>
	
	<?php 
								if(isset($_GET['dsid']))
								{
									$status = $_GET['status'];
									
									if($status == 1)
									{
									 
									 $table="tbl_normal_order";
  $field = array('a_status'=>$status);
  $where = "where id=".$_GET['dsid']."";
  
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
	  
	  $checks = $mysqli->query("select * from tbl_normal_order where id=".$_GET['dsid']."")->fetch_assoc(); 
	  $uid = $checks['uid'];
			$udata = $mysqli->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];

	  $oid = $_GET['dsid'];
	  $timestamp = date("Y-m-d H:i:s");

$title_main = "Order Confirmed!!";
$description = $name.', Your Order #'.$oid.' Has Been Confirmed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Milkman();
	   $h->Ins_milk_latest($field_values,$data_values,$table);
	   
	   
$content = array(
       "en" => $name.', Your Order #'.$_GET['dsid'].' Has Been Confirmed.'
   );
$heading = array(
   "en" => "Order Confirmed!!"
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$_GET['dsid']),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/dailyfresh/order_process_img/confirmed.png'
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


if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Decision Section!!',
    message: 'Approve Decision Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

									}
									else 
									{
										 
										 $table="tbl_normal_order";
  $field = array('a_status'=>$status,'status'=>'Cancelled');
  $where = "where id=".$_GET['dsid']."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Decision Section!!',
    message: 'Reject Decision Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}

									}
									?>
									<script>
setTimeout(function(){ window.location.href="porder.php";}, 3000);
</script>
									<?php 
								}
									?>
									
									<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg ">

    
    <div class="modal-content gray_bg_popup">
      <div class="modal-header">
        <h4>Pending Order Preivew</h4>
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;
    right: 0;
    top: 0;
    width: 50px;
    height: 50px;
    border-radius: 29px;
    padding: 10px;
    background: #5cb85c;
    color: #fff;
    opacity: 1;">&times;</button>
      </div>
      <div class="modal-body p_data">
      
      </div>
     
    </div>

  </div>
</div>

 <?php
 echo $main['milknormal'];
 ?>
    <!-- End js -->
</body>


</html>