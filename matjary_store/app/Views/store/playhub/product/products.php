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
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
        <div class="trans-page-title">
            <h1> <?php 
                if(isset($_REQUEST['query']) && !empty($_REQUEST['query'])){
                    echo ''.$language['Search Results'] .'('.count($productList).')';
                }else{
                    //echo 'Latest Products';
                    echo $language['Latest Products'];
                }
                ?></h1>
        </div>
    </div>
</section>
<section>
    <div class="container-fluid <?php if($locale=='ar'){echo 'text-right';} ?>">
        <div class="row">
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
            <div class="col-md-6 col-lg-3 item">
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
                    <div class="home-prod-price mt-0 mb-3">
                        <h6 class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->retail_price)?number_format((float)$productData->retail_price, 2, '.', ''):''; ?></h6>
                        <h5 class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productData->product_price)?number_format((float)$productData->product_price, 2, '.', ''):''; ?></h5>                        
                    </div>
                    <div class="wishlist">
                    <i class="icofont-heart <?php echo $press; ?> <?php echo $wishlistActnClass; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>"></i>
                    </div>
                    <div class="text-center mb-2">
                        <!--button class="brand-btn-add-cart">Add to Cart</button-->
                        <!--a href="<?php //echo base_url('product/product-details/'.$productData->id); ?>" class="brand-btn-add-cart"><?php //echo $language['Details']; ?></a-->   
                        <?php if(isset($ses_logged_in) && $ses_logged_in===true){ ?> 
                            <span class="product_<?php echo $productData->id; ?>_cartBtn">
                                <a type="button" href="javascript:void(0);" data-baseurl="<?php echo base_url(); ?>" data-actionurl="<?php echo $actionPrdctCarturl; ?>" data-productid="<?php echo $productData->id; ?>" data-customerid="<?php echo $ses_custmr_id; ?>"  data-lang="<?php echo $locale; ?>" class="brand-btn-add-cart <?php echo $actionCartBtnClass; ?>"><?php echo $anchorCartBtnText; ?></a>
                            </span>
                        <?php }else{ ?>
                            <a type="button" href="<?php echo base_url('customer/login'); ?>" class="brand-btn-add-cart"><?php echo $language['Add to Cart']; ?></a>
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
</section>
<?php $this->endSection(); ?>