<?php
$session = \Config\Services::session();
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
$allowedDatatablePagesAry = array('My Gift Details', 'My Orders', 'My Refund Details');
$ristrictLanguageSwitcherPages = array('Order Success','طلب النجاح');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<!DOCTYPE html>
<html lang="<?php echo $locale; ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Site favicon -->
     <?php if (isset($storeSettingInfo->favicon) && !empty($storeSettingInfo->favicon)) { ?>
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>/store_admin/src/images/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('uploads/favicon/'); ?>/<?php echo isset($storeSettingInfo->favicon) ? $storeSettingInfo->favicon : ''; ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('uploads/favicon/'); ?>/<?php echo isset($storeSettingInfo->favicon) ? $storeSettingInfo->favicon : ''; ?>">
    <?php } else { ?>
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('uploads/favicon'); ?>/default_favicon.png">
    <?php } ?>
    <title><?php echo (isset($pageTitle) && !empty($pageTitle)) ? $pageTitle : 'Home'; ?> | <?php echo (isset($storeSettingInfo->name) && !empty($storeSettingInfo->name)) ? $storeSettingInfo->name : $storeInfo['responseData']['store_sub_domain']; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/normalize.css">
    <!-- Iconfont Link -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/icofont/icofont.min.css" />
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <?php if (isset($pageTitle) && in_array($pageTitle, $allowedDatatablePagesAry)) { ?>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    <?php } ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <?php //if (isset($pageTitle) && in_array($pageTitle, $allowedDatatablePagesAry)) { ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <?php //} ?>
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script-->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/style.css">

    <!-- Bootstrap JS -->
    <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- Playhub Stylesheet -->       
    <?php if($ses_lang=='ar'){ ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/playhub-styles-ar.css" />
    <?php }elseif($ses_lang=='en'){?> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/playhub-styles.css" />
    <?php }else{ ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/playhub-styles-ar.css" />
    <?php } ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/responsive.css" />

    <!-- Font Styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/fonts.css" />

    <!-- BOOTNAV STYLESHEET -->
    <?php if($ses_lang=='ar'){ ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/bootnavbar-ar.css">
    <?php }elseif($ses_lang=='en'){?> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/bootnavbar.css">
    <?php }else{ ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/css/bootnavbar-ar.css">
    <?php } ?>
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
    <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/js/main.js"></script>
       <!--Jquery Validation js start-->
       <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/js/jquery-validate.js"></script>
    <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/js/form-validation.js"></script>
    <!--Jquery Validation js end-->
    <!--Sweetalert js start -->
    <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/js/sweetalert.min.js"></script>
    <!--Sweetalert js end -->

    <script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/js/ajax-call.js"></script>
    <?php
    $base_url = base_url();
    if (isset($pageCostomCss) && !empty($pageCostomCss)) {
        foreach ($pageCostomCss as $cssKey => $cssKeyValues) {
            echo '<link rel="stylesheet" href="' . $base_url . '/store/' . $storeActvTmplName . '/assets/css/' . $cssKeyValues . '" />';
        }
    }

    if (isset($pageCostomJs) && !empty($pageCostomJs)) {
        foreach ($pageCostomJs as $jsKey => $jsKeyValues) {
            echo '<link rel="stylesheet" href="' . $base_url . '/store/' . $storeActvTmplName . '/assets/js/' . $jsKeyValues . '" />';
        }
    }
    ?>
</head>
<body>
<div class="preloaderBg" id="preloader" style="display: none;">
    <div class="preloader-position">
        <h3><?php echo $language['Please wait till processing.']; ?>..</h3>
        <div class="preloader"></div>
        <div class="preloader2"></div>
    </div>
