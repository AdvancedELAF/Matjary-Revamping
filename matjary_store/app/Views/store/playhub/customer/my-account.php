<?php $this->extend('store/' . $storeActvTmplName . '/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section <?php if ($locale == 'ar') { echo 'text-right'; } ?>>
    <div class="container-fluid">
        <div class="ot-banner mt-3">
            <div class="container">
                <div class="page-title">
                    <h1><?php echo $language['My Account']; ?></h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- MY ACCOUNT SECTION STARTS -->
<section class="section-spacing <?php if ($locale == 'ar') { echo 'text-right'; } ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-4">
                <a href="<?php echo base_url('customer/my-profile'); ?>">
                    <div class="my-acc-wrapper text-center">
                        <div class="my-acc-icon-holder mx-auto">
                            <i class="icofont-user"></i>
                        </div>
                        <h4><?php echo $language['My Profile']; ?></h4>
                    </div>
                </a>
            </div>           

            <div class="col-sm-6 col-md-6 col-lg-4">
                <a href="<?php echo base_url('customer/my-orders'); ?>">
                    <div class="my-acc-wrapper text-center">                        
                        <div class="my-acc-icon-holder mx-auto">
                            <i class="icofont-tasks-alt"></i>
                        </div>
                        <h4><?php echo $language['My Orders']; ?></h4>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4">
                <a href="<?php echo base_url('customer/cart'); ?>">
                    <div class="my-acc-wrapper text-center">                        
                        <div class="my-acc-icon-holder mx-auto">
                            <i class="icofont-cart"></i>
                        </div>
                        <h4><?php echo $language['My Cart']; ?></h4>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4">
                <a href="<?php echo base_url('customer/my-wishlist'); ?>">
                    <div class="my-acc-wrapper text-center">                       
                        <div class="my-acc-icon-holder mx-auto">
                            <i class="icofont-heart"></i>
                        </div>
                        <h4><?php echo $language['My Wishlist']; ?></h4>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4">
                <a href="<?php echo base_url('customer/my-address'); ?>">
                    <div class="my-acc-wrapper text-center">                        
                        <div class="my-acc-icon-holder mx-auto">
                            <i class="icofont-pin"></i>
                        </div>
                        <h4><?php echo $language['My Addresses']; ?></h4>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4">
                <a href="<?php echo base_url('customer/my-refund-request'); ?>">
                    <div class="my-acc-wrapper text-center">
                        <div class="my-acc-icon-holder mx-auto">
                            <i class="icofont-refresh"></i>
                        </div>
                        <h4><?php echo $language['My Refund Requests']; ?></h4>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4">
                <a href="<?php echo base_url('customer/my-gift-cards'); ?>">
                    <div class="my-acc-wrapper text-center">
                        <div class="my-acc-icon-holder mx-auto">
                            <i class="icofont-gift"></i>
                        </div>
                        <h4><?php echo $language['My Giftcards']; ?></h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- MY ACCOUNT SECTION ENDS -->
<?php $this->endSection(); ?>