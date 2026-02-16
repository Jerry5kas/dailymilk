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
                                <li class="breadcrumb-item"><a href="#">List Delivery Boy</a></li>
                               
                            </ol>
                        </div>
                    </div>
					
					<div class="col-md-4 col-lg-4">
                        <div class="widgetbar">
                            <a href="adddeliveryboy.php"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Add Delivery Boy</button></a>
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
                                
                                <div class="table-responsive">
                                    <div id="default-datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row">
									<div class="col-sm-12 col-md-12">
									<div class="row">
									<div class="col-sm-12">
									<table id="data" class="display table  table-bordered dataTable dtr-inline" role="grid" aria-describedby="default-datatable_info">
                                        <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Delivery Boy Name</th>
                                   <th>Delivery Boy Mobile</th>
								    <th>Delivery Boy Email</th>
									
									 <th>Delivery Boy Pincode</th>
									  <th>Delivery Boy Address</th>
									   <th>Delivery Boy Status</th>
									   <th>Delivery Boy App Status(On/Off)</th>
									    
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `tbl_rider`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td><?php echo $row['name'];?></td>
                                   <td><?php echo $row['mobile'];?></td>
								   <td><?php echo $row['email'];?></td>

								   <td><?php $ad = $mysqli->query("select * from tbl_city where id=".$row['cid']."")->fetch_assoc(); echo $ad['title'];?></td>

 <td><?php echo $row['address'];?></td> 


 
 
								  <td><?php if($row['status'] == 1){echo 'Active';}else {echo 'Deactive';}?></td> 
								    <td><?php if($row['a_status'] == 1) {echo 'On';}else {echo 'Off';}?></td> 
								   
                                    <td>
									<?php if($row['status'] == 0) {?>
									<a href="?status=1&rid=<?php echo $row['id'];?>">	<button class="btn btn-success"   data-original-title="" title="">
                                           Make Active
                                        </button></a>
									<?php } else { ?>
								<a	href="?status=0&rid=<?php echo $row['id'];?>">	<button class="btn btn-danger"  href="?status=0&rid=<?php echo $rkl['id'];?>" data-original-title="" title="">
                                            Make Deactive
                                        </button>
										</a>
									<?php } ?>
										</td>
										</tr>
										<?php 
										}
										?>
                                        <tbody>
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
	
	<?php 
if(isset($_GET['status']))
{
$status = $_GET['status'];
$id = $_GET['rid'];
$table="tbl_rider";
  $field = array('status'=>$status);
  $where = "where id=".$id."";
$h = new Milkman();
	  $check = $h->Ins_milk_updata($field,$table,$where);
	  
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Delivery Boy Section!!',
    message: 'Delivery Boy status Update Successfully!!',
    position: 'topRight'
  });
  </script>
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