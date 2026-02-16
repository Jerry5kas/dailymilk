<!DOCTYPE html>
<html lang="en">

<?php require 'include/header.php';?>
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
                                <li class="breadcrumb-item"><a href="#">Send Notification</a></li>
                               
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
                                
                                <form method="post">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Notification Title</label>
                                        <input type="text" class="form-control" name="ntitle"  placeholder="Enter Notification Title" required>
                                        
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Notification Message</label>
                                        <input type="text" class="form-control" name="nmessage"  placeholder="Enter Notification Message" required>
                                        
                                    </div>
									
                                    <div class="form-group">
                                            <label>Notification Image Url(Optional)</label>
                                            <input type="url" class="form-control" name="nurl" placeholder="Enter Notification Url">
                                        </div>
										
										<div class="form-group">
                                            <label>Send User Type?</label>
                                            <select class="form-control" name="type" required="">
											<option value="">Select A Type</option>
											<option value="Customer">Customer</option>
											<option value="DBoy">Delivery Boy</option>
											</select>
                                        </div>
									
									
									
                                   
                                    <button type="submit" name="sendnotification" class="btn btn-primary">Send Notification</button>
                                </form>
                            </div>
                        </div>
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
    <!-- End js -->
	<?php 
		if(isset($_POST['sendnotification']))
		{
			
			
			$ntitle = $_POST['ntitle'];
			$nmessage = $_POST['nmessage'];
			$nurl = $_POST['nurl'];
			$type = $_POST['type'];
			
			if($type == 'Customer')
			{
				$key = $set['one_key'];
				$hash = $set['one_hash'];
			}
			else
			{
				$key = $set['r_key'];
				$hash = $set['r_hash'];
			}
			$content = array(
       "en" => $nmessage
   );
$heading = array(
   "en" => $ntitle
);

if($nurl != '')
{
$fields = array(
'app_id' => $key,
'included_segments' =>  array("Active Users"),
'contents' => $content,
'headings' => $heading,
'big_picture' => $nurl
);
$fields = json_encode($fields);
}
else {
	$fields = array(
'app_id' => $key,
'included_segments' =>  array("Active Users"),
'contents' => $content,
'headings' => $heading
);
$fields = json_encode($fields);
}
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$hash));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Notification Section!!',
    message: 'Notification Send Successfully!!',
    position: 'topRight'
  });
  </script>
<script>
setTimeout(function(){ window.location.href="addnoti.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
</body>


</html>