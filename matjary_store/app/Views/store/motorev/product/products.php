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
<!-- PRODUCTS LISTING SECTION -->
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1>
                <?php 
                if(isset($_REQUEST['query']) && !empty($_REQUEST['query'])){
                    echo ''.$language['Search Results'] .'('.count($productList).')';
                }else{                   
                    echo $language['Latest Products'];
                }
                ?>
            </h1>
        </div>
    </div>
</section>
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>" >
    <div class="container">
        
        <div class="row" >
            <?php 
            $checkProductData = $locale=='en'?'Product Not Available Yet!.':'البيانات غير متوفرة بعد !.';
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
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="prod-wrapper">
                    <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>"><img src="<?php echo base_url('/uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>"></a>
                    <div class="prod-detail text-center"><a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" title="<?php echo $title; ?>"><h4><?php echo character_limiter($title,10); ?></h4> </a>
                        <div class="home-prod-price text-center">
                            <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></span>
                            <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></span>
                        </div>
                        <div class="wishlist">
                            <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>"></i>
                        </div>                       
                        <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" class="btn btn-primary brand-btn"><?php echo $language['Details']; ?></a>                        
                    </div>
                </div>
            </div>
            <?php
                }
            }else{ ?>
                <div class="col-sm-6 col-md-4 col-lg-3">                 
                    <div class="prod-detail">                        
                        <?php echo $checkProductData; ?>                                      
                   </div>                 
               </div>   
            <?php  } ?>
        </div>
    </div>
</section>
<?php $this->endSection(); ?>