<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>

<!-- CONTACT US SECTION SPACING STARTS -->
<section class="section-spacing contact-bg <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-8">
                <div class="contact-wrap">
                    <div class="ui-title text-white">
                        <h4><?php echo $language['Contact Us']; ?></h4>
                    </div>
                    <?php 
                    $attributes = ['name' => 'save_contactus_form', 'id' => 'save_contactus_form', 'autocomplete' => 'off']; 
                    echo form_open_multipart('customer/save-contact-us',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <div class="mb-2">
                        <label class="brand-label text-orange"><?php echo $language['Name']; ?> <span class="required-mark">*</span></label>
                        <input type="text" class="brand-input" placeholder="<?php echo $language['Name']; ?>" id="name" name="name">
                    </div>

                    <div class="mb-2">
                        <label class="brand-label text-orange"><?php echo $language['Email Address']; ?> <span class="required-mark">*</span></label>
                        <input type="email" class="brand-input mt-3" placeholder="<?php echo $language['Email Address']; ?>" id="email" name="email">
                    </div>

                    <div class="mb-2">
                        <label class="brand-label text-orange"><?php echo $language['Contact No.']; ?> <span class="required-mark">*</span></label>
                        <input type="text" class="brand-input mt-3 numberonly" placeholder="<?php echo $language['Contact No.']; ?>" minlength="9" maxlength="10" id="contact_no" name="contact_no">
                    </div>

                    <div class="mb-2">
                        <label class="brand-label text-orange"><?php echo $language['Your Message']; ?> <span class="required-mark">*</span></label>
                        <textarea type="text" class="brand-input mt-3" placeholder="<?php echo $language['Your Message']; ?>" rows="5" id="massage" maxlength = "500" name="massage"></textarea>
                    </div>
                    <button class="brand-btn-orange btn-block"><?php echo $language['Send Message']; ?></button>
                <?php echo form_close(); ?>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="contact-wrap">
                    <div class="contact-detail">
                        <div class="ui-title text-white">
                            <h4><?php echo $language['Email Address']; ?></h4>
                        </div>
                        <p><a href="mailto:<?php echo (isset($storeSettingInfo->support_email) && !empty($storeSettingInfo->support_email)) ? $storeSettingInfo->support_email : ''; ?>"><?php echo (isset($storeSettingInfo->support_email) && !empty($storeSettingInfo->support_email)) ? $storeSettingInfo->support_email : 'webmaster@example.com'; ?></a></p>
                    </div>
                </div>
                <div class="contact-wrap">
                    <div class="contact-detail">
                        <div class="ui-title text-white">
                            <h4><?php echo $language['Contact Us']; ?></h4>
                        </div>
                        <p><a href="tel:+966 <?php echo (isset($storeSettingInfo->contact_no) && !empty($storeSettingInfo->contact_no)) ? $storeSettingInfo->contact_no : 'NA'; ?>"><?php echo (isset($storeSettingInfo->contact_no) && !empty($storeSettingInfo->contact_no)) ? $storeSettingInfo->contact_no : '123456789'; ?></a></p>
                    </div>
                </div>
                <div class="contact-wrap">
                    <div class="contact-detail">
                        <div class="ui-title text-white">
                            <h4><?php echo $language['Address']; ?></h4> 
                        </div>
                        <p><?php echo (isset($storeSettingInfo->address) && !empty($storeSettingInfo->address)) ? $storeSettingInfo->address : 'NA'; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="contact-map">        
    <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo (isset($storeSettingInfo->address) && !empty($storeSettingInfo->address)) ? $storeSettingInfo->address : ''; ?>&output=embed"></iframe> 
</div>
<!-- CONTACT US SECTION SPACING ENDS -->
<?php $this->endSection(); ?>