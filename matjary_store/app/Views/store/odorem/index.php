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
<div class="section-spacing home-banner-one">
    <div class="container">
        <div class="row align-items-center pb-4">
            <div class="col-lg-6">
                <div class="section-one-content">
                    <h1>New Best Perfume</h1>
                    <?php if($locale=='ar'){ ?> 
                        <h1><i class="icofont-star-alt-1"></i> by Odorem</h1>
                    <?php }else{ ?>
                        <h1>by Odorem <i class="icofont-star-alt-1"></i></h1>
                    <?php } ?>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <div class="banner-btn">
                        <button class="btn btn-primary brand-btn <?php if($locale=='ar'){echo 'ml-auto d-block';} ?>"><?php echo $language['Read More']; ?></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-image">
                    <div class="banner-image-bg">
                        <img src="<?php echo base_url('/store/'.$storeActvTmplName.'/assets/images/banner-1.png'); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- HOME PAGE SECTION ONE STARTS -->
<div class="container">
    <div class="benefits-box">
        <div class="row">
            <div class="col-lg-3">
                <div class="benefits-holder">
                    <div class="benefits-icon">
                        <i class="icofont-shield"></i>
                    </div>
                    <div class="benefits-details">
                        <h5><?php echo $language['Secure Payments']; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="benefits-holder">
                    <div class="benefits-icon">
                        <i class="icofont-hand-thunder"></i>
                    </div>
                    <div class="benefits-details">
                        <h5><?php echo $language['Trusted Products']; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="benefits-holder">
                    <div class="benefits-icon">
                        <i class="icofont-badge"></i>
                    </div>
                    <div class="benefits-details">
                        <h5><?php echo $language['Guaranteed Durability']; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="benefits-holder">
                    <div class="benefits-icon">
                        <i class="icofont-price"></i>
                    </div>
                    <div class="benefits-details">
                        <h5><?php echo $language['Premium Quality']; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- HOME SECTION ONE ENDS -->
