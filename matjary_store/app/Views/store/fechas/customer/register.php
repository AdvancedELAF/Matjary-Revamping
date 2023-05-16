<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['Signup']; ?></h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- SIGN UP SECTION STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title text-center mb-4">
            <h2><?php echo $language['New user? sign up']; ?></h2>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
            <div class="login-signup-wrapper">
                    <?php 
                        $attributes = ['name' => 'save_customer_register_form', 'id' => 'save_customer_register_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('customer/save-customer-register',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="text" name="name" id="name" class="brand-input mb-2" placeholder="<?php echo $language['Enter Full Name']; ?>*">
                    <input type="text" name="contact_no" id="contact_no" minlength="9" maxlength="10" class="brand-input mb-2 numberonly" placeholder="<?php echo $language['Enter Contact No']; ?>*" minlength="9" maxlength="10">
                    <input type="email" name="email" id="email" class="brand-input mb-2" placeholder="<?php echo $language['Email Address']; ?>*">
                    <input type="password" name="password" id="password" class="brand-input mb-2" placeholder="<?php echo $language['Password']; ?>*">
                    <input type="password" name="cnf_password" id="cnf_password" class="brand-input mb-2" placeholder="<?php echo $language['Confirm Password']; ?>*">
                   
                    <div class="d-grid gap-2 d-md-block">
                        <button type="reset" class="g-brand-btn"><?php echo $language['Reset']; ?></button>
                        <button type="submit" class="g-brand-btn"><?php echo $language['Signup']; ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<!-- SIGN UP SECTION ENDS -->
<?php $this->endSection(); ?>