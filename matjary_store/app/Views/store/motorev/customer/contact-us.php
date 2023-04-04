<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['Contact Us']; ?></h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->

<!-- CONTACT US SECTION SPACING STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title text-center mb-4">
            <h2><?php echo $language['Leave a Message']; ?></h2>
        </div>

        <div class="contact-wrapper">
            <?php 
            $attributes = ['name' => 'save_contactus_form', 'id' => 'save_contactus_form', 'autocomplete' => 'off']; 
            echo form_open_multipart('customer/save-contact-us',$attributes); 
            ?>
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <input type="text" class="form-control" placeholder="<?php echo $language['Name']; ?>" id="name" name="name">
            <input type="email" class="form-control mt-3" placeholder="<?php echo $language['Email Address']; ?>" id="email" name="email">
            <input type="text" class="form-control mt-3 numberonly" placeholder="<?php echo $language['Contact No.']; ?>*" minlength="9" maxlength="10" id="contact_no" name="contact_no">
            <textarea type="text" class="form-control mt-3" placeholder="<?php echo $language['Your Message']; ?>" rows="5" id="massage" maxlength = "500" name="massage"></textarea></br>
            <button class="brand-btn mt-3"><?php echo $language['Send Message']; ?></button>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>
<div class="contact-map">        
    <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo isset($GetGeneralSettingInfo->address)?$GetGeneralSettingInfo->address:''; ?>&output=embed"></iframe> 
</div>
<!-- CONTACT US SECTION SPACING ENDS -->
<?php $this->endSection(); ?>