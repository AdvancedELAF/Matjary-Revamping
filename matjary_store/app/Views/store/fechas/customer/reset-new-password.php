<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['Set new Password']; ?></h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- SET NEW PASSWORD SECTION STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">     
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="forgot-pass-wrapper">
                    <div class="section-tagline">
                        <h6><?php echo $language['Set New Password']; ?></h6>
                    </div>
                    <?php if(isset($errorMsg) && !empty($errorMsg)){ ?>
                        <p class="text-center">Sorry!</p>
                        <p><?php echo $errorMsg; ?></p>
                    <?php }else{ ?>
                        <?php 
                            $attributes = ['name' => 'customer_set_new_password_form', 'id' => 'customer_set_new_password_form', 'autocomplete' => 'off']; 
                            echo form_open_multipart('customer/save-reset-password',$attributes); 
                        ?>
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <input type="hidden" name="customer_id" id="customer_id" value="<?php echo isset($customer_id)?$customer_id:''; ?>" />
                        <input type="password" name="password" id="password" class="brand-input mb-3" placeholder="<?php echo $language['Set new Password']; ?>*">
                        <input type="password" name="cnf_password" id="cnf_password" class="brand-input mb-3" placeholder="<?php echo $language['Confirm New Password']; ?>*">
                        <div class="d-grid gap-2 d-md-block">
                            <button type="reset" class="g-brand-btn"><?php echo $language['Cancel']; ?></button>
                            <button type="submit" class="g-brand-btn"><?php echo $language['Submit']; ?></button>
                        </div>
                        <?php echo form_close(); ?>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<!-- SET NEW PASSWORD SECTION ENDS -->
<?php $this->endSection(); ?>