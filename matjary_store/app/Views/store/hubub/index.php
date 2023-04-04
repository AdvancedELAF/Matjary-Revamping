<?php
$session = \Config\Services::session();
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
$allowedDatatablePagesAry = array('My Gift Details', 'My Orders', 'My Refund Details');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/' . $storeActvTmplName . '/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- HOME CAROUSEL STARTS -->
<div class="home-carousel">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <?php
            //echo '<pre>'; print_r($BannerList);  die;
            if (isset($BannerList) && !empty($BannerList)) {
                $j = 1;
                foreach ($BannerList as $i => $value) {
            ?>
                    <li data-target="#carouselExampleIndicators<?php echo $i; ?>" data-slide-to="<?php echo $j; ?>" class="<?php echo (!$i ? 'active' : ''); ?>"></li>
            <?php
                    $j++;
                }
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            if (isset($BannerList) && !empty($BannerList)) {
                foreach ($BannerList as $i => $value) {
            ?>
            <div class="carousel-item <?php echo (!$i ? 'active' : ''); ?>">
                <img src="<?php echo base_url('uploads/banners/'); ?>/<?php echo isset($value->image) ? $value->image : ''; ?>" class="d-block w-100">
                <div class="carousel-content">
                    <h3><?php echo $ses_lang=='en' ? $value->title : $value->title_ar; ?><span class="green-highlight"></span></h3>
                    <p><?php echo $ses_lang=='en' ? $value->sub_title : $value->sub_title_ar; ?></p>
                    <?php if(isset($value->banner_url) && !empty($value->banner_url)){ ?>
                     <a target="_blank" href="<?php echo isset($value->banner_url)?$value->banner_url:''; ?>" class="brand-btn"><?php echo $language['Shop Now']; ?></a>
                    <?php } ?>
                </div>
            </div>
            <?php
                }
            } else { 
            ?>
                <div class="carousel-item active">
                    <img src="https://biagiotti.qodeinteractive.com/elementor/wp-content/uploads/2019/08/m-h-slider-img-1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-content">
                        <h3></h3>
                        <p></p>
                    </div>
                </div>

            <?php } ?>            
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>
</div>
<!-- HOME CAROUSEL ENDS -->
<?php if (isset($advertisementList) && !empty($advertisementList)) { ?>
    <section class="mt-5">
        <div class="container">       
            <div class="row">
                <?php
                if (isset($advertisementList) && !empty($advertisementList)) {
                    foreach ($advertisementList as $advertisementData) {
                        $title = '';
                        $sub_title = '';
                        if($ses_lang=='en'){
                            if(isset($advertisementData->title) && !empty($advertisementData->title)){
                                $title = $advertisementData->title;
                            }else{
                                if(isset($advertisementData->title_ar) && !empty($advertisementData->title_ar)){
                                    $title = $advertisementData->title_ar;
                                }
                            }
                            
                            if(isset($advertisementData->sub_title) && !empty($advertisementData->sub_title)){
                                $sub_title = $advertisementData->sub_title;
                            }else{
                                if(isset($advertisementData->sub_title_ar) && !empty($advertisementData->sub_title_ar)){
                                    $sub_title = $advertisementData->sub_title_ar;
                                }
                            }
                        }else{
                            if(isset($advertisementData->title_ar) && !empty($advertisementData->title_ar)){
                                $title = $advertisementData->title_ar;
                            }else{
                                if(isset($advertisementData->title) && !empty($advertisementData->title)){
                                    $title = $advertisementData->title;
                                }
                            }
                            if(isset($advertisementData->sub_title_ar) && !empty($advertisementData->sub_title_ar)){
                                $sub_title = $advertisementData->sub_title_ar;
                            }else{
                                if(isset($advertisementData->sub_title) && !empty($advertisementData->sub_title)){
                                    $sub_title = $advertisementData->sub_title;
                                }
                            }                                 
                        }
                    if ($advertisementData->add_position == '1') {
                ?>
                <div class="col-md-6">
                    <div class="ad-banner">                    
                        <a href="<?php echo $advertisementData->advertise_link; ?>">
                            <img class="img-fluid" src="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementData->add_img) ? $advertisementData->add_img : ''; ?>">
                        </a>
                        <div class="ad-content">
                            <h4><?php echo $title;  ?></h4>
                            <p><?php $sub_title; ?></p>
                        </div>
                    </div>
                </div>
                <?php }
                if ($advertisementData->add_position == '2') { ?>
                <div class="col-md-6">
                <div class="ad-banner">                    
                        <a href="<?php echo $advertisementData->advertise_link; ?>">
                            <img class="img-fluid" src="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementData->add_img) ? $advertisementData->add_img : ''; ?>">
                        </a>
                        <div class="ad-content">
                            <h4><?php echo $title;  ?></h4>
                            <p><?php echo $sub_title; ?></p>
                        </div>
                    </div>
                </div>
                <?php }
                                
                    }
                }
                ?>
            </div>
        </div>
    </section>
<?php } ?>
<!-- HOME AD SECTION ENDS -->
<!-- ADVERTISEMENT SECTION ENDS -->
<?php if (isset($productList) && !empty($productList)) { ?>
    <!-- LATEST PRODUCT SECTION STARTS -->
    <?php if (isset($productLatestList) && !empty($productLatestList)) { ?>
        <section class="section-spacing">
            <div class="container">
                <div class="section-title text-<?php echo $ses_lang == 'en'?'left':'right'; ?> mb-5">
                    <h4><?php echo $language['Latest Products']; ?></h4>
                </div>
                <div class="row">
                <?php
                        if (isset($productLatestList) && !empty($productLatestList)) {
                            foreach ($productLatestList as $productData) {
                                $actionWishlisturl = base_url('customer/add-product-wishlist');
                                $press = '';
                                $wishlistActnClass = 'addProdToWshlst';

                                if (isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)) {
                                    foreach ($cstmrWishPrdctList as $cstmrWishPrdctData) {
                                        if ($cstmrWishPrdctData->product_id == $productData->id) {
                                            $actionWishlisturl = base_url('customer/remove-product-wishlist');
                                            $press = 'press';
                                            $wishlistActnClass = 'removeProdFromWshlst';
                                        }
                                    }
                                }
                                $title = '';
                                if($ses_lang=='en'){
                                    if(isset($productData->title) && !empty($productData->title)){
                                        $title = $productData->title;
                                    }else{
                                        if(isset($productData->title_ar) && !empty($productData->title_ar)){
                                            $title = $productData->title_ar;
                                        }
                                    } 
                                }else{
                                    if(isset($productData->title_ar) && !empty($productData->title_ar)){
                                        $title = $productData->title_ar;
                                    }else{
                                        if(isset($productData->title) && !empty($productData->title)){
                                            $title = $productData->title;
                                        }
                                    }                                                        
                                }
                            ?>
                            <div class="col-md-6 col-lg-3">
                                <div class="product-wrapper">
                                        <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>">
                                            <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image) ? $productData->image : ''; ?>">
                                        </a>
                                    <div class="wishlist">
                                        <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id) ? $ses_custmr_id : ''; ?>"></i>
                                    </div>
                                    <div class="prod-cart-btn">
                                        <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>">
                                            <div class="d-flex justify-content-center">
                                                <i class="icofont-bag"></i>
                                                <h5><?php echo $language['Details']; ?></h5>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="prod-details">
                                        <h5 title="<?php echo $title; ?>"><?php echo character_limiter($title,10); ?></h5>
                                        <p class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price) ? number_format((float)$productData->retail_price, 2, '.', '') : ''; ?></p>
                                        <p class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price) ? number_format((float)$productData->product_price, 2, '.', '') : ''; ?></p>
                                    </div>
                                </div>
                            </div> 
                            <?php
                            }
                        }
                        ?>          
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- LATEST PRODUCT SECTION ENDS -->
    <!-- FEATURED PRODUCT SECTION STARTS -->
    <?php if (isset($productFeatureList) && !empty($productFeatureList)) { ?>
        <section class="section-spacing">
            <div class="container">
                <div class="section-title text-<?php echo $ses_lang == 'en'?'left':'right'; ?> mb-5">
                    <h4><?php echo $language['Featured Products']; ?></h4>
                </div>
                <div class="row">
                <?php
                if (isset($productFeatureList) && !empty($productFeatureList)) {
                    foreach ($productFeatureList as $productData) {
                        $actionWishlisturl = base_url('customer/add-product-wishlist');
                        $press = '';
                        $wishlistActnClass = 'addProdToWshlst';

                        if (isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)) {
                            foreach ($cstmrWishPrdctList as $cstmrWishPrdctData) {
                                if ($cstmrWishPrdctData->product_id == $productData->id) {
                                    $actionWishlisturl = base_url('customer/remove-product-wishlist');
                                    $press = 'press';
                                    $wishlistActnClass = 'removeProdFromWshlst';
                                }
                            }
                        }

                        $title = '';
                        if($ses_lang=='en'){
                            if(isset($productData->title) && !empty($productData->title)){
                                $title = $productData->title;
                            }else{
                                if(isset($productData->title_ar) && !empty($productData->title_ar)){
                                    $title = $productData->title_ar;
                                }
                            } 
                        }else{
                            if(isset($productData->title_ar) && !empty($productData->title_ar)){
                                $title = $productData->title_ar;
                            }else{
                                if(isset($productData->title) && !empty($productData->title)){
                                    $title = $productData->title;
                                }
                            }                                                        
                        }
                    ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="product-wrapper">
                                <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>">
                                    <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image) ? $productData->image : ''; ?>">
                                </a>
                            <div class="wishlist">
                            <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id) ? $ses_custmr_id : ''; ?>"></i>
                            </div>
                            <div class="prod-cart-btn">                       
                                <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>">
                                    <div class="d-flex justify-content-center">
                                        <i class="icofont-bag"></i>
                                        <h5><?php echo $language['Details']; ?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="prod-details">
                                <h5 title="<?php echo $title; ?>"><?php echo character_limiter($title,10); ?></h5>
                                <p class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price) ? number_format((float)$productData->retail_price, 2, '.', '') : ''; ?></p>
                                <p class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price) ? number_format((float)$productData->product_price, 2, '.', '') : ''; ?></p>
                            </div>
                        </div>
                    </div> 
                    <?php
                        }
                    }
                    ?>           
                </div>
            </div>
        </section>
    <?php } ?>
