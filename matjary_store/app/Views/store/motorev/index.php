<?php
$session = \Config\Services::session();
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
$allowedDatatablePagesAry = array('My Gift Details', 'My Orders', 'My Refund Details');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- HOME CAROUSEL STARTS -->
<div class="home-carousel">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <?php 
            if(isset($BannerList) && !empty($BannerList)){ 
                $j=1;
                foreach($BannerList as $i => $value) { 
            ?>
            <li data-target="#carouselExampleIndicators<?php echo $i;?>" data-slide-to="<?php echo $j;?>" class="<?php echo (!$i?'active':'');?>"></li>          
            <?php 
                $j++;
                }
            } 
            ?>
        </ol>
        <div class="carousel-inner">
            <?php 
            if(isset($BannerList) && !empty($BannerList)){
                foreach($BannerList as $i => $value) { 
            ?>
            <div class="carousel-item <?php echo (!$i?'active':'');?>">
                <img src="<?php echo base_url('uploads/banners/'); ?>/<?php echo isset($value->image)?$value->image:''; ?>" class="d-block w-100" alt="banner">
                <div class="carousel-content">
                    <h3><?php echo $ses_lang=='en' ? $value->title : $value->title_ar; ?></h3>
                    <p><?php echo $ses_lang=='en' ? $value->sub_title : $value->sub_title_ar; ?></p>
                    <?php if(isset($value->banner_url) && !empty($value->banner_url)){ ?>
                    <a target="_blank" href="<?php echo isset($value->banner_url)?$value->banner_url:''; ?>" class="brand-btn"><?php echo $language['Shop Now']; ?></a>
                    <?php } ?>
                </div>
            </div>
            <?php 
                }  
            }else{  
            ?>
            <div class="carousel-item active">
                <img src="https://images.pexels.com/photos/1413412/pexels-photo-1413412.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-content">
                    <h3>Best riding gears available</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <button class="brand-btn"><?php echo $language['Shop Now']; ?></button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.pexels.com/photos/7511968/pexels-photo-7511968.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="d-block w-100" alt="...">
                <div class="carousel-content">
                    <h3>Avail the best offers</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <button class="brand-btn"><?php echo $language['Shop Now']; ?></button>
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
<?php if (isset($productList) && !empty($productList)) { ?>
    <!-- LATEST PRODUCT SECTION STARTS -->
    <?php if(isset($productLatestList) && !empty($productLatestList)){ ?>
        <section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="section-title <?php if($locale=='ar'){echo 'text-right';} ?>">
                            <h2><?php echo $language['Latest Products']; ?></h2>
                        </div>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo base_url('product/products'); ?>" class="brand-btn <?php if($locale=='ar'){echo 'float-left';}else{echo 'float-right';} ?>"><?php echo $language['View All']; ?></a>
                    </div>
                </div>
                <div class="carousel-wrapper mt-3">
                    <div id="latest-products-carousel" class="owl-carousel owl-theme">
                        <?php 
                        if(isset($productLatestList) && !empty($productLatestList)){
                            foreach($productLatestList as $productData){
                                $actionWishlisturl = base_url('customer/add-product-wishlist');
                                $press = '';
                                $wishlistActnClass = 'addProdToWshlst';

                                if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                                    foreach($cstmrWishPrdctList as $cstmrWishPrdctData){
                                        if($cstmrWishPrdctData->product_id==$productData->id){
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
                                <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                                    <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                                </a>
                                <div class="prod-detail text-center">
                                    <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" title="<?php echo $title; ?>">
                                        <h4><?php echo character_limiter($title,10); ?></h4>
                                    </a>
                                    <div class="home-prod-price mb-2">
                                        <?php if($productData->discount_per != 0){ ?>
                                        <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></span>
                                        <?php } ?>
                                        <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></span>
                                    </div>
                                    <div class="wishlist">
                                        <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-actionurl="<?php echo $actionWishlisturl; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>"></i> 
                                    </div>
                                    <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" class="brand-btn"><?php echo $language['Details']; ?></a>
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
    <!-- LATEST PRODUCTS SECTION ENDS -->
    <!-- FEATURED PRODUCTS SECTION STARTS -->
    <?php  if(isset($productFeatureList) && !empty($productFeatureList)){ ?>
        <section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="section-title <?php if($locale=='ar'){echo 'text-right';} ?>">
                            <h2><?php echo $language['Featured Products']; ?></h2>
                        </div>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo base_url('product/products'); ?>" class="brand-btn <?php if($locale=='ar'){echo 'float-left';}else{echo 'float-right';} ?>"><?php echo $language['View All']; ?></a>
                    </div>
                </div>
                <div class="carousel-wrapper mt-3">
                    <div id="featured-products-carousel" class="owl-carousel owl-theme">
                        <?php 
                        if(isset($productFeatureList) && !empty($productFeatureList)){
                            foreach($productFeatureList as $productData){
                                $actionWishlisturl = base_url('customer/add-product-wishlist');
                                $press = '';
                                $wishlistActnClass = 'addProdToWshlst';

                                if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                                    foreach($cstmrWishPrdctList as $cstmrWishPrdctData){
                                        if($cstmrWishPrdctData->product_id==$productData->id){
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
                                <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                                    <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                                </a>
                                <div class="prod-detail text-center">
                                    <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" title="<?php echo $title; ?>">
                                        <h4><?php echo character_limiter($title,10); ?></h4>
                                    </a>
                                    <div class="home-prod-price mb-2">
                                    <?php if($productData->discount_per != 0){ ?>
                                        <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></span>
                                    <?php } ?>    
                                        <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></span>
                                    </div>
                                    <div class="wishlist">
                                        <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>"></i>
                                    </div>
                                    <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" class="brand-btn"><?php echo $language['Details']; ?></a>
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
    <!-- FEATURED PRODUCTS SECTION ENDS -->
    <!-- SHOP BY CATEGORY SECTION STARTS -->
    <?php if (isset($productCategories) && !empty($productCategories)) { ?>
        <section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="section-title">
                            <h2><?php echo $language['Shop by category']; ?></h2>
                        </div>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo base_url('category/all-categories'); ?>" class="brand-btn <?php if($locale=='ar'){echo 'float-left';}else{echo 'float-right';} ?>"><?php echo $language['View All']; ?></a>
                    </div>
                </div>
                <div class="category-tab-wrapper mt-3">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item cat-tab-item" role="presentation" data-carouselid="0" data-catid="0" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>" data-actionurl="<?php echo base_url('get-category-products'); ?>">
                            <a class="nav-link cat-tab-link active" id="pills-allcat-tab" data-toggle="pill" href="#pills-allcat" role="tab" aria-controls="pills-allcat" aria-selected="true">All</a>
                        </li>
                        <?php
                        if (isset($productCategories) && !empty($productCategories)) {
                            $i=1;
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
                        <li class="nav-item cat-tab-item" role="presentation" data-carouselid="<?php echo $i; ?>" data-catid="<?php echo $prodCat->id; ?>" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>" data-actionurl="<?php echo base_url('get-category-products'); ?>">
                            <a class="nav-link cat-tab-link" id="pills-<?php echo $prodCat->id; ?>-tab" data-toggle="pill" href="#pills-<?php echo $prodCat->id; ?>" role="tab" aria-controls="pills-<?php echo $prodCat->id; ?>" aria-selected="false"><?php echo $category_name; ?></a>
                        </li>
                        <?php $i++; } } ?>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-allcat" role="tabpanel" aria-labelledby="pills-allcat-tab">
                            <div class="carousel-wrapper mt-5">
                                <div id="category-carousel-0" class="owl-carousel owl-theme">
                                    <?php 
                                    if(isset($productList) && !empty($productList)){
                                        foreach($productList as $productData){

                                            $actionWishlisturl = base_url('customer/add-product-wishlist');
                                            $press = '';
                                            $wishlistActnClass = 'addProdToWshlst';

                                            if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                                                foreach($cstmrWishPrdctList as $cstmrWishPrdctData){
                                                    if($cstmrWishPrdctData->product_id==$productData->id){
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
                                            <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                                                <img src="<?php echo base_url('/uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                                            </a>
                                            <div class="prod-detail text-center">
                                                <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" title="<?php echo $title; ?>">
                                                    <h4><?php echo character_limiter($title,10); ?></h4>
                                                </a>
                                                <div class="home-prod-price mb-2">
                                                <?php if($productData->discount_per != 0){ ?>
                                                    <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></span>
                                                <?php } ?>
                                                    <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></span>
                                                </div>
                                                <div class="wishlist">
                                                    <i class="icofont-heart <?php echo $wishlistActnClass; ?> <?php echo $press; ?>" data-carouselid="0" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>"></i>
                                                </div>
                                                <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" class="brand-btn"><?php echo $language['Details']; ?></a>
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
                        <?php
                        if (isset($productCategories) && !empty($productCategories)) {
                            $i=1;
                            foreach ($productCategories as $prodCat) {
                        ?>
                        <div class="tab-pane fade show" id="pills-<?php echo $prodCat->id; ?>" role="tabpanel" aria-labelledby="pills-<?php echo $prodCat->id; ?>-tab">
                            <div class="carousel-wrapper mt-5">
                                <div id="category-carousel-<?php echo $i; ?>" class="owl-carousel owl-theme">
                                    
                                </div>
                            </div>
                        </div>
                        <?php $i++; } } ?>
                        
                    </div>
                </div>
            </div>

        </section>
    <?php } ?>
    <!-- SHOP BY CATEGORY SECTION ENDS -->
    <!-- PRODUCT ON SALE SECTION STARTS -->
    <?php if(isset($productDiscountList) && !empty($productDiscountList)){ ?>
        <section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="section-title">
                            <h2><?php echo $language['Products on sale']; ?></h2>
                        </div>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo base_url('product/products'); ?>" class="brand-btn <?php if($locale=='ar'){echo 'float-left';}else{echo 'float-right';} ?>"><?php echo $language['View All']; ?></a>
                    </div>
                </div>
                <div class="carousel-wrapper mt-3">
                    <div id="pos-products-carousel" class="owl-carousel owl-theme">
                        <?php 
                        if(isset($productDiscountList) && !empty($productDiscountList)){
                            foreach($productDiscountList as $productData){
                                $actionWishlisturl = base_url('customer/add-product-wishlist');
                                $press = '';
                                $wishlistActnClass = 'addProdToWshlst';

                                if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                                    foreach($cstmrWishPrdctList as $cstmrWishPrdctData){
                                        if($cstmrWishPrdctData->product_id==$productData->id){
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
                                <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                                    <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                                </a>
                                <div class="prod-detail text-center">
                                    <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" title="<?php echo $title; ?>">
                                        <h4><?php echo character_limiter($title,10); ?></h4>
                                    </a>
                                    <div class="home-prod-price mb-2">
                                        <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></span>
                                        <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></span>
                                    </div>
                                    <div class="wishlist">
                                        <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>"></i>
                                    </div>
                                    <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" class="brand-btn"><?php echo $language['Details']; ?></a>
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
<!-- PRODUCT ON SALE SECTION ENDS -->
<!-- ADVERTISEMENT SECTION STARTS -->
<?php  if(isset($advertisementList) && !empty($advertisementList)){ ?>
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">        
        <div class="carousel-wrapper">
            <div id="ad-carousel" class="owl-carousel owl-theme">
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
                <div class="item">                   
                    <div class="ad-banner">
                        <a href="<?php echo $advertisementData->advertise_link; ?>">
                        <img src="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementData->add_img) ? $advertisementData->add_img : ''; ?>">
                        </a>
                        <div class="ad-content">
                            <h2><?php echo $title; ?></h2>
                            <p><?php echo $sub_title; ?></p>
                            <a  href="<?php echo $advertisementData->advertise_link; ?>" class="brand-btn"><?php echo $language['Shop Now']; ?></a>
                        </div>
                    </div>
                </div>
                <?php }
                if ($advertisementData->add_position == '2') { ?>
                <div class="item">
                    <div class="ad-banner">
                        <a href="<?php echo $advertisementData->advertise_link; ?>">
                        <img src="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementData->add_img) ? $advertisementData->add_img : ''; ?>">
                        </a>
                        <div class="ad-content">
                            <h2><?php echo $title; ?></h2>
                            <p><?php echo $sub_title; ?></p>
                            <a href="<?php echo $advertisementData->advertise_link; ?>" class="brand-btn"><?php echo $language['Shop Now']; ?></a>
                        </div>
                    </div>
                </div>
                <?php }
                if ($advertisementData->add_position == '3') { ?>
                <div class="item">
                    <div class="ad-banner">
                        <a href="<?php echo $advertisementData->advertise_link; ?>">
                        <img src="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementData->add_img) ? $advertisementData->add_img : ''; ?>">
                        </a>
                        <div class="ad-content">
                            <h2><?php echo $title; ?></h2>
                            <p><?php echo $sub_title; ?></p>
                            <a h href="<?php echo $advertisementData->advertise_link; ?>" class="brand-btn"><?php echo $language['Shop Now']; ?></a>
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
<!-- ADVERTISEMENT SECTION ENDS -->
<!-- GIFTCARD SECTION STARTS -->
<?php if(isset($GiftCardList) && !empty($GiftCardList)){ ?>
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="section-title">
                    <h2><?php echo $language['Gift cards']; ?></h2>
                </div>
            </div>
            <div class="col-6">
                <button class="brand-btn <?php if($locale=='ar'){echo 'float-left';}else{echo 'float-right';} ?>"><?php echo $language['View All']; ?></button>
            </div>
        </div>
        <div class="carousel-wrapper mt-3">
            <div id="gift-card-carousel" class="owl-carousel owl-theme">
                <?php 
                if(isset($GiftCardList) && !empty($GiftCardList)){
                    foreach($GiftCardList as $GiftCardData){
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
                        if(date("Y-m-d",strtotime($GiftCardData->expiry_date)) >= $today){
                ?>
                <div class="item">
                    <div class="gc-wrapper">
                        <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>">
                            <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($GiftCardData->image)?$GiftCardData->image:''; ?>">
                        </a>
                        <div class="prod-detail text-center">
                            <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>">
                                <h4><?php echo $name; ?></h4>
                            </a>
                            
                            <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>" class="brand-btn"><?php echo $language['Details']; ?></a>
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
<!-- GIFTCARD SECTION ENDS -->
<!-- BENEFITS SECTION STARTS -->
<div class="benefits-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="benefits-holder">
                    <i class="icofont-truck-loaded"></i>
                    <div class="benefits-detail">
                        <h4><?php echo $language['Free Shipping']; ?></h4>
                        <p><?php echo $language['Free Shipping above SAR250']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="benefits-holder">
                    <i class="icofont-live-support"></i>
                    <div class="benefits-detail">
                        <h4><?php echo $language['24x7 Support']; ?></h4>
                        <p><?php echo $language['Call us anytime, we are there for you']; ?>.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="benefits-holder">
                    <i class="icofont-shield"></i>
                    <div class="benefits-detail">
                        <h4><?php echo $language['100% Safety']; ?></h4>
                        <p><?php echo $language['We have secure payment systems']; ?>.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="benefits-holder">
                    <i class="icofont-tags"></i>
                    <div class="benefits-detail">
                        <h4><?php echo $language['Hot Offers']; ?></h4>
                        <p><?php echo $language['Discounts upto 50%']; ?>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BENEFITS SECTION ENDS -->
<?php $this->endSection(); ?>