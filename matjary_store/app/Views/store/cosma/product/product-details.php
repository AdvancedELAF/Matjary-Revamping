<?php 
$session = \Config\Services::session(); 
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');

$title = '';
if($ses_lang=='en'){
    if(isset($productDetails->title) && !empty($productDetails->title)){
        $title = $productDetails->title;
    }else{
        if(isset($productDetails->title_ar) && !empty($productDetails->title_ar)){
            $title = $productDetails->title_ar;
        }
    } 
}else{
    if(isset($productDetails->title_ar) && !empty($productDetails->title_ar)){
        $title = $productDetails->title_ar;
    }else{
        if(isset($productDetails->title) && !empty($productDetails->title)){
            $title = $productDetails->title;
        }
    }                                                        
}

$short_desc = '';
if($ses_lang=='en'){
    if(isset($productDetails->short_desc) && !empty($productDetails->short_desc)){
        $short_desc = $productDetails->short_desc;
    }else{
        if(isset($productDetails->short_desc_ar) && !empty($productDetails->short_desc_ar)){
            $short_desc = $productDetails->short_desc_ar;
        }
    } 
}else{
    if(isset($productDetails->short_desc_ar) && !empty($productDetails->short_desc_ar)){
        $short_desc = $productDetails->short_desc_ar;
    }else{
        if(isset($productDetails->short_desc) && !empty($productDetails->short_desc)){
            $short_desc = $productDetails->short_desc;
        }
    }                                                        
}

