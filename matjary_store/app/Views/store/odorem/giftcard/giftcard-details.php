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
<style>
    .star-fill {
    color: #FFCE31 !important;
}
</style>
<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> <?php echo $language['Gift Card Details']; ?> <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>
<!-- PRODUCT DETAIL STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="prod-detail-image">
                    <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($giftDetails->image)?$giftDetails->image:''; ?>">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="prod-main-detail <?php if($locale=='ar'){echo 'text-right';} ?>">
                    <?php 
                        $attributes = ['name' => 'purchase_giftcard_form', 'id' => 'purchase_giftcard_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('customer/purchase-giftcard',$attributes); 
                    ?>
                    <div class="prod-detail-title">
                        <h3>
                            <?php 
                            $gc_name = '';
                            if($ses_lang=='en'){
                                if(isset($giftDetails->name) && !empty($giftDetails->name)){
                                    $gc_name = $giftDetails->name;
                                }else{
                                    if(isset($giftDetails->name_ar) && !empty($giftDetails->name_ar)){
                                        $gc_name = $giftDetails->name_ar;
                                    }
                                } 
                            }else{
                                if(isset($giftDetails->name_ar) && !empty($giftDetails->name_ar)){
                                    $gc_name = $giftDetails->name_ar;
                                }else{
                                    if(isset($giftDetails->name) && !empty($giftDetails->name)){
                                        $gc_name = $giftDetails->name;
                                    }
                                }                                                        
                            }
                            echo $gc_name; 
                            ?>
                        </h3>
                    </div>
                    <input type="hidden" name="is_giftcard_purchasing" value="1">
                    <input type="hidden" name="customer_id" value="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>">
                    <input type="hidden" name="gc_id" value="<?php echo isset($giftDetails->id)?$giftDetails->id:''; ?>">
                    <div class="prod-detail-price"><?php echo $language['SAR']; ?> <input type="text" name="gc_amount" id="gc_amount" value="1000" maxlength="5" placeholder="Enter Gift Card Amount"><h6 id="gcAmountErrMsg"></h6></div>
                    
                    <div class="prod-detail-icon">
                        <?php  
                            //$cstavgCount = array();                       
                            for ($i = 1; $i <= 5; $i++) {
                                $ratingClass = "icofont-star btn-grey";
                                if(isset($cstavgCount) && !empty($cstavgCount)){
                                    if($i <= $cstavgCount[0]->AverageRate) {
                                    $ratingClass = "star-fill";
                                    }
                                }
                        ?>
                        <i class="icofont-star <?php echo $ratingClass; ?>" aria-hidden="true" aria-label="Left Align"></i>
                        <?php } ?>                       
                        <div class="prod-detail-rating"><h6>( <?php if(isset($cstratingCount) && !empty($cstratingCount)){ echo count($cstratingCount) ; }else{ echo '0'; }?> <?php echo $language['Customer Review']; ?>)</h6></div>
                    </div>    
                    <div class="prod-detail-desc">
                        <p><?php echo isset($giftDetails->short_desc)?$giftDetails->short_desc:'Short Description Not Available.'; ?></p>
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <?php if(isset($ses_logged_in) && $ses_logged_in===true){ ?>
                        <button type="submit" class="btn btn-primary brand-btn" id="buyGiftCardSbmtBtn" ><?php echo $language['Buy']; ?></button>
                        <?php }else{ ?>
                            <a href="<?php echo base_url('customer/login'); ?>" class="btn btn-primary brand-btn"><?php echo $language['Buy']; ?></a>
                        <?php } ?>
                    </div>
                    <?php echo form_close(); ?>
                    <div class="feedback-links mt-4">
                        <?php if(isset($ses_logged_in) && $ses_logged_in===true){ ?>                          
                            <a href="modal" data-toggle="modal" data-target="#modal"><h4><i class="icofont-ui-edit"></i>  <?php echo $language['Post a feedback']; ?></h4></a> 
                            <a class="viewFeedback" href="#">
                                <h4><i class="icofont-eye-alt"></i>  <?php echo $language['View all feebacks']; ?></h4>
                            </a>
                        <?php }else{ ?>
                            <a href="<?php echo base_url('customer/login'); ?>"><h4><i class="icofont-ui-edit"></i>  <?php echo $language['Post a feedback']; ?></h4></a>
                            <a class="viewFeedback" href="#"><h4><i class="icofont-eye-alt"></i>  <?php echo $language['View all feebacks']; ?></h4></a>
                        <?php } ?>
                    </div>  
                    <!--Post a feedback Model--->
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <?php                 
                                    $attributes = ['name' => 'gift_card_save_feedback_form', 'id' => 'gift_card_save_feedback_form', 'autocomplete' => 'off']; 
                                    echo form_open_multipart('giftcard/save-gift-card-feedback',$attributes);             
                                ?>
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                
                                <input type="hidden" id="gc_id" name="gc_id" value="<?php echo isset($giftDetails->id)?$giftDetails->id:''; ?>" />
                                <input type="hidden" id="customer_id" name="customer_id" value="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>" />
                                <input type="hidden" id="fb_id" name="fb_id" value="<?php echo isset($ProductFeedBackDetails->id)?$ProductFeedBackDetails->id:''; ?>" />
                                <div class="feedback-wrapper">
                                    <div class="mb-2">
                                        <label><?php echo $language['Rating']; ?> *</label>
                                        <select class="custom-select" id="ratting" name="ratting">
                                            <option value=""><?php echo $language['Select Rating']; ?> </option>
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
                                    <div class="modal-footer">
                                        <button class="btn btn-primary brand-btn" type="submit"><?php echo $language['Save']; ?></button>  
                                        <button type="button" class="btn btn-primary brand-btn" data-dismiss="modal"><?php echo $language['Close']; ?></button>                      
                                    </div>
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
                        <a class="nav-link prod-main-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-reviews" aria-selected="false">Reviews (<?php if(isset($cstratingCount) && !empty($cstratingCount)){ echo count($cstratingCount) ; }else{ echo '0'; }?>)</a>
                    </li>
                </ul>
                <div class="tab-content prod-main-content" id="pills-tabContent">
                   
                    <div class="tab-pane prod-main-pane fade active" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                        <h4 class="prod-main-content-title"><?php echo $language['Customer Reviews']; ?></h4>
                       <?php if(isset($getGcFeedbackAll) && !empty($getGcFeedbackAll)){
                            foreach($getGcFeedbackAll as $key => $getGcFeedbackAll){ ?>
                                <h6 class="reviewer-name"><?php echo isset($getGcFeedbackAll->name)?$getGcFeedbackAll->name:''; ?></h6>
                                <p class="review-date-time"><?php echo isset($getGcFeedbackAll->created_at)?date('d M Y',strtotime($getGcFeedbackAll->created_at)):''; ?></p>
                                <p><?php echo isset($getGcFeedbackAll->feedback)?$getGcFeedbackAll->feedback:''; ?></p>
                                <hr>
                    <?php  } } ?>
                    </div>
                </div>
            </div>
        </div>
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