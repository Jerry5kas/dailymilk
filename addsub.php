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
								if(isset($_GET['subcategoryid']))
								{
									?>
									 <li class="breadcrumb-item"><a href="#">Update Subcategory</a></li>
									<?php 
								}
								else 
								{
									?>
                                <li class="breadcrumb-item"><a href="#">Add Subcategory</a></li>
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
								if(isset($_GET['subcategoryid']))
								{
								$data = $mysqli->query("select * from tbl_subcat where id=".$_GET['subcategoryid']."")->fetch_assoc();
								?>
<form method="POST" enctype="multipart/form-data">
								<div class="form-group">
                                        <label for="exampleInputEmail1">Select Category</label>
                                       <select name="cat" class="form-control select2-single" required>
									   <option value="">Select Category</option>
									   <?php
                                     $cat = $mysqli->query("select * from tbl_cat where status=1");
while($row = $cat->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $data['cid']) {echo 'selected';} ?>><?php echo $row['title'];?></option>
	<?php 
}	
									   ?>
									   </select>
                                        
                                    </div>
									
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Subcategory Name</label>
                                        <input type="text" class="form-control" name="cname"  value="<?php echo $data['title'];?>" placeholder="Enter Subcategory Name" required>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Subcategory Image</label>
                                        <input type="file" class="form-control" id="exampleInputPassword1" name="cimg">
										<img src="<?php echo $data['cimg']?>" width="100px"/>
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Subcategory Status</label>
                                        <select class="form-control" name="status" required>
										<option value="">Select Status</option>
										<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
										<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" name="updatesub" class="btn btn-primary">Update Subcategory</button>
                                </form>
								<?php } else { ?>
								
                                <form method="POST" enctype="multipart/form-data">
								<div class="form-group">
                                        <label for="exampleInputEmail1">Select Category</label>
                                       <select name="cat" class="form-control select2-single" required>
									   <option value="">Select Category</option>
									   <?php
                                     $cat = $mysqli->query("select * from tbl_cat where status=1");
while($row = $cat->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
	<?php 
}	
									   ?>
									   </select>
                                        
                                    </div>
									
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Subcategory Name</label>
                                        <input type="text" class="form-control" name="cname"  placeholder="Enter Subcategory Name" required>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Subcategory Image</label>
                                        <input type="file" class="form-control" id="exampleInputPassword1" name="cimg" required>
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Subcategory Status</label>
                                        <select class="form-control" name="status" required>
										<option value="">Select Status</option>
										<option value="1">Publish</option>
										<option value="0">Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" name="addsub" class="btn btn-primary">Add Subcategory</button>
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
		if(isset($_POST['addsub']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$cid = $_POST['cat'];
			$okey = $_POST['status'];
			$target_dir = "subcategory/";
			$temp = explode(".", $_FILES["cimg"]["name"]);
$newfilename = uniqid().round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
   
			
		move_uploaded_file($_FILES["cimg"]["tmp_name"], $target_file);
				


  $table="tbl_subcat";
  $field_values=array("cid","title","cimg","status");
  $data_values=array("$cid","$dname","$target_file","$okey");
  
$h = new Milkman();
	  $check = $h->Ins_milk_latest($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Subcategory Section!!',
    message: 'Subcategory Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="addsub.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
		
		<?php 
		if(isset($_POST['updatesub']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$cid = $_POST['cat'];
			$okey = $_POST['status'];
			$target_dir = "subcategory/";
			$temp = explode(".", $_FILES["cimg"]["name"]);
$newfilename = uniqid().round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cimg"]["name"] != '')
	{		
   
			
		move_uploaded_file($_FILES["cimg"]["tmp_name"], $target_file);
				 
$table="tbl_subcat";
  $field = array('title'=>$dname,'status'=>$okey,'cimg'=>$target_file,'cid'=>$cid);
  $where = "where id=".$_GET['subcategoryid']."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Subcategory Section!!',
    message: 'Subcategory Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listsub.php";}, 3000);
</script>
<?php 
		
		
	}
	else 
	{
		
		$table="tbl_subcat";
  $field = array('title'=>$dname,'status'=>$okey,'cid'=>$cid);
  $where = "where id=".$_GET['subcategoryid']."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Subcategory Section!!',
    message: 'Subcategory Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listsub.php";}, 3000);
</script>
<?php 
	}
		}
		?>
    <!-- End js -->
</body>


</html>