<?php 
$session = \Config\Services::session(); 
$ses_user_logged_in = $session->get('ses_user_logged_in');
$ses_user_name = $session->get('ses_user_name');
$ses_user_id = $session->get('ses_user_id');

$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');

?>

<!DOCTYPE html>
<html lang="<?php echo $locale; ?>">
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title><?php echo isset($pageTitle)?$pageTitle:'Dashboard'; ?> - <?php echo $ses_lang=='en'?$storeSettingInfo->name:$storeSettingInfo->name_ar; ?> Admin | Matjary</title>
	<!-- Site favicon -->
    <?php if(isset($storeSettingInfo->favicon) && !empty($storeSettingInfo->favicon)){ ?>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>/store_admin/src/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('uploads/favicon/'); ?>/<?php echo isset($storeSettingInfo->favicon)?$storeSettingInfo->favicon:''; ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('uploads/favicon/'); ?>/<?php echo isset($storeSettingInfo->favicon)?$storeSettingInfo->favicon:''; ?>">
    <?php }else{ ?>
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('uploads/favicon'); ?>/default_favicon.png"> 
    <?php } ?> 
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&amp;display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/src/plugins/apexcharts/apexcharts.css">
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
	<!--DataTable css start-->
	<!-- <link rel="stylesheet" type="text/css" href="/store_admin/src/plugins/datatables/css/jquery.dataTables.min.css"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/css/responsive.dataTables.min.css">
	<!--DataTable css end-->
	<!--Sweetalert css start-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/assets/css/sweetalert.css">
	<!--Sweetalert css end-->
	<!--Costom css start-->
    <?php if (isset($lang_session) && $lang_session === true) { ?>
        <?php if ( $ses_lang == 'ar') { ?>
	        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/vendors/styles/style-ar.css">
        <?php }else{ ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/vendors/styles/style.css">
        <?php } ?>
    <?php }else{ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store_admin/vendors/styles/style-ar.css">
    <?php } ?>
	<!--Costom css end-->
	<!-- Animate CSS & JS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/store_admin/assets/css/animate.css" />
	<!-- Loader CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/store_admin/assets/css/loader.css" />
	<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
	
