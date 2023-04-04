<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> <?php echo $language['Sign up']; ?> <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- SIGN UP SECTION STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
    <div class="row align-items-center">
            <div class="col-md-6">
                <div class="section-title mb-3">
                    <h3><?php echo $language['New User? Signup']; ?> <i class="icofont-star-alt-1"></i></h3>
                </div>
                <div class="ls-wrapper">
                    <?php 
                        $attributes = ['name' => 'save_customer_register_form', 'id' => 'save_customer_register_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('customer/save-customer-register',$attributes); 
                    ?>                  
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="text" name="name" id="name" class="form-control mb-0" placeholder="<?php echo $language['Enter Full Name']; ?>*">
                    <input type="text" name="contact_no" id="contact_no" minlength="9" maxlength="10" class="form-control numberonly mb-0 mt-3" placeholder="<?php echo $language['Enter Contact No']; ?>*" minlength="9" maxlength="10">
                    <input type="email" name="email" id="email" class="form-control mb-0 mt-3" placeholder="<?php echo $language['Email Address']; ?>*">
                    <input type="password" name="password" id="password" class="form-control mb-0 mt-3" placeholder="<?php echo $language['Password']; ?>*">
                    <input type="password" name="cnf_password" id="cnf_password" class="form-control mb-0 mt-3" placeholder="<?php echo $language['Confirm Password']; ?>*">
                    <!--div class="custom-control custom-checkbox newsletter-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="newsletterCheck">
                        <label class="custom-control-label" for="newsletterCheck">Subscribe Newsletter</label>
                    </div-->
                    <div class="d-grid gap-2 d-md-block mt-3 <?php if($locale=='ar'){echo 'text-right';} ?>">
                        <button type="reset" class="btn btn-primary brand-btn"><?php echo $language['Reset']; ?></button>
                        <button type="submit" class="btn btn-primary brand-btn"><?php echo $language['Sign up']; ?></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ls-banner">
                    <img src="<?php echo base_url('store/'.$storeActvTmplName.'/assets/images/signup-banner.jpg'); ?>">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SIGN UP SECTION ENDS -->
<?php $this->endSection(); ?>