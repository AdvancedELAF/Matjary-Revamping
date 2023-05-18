<?php
$session = \Config\Services::session();
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
$allowedDatatablePagesAry = array('My Gift Details','My Orders','My Refund Details');
$ristrictLanguageSwitcherPages = array('Order Success','طلب النجاح');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');

?>
<!DOCTYPE html>
<html lang="<?php echo $locale; ?>">
<head>
    <!-- Site favicon -->
    <?php if(isset($storeSettingInfo->favicon) && !empty($storeSettingInfo->favicon)){ ?>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>/store_admin/src/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('uploads/favicon/'); ?>/<?php echo isset($storeSettingInfo->favicon)?$storeSettingInfo->favicon:''; ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('uploads/favicon/'); ?>/<?php echo isset($storeSettingInfo->favicon)?$storeSettingInfo->favicon:''; ?>">
    <?php }else{ ?>
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('uploads/favicon'); ?>/default_favicon.png">
    <?php } ?> 
    <title><?php echo (isset($pageTitle) && !empty($pageTitle)) ? $pageTitle : 'Home'; ?> | <?php echo (isset($storeSettingInfo->name) && !empty($storeSettingInfo->name)) ? $storeSettingInfo->name : $storeInfo['responseData']['store_sub_domain']; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/normalize.css">
    <!-- Iconfont Link -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/icofont/icofont.min.css" />
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
    
    <?php if(isset($pageTitle) && in_array($pageTitle,$allowedDatatablePagesAry)){ ?>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    <?php } ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <?php if(isset($pageTitle) && in_array($pageTitle,$allowedDatatablePagesAry)){ ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <?php } ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/style.css">
    <!-- Bootstrap JS -->
    <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Cosma Stylesheet -->
    <?php if($ses_lang=='ar'){ ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/atz-styles-ar.css" />
    <?php }elseif($ses_lang=='en'){?> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/atz-styles.css" />
    <?php }else{ ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/atz-styles-ar.css" />
    <?php } ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/responsive.css" />
    <!-- Font Styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/fonts.css" />
    <!-- Owl carousel -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/owl-carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/owl-carousel/dist/assets/owl.theme.default.min.css">
    <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/owl-carousel/dist/owl.carousel.min.js"></script>
    <!--Sweetalert css start-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/sweetalert.css">
    <!-- Animate CSS & JS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/animate.css" />
    <!-- Loader CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/loader.css" />
    <!-- Local Script -->
    <!--Jquery Validation js start-->
    <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/js/jquery-validate.js"></script>
    <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/js/form-validation.js"></script>
    <!--Jquery Validation js end-->
    <!--Sweetalert js start -->
    <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/js/sweetalert.min.js"></script>
    <!--Sweetalert js end -->
    <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/js/ajax-call.js"></script>
    <!-- Loader Script -->
    <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/js/loader.js"></script>
    <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/js/main.js"></script>    
    <?php
    $base_url = base_url();
    if (isset($pageCostomCss) && !empty($pageCostomCss)) {
        foreach ($pageCostomCss as $cssKey => $cssKeyValues) {
            echo '<link rel="stylesheet" href="' . $base_url . '/store/'.$storeActvTmplName.'/assets/css/' . $cssKeyValues . '" />';
        }
    }

    if (isset($pageCostomJs) && !empty($pageCostomJs)) {
        foreach ($pageCostomJs as $jsKey => $jsKeyValues) {
            echo '<link rel="stylesheet" href="' . $base_url . '/store/'.$storeActvTmplName.'/assets/js/' . $jsKeyValues . '" />';
        }
    }
    ?>
