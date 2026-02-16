 <div class="leftbar">
            <!-- Start Sidebar -->
            <div class="sidebar">
                <!-- Start Logobar -->
                <div class="logobar">
                    <?php $slogo = isset($set['logo']) && $set['logo'] !== '' ? $set['logo'] : 'assets/images/logo.svg'; ?>
                    <?php $sshort = isset($set['pdbanner']) && $set['pdbanner'] !== '' ? $set['pdbanner'] : 'assets/images/favicon.ico'; ?>
                    <a href="dashboard.php" class="logo logo-large"><img src="<?php echo $slogo;?>" class="img-fluid" alt="logo"></a>
                    <a href="dashboard.php" class="logo logo-small"><img src="<?php echo $sshort;?>" class="img-fluid" alt="logo"></a>
                </div>
                <!-- End Logobar -->
                <!-- Start Navigationbar -->
                <div class="navigationbar">
                    <ul class="vertical-menu">
					
					<li>
                            <a href="dashboard.php">
                                <i class="fa fa-line-chart"></i><span>Dashboard</span>
                            </a>
                        </li> 
						
						
						
                        <li>
                            <a href="javaScript:void();">
                                <i class="fa fa-map"></i><span>City</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="addcity.php">Add City</a></li>
                                <li><a href="listcity.php">List City</a></li>
                            </ul>
                        </li>
						
						
						
						
						
						 <li>
                            <a href="javaScript:void();">
                                <i class="fa fa-image"></i><span>Banner</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="addbanner.php">Add Banner</a></li>
                                <li><a href="listbanner.php">List Banner</a></li>
                            </ul>
                        </li>

 <li>
                            <a href="javaScript:void();">
                               <i class="fa fa-list"></i><span>Category</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="addcategory.php">Add Category</a></li>
                                <li><a href="listcategory.php">List Category</a></li>
                            </ul>
                        </li>

 <li>
                            <a href="javaScript:void();">
                                <i class="fa fa-list"></i><span>Subcategory</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="addsub.php">Add Subcategory</a></li>
                                <li><a href="listsub.php">List Subcategory</a></li>
                            </ul>
                        </li>
						<li>
                            <a href="javaScript:void();">
                                <i class="fa fa-product-hunt"></i><span>Product</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="addproduct.php">Add Product</a></li>
                                <li><a href="listproduct.php">List Product</a></li>
                            </ul>
                        </li>
						
						<li>
                            <a href="javaScript:void();">
                                <i class="fa fa-product-hunt"></i><span>Product Attributes</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="addattr.php">Add Product Attr.</a></li>
                                <li><a href="listattr.php">List Product Attr.</a></li>
                            </ul>
                        </li>
						<li>
                            <a href="javaScript:void();">
                               <i class="fa fa-picture-o"></i><span>Collection</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="addcoll.php">Add Collection</a></li>
                                <li><a href="listcoll.php">List Collection</a></li>
                            </ul>
                        </li>
						
						<li>
                            <a href="javaScript:void();">
                                <i class="fa fa-gift"></i><span>Coupon</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="addcoupon.php">Add Coupon</a></li>
                                <li><a href="listcoupon.php">List Coupon</a></li>
                            </ul>
                        </li>
						
						
						
						
						<li>
                            <a href="javaScript:void();">
                                <i class="fa fa-truck"></i><span>Deliveries</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="adddeliveries.php">Add Deliveries</a></li>
                                <li><a href="listdeliveries.php">List Deliveries</a></li>
                            </ul>
                        </li>
						
						<li>
                            <a href="javaScript:void();">
                                <i class="fa fa-clock-o"></i><span>Timeslot</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="timeslot.php">Add Timeslot</a></li>
                                <li><a href="listtime.php">List Timeslot</a></li>
                            </ul>
                        </li>
						
						<li>
                            <a href="javaScript:void();">
                                <i class="fa fa-rocket"></i><span>Subscription Order</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="sporder.php">Pending Order</a></li>
                                <li><a href="scorder.php">Cancelled Order</a></li>
                                 <li><a href="scomplete.php">Completed Order</a></li>
                            </ul>
                        </li>
						<li>
                            <a href="javaScript:void();">
                                <i class="fa fa-first-order"></i><span>Normal Order</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="porder.php">Pending Order</a></li>
                                <li><a href="corder.php">Cancelled Order</a></li>
								 <li><a href="complete.php">Completed Order</a></li>
                            </ul>
                        </li>
						
						
                         <li>
                            <a href="javaScript:void();">
                                <i class="fa fa-motorcycle"></i><span>Delivery Boy</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="adddeliveryboy.php">Add Delivery Boy</a></li>
                                <li><a href="listdeliveryboy.php">List Delivery Boy</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();">
                                 <i class="fa fa-flag"></i><span>Country Code</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="addcode.php">Add Country Code</a></li>
                                <li><a href="listcode.php">List Country Code</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="paymentlist.php">
                                <i class="fa fa-credit-card"></i><span>List Payment Gateway</span>
                            </a>
                        </li> 
                        <li>
                            <a href="userlist.php">
                                <i class="fa fa-user"></i><span>User List</span>
                            </a>
                        </li> 
                        <li>
                            <a href="addnoti.php">
                                <i class="fa fa-bell"></i><span>Push Notification</span>
                            </a>
                        </li> 
                        <li>
                            <a href="setting.php">
                                <i class="fa fa-cog"></i><span>Setting</span>
                            </a>
                        </li> 
                        <li>
                            <a href="profile.php">
                                <i class="fa fa-user"></i><span>My Profile</span>
                            </a>
                        </li> 
                        <li>
                            <a href="logout.php">
                                <i class="fa fa-sign-out"></i><span>Logout</span>
                            </a>
                        </li> 
						
                    </ul>
                </div>
                <!-- End Navigationbar -->
            </div>
            <!-- End Sidebar -->
        </div>
