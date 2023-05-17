<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['Change Password']; ?></h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- RESET PASSWORD FORM STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">        
        <div class="row">           
            <div class="col-md-12">
                <div class="rp-wrapper">  
                    <?php                     
                    $attributes = ['name' => 'update_change_password_form', 'id' => 'update_change_password_form', 'autocomplete' => 'off',]; 
                    echo form_open_multipart('customer/save-change-password',$attributes);                     
                    ?>    
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="customer_id" value="<?php echo isset($getCurId)?$getCurId:''; ?>" />              
                    <div class="row">
                        <div class="col-md-12">
                            <label><?php echo $language['Old Password']; ?></label>
                            <input type="password" class="form-control" id="oldpassword" name="oldpassword">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label><?php echo $language['New Password']; ?></label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="col-md-6">
                            <label><?php echo $language['Confirm Password']; ?></label>
                            <input type="password" class="form-control" id="cnf_password" name="cnf_password">
                        </div>
                    </div>                        
                    <button class="btn btn-primary brand-btn"><?php echo $language['Update']; ?></button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- RESET PASSWORD FORM ENDS -->
<?php $this->endSection(); ?>