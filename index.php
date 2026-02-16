<!DOCTYPE html>
<html lang="en">

<?php require 'include/header.php';
ini_set('display_errors', 0); ini_set('display_startup_errors', 0); error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
if(isset($_SESSION['name']))
{
	?>
	<script>
	window.location.href="dashboard.php";
	</script>
	<?php 
}
else 
{
}
?>
<body class="vertical-layout">

<div style="
    height: 100%;
    width: 100%;
    background: #000000;
    position: absolute;
    opacity: 0.3;
"></div>
    <!-- Start Containerbar -->
    <div id="containerbar" class="containerbar authenticate-bg">
        <!-- Start Container -->
        <div class="container">
            <div class="auth-box login-box">
                <!-- Start row -->
                <div class="row no-gutters align-items-center justify-content-center">
                    <!-- Start col -->
                    <div class="col-md-6 col-lg-5">
                        <!-- Start Auth Box -->
                        <div class="auth-box-right">
                            <div class="card" style="border-radius: 23px;">
                                <div class="card-body">
                                    <form action="#" method="post">
                                        <div class="" style="margin-bottom: 36px;">
                                           <?php $logo = isset($set['logo']) && $set['logo'] !== '' ? $set['logo'] : 'assets/images/logo.svg'; ?>
                                           <img src="<?php echo $logo;?>" class="img-fluid" alt="logo">
                                        </div>                                        
                                        <h4 class="text-primary my-4"></h4>
										
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username here" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password here" required>
                                        </div>
                                                                
                                      <button type="submit" style="margin-bottom: 20px;" name="sub_login" class="btn btn-success btn-lg btn-block font-18">Log in</button>
                                    </form>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <!-- End Auth Box -->
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
        </div>
        <!-- End Container -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->        
   <?php require 'include/milklife.php';?>
   
   <?php 
	if(isset($_POST['sub_login']))
	{
	    
		$username = $_POST['username'];
		$password = $_POST['password'];
	
	 $h = new Milkman();
	 
	 $count = $h->lg_v_ub($username,$password,'admin');
 if($count != 0)
 {
	 $_SESSION['name'] = $username;
	 
	 ?>
	  <script src="assets/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.success({
    title: 'Login Successfully!!',
    message: 'Welcome Admin!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href="dashboard.php"},3000);
	 </script>
	 <?php 
 }
 else 
 {
	 ?>
	 <script src="assets/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'Wrong Data Enter!',
    message: 'Please Use Valid Data!!',
    position: 'topRight'
  });
	 </script>
	 <?php 
 }
	 
	 	
	}
	?>
    <!-- End js -->
</body>


</html>