<?php }else{ ?>    
    <section class="section-spacing">
        <div class="container">
            <div class="row">
                <p><h4><?php echo $language['No Product Found']; ?></h4></p>                               
            </div>
        </div>
    </section>
<?php } ?>
<!-- FEATURED PRODUCT SECTION ENDS -->
<!-- ABOUT SECTION STARTS -->
<section class="section-spacing">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about-image mb-2">
                    <?php if(isset($AboutUsInfo->image) && !empty($AboutUsInfo->image)){ ?>
                        <img class="img-fluid" src="<?php echo base_url('uploads/aboutus/'); ?>/<?php echo isset($AboutUsInfo->image)?$AboutUsInfo->image:''; ?>">
                    <?php }else{ ?>
                        <img class="img-fluid" src="<?php echo base_url('store/'.$storeActvTmplName.'/assets/images/default-about-us.jpg'); ?>">
                    <?php } ?>  
                </div>
            </div>
            <div class="col-md-6">
                <div class="section-title text-<?php echo $ses_lang == 'en'?'left':'right'; ?> mb-3">
                    <h4><?php echo $language['About Us']; ?></h4>
                </div>
                <?php 
                    $checkshortDesc = $locale=='en'?'Short Description Not Available For NowStore About Us Content/Information Not Available Yet!.':'وصف قصير غير متوفر في الوقت الحالي تخزين معلومات عنا المحتوى / المعلومات غير متوفرة بعد !.';
                    if($locale=='en'){
                        if(isset($AboutUsInfo->short_description) && !empty($AboutUsInfo->short_description)){
                            $checkshortDesc = substr($AboutUsInfo->short_description, 0, 500);
                        }else{
                            if(isset($AboutUsInfo->short_description_ar) && !empty($AboutUsInfo->short_description_ar)){
                                $checkshortDesc = substr($AboutUsInfo->short_description_ar, 0, 500);
                            }
                        }
                    }else{
                        if(isset($AboutUsInfo->short_description_ar) && !empty($AboutUsInfo->short_description_ar)){
                            $checkshortDesc = substr($AboutUsInfo->short_description_ar, 0, 500);
                        }else{
                            if(isset($AboutUsInfo->short_description) && !empty($AboutUsInfo->short_description)){
                                $checkshortDesc = substr($AboutUsInfo->short_description, 0, 500);
                            }
                        }
                    }                    
                    //$checkshortDesc = isset($AboutUsInfo->short_description)?substr($AboutUsInfo->short_description, 0, 500):'Short Description Not Available For NowStore About Us Content/Information Not Available Yet!.';

                    ?>
                <div class="about-content">
                    <p><?php echo isset($checkshortDesc)?$checkshortDesc:''; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ABOUT SECTION ENDS -->
