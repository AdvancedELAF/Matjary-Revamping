<?php $this->extend('store/' . $storeActvTmplName . '/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="ot-banner">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['My Gift cards']; ?></h1>
        </div>
    </div>
</section>
<!-- GIFT CARD LISITNG SECTION STARTS -->
<section class="section-spacing <?php if ($locale == 'ar') { echo 'text-right'; } ?>">
    <div class="container">
        <div class="row">
            <?php
            if (isset($GetGiftCardPurchasedInfo) && !empty($GetGiftCardPurchasedInfo)) {
                foreach ($GetGiftCardPurchasedInfo as $GiftCardData) {
            ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="product-wrapper">
                            <a href="<?php echo base_url('customer/my-giftcard-details/' . $GiftCardData->giftcard_prchsed_id); ?>">
                                <img src="<?php echo base_url('/uploads/giftcards/'); ?>/<?php echo isset($GiftCardData->image) ? $GiftCardData->image : ''; ?>">
                            </a>
                           
                            <div class="prod-details">
                                <a href="<?php echo base_url('customer/my-giftcard-details/' . $GiftCardData->giftcard_prchsed_id); ?>">
                                    <h6><?php echo $language['Code']; ?></h6>
                                    <h4><?php echo isset($GiftCardData->egift_code) ? $GiftCardData->egift_code : ''; ?></h4>
                                </a>
                            </div>
                            <div class="prod-details">
                                <h6><?php echo $language['Till Date']; ?></h6>
                                <h4><?php echo isset($GiftCardData->expiry_date) ? date("Y-m-d", strtotime($GiftCardData->expiry_date)) : ''; ?></h4>
                            </div>
                            <div class="prod-details">
                                <h6><?php echo $language['Balance']; ?></h6>
                                <h4><?php echo $language['SAR']; ?> <?php echo isset($GiftCardData->gc_balance) ? $GiftCardData->gc_balance : ''; ?></h4>
                            </div>
                            <div class="prod-cart-btn">
                                <a href="<?php echo base_url('customer/my-giftcard-details/' . $GiftCardData->giftcard_prchsed_id); ?>">
                                    <div class="d-flex justify-content-center">
                                        <i class="icofont-bag"></i>
                                        <h5><?php echo $language['Details']; ?></h5>
                                    </div>
                                </a>
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