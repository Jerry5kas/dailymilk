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
                                <li class="breadcrumb-item"><a href="#">List Report</a></li>
                               
                            </ol>
                        </div>
                    </div>
					
					<div class="col-md-4 col-lg-4">
                        <div class="widgetbar">
                            <a href="userlist.php"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>User List</button></a>
                        </div>                        
                    </div>
                   
                </div>          
            </div>
            <!-- End Breadcrumbbar -->
            <!-- Start Contentbar --> 
			
			<?php 
							
							if(isset($_POST['add_bal']))
							{
								$uid = $_GET['uid'];
								$amt = $_POST['amt'];
								 $vp = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	  
  $table="tbl_user";
  $field = array('wallet'=>$vp['wallet']+$amt);
  $where = "where id=".$uid."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
	  
	   
	   
	   $table="wallet_report";
  $field_values=array("uid","message","status","amt");
  $data_values=array("$uid",'Wallet Balance Added by '.$set['d_title'].'.','Credit',"$amt");
   
      $h = new Milkman();
	  $checks = $h->Ins_milk_latest($field_values,$data_values,$table);
	  if($checks == 1)
{
	?>
	
	<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Wallet Section!!',
    message: 'Wallet Balance Added Successfully!!',
    position: 'topRight'
  });
  </script>
  <script>
setTimeout(function(){ window.location.href="ureports.php?uid="+<?php echo $_GET['uid'];?>;}, 3000);
</script>
	  <?php 
}
else 
{
	?>
	<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Operation DISABLED!!',
    message: 'For Demo purpose all  Insert/Update/Delete are DISABLED !!',
    position: 'topRight'
  });
  </script>
  <script>
setTimeout(function(){ window.location.href="ureports.php?uid="+<?php echo $_GET['uid'];?>;}, 3000);
</script>
	<?php 
}
							}
							?>
							
							<?php 
							if(isset($_POST['sub_bal']))
							{
								$uid = $_GET['uid'];
								$amt = $_POST['amt'];
								 $vp = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	  if($vp['wallet'] >= $amt)
	  {
  $table="tbl_user";
  $field = array('wallet'=>$vp['wallet'] - $amt);
  $where = "where id=".$uid."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
	  
	  
	   
	   $table="wallet_report";
  $field_values=array("uid","message","status","amt");
  $data_values=array("$uid",'Wallet Balance Substract by '.$set['d_title'].'.','Debit',"$amt");
   
      $h = new Milkman();
	  $checks = $h->Ins_milk_latest($field_values,$data_values,$table);
	 if($checks == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Wallet Section!!',
    message: 'Wallet Balance Substract Successfully!!',
    position: 'topRight'
  });
  </script>
  <script>
setTimeout(function(){ window.location.href="ureports.php?uid="+<?php echo $_GET['uid'];?>;}, 3000);
</script>
	 
	  <?php 
}
else 
{
	?>
	<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Operation DISABLED!!',
    message: 'For Demo purpose all  Insert/Update/Delete are DISABLED !!',
    position: 'topRight'
  });
  </script>
  <script>
setTimeout(function(){ window.location.href="ureports.php?uid="+<?php echo $_GET['uid'];?>;}, 3000);
</script>
	<?php 
}
							}
							else 
							{
								 ?>
								 
								 <script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Wallet Section!!',
    message: 'Wallet Not Substract Because Your Amount High As Per User Available Balance!!',
    position: 'topRight'
  });
  </script>
  <script>
setTimeout(function(){ window.location.href="ureports.php?uid="+<?php echo $_GET['uid'];?>;}, 3000);
</script>
	 
	  <?php 
							}
							}
							?>
							
<?php 
						if(isset($_GET['uid']))
						{
							$udata = $mysqli->query("select * from tbl_user where id=".$_GET['uid']."")->fetch_assoc();
							if($udata['name'] == '')
							{
								?>
								<script>
						window.location.href="userlist.php";
						</script>
								<?php 
							}
						}
					else 
					{
						?>
						<script>
						window.location.href="userlist.php";
						</script>
						<?php 
					}
						
						?>
						
            <div class="contentbar"> 
