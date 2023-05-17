<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- CONTACT US SECTION SPACING STARTS -->
<div class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title mb-3 text-center">
            <h4><?php echo $language['Leave a Message']; ?></h4>
        </div>                             
        <div class="contact-wrapper">
            <?php 
            $attributes = ['name' => 'save_contactus_form', 'id' => 'save_contactus_form', 'autocomplete' => 'off']; 
            echo form_open_multipart('customer/save-contact-us',$attributes); 
            ?>
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <input type="text" class="form-control mb-0" placeholder="<?php echo $language['Name']; ?>*" id="name" name="name">                    
            <input type="email" class="form-control mb-0 mt-3" placeholder="<?php echo $language['Email Address']; ?>*" id="email" name="email">
            <input type="text" class="form-control mb-0 mt-3 numberonly" placeholder="<?php echo $language['Contact No.']; ?>*" id="contact_no" name="contact_no" minlength="9" maxlength="10">
            <textarea class="form-control mb-0 mt-3" rows="3" placeholder="<?php echo $language['Your Message']; ?>*" id="massage" maxlength = "500" name="massage"></textarea><br>
            <button class="btn btn-primary brand-btn btn-lg mb-0 mt-3"><?php echo $language['Send Message']; ?></button>
            <?php echo form_close(); ?>
        </div> 
    </div>
</div>
<div class="contact-map">        
    <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo isset($GetGeneralSettingInfo->address)?$GetGeneralSettingInfo->address:''; ?>&output=embed"></iframe> 
</div>
<!-- CONTACT US SECTION SPACING ENDS -->
<?php $this->endSection(); ?>