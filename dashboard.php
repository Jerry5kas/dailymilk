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
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                               
                            </ol>
                        </div>
                    </div>
                   
                </div>          
            </div>
            <!-- End Breadcrumbbar -->
            <!-- Start Contentbar -->    
            <div class="contentbar">              
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                   
									<i class="fa fa-map mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total City</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_city")->num_rows;?></p>                                                             
                                    </div>
									<i class="fa fa-map action-bg rounded-circle text-success"></i>
                                   
                                </div>
                            </div>
                        </div>            
                    </div>
                    <!-- End col --> 
                    <!-- Start col -->
                    <div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                    <i class="fa fa-image mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total Banner</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_banner")->num_rows;?></p>                                                             
                                    </div>
                                   <i class="fa fa-image action-bg rounded-circle text-info"></i>
                                </div>
                            </div>
                        </div>            
                    </div>
					
					 <div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                    <i class="fa fa-list mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total Category</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_cat")->num_rows;?></p>                                                             
                                    </div>
                                   <i class="fa fa-list action-bg rounded-circle text-primary"></i>
                                </div>
                            </div>
                        </div>            
                    </div>
					
					<div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                    <i class="fa fa-list mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total Subategory</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_subcat")->num_rows;?></p>                                                             
                                    </div>
                                   <i class="fa fa-list action-bg rounded-circle text-primary"></i>
                                </div>
                            </div>
                        </div>            
                    </div>
					
					<div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                    <i class="fa fa-motorcycle mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total Delivery Boy</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_rider")->num_rows;?></p>                                                             
                                    </div>
                                   <i class="fa fa-motorcycle action-bg rounded-circle text-success"></i>
                                </div>
                            </div>
                        </div>            
                    </div>
					
					<div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                    <i class="fa fa-picture-o mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total Collection</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_collection")->num_rows;?></p>                                                             
                                    </div>
                                   <i class="fa fa-picture-o action-bg text-info rounded-circle"></i>
                                </div>
                            </div>
                        </div>            
                    </div>
					
					<div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                    <i class="fa fa-gift mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total Coupon</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_coupon")->num_rows;?></p>                                                             
                                    </div>
                                   <i class="fa fa-gift action-bg rounded-circle text-info"></i>
                                </div>
                            </div>
                        </div>            
                    </div>
					
					<div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                    <i class="fa fa-product-hunt mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total Products</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_product")->num_rows;?></p>                                                             
                                    </div>
                                   <i class="fa fa-product-hunt action-bg rounded-circle text-success"></i>
                                </div>
                            </div>
                        </div>            
                    </div>
					
					<div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                    <i class="fa fa-truck mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total Deliveries</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_delivery")->num_rows;?></p>                                                             
                                    </div>
                                   <i class="fa fa-truck action-bg rounded-circle text-info"></i>
                                </div>
                            </div>
                        </div>            
                    </div>
					
					<div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                    <i class="fa fa-user mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total Users</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_user")->num_rows;?></p>                                                             
                                    </div>
                                   <i class="fa fa-user action-bg rounded-circle text-success"></i>
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
                                        <h5 class="mb-2">Total Normal Pending Order</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_normal_order  where status='Pending'")->num_rows;?></p>                                                             
                                    </div>
                                   <i class="fa fa-shopping-bag action-bg rounded-circle text-info"></i>
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
                                        <h5 class="mb-2">Total Normal Cancelled Order</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_normal_order  where status='Cancelled'")->num_rows;?></p>                                                             
                                    </div>
                                   <i class="fa fa-shopping-bag action-bg rounded-circle text-danger"></i>
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
                                        <h5 class="mb-2">Total Normal Completed Order</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_normal_order  where status='Completed'")->num_rows;?></p>                                                             
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
                                        <h5 class="mb-2">Total Subscribe Pending Order</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_subscribe_order  where status='Pending'")->num_rows;?></p>                                                             
                                    </div>
                                   <i class="fa fa-shopping-bag action-bg rounded-circle text-info"></i>
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
                                        <h5 class="mb-2">Total Subscribe Completed Order</h5> 
                                        <p class="mb-0"><?php echo $mysqli->query("select * from tbl_subscribe_order  where status='Completed'")->num_rows;?></p>                                                             
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
                                    <i class="fa fa-shopping-cart mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total Normal Order Sales</h5> 
                                        <p class="mb-0"><?php $sales  = $mysqli->query("select sum(o_total) as full_total from tbl_normal_order where status='Completed'")->fetch_assoc();
               $sa = 0;
               if($sales['full_total'] == ''){echo $sa.' '.$set['currency'];}else {echo number_format((float)$sales['full_total'], 2, '.', '').' '.$set['currency']; } ?></p>                                                             
                                    </div>
                                   <i class="fa fa-shopping-cart action-bg rounded-circle text-success"></i>
                                </div>
                            </div>
                        </div>            
                    </div>
					
					
					<div class="col-lg-6 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="media">
                                    <i class="fa fa-shopping-cart mr-3 rounded-circle"></i>
                                    <div class="media-body">
                                        <h5 class="mb-2">Total Subscribe Order Sales</h5> 
                                        <p class="mb-0"><?php $sales  = $mysqli->query("select sum(o_total) as full_total from tbl_subscribe_order where status='Completed'")->fetch_assoc();
               $sa = 0;
               if($sales['full_total'] == ''){echo $sa.' '.$set['currency'];}else {echo number_format((float)$sales['full_total'], 2, '.', '').' '.$set['currency']; } ?></p>                                                             
                                    </div>
                                   <i class="fa fa-shopping-cart action-bg rounded-circle text-success"></i>
                                </div>
                            </div>
                        </div>            
                    </div>
					
					
					
                    
                    <!-- End col --> 
                </div>
                <!-- End row -->
                <!-- Start row -->
                
                <!-- End row -->
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
</body>


</html>