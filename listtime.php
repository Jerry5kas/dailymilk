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
                                <li class="breadcrumb-item"><a href="#">List Timeslot</a></li>
                               
                            </ol>
                        </div>
                    </div>
					
					<div class="col-md-4 col-lg-4">
                        <div class="widgetbar">
                            <a href="timeslot.php"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Add Timeslot</button></a>
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
								 <th>Sr No.</th>
                                    <th>Timeslot Min Time</th>
                                   <th>Timeslot Max Time</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sel = $mysqli->query("select * from timeslot");
                                $i=0;
                                while($row = $sel->fetch_assoc())
                                {
                                    $i= $i + 1;
                                ?>
                                <tr>
                                    
                                    <td><?php echo $i; ?></td>
                                    <td><?php  echo date("g:i A", strtotime($row['mintime']));?></td>
                                   <td><?php echo date("g:i A", strtotime($row['maxtime']));?></td>
									<td>
									<a href="timeslot.php?timeid=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fa fa-edit" ></i></a>
												<a href="?did=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
										
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

$table="timeslot";
$where = "where id=".$id."";
$h = new Milkman();
	$check = $h->Ins_milk_deldata($where,$table);

if($check == 1)
{
?>
<script src="assets/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Timeslot Section!!',
    message: 'Timeslot Delete Successfully!!',
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