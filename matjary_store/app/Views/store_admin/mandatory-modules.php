<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?php echo $language['Mandatory Modules']; ?></h4>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mb-30">
        <?php if($is_generalsetting_modules_filled==0){ ?>
            <div class="col-md-6">
                <div class="card-box pd-20 mb-30">
                    <div class="mand-box text-center">
                        <i class="icon-copy dw dw-setting-2" style="font-size: 3rem;"></i>
                        <h4 class="text-blue h4 mt-2"><?php echo $language['General Settings']; ?></h4>
                        <div class="alert alert-warning" role="alert">
                            <strong><?php echo $language['Warning!']; ?></strong> <?php echo $language['General Setting Module Mandatory to Fill for use Store Admin Panel.']; ?>
                        </div>
                        <a href="<?php echo base_url('admin/general-settings'); ?>" class="btn btn-primary"><?php echo $language['Click here to fill']; ?></a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if($is_paymentsetting_modules_filled==0){ ?>
            <div class="col-md-6">
                <div class="card-box pd-20 mb-30">
                    <div class="mand-box text-center">
                        <i class="icon-copy dw dw-money-2" style="font-size: 3rem;"></i>
                        <h4 class="text-blue h4 mt-2"><?php echo $language['Payment Settings']; ?></h4>
                        <div class="alert alert-warning" role="alert">
                            <strong><?php echo $language['Warning!']; ?></strong> <?php echo $language['Payment Setting Module Mandatory to Fill for use Store Admin Panel.']; ?>
                        </div>
                        <a href="<?php echo base_url('admin/payment-settings'); ?>" class="btn btn-primary"><?php echo $language['Click here to fill']; ?></a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if($is_shippingsetting_modules_filled==0){ ?>
            <div class="col-md-6">
                <div class="card-box pd-20 mb-30">
                    <div class="mand-box text-center">
                        <i class="icon-copy dw dw-delivery-truck-2" style="font-size: 3rem;"></i>
                        <h4 class="text-blue h4 mt-2"><?php echo $language['Shipping Settings']; ?></h4>
                        <div class="alert alert-warning" role="alert">
                            <strong><?php echo $language['Warning!']; ?></strong> <?php echo $language['Shipping Setting Module Mandatory to Fill for use Store Admin Panel.']; ?>
                        </div>
                        <a href="<?php echo base_url('admin/shipping-settings'); ?>" class="btn btn-primary"><?php echo $language['Click here to fill']; ?></a>
                        <button class="btn btn-secondary" id="setDefaultShipStngs" data-actionurl="<?php echo base_url('admin/set-default-shipping-setting'); ?>"><?php echo $language['Proceed with Default']; ?></button>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if($is_generalsetting_modules_filled==1){ ?>
            <?php if($is_paymentsetting_modules_filled==1){ ?>
                <?php if($is_shippingsetting_modules_filled==1){ ?>
                    <div class="col-md-12 col-sm-12">
                        <div class="card-box pd-20 mb-30">
                            <div class="mand-box">
                                <p class="text-success">Congratulations! You're ready to go!</p>
                                <p class="text-success">We are delighted to inform you that you have successfully completed all the necessary modules and you can now access your store admin panel.</p>
                                <p class="text-success">You can now start adding products, product categories, brands and more to your ecommerce website. This is a great way to get your store up and running quickly.</p>
                                <p class="text-success">If you run into any issues while setting up or running your store, feel free to reach out to us at any time. We're always here to help!</p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
</div>
<?php $this->endSection(); ?>

