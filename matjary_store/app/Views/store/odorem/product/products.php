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
<section class="ot-banner-bg <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> 
                <?php 
                if(isset($_REQUEST['query']) && !empty($_REQUEST['query'])){
                    echo ''.$language['Search Results'] .'('.count($productList).')';
                }else{
                    echo $language['Latest Products'];
                }
                ?> <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>
<!-- PRODUCTS LISTING SECTION -->
<section class="section-spacing" >
    <div class="container">        
        <div class="row">
            <?php 
            $checkProductData = $locale=='en'?'Product Not Available Yet!.':'البيانات غير متوفرة بعد !.';
            if(isset($productList) && !empty($productList)){
                foreach($productList as $productData){
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
                    <div class="prod-wrapper">
                            <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>"><img src="<?php echo base_url('/uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>"></a>
                    </div>
                    <div class="prod-details">
                        <h4 title="<?php echo $title; ?>"><?php echo character_limiter($title,10); ?></h4>
                        <div class="home-prod-price text-center">
                        <?php if($productData->discount_per != 0){ ?>
                        <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></span>
                        <?php } ?>
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
            }else{ ?>
                <div class="col-md-6 col-lg-3">              
                    <h5><?php echo $checkProductData; ?></h5>
               </div>   
            <?php  } ?>            
        </div>
    </div>
</section>
<?php $this->endSection(); ?>