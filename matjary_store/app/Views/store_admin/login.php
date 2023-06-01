
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title><?php echo isset($pageTitle)?$pageTitle:'Login'; ?> - My Store Admin | Matjary</title>
	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="/store_admin/src/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/store_admin/src/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/store_admin/src/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="/store_admin/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="/store_admin/vendors/styles/icon-font.min.css">	
	<link rel="stylesheet" type="text/css" href="/store_admin/vendors/styles/style.css">	
    	<!--Sweetalert css start-->
	<link rel="stylesheet" type="text/css" href="/store_admin/assets/css/sweetalert.css">
	<!--Sweetalert css end-->
	<!-- Loader CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/store_admin/assets/css/loader.css" />
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">				
				<?php if(isset($storeSettingInfo->logo) && !empty($storeSettingInfo->logo)){ ?>
						<img src="<?php echo base_url('uploads/logo/'); ?>/<?php echo isset($storeSettingInfo->logo)?$storeSettingInfo->logo:''; ?>" alt="" class="dark-logo" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:67px;max-height:67px;"> 
					<?php } else { ?>
						<img src="/store_admin/vendors/images/matjary_logo.png" class="brand-logo" alt="">
				<?php } ?>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="#">AR</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="preloaderBg" id="preloader" style="display: none;">
					<div class="preloader-position">
						<h3>Please wait till processing...</h3>
						<div class="preloader"></div>
						<div class="preloader2"></div>
					</div>
				</div>
				<div class="col-md-6 col-lg-7">					
						<img src="/store_admin/vendors/images/login-page-img.png" alt="">				
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-logo">
					<?php if(isset($storeSettingInfo->logo) && !empty($storeSettingInfo->logo)){ ?>
						<img src="<?php echo base_url('uploads/logo/'); ?>/<?php echo isset($storeSettingInfo->logo)?$storeSettingInfo->logo:''; ?>" alt="" class="dark-logo" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;"> 
					<?php } else { ?>
						<img src="/store_admin/vendors/images/matjary_logo.png" alt="">
					<?php } ?>
						</div>	
						<div class="login-title">
							<h2 class="text-center text-primary">Login To Store Admin</h2>
						</div>
						
                        <?php 
                        $attributes = ['name' => 'user_login_form', 'id' => 'user_login_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/user-login',$attributes); 
                        ?>
							<input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Email">
							<div class="input-group custom">								
								<div class="input-group-append custom">
									<span class="input-group-text"></span>
								</div>
							</div>
                          
                            <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="**********">
							<div class="input-group custom">								
								<div class="input-group-append custom">
									<span class="input-group-text"></span>
								</div>
							</div>
                        
							<div class="row pb-30">
								<div class="col-6">								
								</div>								
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">			
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
									</div>									
								</div>
							</div>
                        <?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="/store_admin/vendors/scripts/core.js"></script>
	<script src="/store_admin/vendors/scripts/script.min.js"></script>
	<script src="/store_admin/vendors/scripts/process.js"></script>
	<script src="/store_admin/vendors/scripts/layout-settings.js"></script>
    <script src="/store_admin/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="/store_admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="/store_admin/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="/store_admin/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="/store_admin/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="/store_admin/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="/store_admin/src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="/store_admin/src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="/store_admin/src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="/store_admin/src/plugins/datatables/js/jszip.min.js"></script>
	<script src="/store_admin/src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="/store_admin/src/plugins/datatables/js/vfs_fonts.js"></script>
	<script src="/store_admin/assets/js/data-table-page.js"></script>
	<!--DataTable js end-->
	<script src="/store_admin/vendors/scripts/dashboard.js"></script>	
	<!--Jquery Validation js start-->
	<script src="/store_admin/assets/js/jquery-validate.js"></script>
	<script src="/store_admin/assets/js/form-validation.js"></script>
	<!--Jquery Validation js end-->
	<!--Sweetalert js start -->
	<script src="/store_admin/assets/js/sweetalert.min.js"></script>
	<!--Sweetalert js end -->

	<script src="/store_admin/assets/js/ajax-call.js"></script>
	<!-- Loader Script -->
	<script src="/store_admin/assets/js/loader.js"></script>
	<!-- Costom Script -->
	<script src="/store_admin/src/scripts/custom.js"></script>
</body>
</html>