<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section>
    <div class="container-fluid <?php if($locale=='ar'){echo 'text-right';} ?>">
        <div class="trans-page-title">
            <h1><?php echo $language['My Gift cards']; ?></h1>
        </div>
    </div>
</section>
<!-- GIFT CARD LISITNG SECTION STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
        <div class="row">
            <?php 
            if(isset($GetGiftCardPurchasedInfo) && !empty($GetGiftCardPurchasedInfo)){
                foreach($GetGiftCardPurchasedInfo as $GiftCardData){
            ?>
            <div class="col-md-6 col-lg-3">
                <div class="giftcard-wrap orange-bg">
                       <a href="<?php echo base_url('customer/my-giftcard-details/'.$GiftCardData->giftcard_prchsed_id); ?>">
                            <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($GiftCardData->image)?$GiftCardData->image:''; ?>">
                        </a>  

                        <div class="giftcard-data">
                        <h6><?php echo $language['Code']; ?>:</h6>
                        <p><?php echo isset($GiftCardData->egift_code)?$GiftCardData->egift_code:''; ?></p>
                        </div>

                        <div class="giftcard-data">
                            <h6><?php echo $language['Till Date']; ?>:</h6>
                            <p><?php echo isset($GiftCardData->expiry_date)?date("Y-m-d",strtotime($GiftCardData->expiry_date)):''; ?></p>
                        </div>

                        <div class="giftcard-data">
                            <h6><?php echo $language['Balance']; ?>:</h6>
                            <p><?php echo $language['SAR']; ?> <?php echo isset($GiftCardData->gc_balance)?$GiftCardData->gc_balance:''; ?></p>
                        </div>

                        <div class="text-center mb-2">
                            <a href="<?php echo base_url('customer/my-giftcard-details/'.$GiftCardData->giftcard_prchsed_id); ?>" class="brand-btn-white"><?php echo $language['Details']; ?></a>  
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