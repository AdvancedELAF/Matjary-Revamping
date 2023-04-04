<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>

<!-- FORGOT SECTION STARTS -->
<section class="section-spacing login-bg <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="login-signup-panel">
                    <div class="ui-title text-white">
                        <h4 class="mb-3"><?php echo $language['Request for a new Password']; ?></h4>
                    </div>
                    <?php 
                        $attributes = ['name' => 'customer_reset_forgot_pass_form', 'id' => 'customer_reset_forgot_pass_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('customer/reset-forgoted-password',$attributes); 
                    ?>
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />                    
                    <div class="login-signup-wrap">
                        <div class="mb-2">
                            <label class="brand-label text-orange"><?php echo $language['Email Address']; ?> <span class="required-mark">*</span></label>
                            <input type="email" name="email" id="email" class="form-control mb-0" placeholder="<?php echo $language['Email']; ?>*"> 
                        </div>
                        <div class="row align-items-center">                            
                            <div class="col-md-6">
                                <div class="text-right mt-3">
                                    <a href="<?php echo base_url('customer/login'); ?>" class="brand-btn-white" ><?php echo $language['Cancel']; ?></a>
                                    <button type="submit" class="brand-btn-orange"><?php echo $language['Submit']; ?></button>
                                </div>
                            </div>
                        </div>
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