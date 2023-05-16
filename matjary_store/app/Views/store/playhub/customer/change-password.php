<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section <?php if($locale=='ar'){echo 'text-right';} ?>>
    <div class="container-fluid">
        <div class="trans-page-title">
            <h1><?php echo $language['Change Password']; ?></h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- RESET PASSWORD FORM STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid"> 
        <div class="brand-wrap">      
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
                                <label class="brand-label text-orange" ><?php echo $language['Old Password']; ?><span class="required-mark">*</span></label>
                                <input type="password" class="form-control" id="oldpassword" name="oldpassword">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="brand-label text-orange" ><?php echo $language['New Password']; ?><span class="required-mark">*</span></label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="col-md-6">
                                <label class="brand-label text-orange" ><?php echo $language['Confirm Password']; ?><span class="required-mark">*</span></label>
                                <input type="password" class="form-control" id="cnf_password" name="cnf_password">
                            </div>
                        </div>
                        <div class="text-center mt-2">                       
                         <button class="brand-btn-orange"><?php echo $language['Update']; ?></button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- RESET PASSWORD FORM ENDS -->
<?php $this->endSection(); ?>