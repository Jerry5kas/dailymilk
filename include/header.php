<?php 
require 'include/Milkman.php';
require 'include/milkprams.php';
?>
<head>
<?php 
$dtitle = isset($set['d_title']) && $set['d_title'] !== '' ? $set['d_title'] : 'Daily Milk';
$favicon = isset($set['pdbanner']) && $set['pdbanner'] !== '' ? $set['pdbanner'] : 'assets/images/favicon.ico';
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?php echo $dtitle;?> - Daily Milk Delivery & Subscription</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="<?php echo $favicon;?>">
    <!-- Start css -->
    <!-- Switchery css -->
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="assets/izitoast/css/iziToast.min.css">
	<link href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css">
	    <link href="assets/plugins/summernote/summernote-bs4.css" rel="stylesheet">
     
        <!-- apex css -->
     <!-- Slick css -->
	 <link href="assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css">
	<link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Responsive Datatable css -->
    <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    
    <link href="assets/css/flag-icon.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <!-- End css -->
</head>
