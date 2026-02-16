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
								if(isset($_GET['cityid']))
								{
									?>
									 <li class="breadcrumb-item"><a href="#">Update City</a></li>
									<?php 
								}
								else 
								{
									?>
                                <li class="breadcrumb-item"><a href="#">Add City</a></li>
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
								if(isset($_GET['cityid']))
								{
								$data = $mysqli->query("select * from tbl_city where id=".$_GET['cityid']."")->fetch_assoc();
								?>
								
								<form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">City Name</label>
                                        <input type="text" class="form-control" name="cname"  value="<?php echo $data['title'];?>" placeholder="Enter City Name" required>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">City Image</label>
                                        <input type="file" class="form-control" id="exampleInputPassword1" name="cimg">
										<img src="<?php echo $data['cimg']?>" width="100px"/>
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Delivery Charge</label>
                                        <input type="number" class="form-control" name="d_charge"  value="<?php echo $data['d_charge'];?>" placeholder="Enter Delivery Charge" required>
                                        
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">City Status</label>
                                        <select class="form-control" name="status" required>
										<option value="">Select Status</option>
										<option value="1"  <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
										<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" name="updatecity" class="btn btn-primary">Update City</button>
                                </form>
								
								<?php } else { ?>
								
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">City Name</label>
                                        <input type="text" class="form-control" name="cname"  placeholder="Enter City Name" required>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">City Image</label>
                                        <input type="file" class="form-control" id="exampleInputPassword1" name="cimg" required>
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Delivery Charge</label>
                                        <input type="number" class="form-control" name="d_charge"  placeholder="Enter Delivery Charge" required>
                                        
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">City Status</label>
                                        <select class="form-control" name="status" required>
										<option value="">Select Status</option>
										<option value="1">Publish</option>
										<option value="0">Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" name="addcity" class="btn btn-primary">Add City</button>
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
		if(isset($_POST['addcity']))
		{
			$dname = mysqli_real_escape_string($mysqli,strtolower($_POST['cname']));
			$d_charge = $_POST['d_charge'];
			$okey = $_POST['status'];
			$target_dir = "city/";
			$temp = explode(".", $_FILES["cimg"]["name"]);
$newfilename = uniqid().round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
    
			
		move_uploaded_file($_FILES["cimg"]["tmp_name"], $target_file);
				


  $table="tbl_city";
  $field_values=array("title","cimg","status","d_charge");
  $data_values=array("$dname","$target_file","$okey","$d_charge");
  
$h = new Milkman();
	  $check = $h->Ins_milk_latest($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'City Section!!',
    message: 'City Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="addcity.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
		
		<?php 
		if(isset($_POST['updatecity']))
		{
			$dname = mysqli_real_escape_string($mysqli,strtolower($_POST['cname']));
			$d_charge = $_POST['d_charge'];
			$okey = $_POST['status'];
			$target_dir = "city/";
			$temp = explode(".", $_FILES["cimg"]["name"]);
$newfilename = uniqid().round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cimg"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["cimg"]["tmp_name"], $target_file);
				 
$table="tbl_city";
  $field = array('title'=>$dname,'status'=>$okey,'cimg'=>$target_file,'d_charge'=>$d_charge);
  $where = "where id=".$_GET['cityid']."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'City Section!!',
    message: 'City Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listcity.php";}, 3000);
</script>
<?php 
		
		
	}
	else 
	{
		
		$table="tbl_city";
  $field = array('title'=>$dname,'status'=>$okey,'d_charge'=>$d_charge);
  $where = "where id=".$_GET['cityid']."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'City Section!!',
    message: 'City Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listcity.php";}, 3000);
</script>
<?php 
	}
		}
		?>
    <!-- End js -->
</body>


</html>