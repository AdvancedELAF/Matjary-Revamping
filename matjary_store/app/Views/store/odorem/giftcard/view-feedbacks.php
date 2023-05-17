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
            <h4>All Gift Card customer feedbacks</h4>
        </div>       
        <div class="row">
            <div class="col-md-12">
                <div class="feedback-wrapper">  
                    <?php
                     if(isset($GetGiftCardsFeedbacks) && !empty($GetGiftCardsFeedbacks)){
                        foreach($GetGiftCardsFeedbacks as $key => $GetProductFeedbacksData){ ?>
                        <h4 class="prod-main-content-title">Customer Reviews</h4>
                        <h6 class="prod-main-content-title">Review by <?php echo isset($ses_custmr_name)?$ses_custmr_name:''; ?>  <?php echo isset($GetProductFeedbacksData->created_at)?$GetProductFeedbacksData->created_at:''; ?></h6>
                        <p><?php echo isset($GetProductFeedbacksData->feedback)?$GetProductFeedbacksData->feedback:''; ?></p>
                        <hr>
                    <?php  } } ?>                            
                    <a class="btn btn-primary brand-btn-black-outline" href="<?php echo base_url('giftcard/giftcard-details/'.$GetGiftCardsFeedbacks[0]->gc_id); ?>">Back</a> 
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection(); ?>