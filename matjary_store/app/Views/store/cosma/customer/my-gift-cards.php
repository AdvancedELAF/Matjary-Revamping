<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- GIFT CARD LISITNG SECTION STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h4><?php echo $language['My Gift cards']; ?></h4>
        </div>
        <div class="row">           
            <?php 
            if(isset($GetGiftCardPurchasedInfo) && !empty($GetGiftCardPurchasedInfo)){
                foreach($GetGiftCardPurchasedInfo as $GiftCardData){
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="main-gift-wrapper">
                    <a href="<?php echo base_url('customer/my-giftcard-details/'.$GiftCardData->giftcard_prchsed_id); ?>">
                        <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($GiftCardData->image)?$GiftCardData->image:''; ?>">
                    </a>
                </div>
                <div class="gift-detail">
                    <h4><a href="<?php echo base_url('customer/my-giftcard-details/'.$GiftCardData->giftcard_prchsed_id); ?>"><?php echo $language['Code']; ?> : <?php echo isset($GiftCardData->egift_code)?$GiftCardData->egift_code:''; ?></a></h4>
                </div>
                <div class="gift-detail">
                    <h4><?php echo $language['Till Date']; ?> : <?php echo isset($GiftCardData->expiry_date)?date("Y-m-d",strtotime($GiftCardData->expiry_date)):''; ?></h4>
                </div>
                <div class="gift-detail">
                    <h4><?php echo $language['Balance']; ?> : <?php echo $language['SAR']; ?><?php echo isset($GiftCardData->gc_balance)?$GiftCardData->gc_balance:''; ?></h4>
                </div>
                <div class="text-center mt-3 mb-5">                    
                    <a href="<?php echo base_url('customer/my-giftcard-details/'.$GiftCardData->giftcard_prchsed_id); ?>" class="btn btn-primary brand-btn-black"><?php echo $language['Details']; ?></a>
                </div>
            </div>
            <?php
               }
            }
            ?>
        </div>
    </div>
</section>
<!-- GIFT CARD LISTING SECTION ENDS -->
<?php $this->endSection(); ?>