<?php if (isset($productList) && !empty($productList)) { ?>
    <?php if(isset($productLatestList) && !empty($productLatestList)){ ?>
        <section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
            <div class="container ">
                <div class="section-title text-center">
                    <h2><i class="icofont-star-alt-1"></i> <?php echo $language['Latest Products']; ?><i class="icofont-star-alt-1"></i></h2>
                </div>
                <div class="carousel-wrapper mt-5">
                    <div id="latest-product-carousel" class="owl-carousel owl-theme">
                        <?php 
                        if(isset($productLatestList) && !empty($productLatestList)){
                            foreach($productLatestList as $productData){
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
                            <div class="prod-card">
                                <div class="prod-wrapper">
                                    <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                                        <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>"  >
                                    </a>
                                </div>
                                <div class="prod-details">
                                    <h4 title="<?php echo $title; ?>"><?php echo character_limiter($title,10); ?></h4>
                                    <div class="home-prod-price text-center">
                                        <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></span>
                                        <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></span>
                                    </div>
                                    <div class="prod-btn d-grid">
                                        <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" class="btn btn-primary btn-block brand-btn"><?php echo $language['Details']; ?></a>
                                    </div>
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
    <!-- HOME PAGE SECTION ONE ENDS -->
    <!-- HOME PAGE SECTION TWO STARTS -->
    <?php if(isset($productFeatureList) && !empty($productFeatureList)){ ?>
        <section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
            <div class="container">
                <div class="section-title mb-4 text-center">
                    <h2><i class="icofont-star-alt-1"></i><?php echo $language['Featured Products']; ?> <i class="icofont-star-alt-1"></i></h2>
                </div>
                <div class="carousel-wrapper mt-5">
                    <div id="featured-product-carousel" class="owl-carousel owl-theme">
                        <?php 
                        if(isset($productFeatureList) && !empty($productFeatureList)){
                            foreach($productFeatureList as $productData){
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
                            <div class="prod-card">
                                <div class="prod-wrapper">
                                    <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                                        <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                                    </a>
                                </div>
                                <div class="prod-details">
                                    <h4 title="<?php echo $title; ?>"><?php echo character_limiter($title,10); ?></h4>
                                    <div class="home-prod-price text-center">
                                        <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></span>
                                        <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></span>                            
                                </div>
                                    <div class="prod-btn d-grid">
                                       <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" class="btn btn-primary btn-block brand-btn"><?php echo $language['Details']; ?></a>
                                    </div>
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
    <!-- HOME PAGE SECTION TWO ENDS -->
    <?php if(isset($productDiscountList) && !empty($productDiscountList)){ ?>
    <!-- HOME PAGE SECTION THREE STARTS -->
        <section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
            <div class="container">
                <div class="section-title mb-4 text-center">
                    <h2><i class="icofont-star-alt-1"></i> <?php echo $language['Products on sale']; ?> <i class="icofont-star-alt-1"></i></h2>
                </div>
                <div class="carousel-wrapper mt-5">
                    <div id="pos-product-carousel" class="owl-carousel owl-theme">
                        <?php 
                        if(isset($productDiscountList) && !empty($productDiscountList)){
                            foreach($productDiscountList as $productData){
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
                            <div class="prod-card">
                                <div class="prod-wrapper">
                                    <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                                        <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                                    </a>
                                </div>
                                <div class="prod-details">
                                    <h4 title="<?php echo $title; ?>"><?php echo character_limiter($title,10); ?></h4>
                                    <div class="home-prod-price text-center">
                                        <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></span>
                                        <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></span>                        
                                    </div>
                                    <div class="prod-btn d-grid">
                                        <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" class="btn btn-primary btn-block brand-btn"><?php echo $language['Details']; ?></a>
                                    </div>
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
<!-- HOME PAGE SECTION THREE ENDS -->
<!-- HOME SECTION FIVE STARTS -->
<?php if (isset($GiftCardList) && !empty($GiftCardList)) { ?>
    <section class="section-spacing">
        <div class="container">
            <div class="section-title mb-4 text-center">
                <h2><i class="icofont-star-alt-1"></i> <?php echo $language['Gift cards'] ?> <i class="icofont-star-alt-1"></i></h2>
            </div>
            <div class="carousel-wrapper mt-5">
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
                        <div class="prod-card">
                            <div class="prod-wrapper">
                                    <a href="<?php echo base_url('giftcard/giftcard-details/' . $GiftCardData->id); ?>">
                                            <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($GiftCardData->image) ? $GiftCardData->image : ''; ?>">
                                    </a>
                            </div>
                            <div class="prod-details">
                                    <a href="<?php echo base_url('giftcard/giftcard-details/' . $GiftCardData->id); ?>">
                                    <h4><?php echo $name; ?></h4>
                                    </a>
                                <div class="prod-btn d-grid">
                                    <a href="<?php echo base_url('giftcard/giftcard-details/' . $GiftCardData->id); ?>" class="btn btn-primary btn-block brand-btn"><?php echo $language['Details']; ?></a>
                                </div>
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
<!-- HOME SECTION FIVE ENDS -->
<!-- HOME SECTION SIX STARTS -->
<section class="section-spacing about-sec <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-banner">
                    <div class="about-banner-bg">
                        <?php if(isset($AboutUsInfo->image) && !empty($AboutUsInfo->image)){ ?>
                            <img class="img-fluid" src="<?php echo base_url('uploads/aboutus/'); ?>/<?php echo isset($AboutUsInfo->image)?$AboutUsInfo->image:''; ?>">
                        <?php }else{ ?>
                            <img class="img-fluid" src="<?php echo base_url('store/'.$storeActvTmplName.'/assets/images/default-about-us.jpg'); ?>">
                        <?php } ?>  
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-title <?php if($locale=='ar'){echo 'text-right';} ?>">
                    <h2><?php echo $language['who we are']; ?> <i class="icofont-star-alt-1"></i></h2>
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
                ?>
                <div class="about-home-content">
                    <p><?php echo isset($checkshortDesc)?$checkshortDesc:''; ?></p>
                </div>
                <div class="about-btn">
                    <a href="<?php echo base_url('/abouts-us'); ?>" class="btn btn-primary brand-btn <?php if($locale=='ar'){echo 'float-right';} ?>"><?php echo $language['Know More']; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- HOME SECTION SIX ENDS -->
<!-- HOME PAGE SECTION SEVEN STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> <?php echo $language['Our Newsletter']; ?> <i class="icofont-star-alt-1"></i></h2>
        </div>
        <div class="newsletter-content text-center">
            <p><?php echo $language['If you want to get an email from us every time we have a new special offer, then sign up here!']; ?></p>
        </div>
        <?php 
            $attributes = ['name' => 'save_subscribe_form', 'id' => 'save_subscribe_form', 'autocomplete' => 'off']; 
            echo form_open_multipart('/save-subscribe',$attributes); 
        ?>
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
        <div class="subscribe-wrap w-50 mx-auto d-block">           
            <input type="email" class="form-control mb-2" placeholder="<?php echo $language['Email Address']; ?>" id="email" name="email" data-error=".error2">
            <button class="btn btn-primary brand-btn btn-block"><?php echo $language['Subscribe']; ?></button>           
        </div>
        </br><span class="error2"></span>   
        <?php echo form_close(); ?>
    </div>
</section>
<!-- HOME PAGE SECTION SEVEN ENDS -->
<?php $this->endSection(); ?>