</head>
<body>    
    <div class="preloaderBg" id="preloader" style="display: none;">
        <div class="preloader-position">
            <h3><?php echo $language['Please wait till processing.']; ?></h3>
            <div class="preloader"></div>
            <div class="preloader2"></div>
        </div>
    </div>
    <header>
        <div class="header-container">
            <!-- logo -->
            <strong class="logo">
                <?php if (isset($storeSettingInfo->logo) && !empty($storeSettingInfo->logo)) { ?>
                    <a href="<?php echo base_url('home'); ?>"><img src="<?php echo base_url('/uploads/logo/'); ?>/<?php echo isset($storeSettingInfo->logo) ? $storeSettingInfo->logo : ''; ?>" alt="Logo Image" class="img img-responsive" ></a>
                <?php } else { ?>
                    <a href="<?php echo base_url('home'); ?>"><img src="<?php echo base_url('/store/'.$storeActvTmplName.'/assets/images/logo.png'); ?>" alt="Logo Image" class="img img-responsive" ></a>
                <?php } ?>
            </strong>
            <!-- open nav mobile -->
            <!--search -->
            <label class="open-search" for="open-search">
                <i class="icofont-search"></i>
                <input class="input-open-search" id="open-search" type="checkbox" name="menu" />
                <div class="search">
                    <a href="javascript:void(0);" id="gsearchBtn" class="button-search"><i class="icofont-search"></i></a>
                    <input type="text" value="<?php echo isset($_REQUEST['query'])?$_REQUEST['query']:''; ?>" placeholder="<?php echo $language['publicSearch']; ?>" id="gsearchsimple" class="input-search" />
                    <ul class="list-group <?php if($locale=='ar'){echo 'text-right';} ?>">
                    </ul>
                </div>
            </label>
            <!-- // search -->
            <nav class="nav-content">
                <!-- nav -->
                <ul class="nav-content-list">
                    <li class="nav-content-item account-login">
                        <label class="open-menu-login-account" for="open-menu-login-account">
                            <input class="input-menu" id="open-menu-login-account" type="checkbox" name="menu" />
                            <i class="icofont-ui-user"></i>
                            <?php if (isset($ses_logged_in) && $ses_logged_in === true) { ?>
                                <span class="login-text"><?php echo $language['Hello']; ?>, <strong><?php echo $ses_custmr_name; ?> </strong></span> <span class="item-arrow"></span>
                                <ul class="login-list">
                                    <!-- submenu -->
                                    <a href="<?php echo base_url('customer/my-account'); ?>">
                                        <li class="login-list-item"><?php echo $language['My Account']; ?></li>
                                    </a>
                                    <a href="<?php echo base_url('customer/change-password'); ?>">
                                        <li class="login-list-item"><?php echo $language['Change Password']; ?></li>
                                    </a>
                                    <a href="<?php echo base_url('customer/customer-logout'); ?>">
                                        <li class="login-list-item"><?php echo $language['Logout']; ?></li>
                                    </a>
                                </ul>
                            <?php } else { ?>
                                <span class="login-text"><strong><?php echo $language['SignIn']; ?> | <?php echo $language['SignUp']; ?></strong></span> <span class="item-arrow"></span>
                                <ul class="login-list">
                                    <!-- submenu -->
                                    <a href="<?php echo base_url('customer/login'); ?>">
                                        <li class="login-list-item"><?php echo $language['SignIn']; ?></li>
                                    </a>
                                    <a href="<?php echo base_url('customer/register'); ?>">
                                        <li class="login-list-item"><?php echo $language['SignUp']; ?></li>
                                    </a>
                                </ul>
                            <?php } ?>
                        </label>
                    </li>
                    <li class="nav-content-item">
                        <a class="nav-content-link" href="<?php echo base_url('customer/cart'); ?>">
                            <?php if (isset($ses_logged_in) && $ses_logged_in === true) { ?>
                                <?php
                                $cartCount = 0;
                                if (isset($snglCstmrCartProductList) && !empty($snglCstmrCartProductList)) {
                                    $cartCount = count($snglCstmrCartProductList);
                                }
                                ?>
                                <i class="icofont-cart-alt" id="cartCount"><?php echo $cartCount; ?></i>
                            <?php } else { ?>
                                <i class="icofont-cart-alt" id="cartCount"></i>
                            <?php } ?>
                        </a>
                    </li>
                    <?php if(isset($pageTitle) && !in_array($pageTitle,$ristrictLanguageSwitcherPages)){ ?>
                        <?php if (isset($lang_session) && $lang_session === true) { ?>
                            <?php if ( $ses_lang == 'ar') { ?>
                                <li class="nav-content-item"><a href="javascript:void(0);" data-actionurl="<?php echo base_url('/language'); ?>" data-lang="en" id="languageChange" class="nav-content-link" >EN</a></li> 
                            <?php }elseif($ses_lang == 'en'){ ?>
                                <li class="nav-content-item"><a href="javascript:void(0);" data-actionurl="<?php echo base_url('/language'); ?>" data-lang="ar" id="languageChange" class="nav-content-link" >AR</a></li> 
                            <?php } ?>
                        <?php }else{ ?>
                        <li class="nav-content-item"><a href="javascript:void(0);" data-actionurl="<?php echo base_url('/language'); ?>" data-lang="en" id="languageChange" class="nav-content-link" >EN</a></li> 
                        <?php } ?>
                    <?php } ?>
                    <!-- call to action -->
                </ul>
            </nav>
        </div>
        <!-- nav navigation commerce -->
        <div class="nav-container">
            <nav class="all-category-nav">
                <label class="open-menu-all" for="open-menu-all">
                    <input class="input-menu-all" id="open-menu-all" type="checkbox" name="menu-open" />
                    <span class="all-navigator"><i class="icofont-navigation-menu"></i> <span><?php echo $language['All Category']; ?></span> <i class="icofont-caret-down"></i>
                        <i class="icofont-caret-up"></i>
                    </span>
                    <ul class="all-category-list">
                        <?php
                        if (isset($productCategories) && !empty($productCategories)) {
                            foreach ($productCategories as $prodCat) {
                                $category_name = '';
                                if($ses_lang=='en'){
                                    if(isset($prodCat->category_name) && !empty($prodCat->category_name)){
                                        $category_name = $prodCat->category_name;
                                    }else{
                                        if(isset($prodCat->category_name_ar) && !empty($prodCat->category_name_ar)){
                                            $category_name = $prodCat->category_name_ar;
                                        }
                                    }
                                    
                                }else{
                                    if(isset($prodCat->category_name_ar) && !empty($prodCat->category_name_ar)){
                                        $category_name = $prodCat->category_name_ar;
                                    }else{
                                        if(isset($prodCat->category_name) && !empty($prodCat->category_name)){
                                            $category_name = $prodCat->category_name;
                                        }
                                    }
                                }
                        ?>
                            <li class="all-category-list-item">
                                <a href="<?php echo base_url('category/category-product-list/' . $prodCat->id); ?>" class="all-category-list-link"><?php echo $category_name; ?> <i class="fas fa-angle-right"></i></a>
                                <?php if (isset($prodCat->subcat) && !empty($prodCat->subcat)) { ?>
                                    <div class="category-second-list">
                                        <ul class="category-second-list-ul">
                                            <?php foreach ($prodCat->subcat as $prodCatSub) { ?>
                                                <li class="category-second-item"><a href="<?php echo base_url('category/category-product-list/' . $prodCatSub->id); ?>"><?php echo $prodCatSub->category_name; ?></li>      
                                            <?php } ?>                              
                                        </ul>
                                    </div>  
                                <?php } ?>   
                            </li>
                        <?php 
                            } 
                        } 
                        ?>
                        <li class="all-category-list-item"><a href="<?php echo base_url('category/all-categories'); ?>" class="all-category-list-link"><?php echo $language['All Categories']; ?> </a></li>
                    </ul>
                </label>
            </nav>
            <nav class="featured-category">
                <ul class="nav-row">
                    <li class="nav-row-list"><a href="<?php echo base_url('home'); ?>" class="nav-row-list-link <?php if(isset($pageId) && $pageId==1){echo'menu-active';}else{echo'';} ?>"><?php echo $language['navHome']; ?></a></li>
                    <li class="nav-row-list"><a href="<?php echo base_url('product/products'); ?>" class="nav-row-list-link <?php if(isset($pageId) && $pageId==2){echo'menu-active';}else{echo'';} ?>"><?php echo $language['navProducts']; ?></a></li>
                    <li class="nav-row-list"><a href="<?php echo base_url('giftcard/gift-cards'); ?>" class="nav-row-list-link <?php if(isset($pageId) && $pageId==3){echo'menu-active';}else{echo'';} ?>"><?php echo $language['navGiftCards']; ?></a></li>
                    <li class="nav-row-list"><a href="<?php echo base_url('customer-help'); ?>" class="nav-row-list-link <?php if(isset($pageId) && $pageId==4){echo'menu-active';}else{echo'';} ?>"><?php echo $language['navHelp']; ?></a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?php $this->renderSection('content'); ?>
    <?php if(isset($pageTitle) && in_array($pageTitle,$allowedDatatablePagesAry)){ ?>
        <!--DataTable js start-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/css/jquery.dataTables.min.css"> 
        <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/js/responsive.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/js/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/js/buttons.flash.min.js"></script>
        
        <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/js/buttons.print.min.js"></script>
        
        <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/js/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/js/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/js/data-table-page.js"></script>
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/datatables/css/responsive.dataTables.min.css">
        <!--DataTable js end-->
    <?php } ?>
    <!-- Footer section  -->
    <footer>
        <div id="footer-one">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer-logo">
                            <?php if (isset($storeSettingInfo->logo) && !empty($storeSettingInfo->logo)) { ?>
                                <a href="<?php echo base_url('home'); ?>"><img src="<?php echo base_url('/uploads/logo/'); ?>/<?php echo isset($storeSettingInfo->logo) ? $storeSettingInfo->logo : ''; ?>" alt="Logo Image" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;"></a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('home'); ?>"><img src="https://placehold.jp/100x100.png" alt="Logo Image" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;"></a>
                            <?php } ?>
                        </div>
                        <?php if (isset($AboutUsInfo) && !empty($AboutUsInfo)) { ?>
                        <div class="footer-desc">
                            <p><?php echo $AboutUsInfo->short_description; ?></p>
                        </div>
                        <?php }else{ ?>
                        <div class="footer-desc">
                            <p><?php echo $language['About Store Information not added yet!']; ?></p>
                        </div>
                        <?php } ?>
                        <div class="footer-subtitle">
                            <h4><?php echo $language['Address']; ?></h4>
                            <p><?php echo isset($storeSettingInfo->address) ? $storeSettingInfo->address : ''; ?></p>

                        </div>
                        <div class="footer-subtitle">
                            <h4><?php echo $language['Email']; ?> & <?php echo $language['Call Us']; ?></h4>
                            <div class="footer-link">
                                <a href="tel:<?php echo isset($storeSettingInfo->contact_no) ? $storeSettingInfo->contact_no : ''; ?>"><?php echo isset($storeSettingInfo->contact_no) ? $storeSettingInfo->contact_no : ''; ?></a>
                            </div>
                            <div class="footer-link">
                                <a href="mailto: <?php echo isset($storeSettingInfo->support_email) ? $storeSettingInfo->support_email : ''; ?>"><?php echo isset($storeSettingInfo->support_email) ? $storeSettingInfo->support_email : ''; ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-title">
                            <h3><?php echo $language['Useful Links']; ?></h3>
                        </div>
                        <ul class="footer-list">
                            <li><a href="<?php echo base_url('abouts-us'); ?>"><p><?php echo $language['About Us']; ?></p></a></li>
                            <li><a href="<?php echo base_url('terms-and-conditions'); ?>"><p><?php echo $language['Terms & Condition']; ?></p></a></li>
                            <li><a href="<?php echo base_url('contact-us'); ?>"><p><?php echo $language['Contact Us']; ?></p></a></li>
                            <li><a href="<?php echo base_url('faq/faqs'); ?>"><p><?php echo $language['FAQ']; ?></p></a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4">
                        <div class="footer-title">
                            <h3><?php echo $language['Subscribe']; ?></h3>
                        </div>
                        <div class="footer-desc">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                        <?php
                        $attributes = ['name' => 'save_subscribe_form', 'id' => 'save_subscribe_form', 'autocomplete' => 'off'];
                        echo form_open_multipart('/save-subscribe', $attributes);
                        ?>
                        <div class="subscription-form <?php if($locale=='ar'){echo 'text-right';} ?>">
                            <div class="input-group mb-3">
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <input type="email" class="form-control" placeholder="<?php echo $language['Enter Email Address']; ?>" id="email" name="email" data-error=".error2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary newsletter-btn" type="submit"><i class="icofont-envelope"></i></button>
                                </div>
                            </div>
                            <span class="error2"></span>
                        </div>
                        <?php echo form_close(); ?>
                        <ul class="footer-social-media">
                            <li><a <?php if(isset($storeSettingInfo->social_fb_link) && !empty($storeSettingInfo->social_fb_link)){echo 'href="'.$storeSettingInfo->social_fb_link.'" target="_blank"'; }else{ 'href="#"'; } ?> ><i class="icofont-facebook"></i></a></li>
                            <li><a <?php if(isset($storeSettingInfo->social_instagram_link) && !empty($storeSettingInfo->social_instagram_link)){echo 'href="'.$storeSettingInfo->social_instagram_link.'" target="_blank"'; }else{ 'href="#"'; } ?> ><i class="icofont-instagram"></i></a></li>
                            <li><a <?php if(isset($storeSettingInfo->social_twitter_link) && !empty($storeSettingInfo->social_twitter_link)){echo 'href="'.$storeSettingInfo->social_twitter_link.'" target="_blank"'; }else{ 'href="#"'; } ?> ><i class="icofont-twitter"></i></a></li>
                            <li><a <?php if(isset($storeSettingInfo->social_youtube_link) && !empty($storeSettingInfo->social_youtube_link)){echo 'href="'.$storeSettingInfo->social_youtube_link.'" target="_blank"'; }else{ 'href="#"'; } ?> ><i class="icofont-youtube"></i></a></li>
                            <li><a <?php if(isset($storeSettingInfo->social_linkedin_link) && !empty($storeSettingInfo->social_linkedin_link)){echo 'href="'.$storeSettingInfo->social_linkedin_link.'" target="_blank"'; }else{ 'href="#"'; } ?> ><i class="icofont-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-credit text-center">
                    <p><?php echo $language['Powered By']; ?> <a href="https://matjary.sa">Matjary</a></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- COOKIE STARTS -->
    <div class="cookie-box" id="CookieConsentBox">
        <h4><?php echo $language['Cookies Consent']; ?></h4>
        <p><?php echo $language['cookie_desc']; ?> <a href="<?php echo base_url('cookie-policy'); ?>"><?php echo $language['Cookie Policy']; ?></a>.</p>
        <div class="<?php echo ($locale == 'ar') ?'text-left':'text-right'; ?>">
            <button class="brand-btn" id="acceptCookie"><?php echo $language['Accept']; ?></button>
            <button class="brand-btn" id="declineCookie"><?php echo $language['Decline']; ?></button>
        </div>
    </div>
    <!-- COOKIE ENDS -->
</body>
</html>