<div class="section-header">			
<h5 class="card-title"><?php echo $udata['name'];?> Card Report</h5>
</div>
<div class="row">
                    <!-- Start col -->
                    <div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                   
									<i class="fa fa-shopping-bag mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total Normal Orders</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_normal_order where uid=".$_GET['uid']."")->num_rows;?></p>                                                             
                                    </div>
									<i class="fa fa-shopping-bag action-bg rounded-circle text-success"></i>
                                   
                                </div>
                            </div>
                        </div>            
                    </div>
<div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                   
									<i class="fa fa-shopping-bag mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total Subscribe Orders</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_subscribe_order where uid=".$_GET['uid']."")->num_rows;?></p>                                                             
                                    </div>
									<i class="fa fa-shopping-bag action-bg rounded-circle text-success"></i>
                                   
                                </div>
                            </div>
                        </div>            
                    </div>
					
					<div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                   
									<i class="fa fa-money mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Wallet Balance</h5> 
                                        <p class="mb-0"><?php echo $udata['wallet'].' '.$set['currency'];?> </p>                                                             
                                    </div>
									<i class="fa fa-money action-bg rounded-circle text-success"></i>
                                   
                                </div>
                            </div>
                        </div>            
                    </div>
					
</div>	
<div class="section-header">
<h5 class="card-title">Add Balance OR Substract Balance</h5>
</div>
		<div class="row">
<div class="col-lg-12 col-xl-12">		
<div class="card">
				
				
				                                <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="number" class="form-control" placeholder="Enter Amount" name="amt" required="">
                                        </div>
										
										
										
										
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                          <button type="submit" name="add_bal" class="btn btn-info mb-2">+ Add Amount</button>
												<button type="submit" name="sub_bal" class="btn btn-danger mb-2"> - Substract Amount</button>
                                    </div>
                                </form>
				                            </div>
											</div>
											</div>
											<br>
											<div class="section-header">
											<h5 class="card-title"><?php echo $udata['name'];?> Wallet Transaction Report</h5>
											</div>
                <div class="row">
				
			<div class="col-lg-12">
                        <div class="card m-b-30">
                            
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <div id="default-datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row">
									<div class="col-sm-12 col-md-12">
									<div class="row">
									<div class="col-sm-12">
									<table id="data" class="display table  table-bordered dataTable dtr-inline" role="grid" aria-describedby="default-datatable_info">
                                       <thead>
                                            <tr>
                                               <th class="text-center">
                                                    Sr No.
                                                </th>
												<th class="text-center">
                                                   Wallet Id
                                                </th>
												 
                                                <th>Message</th>
                                                
                                                
                                                
                                               
												<th>Status</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                           <?php 
											 $stmt = $mysqli->query("SELECT * FROM `wallet_report` where uid=".$_GET['uid']." order by id desc");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td class="align-middle">
                                                    <?php echo $i; ?>
                                                </td>
												<td class="align-middle"> <?php echo $row['id']; ?></td>
												
                                                <td> <?php echo $row['message']; ?></td>
                                                
												
                                                
                                               
												
												
																								<?php if($row['status'] == 'Credit') { ?>
                                                <td><div class="badge badge-success">Credit</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Debit</div></td>
												<?php } ?>
												
												<?php if($row['status'] == 'Credit') { ?>
                                                <td><div class="text text-success">+ <?php echo $row['amt'];?></div></td>
												<?php } else { ?>
												<td><div class="text text-danger">- <?php echo $row['amt'];?></div></td>
												<?php } ?>
												
                                                </tr>
<?php } ?>                                           
                                        </tbody>
                                        
                                    </table></div></div>
                                </div>
                            </div>
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
	<script>
	$("#data").dataTable();
	</script>
	<style>
	.section-header
	{
		margin: 1px 0px 30px 0 !important;
    border-color: #fff;
    background-color: #fff;
    /* margin-bottom: 0; */
    font-weight: 700;
    /* display: inline-block; */
    font-size: 24px;
    margin-top: 3px;
    padding: 20px;
    color: #0a0a0a;
	}
	</style>
    <!-- End js -->
</body>


</html>