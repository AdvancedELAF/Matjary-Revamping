<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['Forgot Password']; ?>?</h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- FORGOT SECTION STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">       
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="forgot-pass-wrapper">
                    <div class="section-tagline">
                        <h6><?php echo $language['Request for a new Password']; ?></h6>
                    </div>
                    <?php 
                        $attributes = ['name' => 'customer_reset_forgot_pass_form', 'id' => 'customer_reset_forgot_pass_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('customer/reset-forgoted-password',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="email" name="email" id="email" class="form-control mb-0" placeholder="<?php echo $language['Email']; ?>*">
                    <div class="d-grid gap-2 d-md-block">
                        <a href="<?php echo base_url('customer/login'); ?>" class="btn btn-primary brand-btn" ><?php echo $language['Cancel']; ?></a>
                        <button type="submit" class="btn btn-primary brand-btn"><?php echo $language['Submit']; ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<!-- FORGOT SECTION ENDS -->
<?php $this->endSection(); ?>