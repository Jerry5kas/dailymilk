<!DOCTYPE html>
<html lang="en">

<?php require 'include/header.php';
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
                               
                                <li class="breadcrumb-item"><a href="#">Update Payment Gateway</a></li>
								
                               
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
				if(isset($_GET['paymentid']))
				{
					$data = $mysqli->query("select * from tbl_payment_list where id=".$_GET['paymentid']."")->fetch_assoc();
					?>
								<form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                            <label>Payment Gateway Name</label>
                                            <input type="text" class="form-control " disabled placeholder="Enter Payment Gateway Name" value="<?php echo $data['title'];?>" name="cname" required="">
                                        </div>
										
										<div class="form-group">
                                            <label>Payment Gateway SubTitle</label>
                                            <input type="text" class="form-control" placeholder="Enter Payment Gateway SubTitle" value="<?php echo $data['subtitle'];?>" name="ptitle" required="">
                                        </div>
										
                                        <div class="form-group">
                                            <label>Payment Gateway Image</label>
                                            <input type="file" class="form-control" name="cat_img">
											<img src="<?php echo $data['img']?>" width="100px"/>
                                        </div>
										<div class="form-group">
                                            <label>Payment Gateway Attributes<?php if($_GET['paymentid'] == 3){echo ' ( 1 for Live Paypal And 0 for Sendbox Paypal. )';}?></label>
                                            <input type="text" class="form-control" id="p_attr" value="<?php echo $data['attributes'];?>" name="p_attr"  required="">
                                        </div>
										
										 <div class="form-group">
                                            <label>Payment Gateway Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label>Show On Wallet?</label>
                                            <select name="p_show" class="form-control">
											<option value="1" <?php if($data['p_show'] == 1){echo 'selected';}?>>Yes</option>
											<option value="0" <?php if($data['p_show'] == 0){echo 'selected';}?> >No</option>
											</select>
                                        </div>
									
                                   
                                    <button type="submit" name="updatepayment" class="btn btn-primary">Update Payment Gateway</button>
                                </form>
							<?php 
				}
				else 
				{
					?>
					<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'Insert Operation DISABLED!!',
    message: 'New Payment Gateway Not Add!!',
    position: 'topRight'
  });
  
	 </script>
	 
	 <script>
setTimeout(function(){ window.location.href="paymentlist.php";}, 2000);
</script>
	 
				<?php } ?>	
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
	
	<script>
$('#p_attr').tagsinput('items');

</script>

<?php 
		if(isset($_POST['updatepayment']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$attributes = mysqli_real_escape_string($mysqli,$_POST['p_attr']);
			$ptitle = mysqli_real_escape_string($mysqli,$_POST['ptitle']);
			$okey = $_POST['status'];
			$p_show = $_POST['p_show'];
			$target_dir = "payment/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
    
			
		 move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_payment_list";
  $field = array('title'=>$dname,'status'=>$okey,'img'=>$target_file,'attributes'=>$attributes,'subtitle'=>$ptitle,'p_show'=>$p_show);
  $where = "where id=".$_GET['paymentid']."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Payment Gateway Section!!',
    message: 'Payment Gateway Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="paymentlist.php";}, 3000);
</script>
<?php 
		
		
	}
	else 
	{
		
		$table="tbl_payment_list";
  $field = array('title'=>$dname,'status'=>$okey,'attributes'=>$attributes,'subtitle'=>$ptitle,'p_show'=>$p_show);
  $where = "where id=".$_GET['paymentid']."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Payment Gateway Section!!',
    message: 'Payment Gateway Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="paymentlist.php";}, 3000);
</script>
<?php 
	}
		}
		?>
    <!-- End js -->
</body>


</html>