<?php $this->extend('store/' . $storeActvTmplName . '/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner <?php if ($locale == 'ar') { echo 'text-right'; } ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['My Account']; ?></h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- MY ACCOUNT SECTION STARTS -->
<section class="section-spacing <?php if ($locale == 'ar') {
                                    echo 'text-right';
                                } ?>">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <a href="<?php echo base_url('customer/my-profile'); ?>">
                    <div class="my-acc-wrapper text-center">
                        <i class="icofont-ui-user"></i>
                        <h5><?php echo $language['My Profile']; ?></h5>
                    </div>
                </a>
            </div>

            <div class="col-sm-12 col-md-4">
                <a href="<?php echo base_url('customer/my-orders'); ?>">
                    <div class="my-acc-wrapper text-center">
                        <i class="icofont-tasks-alt"></i>
                        <h5><?php echo $language['My Orders']; ?></h5>
                    </div>
                </a>
            </div>

            <div class="col-sm-12 col-md-4">
                <a href="<?php echo base_url('customer/cart'); ?>">
                    <div class="my-acc-wrapper text-center">
                        <i class="icofont-cart-alt"></i>
                        <h5><?php echo $language['My Cart']; ?></h5>
                    </div>
                </a>
            </div>

            <div class="col-sm-12 col-md-4">
                <a href="<?php echo base_url('customer/my-wishlist'); ?>">
                    <div class="my-acc-wrapper text-center">
                        <i class="icofont-heart-alt"></i>
                        <h5><?php echo $language['My Wishlist']; ?></h5>
                    </div>
                </a>
            </div>

            <div class="col-sm-12 col-md-4">
                <a href="<?php echo base_url('customer/my-address'); ?>">
                    <div class="my-acc-wrapper text-center">
                        <i class="icofont-map-pins"></i>
                        <h5><?php echo $language['My Addresses']; ?> </h5>
                    </div>
                </a>
            </div>

            <div class="col-sm-12 col-md-4">
                <a href="<?php echo base_url('customer/my-refund-request'); ?>">
                    <div class="my-acc-wrapper text-center">
                        <i class="icofont-refresh"></i>
                        <h5><?php echo $language['My Refund Requests']; ?></h5>
                    </div>
                </a>
            </div>

            <div class="col-sm-12 col-md-4">
                <a href="<?php echo base_url('customer/my-gift-cards'); ?>">
                    <div class="my-acc-wrapper text-center">
                        <i class="icofont-gift"></i>
                        <h5><?php echo $language['My Giftcards']; ?></h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- MY ACCOUNT SECTION ENDS -->
<?php $this->endSection(); ?>