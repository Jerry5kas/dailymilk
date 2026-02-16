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
                                <li class="breadcrumb-item"><a href="#">Add Delivery Boy</a></li>
                               
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
                                
                                <form method="POST">
                                          <div class="form-body row">
								

								
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Delivery Boy Name</label>
									<input type="text" id="aname" class="form-control" placeholder="Enter Delivery Boy Name"  name="cname" required >
								</div>
								</div>
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								
								<div class="form-group">
									<label for="cname">Delivery Boy Mobile Number(Only Digit)</label>
									<input type="text" id="dcharge"  maxlength="10" class="form-control" pattern="[0-9]+"  placeholder="Enter Delivery Boy Mobile Number" name="dcharge" required >
								</div>
								</div>
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Delivery Boy Email Address</label>
									<input type="email"   class="form-control"   placeholder="Enter Delivery Boy Email Address" name="email" required >
								</div>
								</div>
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Delivery Boy Password</label>
									<input type="text"   class="form-control"   placeholder="Enter Delivery Boy Password" name="password" required >
								</div>
								</div>
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
 	
 <div class="form-group">
									<label for="cname">Select A City</label>
									<select name="area_id" id="sub_list" class="form-control select2-single" required>
									   <option value="">Select A City</option>
									  <?php
									    $sr = $mysqli->query("select * from tbl_city where status=1");
									    while($r = $sr->fetch_assoc())
									    {
									    ?>
									    <option value="<?php echo $r['id'];?>"><?php echo $r['title'];?></option>
									    <?php } ?>
									   
									</select>
								</div>
								</div>
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Status</label>
									<select name="status" class="form-control">
									    <option value="1">Active</option>
									    <option value="0">Deactive</option>
									</select>
								</div>
</div>

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Admin Commission(%)</label>
									<input type="number"   class="form-control"   placeholder="Enter Admin Commission" name="commission" required >
								</div>
								</div>

 	<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Delivery Boy  Address</label>
								<textarea style="resize: none;min-height:120px;" class="form-control" name="raddress"></textarea>
								</div>
								</div>
								

							

								
							</div>
									
                                   
                                    <button type="submit" class="btn btn-primary" name="adddeliveryboy">Add Delivery Boy</button>
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
	
	<?php 
		if(isset($_POST['adddeliveryboy']))
		{
			$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
							$status = $_POST['status'];
							$dcharge = $_POST['dcharge'];
							$password = $_POST['password'];
							$email = $_POST['email'];
							$raddress = $_POST['raddress'];
							$area_id = $_POST['area_id'];
							$commission = $_POST['commission'];
							
						$check_email = $mysqli->query("select * from tbl_rider where email='".$email."'")->num_rows;
						$check_mobile = $mysqli->query("select * from tbl_rider where mobile='".$dcharge."'")->num_rows;
			
				
if($check_email != 0)
						{
							?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Delivery Boy Section!!',
    message: 'Email Address Already Used!!',
    position: 'topRight'
  });
  </script>
  
<?php 
						}
						else if($check_mobile != 0)
						{
							?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Delivery Boy Section!!',
    message: 'Mobile Number Already Used!!',
    position: 'topRight'
  });
  </script>
  
<?php 
						}
						else 
						{
							

  $table="tbl_rider";
  $field_values=array("name","mobile","email","cid","status","address","password","commission");
  $data_values=array("$cname","$dcharge","$email","$area_id","$status","$raddress","$password","$commission");
  
$h = new Milkman();
	  $check = $h->Ins_milk_latest($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Delivery Boy Section!!',
    message: 'Delivery Boy Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listdeliveryboy.php";}, 3000);
</script>
<?php 
		
		
		}
		}
		?>
		
    <!-- End js -->
</body>


</html>