</head>
<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<!--<div class="loader-logo"><img src="<?php echo base_url(); ?>/store_admin/vendors/images/matjary_logo.png" alt=""></div>-->
            <?php if (isset($storeSettingInfo->logo) && !empty($storeSettingInfo->logo)) { ?>
                <div class="loader-logo"><img src="<?php echo base_url('/uploads/logo/'); ?>/<?php echo isset($storeSettingInfo->logo) ? $storeSettingInfo->logo : ''; ?>" alt=""></div>
            <?php } else { ?>
                <div class="loader-logo"><img src="https://www.matjary.in/assets/images/loader/matjary-loader.gif" alt=""></div>
            <?php } ?>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				<?php echo $language['Loading']; ?>
			</div>
		</div>
	</div>
	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>			
		</div>
		<div class="header-right align-items-center">
			<div class="user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
							<?php
							if(isset($notificationInfo) && !empty($notificationInfo)){							
								foreach ($notificationInfo as $value) {
                                    $name = '';
                                    if($ses_lang=='en'){
                                        if(isset($value->name) && !empty($value->name)){
                                            $name = $value->name;
                                        }else{
                                            if(isset($value->name_ar) && !empty($value->name_ar)){
                                                $name = $value->name_ar;
                                            }
                                        } 
                                    }else{
                                        if(isset($value->name_ar) && !empty($value->name_ar)){
                                            $name = $value->name_ar;
                                        }else{
                                            if(isset($value->name) && !empty($value->name)){
                                                $name = $value->name;
                                            }
                                        }                                                        
                                    }
							?>
							    <li>
									<a  href="<?php echo isset($value->reff_link)?$value->reff_link:''; ?>">										    									
										<p><i class="icon-copy dw dw-bell1"></i> <?php echo $name; ?></p>
									</a>
								</li>
								<?php                      
								}
							}
							?>								
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
                    <?php if(isset($ses_user_logged_in) && $ses_user_logged_in===true){ ?>
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <span class="user-icon">
                                <?php if(isset($loggedInUserData->profile_image) && !empty($loggedInUserData->profile_image)){ ?>
                                    <img src="<?php echo base_url('uploads/user_profile_picture/'); ?>/<?php echo isset($loggedInUserData->profile_image)?$loggedInUserData->profile_image:''; ?>" alt="Profile image" class="img img-responsive" >
                                <?php }else{ ?>
                                    <img src="<?php echo base_url('store_admin/assets/images/profile_default_image.png'); ?>" alt="Profile image | Default" class="img img-responsive" >
                                <?php } ?> 
                            </span>
                            <span class="user-name"><?php echo $ses_user_name; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="<?php echo base_url('admin/profile'); ?>"><i class="dw dw-user1"></i> <?php echo $language['Profile']; ?></a>
                            <a class="dropdown-item" href="<?php echo base_url('admin/general-settings'); ?>"><i class="dw dw-settings2"></i> <?php echo $language['Setting']; ?></a>
                            <a class="dropdown-item" href="<?php echo base_url('admin/admin-help'); ?>"><i class="dw dw-help"></i> <?php echo $language['Help']; ?></a>
                            <a class="dropdown-item" href="<?php echo base_url('admin/change-password'); ?>"><i class="dw dw-help"></i> <?php echo $language['Change Password']; ?></a>
                            <a class="dropdown-item" href="<?php echo base_url('admin/user-logout'); ?>"><i class="dw dw-logout"></i> <?php echo $language['Logout']; ?></a>
                        </div>
                    <?php } ?>
				</div>
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
	<div class="left-side-bar">
        <div class="brand-logo">
            <!--a href="<?php //echo base_url('admin/dashboard'); ?>">
                <img src="<?php //echo base_url('uploads/logo/'); ?>/<?php //echo isset($storeSettingInfo->logo)?$storeSettingInfo->logo:''; ?>" alt="" class="dark-logo" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;"> 
                <img src="<?php //echo base_url('uploads/logo/'); ?>/<?php //echo isset($storeSettingInfo->logo)?$storeSettingInfo->logo:''; ?>" alt="" class="light-logo" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;">
            </a-->
            <?php if (isset($storeSettingInfo->logo) && !empty($storeSettingInfo->logo)) { ?>
                <a href="<?php echo base_url('admin/dashboard'); ?>"><img src="<?php echo base_url('/uploads/logo/'); ?>/<?php echo isset($storeSettingInfo->logo) ? $storeSettingInfo->logo : ''; ?>" alt="Logo Image" class="light-logo" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;"></a>
            <?php } else { ?>
                <img src="https://placehold.jp/100x100.png" class="light-logo" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;">
            <?php } ?>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="<?php echo base_url('admin/dashboard'); ?>" class="single-menu ">
                            <span class="mtext"><?php echo $language['Dashboard']; ?></span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="mtext"><?php echo $language['Manage']; ?></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url('admin/all-banners'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==1){echo'active';}else{echo'';} ?>"><?php echo $language['Banners']; ?></a></li>
                            <li><a href="<?php echo base_url('admin/ship-orders'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==2){echo'active';}else{echo'';} ?>"><?php echo $language['Shipments']; ?></a></li>
							<li><a href="<?php echo base_url('admin/all-orders'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==3){echo'active';}else{echo'';} ?>"><?php echo $language['Orders']; ?></a></li>
							<li><a href="<?php echo base_url('admin/all-refund-request'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==4){echo'active';}else{echo'';} ?>"><?php echo $language['Refund Request']; ?></a></li>
							<li><a href="<?php echo base_url('admin/all-advertisements'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==5){echo'active';}else{echo'';} ?>"><?php echo $language['Advertisements']; ?></a></li>
                            <li><a href="<?php echo base_url('admin/shipment-pickups'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==6){echo'active';}else{echo'';} ?>"><?php echo $language['Pickups']; ?></a></li>
                        </ul>
                    </li> 
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="mtext"><?php echo $language['Products']; ?></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url('admin/all-products'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==7){echo'active';}else{echo'';} ?>"><?php echo $language['All Products']; ?></a></li>
                            <li><a href="<?php echo base_url('admin/all-product-categories'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==8){echo'active';}else{echo'';} ?>"><?php echo $language['Product Categories']; ?></a></li>
                            <!-- <li><a href="product-inventory.html">Product Inventory</a></li>
                            <li><a href="product-attributes.html">Product Attributes</a></li> -->
							<li><a href="<?php echo base_url('admin/all-product-brands'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==9){echo'active';}else{echo'';} ?>"><?php echo $language['Brands']; ?></a></li>
							<li><a href="<?php echo base_url('admin/all-product-colors'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==10){echo'active';}else{echo'';} ?>"><?php echo $language['Colors']; ?></a></li>
							<li><a href="<?php echo base_url('admin/all-product-sizes'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==11){echo'active';}else{echo'';} ?>"><?php echo $language['Sizes']; ?></a></li>
                        </ul>
                    </li>
                    <!-- <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="mtext">Reports</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="#">Product Reports</a></li>
                            <li><a href="#">Product SKU Reports</a></li>
                            <li><a href="#">Sales Report</a></li>
                            <li><a href="#">Monthly Sales Report</a></li>
                            <li><a href="#">Tax by Rate Report</a></li>
                            <li><a href="#">User Report</a></li>
                            <li><a href="#">User Activity Report</a></li>
                            <li><a href="#">Promo Code Report</a></li>
                            <li><a href="#">Gift Card Report</a></li>
                        </ul>
                    </li> -->
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="mtext"><?php echo $language['Coupons']; ?></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url('admin/all-coupons'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==12){echo'active';}else{echo'';} ?>"><?php echo $language['All Coupons']; ?></a></li>
                        </ul>
                    </li>
                    <!-- <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="mtext">Feedbacks</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="#">Customer Feedbacks</a></li>
                            <li><a href="#">Website Feedbacks</a></li>
                        </ul>
                    </li> -->
					<li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="mtext"><?php echo $language['Customers']; ?></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url('admin/all-customers'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==13){echo'active';}else{echo'';} ?>"><?php echo $language['All Customers']; ?></a></li>                          
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="mtext"><?php echo $language['Users']; ?></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url('admin/all-users'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==14){echo'active';}else{echo'';} ?>"><?php echo $language['All Users']; ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="mtext"><?php echo $language['Payment Management']; ?></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url('admin/payment-settings'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==15){echo'active';}else{echo'';} ?>"><?php echo $language['Payment Settings']; ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="mtext"><?php echo $language['Settings']; ?></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url('admin/general-settings'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==16){echo'active';}else{echo'';} ?>"><?php echo $language['General Settings']; ?></a></li>
                            <li><a href="<?php echo base_url('admin/shipping-settings'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==17){echo'active';}else{echo'';} ?>"><?php echo $language['Shipping Setting']; ?></a></li>
                            <!-- <li><a href="tax-settings.html">Tax Settings</a></li>
                            <li><a href="#">Appearance Settings</a></li> -->
                        </ul>
                    </li>
                    <!-- <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="mtext">Imports</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="import-products.html">Import Products</a></li>
                            <li><a href="import-product-images.html">Import Product Images</a></li>
                        </ul>
                    </li> -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="mtext">CMS</span>
                        </a>
						<ul class="submenu">
                            <li><a href="<?php echo base_url('admin/all-faqs'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==18){echo'active';}else{echo'';} ?>"><?php echo $language['FAQ']; ?></a></li>
                        </ul>
						<ul class="submenu">
                            <li><a href="<?php echo base_url('admin/about-us'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==19){echo'active';}else{echo'';} ?>"><?php echo $language['About Us']; ?></a></li>
                        </ul>
						<ul class="submenu">
                            <li><a href="<?php echo base_url('admin/terms-conditions'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==20){echo'active';}else{echo'';} ?>"><?php echo $language['Terms & Condition']; ?></a></li>
                        </ul>
						<ul class="submenu">
                            <li><a href="<?php echo base_url('admin/all-subscribes'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==21){echo'active';}else{echo'';} ?>"><?php echo $language['Subscribers']; ?></a></li>
                        </ul>
						<ul class="submenu">
                            <li><a href="<?php echo base_url('admin/all-contact-us'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==22){echo'active';}else{echo'';} ?>"><?php echo $language['Contact Us']; ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="mtext"><?php echo $language['Help']; ?></span>
                        </a>
						<ul class="submenu">
                            <li><a href="<?php echo base_url('admin/admin-help'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==23){echo'active';}else{echo'';} ?>"><?php echo $language['Admin Help']; ?></a></li>
                        </ul>
						<ul class="submenu">
                            <li><a href="<?php echo base_url('admin/customer-help'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==24){echo'active';}else{echo'';} ?>"><?php echo $language['Customer Help']; ?></a></li>
                        </ul>
                    </li>
					<li class="dropdown">
					    <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="mtext"><?php echo $language['Gift cards']; ?></span>
                        </a>
						<ul class="submenu">
                            <li><a href="<?php echo base_url('admin/all-gift-cards'); ?>" class="nav-row-list-link <?php //if(isset($adminPageId) && $adminPageId==25){echo'active';}else{echo'';} ?>"><?php echo $language['All Gift Cards']; ?></a></li>
                        </ul>
                    </li>
                    <!-- <li class="dropdown">
                        <a href="javascript:;" class="single-menu">
                            <span class="mtext">Domain/Subdomain</span>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
	<div class="mobile-menu-overlay"></div>
	<div class="main-container">
        <div class="preloaderBg" id="preloader" style="display: none;">
            <div class="preloader-position">
                <h3><?php echo $language['Please wait till processing.']; ?>..</h3>
                <div class="preloader"></div>
                <div class="preloader2"></div>
            </div>
        </div>
		<div class="pd-ltr-20">
            <?php $this->renderSection('content'); ?>
			<div class="footer-wrap pd-20 mb-20 card-box">
				Matjary | <?php echo $language['Powered By']; ?> <a href="https://www.advancedelaf.com/" target="_blank">Advanced Elaf</a>
			</div>
		</div>
	</div>
	
	<!-- js -->
	<!--<script src="https://cdn.ckeditor.com/4.12.1/standard-all/ckeditor.js"></script>	-->	
	<script src="<?php echo base_url(); ?>/store_admin/vendors/scripts/core.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/vendors/scripts/script.min.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/vendors/scripts/process.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/vendors/scripts/layout-settings.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/src/plugins/apexcharts/apexcharts.min.js"></script>
	<!--DataTable js start-->
	<script src="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/js/jszip.min.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/src/plugins/datatables/js/vfs_fonts.js"></script>
	<script src="<?php echo base_url(); ?>/store_admin/assets/js/data-table-page.js"></script>
	<!--DataTable js end-->
	<script src="/store_admin/vendors/scripts/dashboard.js"></script>
	
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