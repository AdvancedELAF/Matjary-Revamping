<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- FORGOT SECTION STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title mb-4 text-center">
            <h4><?php echo $language['Forgot Password']; ?></h4>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php 
                    $attributes = ['name' => 'customer_reset_forgot_pass_form', 'id' => 'customer_reset_forgot_pass_form', 'autocomplete' => 'off']; 
                    echo form_open_multipart('customer/reset-forgoted-password',$attributes); 
                ?>
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <div class="forgot-pass-wrapper">
                    <div class="text-center wrapper-title">
                        <h5><?php echo $language['Request for a new Password']; ?></h5>
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-2"><?php echo $language['Email Address']; ?> <span class="required-mark">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo $language['Email']; ?>">
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="<?php echo base_url('customer/login'); ?>" class="btn btn-primary brand-btn" ><?php echo $language['Cancel']; ?></a>
                        <button type="submit" class="btn btn-primary brand-btn"><?php echo $language['Submit']; ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
<!-- FORGOT SECTION ENDS -->
<?php $this->endSection(); ?>