<!-- POS SECTION STARTS -->
<?php if (isset($productDiscountList) && !empty($productDiscountList)) { ?>
<section class="section-spacing">
    <div class="container">
        <div class="section-title text-<?php echo $ses_lang == 'en'?'left':'right'; ?> mb-5">
            <h4><?php echo $language['Products on sale']; ?></h4>
        </div>
        <div class="row">
            <?php
            if (isset($productDiscountList) && !empty($productDiscountList)) {
                foreach ($productDiscountList as $productData) {
                    $actionWishlisturl = base_url('customer/add-product-wishlist');
                    $press = '';
                    $wishlistActnClass = 'addProdToWshlst';

                    if (isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)) {
                        foreach ($cstmrWishPrdctList as $cstmrWishPrdctData) {
                            if ($cstmrWishPrdctData->product_id == $productData->id) {
                                $actionWishlisturl = base_url('customer/remove-product-wishlist');
                                $press = 'press';
                                $wishlistActnClass = 'removeProdFromWshlst';
                            }
                        }
                    }
                    $title = '';
                    if($ses_lang=='en'){
                        if(isset($productData->title) && !empty($productData->title)){
                            $title = $productData->title;
                        }else{
                            if(isset($productData->title_ar) && !empty($productData->title_ar)){
                                $title = $productData->title_ar;
                            }
                        } 
                    }else{
                        if(isset($productData->title_ar) && !empty($productData->title_ar)){
                            $title = $productData->title_ar;
                        }else{
                            if(isset($productData->title) && !empty($productData->title)){
                                $title = $productData->title;
                            }
                        }                                                        
                    }
                ?>
                <div class="col-md-6 col-lg-3">
                    <div class="product-wrapper">
                        <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>">
                            <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image) ? $productData->image : ''; ?>">
                        </a>
                        <div class="wishlist">
                        <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id) ? $ses_custmr_id : ''; ?>"></i>
                        </div>                            
                        <div class="prod-cart-btn">                       
                            <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>">
                                <div class="d-flex justify-content-center">
                                    <i class="icofont-bag"></i>
                                    <h5><?php echo $language['Details']; ?></h5>
                                </div>
                            </a>
                        </div>
                        <div class="prod-details">
                            <h5 title="<?php echo $title; ?>"><?php echo character_limiter($title,10); ?></h5>
                            <p class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price) ? number_format((float)$productData->retail_price, 2, '.', '') : ''; ?></p>
                            <p class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price) ? number_format((float)$productData->product_price, 2, '.', '') : ''; ?></p>
                        </div>
                    </div>
                </div> 
                <?php
                }
            }
            ?>                              
        </div>
    </div>
