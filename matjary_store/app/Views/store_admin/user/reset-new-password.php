<?php 
$session = \Config\Services::session(); 
$ses_user_logged_in = $session->get('ses_user_logged_in');
$ses_user_name = $session->get('ses_user_name');
$ses_user_id = $session->get('ses_user_id');

$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title><?php echo isset($pageTitle)?$pageTitle:'Login'; ?> - My Store Admin | Matjary</title>
	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>/store_admin/src/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>/store_admin/src/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>/store_admin/src/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&amp;display=swap" rel="stylesheet">
	<!-- CSS -->
	<?php if (isset($lang_session) && $lang_session === true) { ?>
        <?php if ( $ses_lang == 'ar') { ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/vendors/styles/core-ar.css">
        <?php }else{ ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/vendors/styles/core.css">
        <?php } ?>
    <?php }else{ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/vendors/styles/core-ar.css">
    <?php } ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/vendors/styles/icon-font.min.css">	
	<?php if (isset($lang_session) && $lang_session === true) { ?>
        <?php if ( $ses_lang == 'ar') { ?>
	        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/vendors/styles/style-ar.css">
        <?php }else{ ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/vendors/styles/style.css">
        <?php } ?>
    <?php }else{ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/vendors/styles/style-ar.css">
    <?php } ?>
	<!--Sweetalert css start-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/assets/css/sweetalert.css">
	<!--Sweetalert css end-->
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="<?php echo base_url('admin/login'); ?>">
                    <?php if(isset($storeSettingInfo->logo) && !empty($storeSettingInfo->logo)){ ?>
                        <img src="<?php echo base_url('uploads/logo/'); ?>/<?php echo isset($storeSettingInfo->logo)?$storeSettingInfo->logo:''; ?>" alt="" class="dark-logo" > 
                    <?php } else { ?>
                        <img src="<?php echo base_url(); ?>/store_admin/vendors/images/matjary_logo.png" class="brand-logo" alt="">
                    <?php } ?>
				</a>
			</div>
			<div class="login-menu <?php echo $ses_lang == 'en'?'mr-3':'ml-3'; ?>">
				<ul>
                    <?php if (isset($lang_session) && $lang_session === true) { ?>
                        <?php if ( $ses_lang == 'ar') { ?>
                            <li><a href="javascript:void(0);" data-actionurl="<?php echo base_url('/language'); ?>" data-lang="en" id="languageChange">EN</a></li> 
                        <?php }elseif($ses_lang == 'en'){ ?>
                            <li><a href="javascript:void(0);" data-actionurl="<?php echo base_url('/language'); ?>" data-lang="ar" id="languageChange">AR</a></li> 
                        <?php } ?>
                    <?php }else{ ?>
                        <li><a href="javascript:void(0);" data-actionurl="<?php echo base_url('/language'); ?>" data-lang="en" id="languageChange">EN</a></li> 
                    <?php } ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="<?php echo base_url(); ?>/store_admin/vendors/images/forgot-password.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5 <?php if ($locale == 'ar') { echo 'text-right';} ?> ">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-logo">
							<img src="<?php echo base_url(); ?>/store_admin/vendors/images/matjary_logo.png">	
						</div>	
						<div class="login-title">
							<h2 class="text-center text-primary"><?php echo $language['Reset Password']; ?></h2>
						</div>
						<?php if(isset($errorMsg) && !empty($errorMsg)){ ?>
							<p class="text-center"><?php echo $language['Sorry!']; ?></p>
							<p><?php echo $errorMsg; ?></p>
							<a href="<?php echo base_url('admin/login'); ?>"><?php echo $language['Go to store admin login']; ?></a>
                        <?php }else{ ?>
							<?php 
								$attributes = ['name' => 'user_set_new_password_form', 'id' => 'user_set_new_password_form', 'autocomplete' => 'off']; 
								echo form_open_multipart('admin/user-save-reset-password',$attributes); 
							?>	
								<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
								<input type="hidden" name="user_id" id="user_id" value="<?php echo isset($user_id)?$user_id:''; ?>" />
								<div class="input-group custom mb-1 mt-2">  
									<input type="password" name="password" id="password" data-error=".error1" class="form-control mt-2" placeholder="<?php echo $language['Set New Password']; ?>*">  							                        
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
									</div>								
								</div>
								<span class="error1"></span>
								<div class="input-group custom mb-1 mt-2">   
									<input type="password" name="cnf_password" id="cnf_password" data-error=".error2" class="form-control mt-2" placeholder="<?php echo $language['Confirm New Password']; ?>*">                         							
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
									</div>								
								</div>
								<span class="error2"></span>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0 mt-2">
											<button type="submit" class="btn btn-primary btn-lg btn-block"><?php echo $language['Submit']; ?></button>
										</div>								
									</div>
								</div>
							<?php echo form_close(); ?>
					   <?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="<?php echo base_url(); ?>/store_admin/vendors/scripts/core.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/vendors/scripts/script.min.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/vendors/scripts/process.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/vendors/scripts/layout-settings.js"></script>
    
	<script src="<?php echo base_url(); ?>/store_admin/vendors/scripts/dashboard.js"></script>
	
	<!--Jquery Validation js start-->
	<script src="<?php echo base_url(); ?>/store_admin/assets/js/jquery-validate.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/assets/js/form-validation.js"></script>
	<!--Jquery Validation js end-->
	<!--Sweetalert js start -->
	<script src="<?php echo base_url(); ?>/store_admin/assets/js/sweetalert.min.js"></script>
	<!--Sweetalert js end -->

	<script src="<?php echo base_url(); ?>/store_admin/assets/js/ajax-call.js"></script>
	<!-- Loader Script -->
	<script src="<?php echo base_url(); ?>/store_admin/assets/js/loader.js"></script>
	<!-- Costom Script -->
	<script src="<?php echo base_url(); ?>/store_admin/src/scripts/custom.js"></script>
</body>
</html>