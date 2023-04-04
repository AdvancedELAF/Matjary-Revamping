<?php 
$session = \Config\Services::session(); 
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner-bg <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> <?php echo $language['My Wishlist']; ?> <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<section class="section-spacing">
    <div class="container">  
        <div class="row">
            <?php 
            if(isset($CstmrProductWishList) && !empty($CstmrProductWishList)){
                foreach($CstmrProductWishList as $productData){
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
                <div class="prod-card">
                    <div class="prod-wrapper"><a href="<?php echo base_url('product/product-details/'.$productData->id); ?>"><img src="<?php echo base_url('/uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>"></a></div>
                    <div class="prod-details">
                            <h4><?php echo $title; ?></h4>
                    
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
</section>
<?php $this->endSection(); ?>