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
								if(isset($_GET['collectionid']))
								{
									?>
									 <li class="breadcrumb-item"><a href="#">Update Collection</a></li>
									<?php 
								}
								else 
								{
									?>
                                <li class="breadcrumb-item"><a href="#">Add Collection</a></li>
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
								if(isset($_GET['collectionid']))
								{
								$data = $mysqli->query("select * from tbl_collection where id=".$_GET['collectionid']."")->fetch_assoc();
								?>
								<form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Collection Name</label>
                                        <input type="text" class="form-control" name="cname"  value="<?php echo $data['title'];?>" placeholder="Enter Collection Name" required>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Collection Image</label>
                                        <input type="file" class="form-control" id="exampleInputPassword1" name="cimg">
										<br>
										<img src="<?php echo $data['cimg']?>" width="100px"/>
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputPassword1">City</label>
                                        <select name="city" id="city" class="form-control select2-single" required>
										<option value="">select city</option>
									   <?php 
									   $product = $mysqli->query("select * from tbl_city");
									   while($row = $product->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>" <?php if($row['id'] == $data['cid']){echo 'selected';}?>><?php echo $row['title'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputPassword1">Collection Product</label>
                                        <select name="product[]" id="product" class="select2-multi-select form-control" required multiple>
									   <?php 
									   $product = $mysqli->query("select * from tbl_product where cityid=".$data['cid']."");
									   $people = explode(',',$data['pid']);
									   while($row = $product->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>" <?php if(in_array($row['id'], $people)){echo 'selected';}?>><?php echo $row['ptitle'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Collection Status</label>
                                        <select name="status" class="form-control" required>
										<option value="">Select Status</option>
										<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
										<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" class="btn btn-primary" name="updatecoll">Update Collection</button>
                                </form>
								<?php } else { ?>
                               <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Collection Name</label>
                                        <input type="text" class="form-control" name="cname"  placeholder="Enter Collection Name" required>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Collection Image</label>
                                        <input type="file" class="form-control" id="exampleInputPassword1" name="cimg" required>
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputPassword1">City</label>
                                        <select name="city" id="city" class="form-control select2-single" required>
										<option value="">select city</option>
									   <?php 
									   $product = $mysqli->query("select * from tbl_city");
									   while($row = $product->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputPassword1">Collection Product</label>
                                        <select name="product[]" id="product" class="select2-multi-select form-control" required multiple>
									   
									   </select>
                                    </div>
									
									<div class="form-group">
                                        <label for="exampleInputEmail1">Collection Status</label>
                                        <select name="status" class="form-control" required>
										<option value="">Select Status</option>
										<option value="1">Publish</option>
										<option value="0">Unpublish</option>
										</select>
                                        
                                    </div>
									
                                   
                                    <button type="submit" class="btn btn-primary" name="addcoll">Add Collection</button>
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
    <!-- End js -->
	
	<?php 
		if(isset($_POST['addcoll']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$city = $_POST['city'];
			$product = implode(',',$_POST['product']);
			 $okey = $_POST['status'];
			$target_dir = "collection/";
			$temp = explode(".", $_FILES["cimg"]["name"]);
$newfilename = uniqid().round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
   
			
		move_uploaded_file($_FILES["cimg"]["tmp_name"], $target_file);
				


  $table="tbl_collection";
  $field_values=array("title","cimg","status","cid","pid");
  $data_values=array("$dname","$target_file","$okey","$city","$product");
  
$h = new Milkman();
	  $check = $h->Ins_milk_latest($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Collection Section!!',
    message: 'Collection Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="addcoll.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
		
		<?php 
		if(isset($_POST['updatecoll']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$city = $_POST['city'];
			$product = implode(',',$_POST['product']);
			 $okey = $_POST['status'];
			$target_dir = "collection/";
			$temp = explode(".", $_FILES["cimg"]["name"]);
$newfilename = uniqid().round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cimg"]["name"] != '')
	{		
   
			
		move_uploaded_file($_FILES["cimg"]["tmp_name"], $target_file);
				 
$table="tbl_collection";
  $field = array('title'=>$dname,'status'=>$okey,'cimg'=>$target_file,'cid'=>$city,'pid'=>$product);
  $where = "where id=".$_GET['collectionid']."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Collection Section!!',
    message: 'Collection Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listcoll.php";}, 3000);
</script>
<?php 
		
	}
	else 
	{
		
		$table="tbl_collection";
  $field = array('title'=>$dname,'status'=>$okey,'cid'=>$city,'pid'=>$product);
  $where = "where id=".$_GET['collectionid']."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Collection Section!!',
    message: 'Collection Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listcoll.php";}, 3000);
</script>
<?php 
	}
		}
		?>
		
		<script>
   $(document).on('change','#city',function()
	{
		var value = $(this).val();
		
		$.ajax({
			type:'post',
			url:'getproduct.php',
			data:
			{
				cityid:value
			},
			success:function(data)
			{
				$('#product').html(data);
			}
		});
	});
	</script>
</body>


</html>