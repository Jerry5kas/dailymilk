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
								if(isset($_GET['productid']))
								{
									?>
									 <li class="breadcrumb-item"><a href="#">Update Product</a></li>
									<?php 
								}
								else 
								{
									?>
                                <li class="breadcrumb-item"><a href="#">Add Product</a></li>
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
				if(isset($_GET['productid']))
				{
					$data = $mysqli->query("select * from tbl_product where id=".$_GET['productid']."")->fetch_assoc();
					?>
					 <form method="POST" enctype="multipart/form-data">
                                   <div class="row">
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Product Image</label>
									<input type="file" name="f_up" class="form-control-file" id="projectinput8">
									<br>
									<img src="<?php echo $data['pimg'];?>" width="100" height="100"/>
								</div>
								</div>
								
							 <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Product title </label>
									<input type="text"  class="form-control" placeholder="Enter Product Title" value="<?php echo $data['ptitle'];?>" name="ptitle" required >
								</div>
							</div>
							
							

  	

<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Product Status </label>
									<select name="status" class="form-control" required>
									<option value="">Select Product Status</option>
									<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
									<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">City </label>
									<select name="city[]" class="form-control select2-multi-select" required multiple>
									<option value="">Select Product City</option>
									<?php
                                     $city = $mysqli->query("select * from tbl_city where status=1");
									 $people = explode(',',$data['cityid']);
while($row = $city->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>" <?php if(in_array($row['id'], $people)){echo 'selected';}?>><?php echo $row['title'];?></option>
	<?php 
}	
									   ?>
									</select>
								</div>
							</div>	
							
							<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Product Category </label>
									<select id="cat_change" name="cat" class="form-control select2-single" required>
									<option value="">Select Product Category</option>
									<?php
                                     $cat = $mysqli->query("select * from tbl_cat where status=1");
while($row = $cat->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"  <?php if($data['catid'] == $row['id']){echo 'selected';}?> ><?php echo $row['title'];?></option>
	<?php 
}	
									   ?>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Product Subcategory </label>
									<select id="sub_list" name="subcat" class="form-control select2-single" required>
									<option value="">Select A Subcategory</option>
								<?php
                                     $subcat = $mysqli->query("select * from tbl_subcat where cid=".$data['catid']." and status=1");
while($row = $subcat->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"  <?php if($data['subcatid'] == $row['id']){echo 'selected';}?> ><?php echo $row['title'];?></option>
	<?php 
}	
									   ?>
									</select>
								</div>
							</div>	
							
							 

							
								
							</div>
									
                                   
                                    <button type="submit" class="btn btn-primary" name="updateproduct">Update Product</button>
                                </form>
				<?php } else { ?>
                               <form method="POST" enctype="multipart/form-data">
                                   <div class="row">
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Product Image</label>
									<input type="file" name="f_up" class="form-control-file" id="projectinput8" required>
								</div>
								</div>
								
							 <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Product title </label>
									<input type="text"  class="form-control" placeholder="Enter Product Title"  name="ptitle" required >
								</div>
							</div>
							
							

  	

<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Product Status </label>
									<select name="status" class="form-control" required>
									<option value="">Select Product Status</option>
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">City(Select Multiple) </label>
									<select name="city[]" class="form-control select2-multi-select" required multiple>
									<option value="">Select Product City</option>
									<?php
                                     $city = $mysqli->query("select * from tbl_city where status=1");
while($row = $city->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
	<?php 
}	
									   ?>
									</select>
								</div>
							</div>	
							
							<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Product Category </label>
									<select id="cat_change" name="cat" class="form-control select2-single" required>
									<option value="">Select Product Category</option>
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
							</div>	
							
							<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Product Subcategory </label>
									<select id="sub_list" name="subcat" class="form-control select2-single" required>
									<option value="">Select A Subcategory</option>
								
									</select>
								</div>
							</div>	
							
							 

							
								
							</div>
									
                                   
                                    <button type="submit" class="btn btn-primary" name="addproduct">Add Product</button>
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
		if(isset($_POST['updateproduct']))
		{
			                $ptitle = $mysqli->real_escape_string($_POST['ptitle']);
$city = implode(',',$_POST['city']);
							$ctitle = $mysqli->real_escape_string($_POST['ctitle']);
							$status = $_POST['status'];
							$cat = $_POST['cat'];
							$subcat = $_POST['subcat'];
if(trim($ptitle) == '' || $status === '' || $cat === '' || $subcat === '' || $city === ''){
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
<script>
iziToast.error({
title: 'Product Section!!',
message: 'Please fill all required fields!!',
position: 'topRight'
});
</script>
<script>
setTimeout(function(){ window.location.href="addproduct.php";}, 3000);
</script>
<?php 
}else{
	if($_FILES["f_up"]["name"] != '')
	{		
$h = new Milkman();
$image = $h->upload_product_image($_FILES["f_up"]);
$check = $h->update_product($_GET['productid'],$city,$cat,$subcat,$status,$ptitle,$image);
	  
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Product Section!!',
    message: 'Product Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listproduct.php";}, 3000);
</script>
<?php 
		
		
	}
	else 
	{
		
		
$h = new Milkman();
	  $check = $h->update_product($_GET['productid'],$city,$cat,$subcat,$status,$ptitle);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Product Section!!',
    message: 'Product Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listproduct.php";}, 3000);
</script>
<?php 
	}
		}
}
		?>
		
	<?php 
	if(isset($_POST['addproduct']))
	{
		$ptitle = $mysqli->real_escape_string($_POST['ptitle']);
							$city = implode(',',$_POST['city']);
							$ctitle = $mysqli->real_escape_string($_POST['ctitle']);
							$status = $_POST['status'];
							$cat = $_POST['cat'];
							$subcat = $_POST['subcat'];
if(trim($ptitle) == '' || $status === '' || $cat === '' || $subcat === '' || $city === ''){
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
<script>
iziToast.error({
title: 'Product Section!!',
message: 'Please fill all required fields!!',
position: 'topRight'
});
</script>
<script>
setTimeout(function(){ window.location.href="addproduct.php";}, 3000);
</script>
<?php 
}else{
$h = new Milkman();
$image = $h->upload_product_image($_FILES["f_up"]);
	  $check = $h->create_product($image,$city,$cat,$subcat,$status,$ptitle);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Product Section!!',
    message: 'Product Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="addproduct.php";}, 3000);
</script>
<?php 
		
		
	}
}
	?>
	
	<script>
   $(document).on('change','#cat_change',function()
	{
		var value = $(this).val();
		
		$.ajax({
			type:'post',
			url:'getsub.php',
			data:
			{
				catid:value
			},
			success:function(data)
			{
				$('#sub_list').html(data);
			}
		});
	});
	</script>
    <!-- End js -->
</body>


</html>
