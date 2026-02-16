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
                                <li class="breadcrumb-item"><a href="#">List User</a></li>
                               
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
                                
                                <div class="table-responsive">
                                    <div id="default-datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row">
									<div class="col-sm-12 col-md-12">
									<div class="row">
									<div class="col-sm-12">
									<table id="data" class="display table table-bordered dataTable dtr-inline" role="grid" aria-describedby="default-datatable_info">
                                         <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Full Name</th>
                                                
                                                
                                                
                                                <th>Mobile</th>
												<th>Status</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											 $stmt = $mysqli->query("SELECT * FROM `tbl_user` order by id desc");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td> <?php echo $row['name']; ?></td>
                                                
												<td> <?php echo $row['mobile']; ?></td>
                                                
                                               
												
												
																								<?php if($row['status'] == 1) { ?>
                                                <td><a href="?id=<?php echo $row['id'];?>&status=0"><div class="badge badge-danger">Make Deactive</div></a></td>
												<?php } else { ?>
												<td><a href="?id=<?php echo $row['id'];?>&status=1"><div class="badge badge-success">Make Active</div></a></td>
												<?php } ?>
												<td>
												<a href="?did=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
												<a href="addresslist.php?uid=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fa fa-map-pin"></i></a>
												<a href="ureports.php?uid=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fa fa-bar-chart"></i></a>
												</td>
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
	<?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="tbl_user";
$where = "where id=".$id."";
$h = new Milkman();
	$check = $h->Ins_milk_deldata($where,$table);

if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Customer Section!!',
    message: 'Customer Delete Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="userlist.php";}, 3000);
</script>
<?php 
}
?>

<?php 
		
		if(isset($_GET['status']))
		{
			
		$id = $_GET['id'];
$status = $_GET['status'];
 $table="tbl_user";
  $field = "status=".$status."";
  $where = "where id=".$id."";
$h = new Milkman();
	  $check = $h->Ins_milk_updatasingle($field,$table,$where);
if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.success({
    title: 'Customer Section!!',
    message: 'Customer Status Update Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="userlist.php";}, 3000);
</script>
<?php 	  
		}
		?>
    <!-- End js -->
</body>


</html>