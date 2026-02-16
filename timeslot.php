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
								if(isset($_GET['timeid']))
								{
									?>
									 <li class="breadcrumb-item"><a href="#">Update Timeslot</a></li>
									<?php 
								}
								else 
								{
									?>
                                <li class="breadcrumb-item"><a href="#">Add Timeslot</a></li>
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
								if(isset($_GET['timeid']))
								{
								$data = $mysqli->query("select * from timeslot where id=".$_GET['timeid']."")->fetch_assoc();
								?>
								<form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">
								

								

								<div class="form-group">
									<label for="cname">Time Slot Min Time</label>
									<input type="time" id="mintime" value="<?php echo $data['mintime'];?>" class="form-control"  name="mintime" required >
								</div>
								<div class="form-group">
									<label for="cname">Time Slot Max Time</label>
									<input type="time" id="mintime" value="<?php echo $data['maxtime'];?>" class="form-control"  name="maxtime" required >
								</div>

								

							
							

							<div class="form-actions">
								
								<button type="submit" name="up_cat" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Update Timeslot
								</button>
							</div>
							
							
						</form>
								<?php }else {
?>
<form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">
								

								

								<div class="form-group">
									<label for="cname">Min Time Sloat</label>
									<input type="time" id="mintime" class="form-control"  name="mintime" required >
								</div>
								
								<div class="form-group">
									<label for="cname">Max Time Sloat</label>
									<input type="time" id="maxtime" class="form-control"  name="maxtime" required >
								</div>

									


							

								
							</div>

							<div class="form-actions">
								
								<button type="submit" name="sub_cat" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Save Time Sloat
								</button>
							</div>
							
							
						</form>
<?php 
									}?>
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
		if(isset($_POST['sub_cat']))
		{
			
			$mintime = mysqli_real_escape_string($mysqli,$_POST['mintime']);
							
							$maxtime = mysqli_real_escape_string($mysqli,$_POST['maxtime']);

  $table="timeslot";
  $field_values=array("mintime","maxtime");
  $data_values=array("$mintime","$maxtime");
  
$h = new Milkman();
	  $check = $h->Ins_milk_latest($field_values,$data_values,$table);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Timeslot Section!!',
    message: 'Timeslot Insert Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="timeslot.php";}, 3000);
</script>
<?php 
		
		
		}
		?>
		
		<?php 
		if(isset($_POST['up_cat']))
		{
			$mintime = mysqli_real_escape_string($mysqli,$_POST['mintime']);
							
							$maxtime = mysqli_real_escape_string($mysqli,$_POST['maxtime']);
		
	
	
		
		$table="timeslot";
  $field = array('mintime'=>$mintime,'maxtime'=>$maxtime);
  $where = "where id=".$_GET['timeid']."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Timeslot Section!!',
    message: 'Timeslot Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="listtime.php";}, 3000);
</script>
<?php 
	
		}
		?>
    <!-- End js -->
</body>


</html>