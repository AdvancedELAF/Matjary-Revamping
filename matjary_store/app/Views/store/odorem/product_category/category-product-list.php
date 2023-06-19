<?php 
$session = \Config\Services::session(); 
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
$category_name = '';
if($ses_lang=='en'){
    if(isset($catDetails[0]->category_name) && !empty($catDetails[0]->category_name)){
        $category_name = $catDetails[0]->category_name;
    }else{
        if(isset($catDetails[0]->category_name_ar) && !empty($catDetails[0]->category_name_ar)){
            $category_name = $catDetails[0]->category_name_ar;
        }
    } 
}else{
    if(isset($catDetails[0]->category_name_ar) && !empty($catDetails[0]->category_name_ar)){
        $category_name = $catDetails[0]->category_name_ar;
    }else{
        if(isset($catDetails[0]->category_name) && !empty($catDetails[0]->category_name)){
            $category_name = $catDetails[0]->category_name;
        }
    }                                                        
}
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> <?php echo $category_name; ?> <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>
<!-- PRODUCTS LISTING SECTION -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        
        <div class="carousel-wrapper mt-5">
            <div id="featured-product-carousel" class="owl-carousel owl-theme">
                <?php 
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
                <div class="item">
                    <div class="prod-card">
                        <div class="prod-wrapper">
                            <a href="<?php echo base_url('product/product-details/'.$productData->id); ?>">
                                <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>">
                            </a>
                        </div>
                        <div class="prod-details">
                            <h4><?php echo $title; ?></h4>
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
                }else{
                    ?>
                        <div>
                        <?php echo $language['No Product Found in this category']; ?>.
                        </div>
                    <?php
                }
                ?>                       
            </div>
        </div>
    </div>
</section>

<?php $this->endSection(); ?>