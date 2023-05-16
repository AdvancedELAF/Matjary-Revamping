<?php 
$session = \Config\Services::session(); 
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="section-spacing">
    <div class="container">       
        <div class="section-title text-center mb-3">
            <h4><?php echo isset($GiftCardDetails->title)?$GiftCardDetails->title:''; ?></h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php                 
                    $attributes = ['name' => 'gift_card_save_feedback_form', 'id' => 'gift_card_save_feedback_form', 'autocomplete' => 'off']; 
                    echo form_open_multipart('giftcard/save-gift-card-feedback',$attributes);             
                ?>
                 <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                
                 <input type="hidden" id="gc_id" name="gc_id" value="<?php echo isset($GiftCardDetails->id)?$GiftCardDetails->id:''; ?>" />
                 <input type="hidden" id="customer_id" name="customer_id" value="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>" />
                 <input type="hidden" id="fb_id" name="fb_id" value="<?php echo isset($ProductFeedBackDetails->id)?$ProductFeedBackDetails->id:''; ?>" />
                <div class="feedback-wrapper">
                    <div class="mb-2">
                        <label>Ratting*</label>
                        <select class="custom-select" id="ratting" name="ratting">
                            <option value="">Select Ratting </option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Enter Feedback*</label>
                        <textarea class="form-control" rows="3" id="feedback" name="feedback" ><?php //echo isset($ProductFeedBackDetails[0]->feedback)?$ProductFeedBackDetails[0]->feedback:''; ?></textarea>
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary brand-btn-black" type="submit">Save</button>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PRODUCT FEEDBACK ENDS -->
<?php $this->endSection(); ?>