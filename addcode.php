<!DOCTYPE html>
<html lang="en">

<?php require 'include/header.php';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
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
								if(isset($_GET['codeid']))
								{
									?>
									 <li class="breadcrumb-item"><a href="#">Update Country Code</a></li>
									<?php 
								}
								else 
								{
									?>
                                <li class="breadcrumb-item"><a href="#">Add Country Code</a></li>
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
								if(isset($_GET['codeid']))
								{
								$data = $mysqli->query("select * from tbl_code where id=".$_GET['codeid']."")->fetch_assoc();
								?>
								
								<form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Country Code</label>
                                        <input type="text" class="form-control" name="cname"  value="<?php echo $data['ccode'];?>" placeholder="Enter Country Code" required>
                                        
                                    </div>
                                    
                                   
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">City Status</label>
                                        <select class="form-control" name="status" required>
										<option value="">Select Status</option>
										<option value="1"  <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
										<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" name="updatecode" class="btn btn-primary">Update Country Code</button>
                                </form>
								
								<?php } else { ?>
								
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Country Code</label>
                                        <input type="text" class="form-control" name="cname"  placeholder="Enter Country Code" required>
                                        
                                    </div>
                                   
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Country Code Status</label>
                                        <select class="form-control" name="status" required>
										<option value="">Select Status</option>
										<option value="1">Publish</option>
										<option value="0">Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" name="addcode" class="btn btn-primary">Add Country Code</button>
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
		if(isset($_POST['addcode']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			
			$okey = $_POST['status'];
			
		
				


  $table="tbl_code";
  $field_values=array("ccode","status");
  $data_values=array("$dname","$okey");
  
$h = new Milkman();
	  $check = $h->Ins_milk_latest($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Country Code Section!!',
    message: 'Country Code Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="addcode.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
		
		<?php 
		if(isset($_POST['updatecode']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			
			$okey = $_POST['status'];
			
			
		
		$table="tbl_code";
  $field = array('ccode'=>$dname,'status'=>$okey);
  $where = "where id=".$_GET['codeid']."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Country Code Section!!',
    message: 'Country Code Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listcode.php";}, 3000);
</script>
<?php 
	}
		
		?>
    <!-- End js -->
</body>


</html>