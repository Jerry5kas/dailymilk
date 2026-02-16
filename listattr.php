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
                                <li class="breadcrumb-item"><a href="#">List Product Attributes</a></li>
                               
                            </ol>
                        </div>
                    </div>
					
					<div class="col-md-4 col-lg-4">
                        <div class="widgetbar">
                            <a href="addproduct.php"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Add Product Attributes</button></a>
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
												 
                                                
                                                <th>Product Title</th>
                                                
                                                <th>Product Type</th>
												<th>Product Price</th>
												<th>Product Sprice</th>
												<th>Product Discount</th>
												<th>Subscription <br>Required?</th>
												
                                                <th>Stock Status</th>
												
												
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
											$store_id = $sdata['id'];
											 $stmt = $mysqli->query("SELECT * FROM `tbl_product_attribute`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
												
                                                
                                                <td class="align-middle">
                                                   <?php 
												   $jp = $mysqli->query("select * from tbl_product where id=".$row['pid']."")->fetch_assoc();
												   echo $jp['ptitle'];
												   ?>
                                                </td>
                                                
                                               <td><?php echo $row['title'];?></td>
											   <td><?php echo $row['price'];?></td>
											   <td><?php echo $row['sprice'];?></td>
											   <td><?php echo $row['discount'];?></td>
												
											 <?php if($row['sreq'] == 1) { ?>
                                                <td><div class="badge badge-success">Yes</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">No</div></td>
												<?php } ?>
											  
												<?php if($row['ostock'] == 0) { ?>
                                                <td><div class="badge badge-success">In Stock</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Out Of Stock</div></td>
												<?php } ?>
                                                <td style="min-width: 100px;"><a href="addattr.php?productid=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fa fa-edit" ></i></a>
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

$table="tbl_product_attribute";
$where = "where id=".$id."";
$h = new Milkman();
	$check = $h->Ins_milk_deldata($where,$table);

if($check == 1)
{
?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
 <script>
 iziToast.error({
    title: 'Product Section!!',
    message: 'Product Attributes Delete Successfully!!',
    position: 'topRight'
  });
  </script>
  
<?php 
}
else 
{

?>
<script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'Operation DISABLED!!',
    message: 'For Demo purpose all  Insert/Update/Delete are DISABLED !!',
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
?>
    <!-- End js -->
</body>


</html>