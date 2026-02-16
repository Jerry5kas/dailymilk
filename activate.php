<!DOCTYPE html>
<html lang="en">

<?php require 'include/header.php';
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
                                           <img src="<?php echo $set['logo'];?>" class="img-fluid" alt="logo">
                                        </div>                                        
                                       <div id="getmsg"></div>
										
                                        <div class="form-group">
                                           <input placeholder="Enter Envato Purchase Code" class="form-control" type="text" name="code" id="inputCode" tabindex="1" required="" autofocus="">
                                        </div>
                                        
                                                                
                                      <button type="submit" style="margin-bottom: 20px;" id="sub_activate" name="sub_login" class="btn btn-success btn-lg btn-block font-18">Activate</button>
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
   
  
    <!-- End js -->
</body>


</html>