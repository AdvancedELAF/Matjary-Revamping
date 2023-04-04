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
<!-- PRODUCTS LISTING SECTION -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title text-center mb-5"><h4><?php echo $category_name; ?> </h4></div>
        <div class="row">
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
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="main-prod-wrapper"><a href="<?php echo base_url('product/product-details/'.$productData->id); ?>"><img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData->image)?$productData->image:''; ?>"></a></div>
                <div class="prod-detail"><h4><a href="<?php echo base_url('product/product-details/'.$productData->id); ?>"><?php echo $title; ?> </a></h4></div>
                <div class="home-prod-price text-center">
                    <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></span>
                    <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></span>
                </div>
                <div class="text-center mt-3 mb-5"><a href="<?php echo base_url('product/product-details/'.$productData->id); ?>" class="btn btn-primary brand-btn-black"><?php echo $language['Details']; ?></a></div>
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
</section>
<?php $this->endSection(); ?>