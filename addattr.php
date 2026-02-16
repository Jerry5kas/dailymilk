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
					$data = $mysqli->query("select * from tbl_product_attribute where id=".$_GET['productid']."")->fetch_assoc();
					?>
					                               <form method="post" >
                                    
                                    
                                        
                                        <div class="row">
								
<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Select product</label>
									<select name="product" class="form-control select2-single" required>
									<option value="">Select product</option>
									<?php 
									$product = $mysqli->query("select * from tbl_product where status=1");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>" <?php if($data['pid'] == $rmed['id']){echo 'selected';}?>><?php echo $rmed['ptitle'];?></option>
									<?php } ?>
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Type</label>
									<input type="text" name="mtype" placeholder="Enter product Type" value="<?php echo $data['title'];?>" class="form-control" required>
								</div>
								</div>
							
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Discount</label>
									<input type="number" name="mdiscount" placeholder="Enter product Discount" value="<?php echo $data['discount'];?>" class="form-control" step="any" required>
								</div>
								</div>
								
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Price</label>
									<input type="number" name="mprice" placeholder="Enter product Price" value="<?php echo $data['price'];?>" class="form-control" required step="any">
								</div>
								</div>
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Subscription Price</label>
									<input type="number" name="sprice" placeholder="Enter product Subscription Price" value="<?php echo $data['sprice'];?>" class="form-control" required step="any">
								</div>
								</div>
								
								
							
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Out OF Stock?</label>
									<select name="mstock" class="form-control" required>
									<option value="">Select Status</option>
									<option value="1" <?php if($data['ostock'] == 1){echo 'selected';}?>>Yes</option>
									<option value="0"<?php if($data['ostock'] == 0){echo 'selected';}?>>No</option>
									
									</select>
								</div>
								</div>
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Subscription Required?</label>
									<select name="srequire" class="form-control" required>
									<option value="">Select Status</option>
									<option value="1" <?php if($data['sreq'] == 1){echo 'selected';}?>>Yes</option>
									<option value="0"<?php if($data['sreq'] == 0){echo 'selected';}?>>No</option>
									
									</select>
								</div>
								</div>

				
								
							</div>
                                        
										
                                    
                                    
                                        <button name="upattr" class="btn btn-primary">Update product Attributes</button>
                                   
                                </form>
				<?php } else { ?>
                               <form method="post" >
                                    
                                    
                                        
                                        <div class="row">
								
<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Select product</label>
									<select name="product" class="form-control select2-single" required>
									<option value="">Select product</option>
									<?php 
									$product = $mysqli->query("select * from tbl_product where status=1");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>"><?php echo $rmed['ptitle'];?></option>
									<?php } ?>
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Type</label>
									<input type="text" name="mtype" placeholder="Enter product Type" value="" class="form-control" required>
								</div>
								</div>
							
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Discount</label>
									<input type="number" name="mdiscount" placeholder="Enter product Discount" value="0" class="form-control" step="any" required>
								</div>
								</div>
								
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Price</label>
									<input type="number" name="mprice" placeholder="Enter product Price" value="" class="form-control" required step="any">
								</div>
								</div>
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Subscription Price</label>
									<input type="number" name="sprice" placeholder="Enter product Subscription Price" value="" class="form-control" required step="any">
								</div>
								</div>
								
								
							
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>product Out OF Stock?</label>
									<select name="mstock" class="form-control" required>
									<option value="">Select Status</option>
									<option value="1" >Yes</option>
									<option value="0">No</option>
									
									</select>
								</div>
								</div>
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Subscription Required?</label>
									<select name="srequire" class="form-control" required>
									<option value="">Select Status</option>
									<option value="1" >Yes</option>
									<option value="0">No</option>
									
									</select>
								</div>
								</div>

				
								
							</div>
                                        
										
                                    
                                    
                                        <button name="addattr" class="btn btn-primary">Add product Attributes</button>
                                   
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
		if(isset($_POST['upattr']))
		{
			
			
            $product = $_POST['product'];
			$mprice = $_POST['mprice'];
			$mtype = stripslashes($mysqli->real_escape_string(trim($_POST['mtype'])));
			$mdiscount = $_POST['mdiscount'];
			$mstock = $_POST['mstock'];
			$sprice = $_POST['sprice'];
			$srequire = $_POST['srequire'];
			$table="tbl_product_attribute";
						
    $field=array('pid'=>$product,'price'=>$mprice,'title'=>$mtype,'discount'=>$mdiscount,'ostock'=>$mstock,'sprice'=>$sprice,'sreq'=>$srequire);
  
  $where = "where id=".$_GET['productid']."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Product Section!!',
    message: 'Product Attributes Update Successfully!!',
    position: 'topRight'
  });
  setTimeout(function(){ window.location.href="listattr.php";}, 3000);
  </script>
  
<?php 
}

		}
		?>
		
	<?php 
	if(isset($_POST['addattr']))
	{
		$product = $_POST['product'];
			$mprice = $_POST['mprice'];
			$sprice = $_POST['sprice'];
			$srequire = $_POST['srequire'];
			$mtype = stripslashes($mysqli->real_escape_string(trim($_POST['mtype'])));
			$mdiscount = $_POST['mdiscount'];
			$mstock = $_POST['mstock'];
  $table="tbl_product_attribute";
  $field_values=array("pid","price","title","discount","ostock","sprice","sreq");
  $data_values=array("$product","$mprice","$mtype","$mdiscount","$mstock","$sprice","$srequire");
  
			$h = new Milkman();
	  $check = $h->Ins_milk_latest($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Product Section!!',
    message: 'Product Attributes Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="addattr.php";}, 3000);
</script>
<?php 
		
		
	}
	?>
	
	
    <!-- End js -->
</body>


</html>