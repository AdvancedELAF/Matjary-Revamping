<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- GIFT CARD LISITNG SECTION STARTS -->
<section class="ot-banner-bg <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> <?php echo $language['My Gift cards']; ?> <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">       
        <div class="row">
            <?php 
            if(isset($GetGiftCardPurchasedInfo) && !empty($GetGiftCardPurchasedInfo)){
                foreach($GetGiftCardPurchasedInfo as $GiftCardData){
            ?>
            <div class="col-md-6 col-lg-3">
                <div class="prod-card">
                        <div class="prod-wrapper">
                            <a href="<?php echo base_url('customer/my-giftcard-details/'.$GiftCardData->giftcard_prchsed_id); ?>">
                                <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($GiftCardData->image)?$GiftCardData->image:''; ?>">
                            </a>
                        </div>
                        <div class="prod-details">
                            <h4><a href="<?php echo base_url('customer/my-giftcard-details/'.$GiftCardData->giftcard_prchsed_id); ?>"><?php echo $language['Code']; ?> : <?php echo isset($GiftCardData->egift_code)?$GiftCardData->egift_code:''; ?></a></h4>                            
                            <h4><?php echo $language['Till Date']; ?> : <?php echo isset($GiftCardData->expiry_date)?date("Y-m-d",strtotime($GiftCardData->expiry_date)):''; ?></h4>
                            <h4><?php echo $language['Balance']; ?> : <?php echo $language['SAR']; ?><?php echo isset($GiftCardData->gc_balance)?$GiftCardData->gc_balance:''; ?></h4>
                        </div>
                        <div class="prod-btn d-grid">                 
                            <a href="<?php echo base_url('customer/my-giftcard-details/'.$GiftCardData->giftcard_prchsed_id); ?>" class="btn btn-primary brand-btn"><?php echo $language['Details']; ?></a>
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
<!-- GIFT CARD LISTING SECTION ENDS -->
<?php $this->endSection(); ?>