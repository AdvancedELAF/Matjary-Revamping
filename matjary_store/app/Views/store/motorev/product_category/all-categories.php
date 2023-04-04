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
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['All Categories']; ?></h1>
        </div>
    </div>
</section>
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">      
        <div class="category-carousel-wrapper mt-3">
            <div id="category-products-carousel" class="owl-carousel owl-theme">
            <?php            
            if(isset($prodCatList) && !empty($prodCatList)){
                foreach ($prodCatList as $value) { 
                    $category_name = '';
                        if($ses_lang=='en'){
                            if(isset($value->category_name) && !empty($value->category_name)){
                                $category_name = $value->category_name;
                            }else{
                                if(isset($value->category_name_ar) && !empty($value->category_name_ar)){
                                    $category_name = $value->category_name_ar;
                                }
                            } 
                        }else{
                            if(isset($value->category_name_ar) && !empty($value->category_name_ar)){
                                $category_name = $value->category_name_ar;
                            }else{
                                if(isset($value->category_name) && !empty($value->category_name)){
                                    $category_name = $value->category_name;
                                }
                            }                                                        
                        } ?>
                <div class="item">
                    <div class="category-wrapper">
                    <a href="<?php echo base_url('category/category-product-list/'.$value->id); ?>">
                                <img src="<?php echo base_url('uploads/product_category/'); ?>/<?php echo isset($value->category_img)?$value->category_img:''; ?>">
                            </a>
                        <div class="cat-name text-center">
                            <a href="#">
                                <h4><?php echo $category_name; ?></h4>
                            </a>
                        </div>
                    </div>
                </div> 
                <?php }
            }else{
                ?>                
                <div><?php echo $language['No Category Found']; ?>.</div>            
                <?php
            } ?>              
            </div>
        </div>
    </div>
</section>
<?php $this->endSection(); ?>
