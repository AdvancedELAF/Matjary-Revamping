<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner-bg <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i><?php echo $language['Log in']; ?> <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- LOGIN SECTION STARTS -->
<section class="section-spacing">
    <div class="container">
        <div class="section-title text-center mb-3"><h4><?php echo $language['Already a User? Log in']; ?>!</h4></div>
        <div class="row align-items-center"> 
            <div class="col-md-6">
                <div class="section-title mb-3">
                    <div class="ls-wrapper <?php if($locale=='ar'){echo 'text-right';} ?>">
                        <?php 
                            $attributes = ['name' => 'customer_login_form', 'id' => 'customer_login_form', 'autocomplete' => 'off']; 
                            echo form_open_multipart('customer/customer-login',$attributes); 
                        ?>
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <input type="email" name="email" id="email" class="form-control mb-0" placeholder="<?php echo $language['Email']; ?>*">
                        <input type="password" name="password" id="password" class="form-control  mb-0 mt-3" placeholder="<?php echo $language['Password']; ?>*">
                        <div class="d-grid gap-2 d-md-block mt-3">                      
                            <button type="reset" class="btn btn-primary brand-btn"><?php echo $language['Reset']; ?></button>
                            <button type="submit" class="btn btn-primary brand-btn"><?php echo $language['Login']; ?></button>
                        </div>
                        <div class="loginSignupLink">
                            <a href="<?php echo base_url('customer/forgot-password'); ?>"><h5><?php echo $language['Forgot Password']; ?>?</h5></a>
                            <a href="<?php echo base_url('customer/register'); ?>"><h5><?php echo $language['New User? Signup']; ?></h5></a>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ls-banner">
                    <img src="<?php echo base_url('store/'.$storeActvTmplName.'/assets/images/login-banner.jpg'); ?>">
                </div>
            </div>
        </div>          
    </div>
</section>
<!-- LOGIN SECTION ENDS -->
<?php $this->endSection(); ?>