</div>
<header>
    <div class="topbar ml-auto">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-9">                    
                    <div class="d-flex search-btn">   
                        <input type="text" value="<?php echo isset($_REQUEST['query'])?$_REQUEST['query']:''; ?>" placeholder="<?php echo $language['publicSearch']; ?>" id="gsearchsimple" class="brand-input ml-2 input-search" />
                        <a href="javascript:void(0);" id="gsearchBtn" class="brand-btn-black ml-2"><i class="icofont-search"></i></a>
                    </div>
                    <ul class="list-group" > </ul>     
                </div>                
                <div class="col-md-3 text-right">
                    <div class="dropdown <?php if($locale=='ar'){echo 'text-left';} ?> mt-sm-2 mt-md-0 mt-0">
                        <?php if (isset($ses_logged_in) && $ses_logged_in === true) { ?>
                            <a class="dropdown-toggle mb-0 login-dropdown" data-toggle="dropdown" aria-expanded="false">
                            <?php echo $language['Hello']; ?> , <strong><?php echo $ses_custmr_name; ?></strong>
                            </a>
                            <div class="login-menu dropdown-menu">
                                <a class="dropdown-item" href="<?php echo base_url('customer/my-account'); ?>"><?php echo $language['My Account']; ?></a>
                                <a class="dropdown-item" href="<?php echo base_url('customer/change-password'); ?>"><?php echo $language['Change Password']; ?></a>
                                <a class="dropdown-item" href="<?php echo base_url('customer/customer-logout'); ?>"><?php echo $language['Logout']; ?></a>
                            </div>
                        <?php } else { ?>
                            <a class="dropdown-toggle mb-0 login-dropdown" data-toggle="dropdown" aria-expanded="false">
                            <?php echo $language['SignIn']; ?> | <?php echo $language['SignUp']; ?>
                            </a>
                            <div class="login-menu dropdown-menu">
                                <a class="dropdown-item" href="<?php echo base_url('customer/login'); ?>"><?php echo $language['SignIn']; ?></a>
                                <a class="dropdown-item" href="<?php echo base_url('customer/register'); ?>"><?php echo $language['SignUp']; ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php //echo '<pre>'; print_r($productCategories['subcat']); ?>
    <!-- HEADER STARTS -->
    <nav class="navbar navbar-expand-lg navbar-light header-nav" id="main_navbar">
        <a class="navbar-brand" href="index.php">
            <div class="store-logo">
                <?php if (isset($storeSettingInfo->logo) && !empty($storeSettingInfo->logo)) { ?>
                    <a href="<?php echo base_url('home'); ?>"><img src="<?php echo base_url('/uploads/logo/'); ?>/<?php echo isset($storeSettingInfo->logo) ? $storeSettingInfo->logo : ''; ?>" width="150px" height="50px"></a>
                <?php } else { ?>
                    <img src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/images/logo.png">
                <?php } ?>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0 mob-ar-align ">
                
                    <li class="nav-item header-item">
                        <a class="nav-link active <?php if (isset($pageId) && $pageId == 1) { echo 'menu-active'; } else { echo ''; } ?>" aria-current="page" href="<?php echo base_url('home'); ?>"><?php echo $language['navHome']; ?></a>
                    </li>
                    <li class="nav-item header-item">
                        <a class="nav-link <?php if (isset($pageId) && $pageId == 4) { echo 'menu-active'; } else { echo ''; } ?>" href="<?php echo base_url('abouts-us'); ?>"><?php echo $language['About Us']; ?></a>
                    </li>
                    <li class="nav-item dropdown header-item">                   
                        <a class="nav-link dropdown-toggle  <?php if (isset($pageId) && $pageId == 2) { echo 'menu-active'; } else { echo ''; } ?>" href="<?php echo base_url('product/products'); ?>" role="button" data-bs-toggle="dropdown">
                            <?php echo $language['All Category']; ?>
                        </a> 
                        <ul class="dropdown-menu header-dropdown-menu">
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
                                        $subCatCount = count($prodCat->subcat);
                                        ?>
                                        <li <?php if($subCatCount>0){ ?> class="nav-item dropdown" <?php } ?>>
                                            <a  href="<?php echo base_url('category/category-product-list/' . $prodCat->id); ?>"  <?php if($subCatCount>0){ ?>class="dropdown-item dropdown-toggle" role="button" data-bs-toggle="dropdown" <?php }else{ ?>class="dropdown-item" <?php } ?>   ><?php echo $category_name; ?> </a>
                                            <ul class="dropdown-menu header-dropdown-menu">
                                                <?php foreach ($prodCat->subcat as $prodCatSub) {  
                                                        $category_name_second = '';
                                                        if($ses_lang=='en'){
                                                            if(isset($prodCatSub->category_name) && !empty($prodCatSub->category_name)){
                                                                    $category_name_second = $prodCatSub->category_name;
                                                            }else{
                                                                if(isset($prodCatSub->category_name_ar) && !empty($prodCatSub->category_name_ar)){
                                                                    $category_name_second = $prodCatSub->category_name_ar;
                                                                }
                                                            }                                                    
                                                        }else{
                                                            if(isset($prodCatSub->category_name_ar) && !empty($prodCatSub->category_name_ar)){
                                                                    $category_name_second = $prodCatSub->category_name_ar;
                                                            }else{
                                                                if(isset($prodCatSub->category_name) && !empty($prodCatSub->category_name)){
                                                                    $category_name_second = $prodCatSub->category_name;
                                                                }
                                                            }                                                                                    
                                                        }  
                                                        $subThirdCatCount = count($prodCatSub->subcat_level_1); ?>    
                                                        <li <?php if($subThirdCatCount>0){ ?> class="nav-item dropdown" <?php } ?>>
                                                            <a 
                                                                <?php if($subThirdCatCount>0){ ?> class="dropdown-item dropdown-toggle" <?php }else{ ?>class="dropdown-item" <?php } ?> href="<?php  echo base_url('category/category-product-list/' . $prodCatSub->id); ?>" role="button" data-bs-toggle="dropdown"><?php echo $category_name_second; ?>
                                                            </a>
                                                            <ul class="dropdown-menu header-dropdown-menu">
                                                                <?php  foreach ($prodCatSub->subcat_level_1 as $prodCatthird) {  
                                                                    $category_name_third = '';
                                                                    if($ses_lang=='en'){
                                                                        if(isset($prodCatthird->category_name) && !empty($prodCatthird->category_name)){
                                                                                $category_name_third = $prodCatthird->category_name;
                                                                        }else{
                                                                            if(isset($prodCatthird->category_name_ar) && !empty($prodCatthird->category_name_ar)){
                                                                                $category_name_third = $prodCatthird->category_name_ar;
                                                                            }
                                                                        }
                                                                        
                                                                    }else{
                                                                        if(isset($prodCatthird->category_name_ar) && !empty($prodCatthird->category_name_ar)){
                                                                                $category_name_third = $prodCatthird->category_name_ar;
                                                                        }else{
                                                                            if(isset($prodCatthird->category_name) && !empty($prodCatthird->category_name)){
                                                                                $category_name_third = $prodCatthird->category_name;
                                                                            }
                                                                        }
                                                                                                        
                                                                    }  
                                                                    ?> 
                                                                    <li class="nav-item dropdown">
                                                                        <a  class="dropdown-item" href="<?php echo base_url('category/category-product-list/' . $prodCatthird->id); ?>" role="button" data-bs-toggle="dropdown">
                                                                        <?php echo $category_name_third; ?>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </li>
                                                <?php } ?>                                        
                                            </ul>
                                        </li>
                                 <?php } ?>
                            <?php  } ?>
                            <?php if (isset($productCategories) && !empty($productCategories)) { ?>
                                <li class="all-category-list-item"><a href="<?php echo base_url('category/all-categories'); ?>" class="all-category-list-link dropdown-item"><?php echo $language['All Categories']; ?><i class="fas fa-angle-right"></i></a></li>
                            <?php }else{ ?>
                                <li class="all-category-list-item"><a href="javascript:void(0);" class="all-category-list-link dropdown-item"><?php echo $language['No Data Found']; ?><i class="fas fa-angle-right"></i></a></li>
                            <?php } ?>
                        </ul>
                    </li> 
                    <li class="nav-item header-item">
                        <a href="<?php echo base_url('product/products'); ?>" class="nav-link <?php if (isset($pageId) && $pageId == 2) { echo 'menu-active'; } else { echo ''; } ?>"><?php echo $language['navProducts']; ?></a>
                    </li>   
                               
                    <li class="nav-item header-item">
                        <a class="nav-link <?php if (isset($pageId) && $pageId == 3) { echo 'menu-active'; } else { echo ''; } ?>" href="<?php echo base_url('giftcard/gift-cards'); ?>"><?php echo $language['navGiftCards']; ?></a>
                    </li>
                    <li class="nav-item header-item">
                        <a class="nav-link <?php if (isset($pageId) && $pageId == 4) { echo 'menu-active'; } else { echo ''; } ?>" href="<?php echo base_url('contact-us'); ?>"><?php echo $language['Contact Us']; ?></a>
                    </li>
            </ul>

            <form class="form-inline my-2 my-lg-0">
                <div class="header-icon">
                    <a href="<?php echo base_url('customer/my-wishlist'); ?>">
                        <i class="icofont-heart"></i>
                    </a>
                    <a href="<?php echo base_url('customer/cart'); ?>">
                    <?php if (isset($ses_logged_in) && $ses_logged_in === true) { ?>
                        <?php
                        $cartCount = 0;
                        if (isset($snglCstmrCartProductList) && !empty($snglCstmrCartProductList)) {
                            $cartCount = count($snglCstmrCartProductList);
                        }
                        ?>
                        <i class="icofont-cart" id="cartCount"><?php echo $cartCount; ?></i>
                    <?php } else { ?>
                        <i class="icofont-cart"></i>
                    <?php } ?>
                    </a>
                </div>

                <div class="language-link">
                    <?php if(isset($pageTitle) && !in_array($pageTitle,$ristrictLanguageSwitcherPages)){ ?>
                        <?php if (isset($lang_session) && $lang_session === true) { ?>
                            <?php if ( $ses_lang == 'ar') { ?>
                                <a href="javascript:void(0);" data-actionurl="<?php echo base_url('/language'); ?>" data-lang="en" id="languageChange" class="nav-content-link" >EN</a>
                            <?php }elseif($ses_lang == 'en'){ ?>
                                <a href="javascript:void(0);" data-actionurl="<?php echo base_url('/language'); ?>" data-lang="ar" id="languageChange" class="nav-content-link" >AR</a>
                            <?php } ?>  
                            <?php }else{ ?>
                                <a href="javascript:void(0);" data-actionurl="<?php echo base_url('/language'); ?>" data-lang="en" id="languageChange" class="nav-content-link" >EN</a>  
                            <?php } ?>
                    <?php } ?>
                </div>

            </form>
        </div>
    </nav>
    <!-- HEADE ENDS -->
    
