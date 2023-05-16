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
<section>
    <div class="container-fluid <?php if($locale=='ar'){echo 'text-right';} ?>">
        <div class="trans-page-title">
            <h1><?php echo $language['My Wishlist']; ?></h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">     
        <div class="row">
            <?php 
            if(isset($CstmrProductWishList) && !empty($CstmrProductWishList)){
                foreach($CstmrProductWishList as $productData){
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
            <div class="col-md-6 col-lg-3">

                <div class="prod-wrapper text-center">
                    <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                        <img src="<?php echo base_url('/uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                    </a>
                    <div class="offer-badge">
                        <h5><?php echo isset($productData->discount_per) ? $productData->discount_per : ''; ?>%</h5>
                    </div>
                    <div class="prod-title">
                        <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                            <h5><?php echo $title; ?></h5>
                        </a>
                    </div>
                    <div class="home-prod-price mb-3">
                        <h6 class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></h6>
                        <h5 class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></h5>
                    </div>

                    <div class="wishlist">
                            <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>"></i>
                        </div> 

                    <div class="text-center">
                        <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" class="brand-btn-add-cart"><?php echo $language['Details']; ?></a>  
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