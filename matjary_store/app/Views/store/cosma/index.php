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
                    <img src="<?php echo base_url('uploads/banners/'); ?>/<?php echo isset($value->image)?$value->image:''; ?>" class="d-block w-100">            
                    <div class="carousel-content-white">
                        <h6 class="carousel-tagline-white"><?php echo $ses_lang=='en' ? $value->title : $value->title_ar; ?></h6>
                        <h2><?php echo $ses_lang=='en' ? $value->title : $value->title_ar; ?></h2>
                        <h5><?php echo $ses_lang=='en' ? $value->sub_title : $value->sub_title_ar; ?></h5>
                        <?php if(isset($value->banner_url) && !empty($value->banner_url)){ ?>
                        <a target="_blank" href="<?php echo isset($value->banner_url)?$value->banner_url:''; ?>" class="btn btn-primary btn-lg brand-btn-white">View More</a>
                        <?php } ?>
                    </div>
                </div> 
        <?php 
            }  
        }else{  
        ?>
            <div class="carousel-item active">
                <img src="https://biagiotti.qodeinteractive.com/elementor/wp-content/uploads/2019/08/m-h-slider-img-1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-content-white">
                    <h6 class="carousel-tagline-white"><?php echo $language['Perfect shades']; ?></h6>
                    <h2>Infinite Beauty</h2>
                    <h5>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h5>
                    <?php if(isset($BannerList) && !empty($BannerList)){ ?>
                    <a href="#" class="btn btn-primary btn-lg brand-btn-white">View More</a>
                    <?php }  
                        ?>
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
<!-- HOME CAROUSEL ENDS -->
<?php if (isset($productList) && !empty($productList)) { ?>
    <!-- HOME PAGE SECTION ONE STARTS -->
    <?php if(isset($productLatestList) && !empty($productLatestList)){ ?>
        <section class="section-spacing text-<?php echo $ses_lang == 'en'?'left':'right'; ?>">
            <div class="container">
                <div class="section-tagline text-center">
                    <h6><?php echo $language['Perfect shades']; ?></h6> 
                </div>
                <div class="section-title text-center">
                    <h4><?php echo $language['Latest Products']; ?></h4>
                </div>
                <div class="carousel-wrapper mt-5">
                    <div id="latest-products-carousel" class="owl-carousel owl-theme">
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
                                <div class="prod-wrapper">
                                    <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                                        <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>"  >
                                    </a>
                                </div>
                                <div class="prod-detail">
                                    <h4>
                                        <a href="#"><?php echo $title; ?> </a>
                                    </h4>
                                </div>
                                <div class="home-prod-price text-center">
                                    <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></span>
                                    <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></span>
                                </div>
                                <div class="text-center mt-3">
                                <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" class="btn btn-primary brand-btn-black"><?php echo $language['Details']; ?></a>
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
        <section class="section-spacing text-<?php echo $ses_lang == 'en'?'left':'right'; ?>">
            <div class="container">
                <div class="section-tagline text-center">
                    <h6><?php echo $language['Perfect shades']; ?></h6>
                </div>
                <div class="section-title text-center">
                    <h4><?php echo $language['Featured Products']; ?></h4>
                </div>

                <div class="carousel-wrapper mt-5">
                    <div id="featured-products-carousel" class="owl-carousel owl-theme">
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
                            <div class="prod-wrapper">
                                <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                                    <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                                </a>
                            </div>
                            <div class="prod-detail">
                                <h4>
                                    <a href="#"><?php echo $title; ?> </a>
                                </h4>
                            </div>
                            <div class="home-prod-price text-center">
                                <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></span>
                                <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></span>                            
                            </div>
                            <div class="text-center mt-3">
                                <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" class="btn btn-primary brand-btn-black"><?php echo $language['Details']; ?></a>
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
    <!-- HOME PAGE SECTION THREE STARTS -->
    <?php if(isset($productDiscountList) && !empty($productDiscountList)){ ?>
        <section class="section-spacing text-<?php echo $ses_lang == 'en'?'left':'right'; ?>">
            <div class="container">
                <div class="section-tagline text-center">
                    <h6><?php echo $language['Perfect shades']; ?></h6>
                </div>
                <div class="section-title text-center">
                    <h4><?php echo $language['Products on sale']; ?></h4>
                </div>

                <div class="carousel-wrapper mt-5">
                    <div id="pos-products-carousel" class="owl-carousel owl-theme">
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
                            <div class="prod-wrapper">
                                <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                                    <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                                </a>
                            </div>
                            <div class="prod-detail">
                                <h4>
                                    <a href="#"><?php echo $title; ?> </a>
                                </h4>
                            </div>
                            <div class="home-prod-price text-center">
                                <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></span>
                                <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></span>
                            </div>
                            <div class="text-center mt-3">
                                <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" class="btn btn-primary brand-btn-black"><?php echo $language['Details']; ?></a>
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
<!-- HOME PAGE SECTION FOUR STARTS  -->
<section class="text-<?php echo $ses_lang == 'en'?'left':'right'; ?>">
    <div class="container">
        <div class="row">
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
                <div class="section-title text-<?php echo $ses_lang == 'en'?'left':'right'; ?>">
                    <h4><?php echo $language['who we are']; ?></h4>
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
                <div class="section-subpara">
                    <p><?php echo isset($checkshortDesc)?$checkshortDesc:''; ?></p>
                </div>
                <a href="<?php echo base_url('/abouts-us'); ?>" class="btn btn-primary brand-btn-black <?php if($locale=='ar'){echo 'float-right';} ?>"><?php echo $language['Know More']; ?></a>
            </div>
        </div>
    </div>
</section>
<!-- HOME PAGE SECTION FOUR ENDS -->
<!-- HOME PAGE SECTION FIVE STARTS -->
<section class="bg-pink section-spacing mt-5 text-<?php echo $ses_lang == 'en'?'left':'right'; ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="shop-benefits">
                    <div class="benefits-content">
                        <img src="https://biagiotti.qodeinteractive.com/elementor/wp-content/uploads/2019/08/m-h-icon-number-1.png">
                        <div class="benefits-text">
                            <h4><?php echo $language['Online purchase']; ?></h4>
                            <p><?php echo $language['Allows Consumers']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="shop-benefits">
                    <div class="benefits-content">
                        <img src="https://biagiotti.qodeinteractive.com/elementor/wp-content/uploads/2019/08/m-h-icon-number-2.png">
                        <div class="benefits-text">
                            <h4><?php echo $language['Free Shipping']; ?></h4>
                            <p><?php echo $language['Customers Do Not']; ?>  </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="shop-benefits">
                    <div class="benefits-content">
                        <img src="https://biagiotti.qodeinteractive.com/elementor/wp-content/uploads/2019/08/m-h-icon-number-3.png">
                        <div class="benefits-text">
                            <h4><?php echo $language['Money Back']; ?></h4>
                            <p><?php echo $language['Guarantee That Provides']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- HOME PAGE SECTION FIVE ENDS -->
<!-- HOME PAGE SECTION SIX STARTS -->
<?php if(isset($BrandInfo) && !empty($BrandInfo)){ ?>
    <section class="bg-grey section-spacing text-<?php echo $ses_lang == 'en'?'left':'right'; ?>">
        <div class="container">
            <div class="section-tagline text-center">
                <h6><?php echo $language['Partners']; ?></h6>
            </div>
            <div class="section-title text-center">
                <h4><?php echo $language['Partnered With Best']; ?></h4>
            </div>
            <div class="carousel-wrapper mt-2">
                <div id="brand-partners-carousel" class="owl-carousel owl-theme">                
                <?php 
                if(isset($BrandInfo) && !empty($BrandInfo)){
                    foreach($BrandInfo as $brandInfoData){
                ?>
                    <div class="item">
                        <div class="brand-wrapper">
                            <p><h4><?php echo isset($brandInfoData->brand_name)?$brandInfoData->brand_name:''; ?></h4></p>
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
<!-- HOME PAGE SECTION SIX ENDS -->
<!-- HOME PAGE SECTION SEVEN STARTS -->
<section class="section-spacing bg-pink text-<?php echo $ses_lang == 'en'?'left':'right'; ?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="subs-text">
                    <h1><?php echo $language['Subscribe']; ?></h1>
                </div>
            </div>
            <div class="col-md-6">
                <?php 
                    $attributes = ['name' => 'save_subscribe_form', 'id' => 'save_subscribe_form', 'autocomplete' => 'off']; 
                    echo form_open_multipart('/save-subscribe',$attributes); 
                ?>
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <div class="subs-input">
                    <input type="email" class="form-control" placeholder="<?php echo $language['Email Address']; ?>" id="email" name="email" data-error=".error2">
                    <button class="btn btn-primary brand-btn-black" type="submit" ><?php echo $language['Send']; ?></button>                                        
                </div>
                </br><span class="error2"></span>   
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
<!-- HOME PAGE SECTION SEVEN ENDS -->
<?php $this->endSection(); ?>