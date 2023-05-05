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
<!-- SECTION ONE STARTS -->
<section class="section-spacing">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="hero-carousel mb-sm-3">
                    <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                            <?php 
                            if(isset($BannerList) && !empty($BannerList)){ 
                                $j=1;
                                foreach($BannerList as $i => $value) { 
                            ?>
                            <li data-target="#carouselIndicators<?php echo $i;?>" data-slide-to="<?php echo $j;?>" class="<?php echo (!$i?'active':'');?>"></li>          
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
                                <div class="carousel-item banner-item <?php echo (!$i?'active':'');?>">
                                    <img class="d-block w-100" src="<?php echo base_url('uploads/banners/'); ?>/<?php echo isset($value->image)?$value->image:''; ?>" alt="First slide">
                                    <div class="carousel-content text-white">
                                        <h4><?php echo $ses_lang=='en' ? $value->title : $value->title_ar; ?></h4>
                                        <p><?php echo $ses_lang=='en' ? $value->sub_title : $value->sub_title_ar; ?></p>
                                        <?php if(isset($value->banner_url) && !empty($value->banner_url)){ ?>
                                        <a href="#" class="brand-btn-blue-grad"><?php echo $language['Shop Now']; ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php  }  ?>
                            <?php }else{  ?>
                                <div class="carousel-item banner-item active">
                                    <img class="d-block w-100" src="<?php echo base_url('/store/' . $storeActvTmplName . '/assets/images/banner-2.jpg'); ?>" alt="Second slide">
                                    <div class="carousel-content text-white">
                                        <h4>Gaming Accessories</h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <a href="#" class="brand-btn-blue-grad"><?php echo $language['Shop Now']; ?></a>
                                    </div>
                                </div>                                
                            <?php } ?>     
                        </div>
                        <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fixed-banner">
                    <a href="#">
                        <img src="https://images.pexels.com/photos/1413412/pexels-photo-1413412.jpeg">
                        <div class="fixed-banner-content">
                            <h4>Get the best offers on Play Stations</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SECTION ONE ENDS -->
<!-- SECTION TWO STARTS -->
<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="benefits-wrapper">
                    <i class="icofont-star"></i>
                    <div class="benefits-text">
                        <h5>Genuine Products</h5>
                        <p>Guarantee of product authenticity.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="benefits-wrapper">
                    <i class="icofont-support"></i>
                    <div class="benefits-text">
                        <h5>24x7 Support</h5>
                        <p>We provide good support for our customers.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="benefits-wrapper">
                    <i class="icofont-fast-delivery"></i>
                    <div class="benefits-text">
                        <h5>Fast Delivery</h5>
                        <p>We belive in delivering happiness ASAP.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="benefits-wrapper">
                    <i class="icofont-pay"></i>
                    <div class="benefits-text">
                        <h5>Online Payment</h5>
                        <p>We offer secured on Online Payment method.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION TWO ENDS -->
<!-- SECTION THREE STARTS -->
<?php if (isset($productList) && !empty($productList)) { ?>
<?php if(isset($productDiscountList) && !empty($productDiscountList)){ ?>
<section>
    <div class="container-fluid">
        <div class="orange-bg">
            <div class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <div class="ui-title text-white">
                                <h4><?php echo $language['Special Offers']; ?></h4>
                                <h5><?php echo $language['Exciting offer every day']; ?></h5>
                            </div>
                            <a href="<?php echo base_url('product/products'); ?>" class="brand-btn-white"><?php echo $language['View All']; ?></a>
                            
                        </div>
                        <div class="col-lg-8">
                            <div class="carousel-wrapper mt-3">
                                <div id="offers-products-carousel" class="owl-carousel owl-theme">
                                    <?php 
                                    if(isset($productDiscountList) && !empty($productDiscountList)){
                                        foreach($productDiscountList as $productData){
                                            $actionWishlisturl = base_url('customer/add-product-wishlist');
                                            $press = '';
                                            $wishlistActnClass = 'addProdToWshlst';

                                            $actionPrdctCarturl = base_url('customer/add-product-cart');
                                            //$anchorCartBtnText = 'Add to Cart';
                                            $anchorCartBtnText = $language['Add to Cart'];
                                            $actionCartBtnClass = 'addToCart';


                                            if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                                                foreach($cstmrWishPrdctList as $cstmrWishPrdctData){
                                                    if($cstmrWishPrdctData->product_id==$productData->id){
                                                        $actionWishlisturl = base_url('customer/remove-product-wishlist');
                                                        $press = 'press';
                                                        $wishlistActnClass = 'removeProdFromWshlst';
                                                    }
                                                }
                                            }

                                            if(isset($snglCstmrCartProductList) && !empty($snglCstmrCartProductList)){
                                                foreach($snglCstmrCartProductList as $snglCstmrCartProductData){
                                                    if($snglCstmrCartProductData->product_id==$productData->id){
                                                        $actionPrdctCarturl = base_url('customer/remove-product-cart');
                                                        //$anchorCartBtnText = 'Remove From Cart';
                                                        $anchorCartBtnText =  $language['Remove From Cart'];
                                                        $actionCartBtnClass = 'removeFromCart';
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
                                        <div class="prod-wrapper text-center">
                                            <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                                                <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                                            </a>
                                            <div class="offer-badge">
                                                <h5><?php echo isset($productData->discount_per) ? $productData->discount_per : ''; ?>%</h5>
                                            </div>
                                            <div class="prod-title">
                                                <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" title="<?php echo $title; ?>">
                                                    <h5><?php echo character_limiter($title,10); ?></h5>
                                                </a>
                                            </div>
                                            <div class="home-prod-price mb-4">
                                                <h6 class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></h6>
                                                <h5 class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></h5>
                                            </div>
                                            <div class="wishlist">
                                                <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>"></i>
                                            </div>
                                            <div class="text-center mb-2">
                                            <?php if(isset($ses_logged_in) && $ses_logged_in===true){ ?> 
                                                <span class="product_<?php echo $productData->id; ?>_cartBtn">
                                                    <a href="javascript:void(0);" data-baseurl="<?php echo base_url(); ?>" data-actionurl="<?php echo $actionPrdctCarturl; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo $ses_custmr_id; ?>"  data-lang="<?php echo $locale; ?>" class="brand-btn-add-cart <?php echo $actionCartBtnClass; ?>"><?php echo $anchorCartBtnText; ?></a>
                                                </span>
                                            <?php }else{ ?>
                                                <a href="<?php echo base_url('customer/login'); ?>" class="brand-btn-add-cart"><?php echo $language['Add to Cart']; ?></a>
                                            <?php } ?>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<!-- SECTION THREE ENDS -->
<!-- SECTION FOUR STARTS -->
<?php if(isset($productLatestList) && !empty($productLatestList)){ ?>
<section>
    <div class="container-fluid <?php if($locale=='ar'){echo 'text-right';} ?>">
        <div class="ui-title text-center text-black <?php if($locale=='ar'){echo 'text-right';} ?>">
            <h4><?php echo $language['Latest Products']; ?></h4>
            <h5><?php echo $language['Great collection at one stop']; ?></h5>
        </div>
        <div class="carousel-wrapper mt-3">
            <div id="latest-products-carousel" class="owl-carousel owl-theme">
            <?php 
            if(isset($productLatestList) && !empty($productLatestList)){
                foreach($productLatestList as $productData){
                    $actionWishlisturl = base_url('customer/add-product-wishlist');
                    $press = '';
                    $wishlistActnClass = 'addProdToWshlst';

                    $actionPrdctCarturl = base_url('customer/add-product-cart');
                    //$anchorCartBtnText = 'Add to Cart';
                    $anchorCartBtnText = $language['Add to Cart'];
                    $actionCartBtnClass = 'addToCart';

                    if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                        foreach($cstmrWishPrdctList as $cstmrWishPrdctData){
                            if($cstmrWishPrdctData->product_id==$productData->id){
                                $actionWishlisturl = base_url('customer/remove-product-wishlist');
                                $press = 'press';
                                $wishlistActnClass = 'removeProdFromWshlst';
                            }
                        }
                    }

                    if(isset($snglCstmrCartProductList) && !empty($snglCstmrCartProductList)){
                        foreach($snglCstmrCartProductList as $snglCstmrCartProductData){
                            if($snglCstmrCartProductData->product_id==$productData->id){
                                $actionPrdctCarturl = base_url('customer/remove-product-cart');
                                //$anchorCartBtnText = 'Remove From Cart';
                                $anchorCartBtnText =  $language['Remove From Cart'];
                                $actionCartBtnClass = 'removeFromCart';
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
                    <div class="prod-wrapper text-center">
                        <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                            <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                        </a>
                        <div class="offer-badge">
                            <h5><?php echo isset($productData->discount_per) ? $productData->discount_per : ''; ?>%</h5>
                        </div>
                        <div class="prod-title">
                            <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" title="<?php echo $title; ?>">
                                <h5><?php echo character_limiter($title,10); ?></h5>
                            </a>
                        </div>
                        <div class="home-prod-price mb-4">
                            <h6 class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></h6>
                            <h5 class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></h5>
                        </div>
                        <div class="wishlist">
                        <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-actionurl="<?php echo $actionWishlisturl; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>"></i> 
                        </div>
                        <div class="text-center mb-4">
                            <?php if(isset($ses_logged_in) && $ses_logged_in===true){ ?> 
                                <span class="product_<?php echo $productData->id; ?>_cartBtn">
                                    <a href="javascript:void(0);" data-baseurl="<?php echo base_url(); ?>" data-actionurl="<?php echo $actionPrdctCarturl; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo $ses_custmr_id; ?>"  data-lang="<?php echo $locale; ?>" class="brand-btn-add-cart <?php echo $actionCartBtnClass; ?>"><?php echo $anchorCartBtnText; ?></a>
                                </span>
                            <?php }else{ ?>
                                <a href="<?php echo base_url('customer/login'); ?>" class="brand-btn-add-cart"><?php echo $language['Add to Cart']; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="text-center text-center mb-3 mt-3">
                <a href="<?php echo base_url('product/products'); ?>" class="brand-btn-orange"><?php echo $language['View All']; ?></a>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php }else{ ?>    
    <section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
        <div class="container">
            <div class="row">
                 <p><h5><?php echo $language['No Product Found']; ?></h5></p>                               
            </div>
        </div>
    </section>
<?php } ?>
<!-- SECTION FOUR ENDS  -->
<!-- SECTION FIVE STARTS -->
<?php  if(isset($advertisementList) && !empty($advertisementList)){ ?>
<section>
    <div class="container-fluid">
        <div class="ui-title text-center text-black">
            <h4><?php echo $language['Promotions']; ?></h4>
            <h5><?php echo $language['We believe in promoting happiness']; ?></h5>
        </div>
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
                        if ($advertisementData->add_position == '1') { ?>
                            <div class="col-md-4">
                                <div class="ad-wrapper">
                                    <img src="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementData->add_img) ? $advertisementData->add_img : ''; ?>">
                                    <div class="ad-content text-white">
                                        <h5><?php echo $title; ?></h5>
                                        <p><?php echo $sub_title; ?></p>
                                        <!--button class="brand-btn-ad-black">Shop Now</button-->
                                        <a href="<?php echo $advertisementData->advertise_link; ?>" class="brand-btn-ad-black"><?php echo $language['Shop Now']; ?></a>
                                    </div>
                                </div>
                            </div>   

                        <?php } if ($advertisementData->add_position == '2') { ?>
                            <div class="col-md-4">
                                <div class="ad-wrapper">
                                    <img src="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementData->add_img) ? $advertisementData->add_img : ''; ?>">
                                    <div class="ad-content text-white">
                                        <h5><?php echo $title; ?></h5>
                                        <p><?php echo $sub_title; ?></p>
                                        <!--button class="brand-btn-ad-black">Shop Now</button-->
                                        <a href="<?php echo $advertisementData->advertise_link; ?>" class="brand-btn-ad-black"><?php echo $language['Shop Now']; ?></a>
                                    </div>
                                </div>
                         </div>
                        <?php } if ($advertisementData->add_position == '3') { ?>
                            <div class="col-md-4">
                                <div class="ad-wrapper">
                                    <img src="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementData->add_img) ? $advertisementData->add_img : ''; ?>">
                                    <div class="ad-content text-white">
                                        <h5><?php echo $title; ?></h5>
                                        <p><?php echo $sub_title; ?></p>
                                        <!--button class="brand-btn-ad-black">Shop Now</button-->
                                        <a href="<?php echo $advertisementData->advertise_link; ?>" class="brand-btn-ad-black"><?php echo $language['Shop Now']; ?></a>
                                    </div>
                                </div>
                         </div>
                        <?php  } 
                        }
                        }
                    ?>         
        </div>

        <div class="ad-video mt-3">
            <video autoplay loop muted src="<?php echo base_url('/store/' . $storeActvTmplName . '/assets/images/ces-homepage-1920x600.mp4'); ?>"></video>
            
        </div>
    </div>
</section>
<?php } ?>
<!-- SECTION FIVE ENDS -->
<!-- SECTION SIX STARTS -->
<?php  if(isset($productFeatureList) && !empty($productFeatureList)){ ?>
<section>
    <div class="container-fluid <?php if($locale=='ar'){echo 'text-right';} ?>">
        <div class="ui-title text-center text-black <?php if($locale=='ar'){echo 'text-right';} ?>">
            <h4><?php echo $language['Featured Products']; ?></h4>
            <h5><?php echo $language['Quality products we offer']; ?></h5>
        </div>
        <div class="carousel-wrapper mt-3">
            <div id="featured-products-carousel" class="owl-carousel owl-theme">
            <?php 
                if(isset($productFeatureList) && !empty($productFeatureList)){
                    foreach($productFeatureList as $productData){
                        $actionWishlisturl = base_url('customer/add-product-wishlist');
                        $press = '';
                        $wishlistActnClass = 'addProdToWshlst';

                        $actionPrdctCarturl = base_url('customer/add-product-cart');
                        //$anchorCartBtnText = 'Add to Cart';
                        $anchorCartBtnText = $language['Add to Cart'];
                        $actionCartBtnClass = 'addToCart';

                        if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                            foreach($cstmrWishPrdctList as $cstmrWishPrdctData){
                                if($cstmrWishPrdctData->product_id==$productData->id){
                                    $actionWishlisturl = base_url('customer/remove-product-wishlist');
                                    $press = 'press';
                                    $wishlistActnClass = 'removeProdFromWshlst';
                                }
                            }
                        }

                        if(isset($snglCstmrCartProductList) && !empty($snglCstmrCartProductList)){
                            foreach($snglCstmrCartProductList as $snglCstmrCartProductData){
                                if($snglCstmrCartProductData->product_id==$productData->id){
                                    $actionPrdctCarturl = base_url('customer/remove-product-cart');
                                    //$anchorCartBtnText = 'Remove From Cart';
                                    $anchorCartBtnText =  $language['Remove From Cart'];
                                    $actionCartBtnClass = 'removeFromCart';
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
                    <div class="prod-wrapper text-center">
                        <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                            <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                        </a>
                        <div class="offer-badge">
                            <h5><?php echo isset($productData->discount_per) ? $productData->discount_per : ''; ?>%</h5>
                        </div>
                        <div class="prod-title">
                            <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" title="<?php echo $title; ?>">
                                <h5><?php echo character_limiter($title,10); ?></h5>
                            </a>
                        </div>
                        <div class="home-prod-price mb-4">
                            <h6 class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></h6>
                            <h5 class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></h5>
                        </div>

                        <div class="wishlist">
                        <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>"></i>
                        </div>
                        <div class="text-center mb-4">
                            <?php if(isset($ses_logged_in) && $ses_logged_in===true){ ?> 
                                <span class="product_<?php echo $productData->id; ?>_cartBtn">
                                    <a href="javascript:void(0);" data-baseurl="<?php echo base_url(); ?>" data-actionurl="<?php echo $actionPrdctCarturl; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo $ses_custmr_id; ?>"  data-lang="<?php echo $locale; ?>" class="brand-btn-add-cart <?php echo $actionCartBtnClass; ?>"><?php echo $anchorCartBtnText; ?></a>
                                </span>
                            <?php }else{ ?>
                                <a href="<?php echo base_url('customer/login'); ?>" class="brand-btn-add-cart"><?php echo $language['Add to Cart']; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>  
                <?php
                    }
                }
                ?>
            </div>
            <div class="text-center mt-4">
                <a href="<?php echo base_url('product/products'); ?>" class="brand-btn-orange"><?php echo $language['View All']; ?></a>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<!-- SECTION SIX ENDS -->
<!-- CATEGORY SECTION STARTS -->
<?php if (isset($productCategories) && !empty($productCategories)) { ?>
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid mt-3 ">
        <div class="orange-bg section-spacing">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="ui-title text-white">
                            <h4><?php echo $language['Shop by category']; ?></h4>
                        </div>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo base_url('category/all-categories'); ?>" class="brand-btn-black <?php if($locale=='ar'){echo 'float-left';}else{echo 'float-right';} ?>"><?php echo $language['View All']; ?></a>
                    </div>
                </div>

                <div class="category-tab-wrapper mt-3">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      
                        <li class="nav-item cat-tab-item" role="presentation" data-carouselid="0" data-catid="0" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>" data-actionurl="<?php echo base_url('get-category-products'); ?>">
                            <a class="nav-link cat-tab-link active" id="pills-allcat-tab" data-toggle="pill" href="#pills-allcat" role="tab" aria-controls="pills-allcat" aria-selected="true"><?php echo $language['All']; ?></a>
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
                            <div class="carousel-wrapper mt-3">
                                <div id="category-carousel-0" class="owl-carousel owl-theme">
                                    <?php 
                                    if(isset($productList) && !empty($productList)){
                                        foreach($productList as $productData){

                                            $actionWishlisturl = base_url('customer/add-product-wishlist');
                                            $press = '';
                                            $wishlistActnClass = 'addProdToWshlst';

                                            $actionPrdctCarturl = base_url('customer/add-product-cart');
                                            //$anchorCartBtnText = 'Add to Cart';
                                            $anchorCartBtnText = $language['Add to Cart'];
                                            $actionCartBtnClass = 'addToCart';

                                            if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                                                foreach($cstmrWishPrdctList as $cstmrWishPrdctData){
                                                    if($cstmrWishPrdctData->product_id==$productData->id){
                                                        $actionWishlisturl = base_url('customer/remove-product-wishlist');
                                                        $press = 'press';
                                                        $wishlistActnClass = 'removeProdFromWshlst';
                                                    }
                                                }
                                            }
                                            
                                            if(isset($snglCstmrCartProductList) && !empty($snglCstmrCartProductList)){
                                                foreach($snglCstmrCartProductList as $snglCstmrCartProductData){
                                                    if($snglCstmrCartProductData->product_id==$productData->id){
                                                        $actionPrdctCarturl = base_url('customer/remove-product-cart');
                                                        //$anchorCartBtnText = 'Remove From Cart';
                                                        $anchorCartBtnText =  $language['Remove From Cart'];
                                                        $actionCartBtnClass = 'removeFromCart';
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
                                        <div class="prod-wrapper text-center">
                                            <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                                                <img src="<?php echo base_url('/uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                                            </a>
                                            <div class="offer-badge">
                                                <h5><?php echo isset($productData->discount_per) ? $productData->discount_per : ''; ?>%</h5>
                                            </div>
                                            <div class="prod-title">
                                                <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>"  title="<?php echo $title; ?>">
                                                    <h5><?php echo character_limiter($title,10); ?></h5>
                                                </a>
                                            </div>
                                            <div class="home-prod-price mb-4">
                                                <h6 class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></h6>
                                                <h5 class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></h5>
                                            </div>

                                            <div class="wishlist">
                                                <i class="icofont-heart <?php echo $wishlistActnClass; ?> <?php echo $press; ?>" data-carouselid="0" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>"></i>
                                            </div>

                                            <div class="text-center mb-3">
                                                <?php if(isset($ses_logged_in) && $ses_logged_in===true){ ?> 
                                                    <span class="product_<?php echo $productData->id; ?>_cartBtn">
                                                        <a href="javascript:void(0);" data-baseurl="<?php echo base_url(); ?>" data-actionurl="<?php echo $actionPrdctCarturl; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo $ses_custmr_id; ?>"  data-lang="<?php echo $locale; ?>" class="brand-btn-add-cart <?php echo $actionCartBtnClass; ?>"><?php echo $anchorCartBtnText; ?></a>
                                                    </span>
                                                <?php }else{ ?>
                                                    <a href="<?php echo base_url('customer/login'); ?>" class="brand-btn-add-cart"><?php echo $language['Add to Cart']; ?></a>
                                                <?php } ?>
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
                            <div class="carousel-wrapper mt-3">
                                <div id="category-carousel-<?php echo $i; ?>" class="owl-carousel owl-theme">
                                
                                </div>
                            </div>
                        </div>   
                        <?php $i++; } } ?>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<!-- CATEGORY SECTION ENDS -->
<!-- ABOUT SECTION STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="about-banner">                    
                    <?php if(isset($AboutUsInfo->image) && !empty($AboutUsInfo->image)){ ?>
                            <img class="img-fluid" src="<?php echo base_url('uploads/aboutus/'); ?>/<?php echo isset($AboutUsInfo->image)?$AboutUsInfo->image:''; ?>">
                    <?php }else{ ?>
                        <img class="img-fluid" src="<?php echo base_url('store/'.$storeActvTmplName.'/assets/images/default-about-us.jpg'); ?>">
                    <?php } ?>  
                </div>
            </div>
            <div class="col-md-6">
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
                ?>
                <div class="ui-title text-black">
                    <h4><?php echo $language['who we are']; ?></h4>
                </div>
                <div class="about-content text-black mb-4">
                   <p><?php echo isset($checkshortDesc)?$checkshortDesc:''; ?></p>
                </div>
                <div class="text-left">
                    <a href="<?php echo base_url('/abouts-us'); ?>" class="brand-btn-orange <?php if($locale=='ar'){echo 'float-right';} ?>"><?php echo $language['Know More']; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ABOUT SECTION ENDS -->
<!-- GIFT CARD SECTION STARTS -->
<?php if(isset($GiftCardList) && !empty($GiftCardList)){ ?>
<section class="mb-5 section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
        <div class="ui-title text-center text-black">
            <h4><?php echo $language['Gift cards']; ?></h4>
            <h5><?php echo $language['Enjoy this festive season with our Gift Cards']; ?></h5>
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
                                <div class="prod-wrapper text-center">
                                    <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>">
                                        <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($GiftCardData->image)?$GiftCardData->image:''; ?>">
                                    </a>
                                    <div class="prod-title mb-4">
                                        <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>">
                                            <h5><?php echo $name; ?></h5>
                                        </a>
                                    </div>                       
                                    <div class="text-center mb-3">
                                        <!--button class="brand-btn-add-cart">Add to Cart</button-->
                                        <a href="<?php echo base_url('giftcard/giftcard-details/'.$GiftCardData->id); ?>" class="brand-btn brand-btn-add-cart"><?php echo $language['Details']; ?></a>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?> 
            </div>
            <div class="text-center">
                <!--button class="brand-btn-orange"><?php //echo $language['View All']; ?></button-->
                <a href="<?php echo base_url('giftcard/gift-cards'); ?>" class="brand-btn-orange"><?php echo $language['View All']; ?></a>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<!-- GIFT CARD SECTION ENDS -->
<!-- NEWSLETTER SECTION STARTS -->
<section>
    <div class="container-fluid">
        <div class="orange-bg section-spacing">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ui-title text-white">
                            <h4><?php echo $language['Newletter Subscription']; ?></h4>
                            <h5><?php echo $language['Subscribe to our newsletter and stay updated to receive exciting offers!']; ?></h5>
                        </div>
                        <?php 
                            $attributes = ['name' => 'save_subscribe_form', 'id' => 'save_subscribe_form', 'autocomplete' => 'off']; 
                            echo form_open_multipart('/save-subscribe',$attributes); 
                        ?>
                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <div class="mt-3 mb-2">
                            <input type="email" class="brand-input mb-2" placeholder="<?php echo $language['Email Address']; ?>" id="email" name="email" data-error=".error2">
                        </div>
                        <span class="error2"></span>  
                        <button class="brand-btn-black btn-block"><?php echo $language['Subscribe']; ?></button>
                         
                        <?php echo form_close(); ?>
                    </div>
                    <div class="col-md-6">
                        <div class="subs-banner">
                            <img src="https://assets.reedpopcdn.com/ps_xbox_nintendo.jpg/BROK/thumbnail/1600x900/quality/100/ps_xbox_nintendo.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- NEWSLETTER SECTION ENDS -->
<!-- BRANDS SECTION STARTS -->
<?php if(isset($BrandInfo) && !empty($BrandInfo)){ ?>
<section class="section-spacing text-<?php echo $ses_lang == 'en'?'left':'right'; ?>">
    <div class="container-fluid">
        <div class="ui-title text-center text-black">
            <h4><?php echo $language['Brands']; ?></h4>
            <h5><?php echo $language['We provide the best brand products']; ?></h5>
        </div>     
        <div class="carousel-wrapper">
            <div id="brand-carousel" class="owl-carousel owl-theme">
                <?php 
                if(isset($BrandInfo) && !empty($BrandInfo)){
                    foreach($BrandInfo as $brandInfoData){
                ?>
                <div class="item">
                    <div class="brand-image">
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
<!-- BRANDS SECTION ENDS -->
<?php $this->endSection(); ?>