$long_desc = '';
if($ses_lang=='en'){
    if(isset($productDetails->long_desc) && !empty($productDetails->long_desc)){
        $long_desc = $productDetails->long_desc;
    }else{
        if(isset($productDetails->long_desc_ar) && !empty($productDetails->long_desc_ar)){
            $long_desc = $productDetails->long_desc_ar;
        }
    } 
}else{
    if(isset($productDetails->long_desc_ar) && !empty($productDetails->long_desc_ar)){
        $long_desc = $productDetails->long_desc_ar;
    }else{
        if(isset($productDetails->long_desc) && !empty($productDetails->long_desc)){
            $long_desc = $productDetails->long_desc;
        }
    }                                                        
}
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<style>
    .star-fill {
    color: #FFCE31 !important;
}
</style>
<!-- PRODUCT DETAIL STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <?php if(isset($productDetails->is_active) && $productDetails->is_active==1){ ?>
        <div class="row">
            <div class="col-lg-4">
                <div class="prod-detail-image">
                    <img src="<?php echo base_url('/uploads/product/'); ?>/<?php echo isset($productDetails->image)?$productDetails->image:''; ?>">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="prod-main-detail">
                    <div class="prod-detail-title">
                        <h3><?php echo $title; ?></h3>
                        
                    </div>
                    <div class="prod-detail-price">
                        <p>
                            <span class="strike-amount"><?php echo $language['SAR']; ?> <?php echo isset($productDetails->retail_price)?number_format((float)$productDetails->retail_price, 2, '.', ''):''; ?></span>
                            <span class="sale-amount"><?php echo $language['SAR']; ?> <?php echo isset($productDetails->product_price)?number_format((float)$productDetails->product_price, 2, '.', ''):''; ?></span>
                        </p>
                    </div>
                 
                    <div class="prod-detail-icon">
                        <?php
                             for ($i = 1; $i <= 5; $i++) {
                                $ratingClass = "icofont-star btn-grey";
                               if(isset($cstavgCount) && !empty($cstavgCount)){
                                    if($i <= $cstavgCount[0]->AverageRate) {
                                    $ratingClass = "star-fill";
                                    }
                               }
                        ?>
                        <i class="icofont-star <?php echo $ratingClass; ?>" aria-label="Left Align"></i>
                        <?php } ?>                       
                        <div class="prod-detail-rating"><h6>( <?php if(isset($cstratingCount) && !empty($cstratingCount)){ echo count($cstratingCount) ; }else{ echo '0';}?> <?php echo $language['Customer Review']; ?>)</h6></div>
                    </div>                    
                   
                    <div class="prod-stock-count">
                        <h4><?php echo $language['Stock']; ?>: <?php if($productDetails->stock_quantity==0){echo'<span class="text-danger">Out of Stock</span>';}elseif($productDetails->stock_quantity <= $productDetails->threshold_quantity){echo '<span class="text-warning">Only '.$productDetails->stock_quantity.' Units Left</span>';}else{ echo '<span class="text-success">'. $language['Available'].'</span>'; } ?></h4>
                    </div>
                    <div class="prod-detail-desc">
                        <p><?php echo $short_desc; ?></p>
                    </div>

                    <div class="row">
                        <?php if(isset($productColors) && !empty($productColors)){ ?>
                            <div class="col-md-6 mb-2 pl-0">
                                <select class="custom-select">
                                    <option value=""><?php echo $language['Choose Color']; ?></option>
                                    <?php foreach ($productColors as $colorData) { ?>
                                        <option value="<?php echo $colorData->id; ?>"><?php echo $colorData->color_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>
                        <?php if(isset($productSizes) && !empty($productSizes)){ ?>
                            <div class="col-md-6 mb-2 pl-0">
                                <select class="custom-select">
                                    <option value=""><?php echo $language['Choose Size']; ?></option>
                                    <?php foreach ($productSizes as $sizeData) { ?>
                                        <option value="<?php echo $sizeData->id; ?>"><?php echo $sizeData->size; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-block <?php if($locale=='ar'){echo 'text-right';} ?>" id="productCartBox">
                        <?php if(isset($ses_logged_in) && $ses_logged_in===true){ ?>
                            <?php 
                            $actionPrdctCarturl = base_url('customer/add-product-cart');
                            //$anchorCartBtnText = 'Add to Cart';
                            $anchorCartBtnText = $language['Add to Cart'];
                            $actionCartBtnClass = 'addToCart';

                            $actionWishlisturl = base_url('customer/add-product-wishlist');
                            //$anchorWishlistBtnText = 'Wishlist';
                            $anchorWishlistBtnText = $language['Wishlist'];
                            $actionWishlistBtnClass = 'addToWishlist';

                            if(isset($snglCstmrCartProductList) && !empty($snglCstmrCartProductList)){
                                foreach($snglCstmrCartProductList as $snglCstmrCartProductData){
                                    if($snglCstmrCartProductData->product_id==$productDetails->id){
                                        $actionPrdctCarturl = base_url('customer/remove-product-cart');
                                       // $anchorCartBtnText = 'Remove From Cart';
                                        $anchorCartBtnText =  $language['Remove From Cart'];
                                        $actionCartBtnClass = 'removeFromCart';
                                    }
                                }
                            }

                            if(isset($cstmrWishPrdctList) && !empty($cstmrWishPrdctList)){
                                foreach($cstmrWishPrdctList as $cstmrWishPrdctList){
                                    if($cstmrWishPrdctList->product_id==$productDetails->id){

                                        $actionWishlisturl = base_url('customer/remove-product-wishlist');
                                        //$anchorWishlistBtnText = 'Remove From Wishlist';
                                        $anchorWishlistBtnText = $language['Remove From Wishlist'];
                                        $actionWishlistBtnClass = 'removeFromWishlist';
                                    }
                                }
                            }
                            ?>
                            <span id="product_<?php echo $productDetails->id; ?>_cartBtn">
                                <a href="javascript:void(0);" data-baseurl="<?php echo base_url(); ?>" data-actionurl="<?php echo $actionPrdctCarturl; ?>" data-productid="<?php echo $productDetails->id; ?>" data-customerid="<?php echo $ses_custmr_id; ?>"  data-lang="<?php echo $locale; ?>" class="btn btn-primary brand-btn-black <?php echo $actionCartBtnClass; ?>"><?php echo $anchorCartBtnText; ?></a> 
                            </span>
                            <span id="product_<?php echo $productDetails->id; ?>_whishlistBtn">
                                <a href="javascript:void(0);" data-baseurl="<?php echo base_url(); ?>" data-actionurl="<?php echo $actionWishlisturl; ?>" data-productid="<?php echo $productDetails->id; ?>" data-customerid="<?php echo $ses_custmr_id; ?>"  data-lang="<?php echo $locale; ?>" class="btn btn-primary brand-btn-black-outline <?php echo $actionWishlistBtnClass; ?>"><?php echo $anchorWishlistBtnText; ?></a>
                            </span>
                            <?php if($productDetails->stock_quantity!=0){ ?>
                            <a href="javascript:void(0);" class="btn btn-primary brand-btn-black-outline" data-actionurl="<?php echo base_url('customer/buy-product'); ?>" data-productid="<?php echo $productDetails->id; ?>" data-customerid="<?php echo $ses_custmr_id; ?>" id="buyProductBtn"><?php echo $language['Buy']; ?></a>
                            <?php } ?>
                        <?php }else{ ?> 
                            <a href="<?php echo base_url('customer/login'); ?>" class="btn btn-primary brand-btn-black"><?php echo $language['Add to Cart']; ?></a>
                            <a href="<?php echo base_url('customer/login'); ?>" class="btn btn-primary brand-btn-black-outline"><?php echo $language['Wishlist']; ?></a>
                            <a href="<?php echo base_url('customer/login'); ?>" class="btn btn-primary brand-btn-black-outline"><?php echo $language['Buy']; ?></a>
                        <?php } ?>
                        
                        
                    </div>
                    <div class="feedback-links mt-4">
                        <?php if(isset($ses_logged_in) && $ses_logged_in===true){ ?>
                            <!--<a href="<?php //echo base_url('product/post-feedback/'.$productDetails->id); ?>">
                                <h4><i class="icofont-ui-edit"></i> Post a feedback</h4>
                            </a>---Review Post on Page ---->
                            <a href="modal" data-toggle="modal" data-target="#modal"><h4><i class="icofont-ui-edit"></i> <?php echo $language['Post a feedback']; ?></h4></a>                            
                            <a class="viewFeedback" href="#">
                                <h4><i class="icofont-eye-alt"></i> <?php echo $language['View all feebacks']; ?></h4>
                            </a>
                        <?php }else{ ?>
                            <a href="<?php echo base_url('customer/login'); ?>"><h4><i class="icofont-ui-edit"></i><?php echo $language['Post a feedback']; ?></h4></a>
                            <!--<a href="<?php //echo base_url('customer/login'); ?>"><h4><i class="icofont-eye-alt"></i>View all feebacks</h4></a>-->
                            <a class="viewFeedback" href="#"><h4><i class="icofont-eye-alt"></i><?php echo $language['View all feebacks']; ?></h4></a>
                        <?php } ?>
                    </div>
                    <!--Post a feedback Model--->
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <?php                 
                                    $attributes = ['name' => 'save_feedback_form', 'id' => 'save_feedback_form', 'autocomplete' => 'off']; 
                                    echo form_open_multipart('product/save-feedback',$attributes);             
                                ?>
                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                    <input type="hidden" id="product_id" name="product_id" value="<?php echo isset($productDetails->id)?$productDetails->id:''; ?>" />
                                    <input type="hidden" id="category_id" name="category_id" value="<?php echo isset($productDetails->category_id)?$productDetails->category_id:''; ?>" />
                                    <input type="hidden" id="customer_id" name="customer_id" value="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>" />
                                <div class="modal-body pd-5">
                                <div class="mb-2">
                                <label><?php echo $language['Rating']; ?> *</label>
                                <select class="custom-select" id="ratting" name="ratting">
                                    <option value=""><?php echo $language['Select Rating']; ?>  </option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label><?php echo $language['Enter Feedback']; ?>*</label>
                                <textarea class="form-control" rows="3" id="feedback" name="feedback" maxlength="5002"><?php //echo isset($ProductFeedBackDetails[0]->feedback)?$ProductFeedBackDetails[0]->feedback:''; ?></textarea>
                            </div>
                                </div>
                                <div class="modal-footer">
                                 <!--  <button class="btn btn-primary brand-btn-black" type="submit">Save</button>   -->
                                    <input type="submit" value="<?php echo $language['Submit']; ?>" class="btn btn-primary brand-btn-black">
                                    <button type="button" class="btn btn-primary brand-btn-black-outline" data-dismiss="modal"><?php echo $language['Close']; ?></button>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
					</div>
                    <!--Post a feedback Model End--->
                </div>
            </div>
        </div>
        <div id="reviewShow" class="row">
            <div class="prod-main-tab">
                <ul class="nav nav-pills prod-main-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item prod-main-item" role="presentation">
                        <a class="nav-link prod-main-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-selected="true"><?php echo $language['Description']; ?></a>
                    </li>
                    <li class="nav-item prod-main-item" role="presentation">
                        <a class="nav-link prod-main-link" id="pills-summary-tab" data-toggle="pill" href="#pills-summary" role="tab" aria-controls="pills-summary" aria-selected="false"><?php echo $language['Summary']; ?></a>
                    </li>
                    <li class="nav-item prod-main-item" role="presentation">                        
                        <a class="nav-link prod-main-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-reviews" aria-selected="false"><?php echo $language['Reviews']; ?> (<?php if(isset($cstratingCount) && !empty($cstratingCount)){ echo count($cstratingCount) ; }else{ echo '0'; }?>)</a>
                    </li>
                </ul>
                <div class="tab-content prod-main-content" id="pills-tabContent">
                    <div class="tab-pane prod-main-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                        
                        <p><?php echo $long_desc; ?></p>
                    </div>
                    <div class="tab-pane prod-main-pane fade" id="pills-summary" role="tabpanel" aria-labelledby="pills-summary-tab">
                        
                        <p><?php echo $short_desc;  ?></p>
                    </div>
                    <div class="tab-pane prod-main-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                        
                        <?php //echo '<pre>'; print_r($GetProductFeedbacks); ?>
                       <?php if(isset($GetProductFeedbacks) && !empty($GetProductFeedbacks)){
                            foreach($GetProductFeedbacks as $key => $GetProductFeedbacksData){ 
                                $feedback = '';
                                if($ses_lang=='en'){
                                    if(isset($GetProductFeedbacksData->feedback) && !empty($GetProductFeedbacksData->feedback)){
                                        $feedback = $GetProductFeedbacksData->feedback;
                                    }else{
                                        if(isset($GetProductFeedbacksData->feedback_ar) && !empty($GetProductFeedbacksData->feedback_ar)){
                                            $feedback = $GetProductFeedbacksData->feedback_ar;
                                        }
                                    } 
                                }else{
                                    if(isset($GetProductFeedbacksData->feedback_ar) && !empty($GetProductFeedbacksData->feedback_ar)){
                                        $feedback = $GetProductFeedbacksData->feedback_ar;
                                    }else{
                                        if(isset($GetProductFeedbacksData->feedback) && !empty($GetProductFeedbacksData->feedback)){
                                            $feedback = $GetProductFeedbacksData->feedback;
                                        }
                                    }                                                        
                                }?>
                            <h6 class="reviewer-name"><?php echo isset($GetProductFeedbacksData->name)?$GetProductFeedbacksData->name:''; ?></h6>
                            <p class="review-date-time"><?php echo isset($GetProductFeedbacksData->created_at)?date('d M Y',strtotime($GetProductFeedbacksData->created_at)):''; ?></p>
                            
                            <p><?php echo $feedback; ?></p>
                            <hr>
                       <?php  } } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{ ?>
            <div class="section-spacing">
                <div class="success-message text-center">
                    <p><?php echo $language['The Product Is Not Active In The Store.']; ?> </p>
                </div>
                <div class="d-grid gap-2 d-md-block text-center">
                    <button class="btn btn-primary brand-btn-black">
                        <a href="<?php echo base_url('product/products'); ?>"><?php echo $language['Continue shopping']; ?></a>
                    </button>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<!-- PRODUCT DETAIL ENDS -->
<script>
    $(".viewFeedback").click(function() {
        $('[href="#pills-reviews"]').tab("show");         
        $('html, body').animate({
        scrollTop: $("#reviewShow").offset().top
    }, 2000);
    });
</script>
<?php $this->endSection(); ?>