</header>
<?php $this->renderSection('content'); ?>
<script src="<?php echo base_url(); ?>/store/<?php echo $storeActvTmplName; ?>/assets/js/bootnavbar.js"></script>
<?php if (isset($pageTitle) && in_array($pageTitle, $allowedDatatablePagesAry)) { ?>
        <!--DataTable js start-->
        <link rel="stylesheet" type="text/css" href="/store/<?php echo $storeActvTmplName; ?>/assets/datatables/css/jquery.dataTables.min.css">
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
<footer>
    <div class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="footer-title">
                        <h5><?php echo $language['About Us']; ?></h5>
                    </div>
                    <div class="footer-info">
                    <?php if (isset($storeSettingInfo->logo) && !empty($storeSettingInfo->logo)) { ?>
                    <a href="<?php echo base_url('home'); ?>"><img src="<?php echo base_url('/uploads/logo/'); ?>/<?php echo isset($storeSettingInfo->logo) ? $storeSettingInfo->logo : ''; ?>" alt="Logo Image" class="img img-responsive"></a>
                    <?php } else { ?>
                        <a href="<?php echo base_url('home'); ?>"><img src="https://placehold.jp/100x100.png" alt="Logo Image" class="img img-responsive"></a>
                    <?php } ?>
                        <p><?php echo isset($AboutUsInfo->short_description) ? $AboutUsInfo->short_description : ''; ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="footer-title">
                        <h5><?php echo $language['Useful Links']; ?></h5>
                    </div>

                    <ul class="footer-list">
                        <li class="d-flex align-items-center">
                            <i class="icofont-stylish-right"></i>
                            <a href="<?php echo base_url('abouts-us'); ?>"><?php echo $language['About Us']; ?></a>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="icofont-stylish-right"></i>
                            <a href="<?php echo base_url('contact-us'); ?>"><?php echo $language['Contact Us']; ?></a>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="icofont-stylish-right"></i>
                            <a href="<?php echo base_url('customer-help'); ?>"><?php echo $language['navHelp']; ?></a>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="icofont-stylish-right"></i>
                            <a href="<?php echo base_url('terms-and-conditions'); ?>"><?php echo $language['Terms & Conditions']; ?></a>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="icofont-stylish-right"></i>
                            <a href="<?php echo base_url('privacy-policy'); ?>"><?php echo $language['Privacy Policy']; ?></a>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="icofont-stylish-right"></i>
                            <a href="<?php echo base_url('refund-return'); ?>"><?php echo $language['Refund & Return']; ?></a>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="icofont-stylish-right"></i>
                            <a href="<?php echo base_url('faq/faqs'); ?>"><?php echo $language['FAQ']; ?></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="footer-title">
                        <h5><?php echo $language['Contact Us']; ?></h5>
                    </div>

                    <div class="contact-info">
                        <i class="icofont-location-pin"></i>
                        <a href="#">
                            <p><?php echo isset($storeSettingInfo->address) ? $storeSettingInfo->address : ''; ?></p>
                        </a>
                    </div>

                    <div class="contact-info">
                        <i class="icofont-ui-call"></i>
                        <a href="tel:">
                            <p><?php echo isset($storeSettingInfo->contact_no) ? $storeSettingInfo->contact_no : ''; ?></p>
                        </a>
                    </div>

                    <div class="contact-info">
                        <i class="icofont-envelope"></i>
                        <a href="mailto:">
                            <p><?php echo isset($storeSettingInfo->support_email) ? $storeSettingInfo->support_email : ''; ?></p>
                        </a>
                    </div>

                    <ul class="footer-social">
                    <li><a <?php if (isset($storeSettingInfo->social_fb_link) && !empty($storeSettingInfo->social_fb_link)) {
                                        echo 'href="' . $storeSettingInfo->social_fb_link . '" target="_blank"';
                                    } else {
                                        'href="#"';
                                    } ?>><i class="icofont-facebook"></i></a></li>
                            <li><a <?php if (isset($storeSettingInfo->social_instagram_link) && !empty($storeSettingInfo->social_instagram_link)) {
                                        echo 'href="' . $storeSettingInfo->social_instagram_link . '" target="_blank"';
                                    } else {
                                        'href="#"';
                                    } ?>><i class="icofont-instagram"></i></a></li>
                            <li><a <?php if (isset($storeSettingInfo->social_twitter_link) && !empty($storeSettingInfo->social_twitter_link)) {
                                        echo 'href="' . $storeSettingInfo->social_twitter_link . '" target="_blank"';
                                    } else {
                                        'href="#"';
                                    } ?>><i class="icofont-twitter"></i></a></li>
                            <li><a <?php if (isset($storeSettingInfo->social_youtube_link) && !empty($storeSettingInfo->social_youtube_link)) {
                                        echo 'href="' . $storeSettingInfo->social_youtube_link . '" target="_blank"';
                                    } else {
                                        'href="#"';
                                    } ?>><i class="icofont-youtube"></i></a></li>
                            <li><a <?php if (isset($storeSettingInfo->social_linkedin_link) && !empty($storeSettingInfo->social_linkedin_link)) {
                                        echo 'href="' . $storeSettingInfo->social_linkedin_link . '" target="_blank"';
                                    } else {
                                        'href="#"';
                                    } ?>><i class="icofont-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="cards">
                <img src="<?php echo base_url('store/'.$storeActvTmplName.'/assets/images/cards.png'); ?>">      
                
            </div>
        </div>
    </div>
</footer>
<script>
    new bootnavbar();
</script>