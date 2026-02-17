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
                               <?php 
								if(isset($_GET['bannerid']))
								{
									?>
									 <li class="breadcrumb-item"><a href="#">Update Banner</a></li>
									<?php 
								}
								else 
								{
									?>
                                <li class="breadcrumb-item"><a href="#">Add Banner</a></li>
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
								if(isset($_GET['bannerid']))
								{
								$data = $mysqli->query("select * from tbl_banner where id=".$_GET['bannerid']."")->fetch_assoc();
								?>
								<form method="POST" enctype="multipart/form-data">
                                   
								   <div class="form-group">
                                        <label for="exampleInputEmail1">Select Category</label>
                                       <select name="cat" class="form-control select2-single" required>
									   <option value="0">Select Category</option>
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
                                        <label for="exampleInputPassword1">Banner Image</label>
                                        <input type="file" class="form-control" id="exampleInputPassword1" name="cimg">
										<img src="<?php echo $data['bimg']?>" width="100px"/>
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Banner Status</label>
                                        <select class="form-control" name="status" required>
										<option value="">Select Status</option>
										<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
										<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" name="updatebanner" class="btn btn-primary">Update Banner</button>
                                </form>
								<?php } else { ?>
                                <form method="POST" enctype="multipart/form-data">
                                   
								   <div class="form-group">
                                        <label for="exampleInputEmail1">Select Category</label>
                                       <select name="cat" class="form-control select2-single" required>
									   <option value="0">Select Category</option>
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
                                        <label for="exampleInputPassword1">Banner Image</label>
                                        <input type="file" class="form-control" id="exampleInputPassword1" name="cimg" required>
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Banner Status</label>
                                        <select class="form-control" name="status" required>
										<option value="">Select Status</option>
										<option value="1">Publish</option>
										<option value="0">Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" name="addbanner" class="btn btn-primary">Add Banner</button>
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
		if(isset($_POST['addbanner']))
		{
			$okey = $_POST['status'];
			$cid = $_POST['cat'];
		$h = new Milkman();
$image = $h->upload_image($_FILES["cimg"],'banner/','/banner');
	  $check = $h->create_banner($image,$okey,$cid);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Banner Section!!',
    message: 'Banner Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="addbanner.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
		
		<?php 
		if(isset($_POST['updatebanner']))
		{
			$okey = $_POST['status'];
			$cid = $_POST['cat'];
	if($_FILES["cimg"]["name"] != '')
	{		
$h = new Milkman();
$image = $h->upload_image($_FILES["cimg"],'banner/','/banner');
	  $check = $h->update_banner($_GET['bannerid'],$okey,$cid,$image);
	  
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Banner Section!!',
    message: 'Banner Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listbanner.php";}, 3000);
</script>
<?php 
		
		
	}
	else 
	{
		
$h = new Milkman();
	  $check = $h->update_banner($_GET['bannerid'],$okey,$cid);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Banner Section!!',
    message: 'Banner Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listbanner.php";}, 3000);
</script>
<?php 
	}
		}
		?>
    <!-- End js -->
</body>


</html>
