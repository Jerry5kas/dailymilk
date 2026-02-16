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
                                <?php 
								if(isset($_GET['deliveryid']))
								{
									?>
									 <li class="breadcrumb-item"><a href="#">Update Deliveries</a></li>
									<?php 
								}
								else 
								{
									?>
                                <li class="breadcrumb-item"><a href="#">Add Deliveries</a></li>
								<?php } ?>
                               
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
								if(isset($_GET['deliveryid']))
								{
								$data = $mysqli->query("select * from tbl_delivery where id=".$_GET['deliveryid']."")->fetch_assoc();
								?>
								<form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Deliveries Title</label>
                                        <input type="text" class="form-control" name="cname" value="<?php echo $data['title'];?>"  placeholder="Enter Deliveries Title" required>
                                        
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Deliveries IN Digit</label>
                                        <input type="number" class="form-control" name="ddigit" value="<?php echo $data['de_digit'];?>"  placeholder="Enter Deliveries Digit" required>
                                        
                                    </div>
                                    
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Deliveries Status</label>
                                        <select class="form-control" name="status" required>
										<option value="">Select Status</option>
										<option value="1"<?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
										<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" class="btn btn-primary" name="updatedeliveries">Update Deliveries</button>
                                </form>
								<?php } else { ?>
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Deliveries Title</label>
                                        <input type="text" class="form-control" name="cname"  placeholder="Enter Deliveries Title" required>
                                        
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Deliveries IN Digit</label>
                                        <input type="number" class="form-control" name="ddigit"  placeholder="Enter Deliveries Digit" required>
                                        
                                    </div>
                                    
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Deliveries Status</label>
                                        <select class="form-control" name="status" required>
										<option value="">Select Status</option>
										<option value="1">Publish</option>
										<option value="0">Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" class="btn btn-primary" name="adddeliveries">Add Deliveries</button>
                                </form>
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
	
	<?php 
		if(isset($_POST['updatedeliveries']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$ddigit = $_POST['ddigit'];
			$okey = $_POST['status'];
			
			$table="tbl_delivery";
  $field = array('title'=>$dname,'de_digit'=>$ddigit,'status'=>$okey);
  $where = "where id=".$_GET['deliveryid']."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
	  
			if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Deliveries Section!!',
    message: 'Deliveries Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listdeliveries.php";}, 3000);
</script>
<?php 
		
		}
		?>
			
	<?php 
		if(isset($_POST['adddeliveries']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$ddigit = $_POST['ddigit'];
			$okey = $_POST['status'];
			
		


  $table="tbl_delivery";
  $field_values=array("title","de_digit","status");
  $data_values=array("$dname","$ddigit","$okey");
  
$h = new Milkman();
	  $check = $h->Ins_milk_latest($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Deliveries Section!!',
    message: 'Deliveries Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="adddeliveries.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
    <!-- End js -->
</body>


</html>