</section>
<?php } ?>
<!-- POS SECTION ENDS -->
<!-- GIFTCARD SECTION STARTS -->
<?php if (isset($GiftCardList) && !empty($GiftCardList)) { ?>
<section class="section-spacing">
    <div class="container">
        <div class="section-title text-<?php echo $ses_lang == 'en'?'left':'right'; ?> mb-5">
            <h4><?php echo $language['Gift cards']; ?></h4>
        </div>
        <div class="row">
            <?php
                if (isset($GiftCardList) && !empty($GiftCardList)) {
                    foreach ($GiftCardList as $GiftCardData) {
                        $name = '';
                        if($ses_lang=='en'){
                            if(isset($GiftCardData->name) && !empty($GiftCardData->name)){
                                $name = $GiftCardData->name;
                            }else{
                                if(isset($GiftCardData->name_ar) && !empty($GiftCardData->name_ar)){
                                    $name = $GiftCardData->name_ar;
                                }
                            } 
                        }else{
                            if(isset($GiftCardData->name_ar) && !empty($GiftCardData->name_ar)){
                                $name = $GiftCardData->name_ar;
                            }else{
                                if(isset($GiftCardData->name) && !empty($GiftCardData->name)){
                                    $name = $GiftCardData->name;
                                }
                            }                                                        
                        }
            $today = date("Y-m-d");
            if (date("Y-m-d", strtotime($GiftCardData->expiry_date)) >= $today) {
            ?>
            <div class="col-md-6 col-lg-3">
                <div class="product-wrapper">
                    <a href="<?php echo base_url('giftcard/giftcard-details/' . $GiftCardData->id); ?>">
                        <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($GiftCardData->image) ? $GiftCardData->image : ''; ?>">
                    </a>
                    <!--div class="wishlist">
                        <i class="icofont-heart"></i>
                    </div-->
                    <div class="prod-cart-btn">
                        <a href="<?php echo base_url('giftcard/giftcard-details/' . $GiftCardData->id); ?>">
                            <div class="d-flex justify-content-center">
                                <i class="icofont-bag"></i>
                                <h5><?php echo $language['Details']; ?></h5>
                            </div>
                        </a>                       
                    </div>
                    <div class="prod-details">
                        <h5><?php echo $name;  ?></h5>                      
                    </div>
                </div>                
            </div>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</section>
<?php } ?>
<!-- GIFTCARD SECTION ENDS -->
<!-- AD BANNER SECTION STARTS -->
<section class="mt-5">
    <div class="container">       
        <div class="row">
            <?php
            if (isset($advertisementList) && !empty($advertisementList)) {
                foreach ($advertisementList as $advertisementData) {
                    $title = '';
                    $sub_title = '';
                    if($ses_lang=='en'){
                        if(isset($advertisementData->title) && !empty($advertisementData->title)){
                            $title = $advertisementData->title;
                        }else{
                            if(isset($advertisementData->title_ar) && !empty($advertisementData->title_ar)){
                                $title = $advertisementData->title_ar;
                            }
                        }
                        
                        if(isset($advertisementData->sub_title) && !empty($advertisementData->sub_title)){
                            $sub_title = $advertisementData->sub_title;
                        }else{
                            if(isset($advertisementData->sub_title_ar) && !empty($advertisementData->sub_title_ar)){
                                $sub_title = $advertisementData->sub_title_ar;
                            }
                        }
                    }else{
                        if(isset($advertisementData->title_ar) && !empty($advertisementData->title_ar)){
                            $title = $advertisementData->title_ar;
                        }else{
                            if(isset($advertisementData->title) && !empty($advertisementData->title)){
                                $title = $advertisementData->title;
                            }
                        }
                        if(isset($advertisementData->sub_title_ar) && !empty($advertisementData->sub_title_ar)){
                            $sub_title = $advertisementData->sub_title_ar;
                        }else{
                            if(isset($advertisementData->sub_title) && !empty($advertisementData->sub_title)){
                                $sub_title = $advertisementData->sub_title;
                            }
                        }                                 
                    }
                if ($advertisementData->add_position == '3') {
            ?>
                <div class="ad-banner">                    
                    <a href="<?php echo $advertisementData->advertise_link; ?>">
                        <img class="img-fluid" src="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementData->add_img) ? $advertisementData->add_img : ''; ?>">
                    </a>
                    <div class="ad-content">
                        <h4><?php echo $title;  ?></h4>
                        <p><?php $sub_title; ?></p>
                    </div>
                </div>
            <?php }         
                            
                }
            }
            ?>
        </div>
    </div>
</section>
<!-- AB BANNER SECTION ENDS -->
<!-- BRAND PARTNER SECTION STARTS -->
<?php if(isset($BrandInfo) && !empty($BrandInfo)){ ?>
<section class="section-spacing">
    <div class="container">
        <div class="section-title text-<?php echo $ses_lang == 'en'?'left':'right'; ?> mb-3">
            <h4><?php echo $language['Brands we offer']; ?></h4>
        </div>
        <div class="carousel-wrapper mt-2">
            <div id="brand-partners-carousel" class="owl-carousel owl-theme">
                <?php 
                if(isset($BrandInfo) && !empty($BrandInfo)){
                    foreach($BrandInfo as $brandInfoData){
                ?>
                <div class="item">
                    <div class="brand-wrapper">
                        <img src="<?php echo base_url('/uploads/product_brands/'); ?>/<?php echo isset($brandInfoData->brand_image) ? $brandInfoData->brand_image : ''; ?>">
                    </div>
                </div>
                <?php
                    }
                }
                ?> 
            </div>
        </div>
    </div>
</section>
<?php } ?>
<!-- BRAND PARTNER SECTION ENDS -->
<?php $this->endSection(); ?>