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
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
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
                            <h3><?php echo $ses_lang=='en' ? $value->title : $value->title_ar; ?></h3>
                            <p><?php echo $ses_lang=='en' ? $value->sub_title : $value->sub_title_ar; ?></p>
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
<!-- HOME AD SECTION STARTS -->
<?php if (isset($advertisementList) && !empty($advertisementList)) { ?>
<section class="mt-5">
    <div class="container">       
        <div class="row">
            <?php
            //echo '<pre>'; print_r($advertisementList); die;
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
            <div class="col-lg-4">
                <div class="ad-wrapper">                    
                    <a href="<?php echo $advertisementData->advertise_link; ?>">
                        <img src="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementData->add_img) ? $advertisementData->add_img : ''; ?>">
                    </a>
                    <div class="ad-content">
                        <h4><?php echo $title;  ?></h4>
                        <p><?php $sub_title; ?></p>
                    </div>
                </div>
            </div>
            <?php }
            if ($advertisementData->add_position == '2') { ?>
            <div class="col-lg-4">
            <div class="ad-wrapper">                    
                    <a href="<?php echo $advertisementData->advertise_link; ?>">
                        <img src="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementData->add_img) ? $advertisementData->add_img : ''; ?>">
                    </a>
                    <div class="ad-content">
                        <h4><?php echo $title;  ?></h4>
                        <p><?php echo $sub_title; ?></p>
                    </div>
                </div>
            </div>
            <?php }
                if ($advertisementData->add_position == '3') { ?>
            <div class="col-lg-4">
            <div class="ad-wrapper">                    
                    <a href="<?php echo $advertisementData->advertise_link; ?>">
                        <img src="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementData->add_img) ? $advertisementData->add_img : ''; ?>">
                    </a>
                    <div class="ad-content">
                        <h4><?php echo $title;  ?></h4>
                        <p><?php echo $sub_title; ?></p>
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
<!-- HOME AD SECTION ENDS -->
<?php if (isset($productList) && !empty($productList)) { ?>
    <!-- HOME LATEST PRODUCT SECTION STARTS -->
    <?php if(isset($productLatestList) && !empty($productLatestList)){ ?>
        <section class="section-spacing">
            <div class="container">
                <div class="section-title text-<?php echo $ses_lang == 'en'?'left':'right'; ?> mb-4">
                    <h4><?php echo $language['Latest Products']; ?></h4>
                </div>
                <div class="carousel-wrapper">
                    <div id="latest-products-carousel" class="owl-carousel owl-theme">
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
                                <div class="item">
                                    <div class="prod-wrapper">
                                        <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>">
                                            <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image) ? $productData->image : ''; ?>">
                                        </a>
                                        <div class="prod-detail">
                                            <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>" title="<?php echo $title; ?>">
                                                <h4><?php echo character_limiter($title,10); ?></h4>
                                            </a>
                                            <div class="home-prod-price mb-2 text-center">
                                                <div class="wishlist">
                                                    <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id) ? $ses_custmr_id : ''; ?>"></i>
                                                </div>
                                                <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price) ? number_format((float)$productData->retail_price, 2, '.', '') : ''; ?></span>
                                                <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price) ? number_format((float)$productData->product_price, 2, '.', '') : ''; ?></span>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>" class="brand-btn"><?php echo $language['Details']; ?></a>
                                        </div>
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
    <!-- HOME LATEST PRODUCT SECTION ENDS -->
    <!-- HOME FEATURED PRODUCT SECTION STARTS -->
    <?php if (isset($productFeatureList) && !empty($productFeatureList)) { ?>
    <section class="section-spacing">
        <div class="container">
            <div class="section-title mb-4 text-<?php echo $ses_lang == 'en'?'left':'right'; ?>">
                <h4><?php echo $language['Featured Products']; ?></h4>
            </div>
            <div class="carousel-wrapper">
                <div id="featured-products-carousel" class="owl-carousel owl-theme">
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
                            <div class="item">
                                <div class="prod-wrapper">
                                    <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>">
                                        <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image) ? $productData->image : ''; ?>">
                                    </a>
                                    <div class="prod-detail">
                                        <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>" title="<?php echo $title; ?>">
                                            <h4><?php echo character_limiter($title,10); ?></h4>
                                        </a>
                                        <div class="home-prod-price mb-2 text-center">
                                            <div class="wishlist">
                                                <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id) ? $ses_custmr_id : ''; ?>"></i>
                                            </div>
                                            <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price) ? number_format((float)$productData->retail_price, 2, '.', '') : ''; ?></span>
                                            <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price) ? number_format((float)$productData->product_price, 2, '.', '') : ''; ?></span>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>" class="brand-btn"><?php echo $language['Details']; ?></a>
                                    </div>
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
    <!-- HOME FEATURED PRODUCT SECTION ENDS -->
    <!-- HOME POS SECTION STARTS -->
    <?php if (isset($productDiscountList) && !empty($productDiscountList)) { ?>
    <section class="section-spacing">
        <div class="container">
            <div class="section-title mb-4 text-<?php echo $ses_lang == 'en'?'left':'right'; ?>">
                <h4><?php echo $language['Products on sale']; ?></h4>
            </div>
            <div class="carousel-wrapper">
                <div id="pos-products-carousel" class="owl-carousel owl-theme">
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
                            <div class="item">
                                <div class="prod-wrapper">
                                    <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>">
                                        <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image) ? $productData->image : ''; ?>">
                                    </a>
                                    <div class="prod-detail">
                                        <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>" title="<?php echo $title; ?>">
                                            <h4><?php echo character_limiter($title,10); ?></h4>
                                        </a>
                                        <div class="home-prod-price mb-2 text-center">
                                            <div class="wishlist">
                                                <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id) ? $ses_custmr_id : ''; ?>"></i>
                                            </div>
                                            <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price) ? number_format((float)$productData->retail_price, 2, '.', '') : ''; ?></span>
                                            <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price) ? number_format((float)$productData->product_price, 2, '.', '') : ''; ?></span>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="<?php echo base_url('product/product-details/' . $productData->id); ?>" class="brand-btn"><?php echo $language['Details']; ?></a>
                                    </div>
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
<?php }else{ ?>    
    <section class="section-spacing">
        <div class="container">
            <div class="row">
                <p><h4><?php echo $language['No Product Found']; ?></h4></p>                               
            </div>
        </div>
    </section>
<?php } ?>
<!-- HOME POS SECTION ENDS -->
<!-- HOME GIFT CARDS SECTION STARTS -->
<?php 
if (isset($GiftCardList) && !empty($GiftCardList)) { ?>
<section class="section-spacing">
    <div class="container">
        <div class="section-title mb-4 text-<?php echo $ses_lang == 'en'?'left':'right'; ?>">
            <h4><?php echo $language['Gift cards']; ?></h4>
        </div>      
        <div class="carousel-wrapper">
            <div id="gift-card-carousel" class="owl-carousel owl-theme">
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
                            <div class="item">
                                <div class="gc-wrapper">
                                    <a href="<?php echo base_url('giftcard/giftcard-details/' . $GiftCardData->id); ?>">
                                        <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($GiftCardData->image) ? $GiftCardData->image : ''; ?>">
                                    </a>
                                    <div class="gc-detail">
                                        <a href="<?php echo base_url('giftcard/giftcard-details/' . $GiftCardData->id); ?>" title="<?php echo $name; ?>">
                                            <h4><?php echo character_limiter($name,10); ?></h4>
                                        </a>                                      
                                    </div>
                                    <div class="text-center">
                                        <a href="<?php echo base_url('giftcard/giftcard-details/' . $GiftCardData->id); ?>" class="brand-btn"><?php echo $language['Details']; ?></a>
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
    </div>
</section>
<?php } ?>
<!-- HOME GIFT CARDS SECTION ENDS -->
<!-- HOME FEATURE SECTION STARTS -->
<section class="section-spacing">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="benefits-holder">
                    <i class="icofont-shield"></i>
                    <div class="benefits-detail">
                        <h4>Secure</h4>
                        <p>Payment</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="benefits-holder">
                    <i class="icofont-flash"></i>
                    <div class="benefits-detail">
                        <h4>Trusted</h4>
                        <p>Products</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="benefits-holder">
                    <i class="icofont-tag"></i>
                    <div class="benefits-detail">
                        <h4>Guaranteed</h4>
                        <p>Durability</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="benefits-holder">
                    <i class="icofont-diamond"></i>
                    <div class="benefits-detail">
                        <h4>Premium</h4>
                        <p>Quality</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- HOME FEATURE SECTION ENDS -->
<?php $this->endSection(); ?>