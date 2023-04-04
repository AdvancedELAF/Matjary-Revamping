<?php 
$session = \Config\Services::session(); 
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section>
    <div class="container-fluid">
        <div class="trans-page-title">
            <h1><?php echo $language['My Profile']; ?></h1>
        </div>
    </div>
</section>

<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
        <?php   
            $attributes = ['name' => 'update_my_profile_form', 'id' => 'update_my_profile_form', 'autocomplete' => 'off',]; 
            echo form_open_multipart('customer/update-my-profile',$attributes);                     
            ?> 
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <input type="hidden" name="profile_id" value="<?php echo isset($customerDetails->id)?$customerDetails->id:''; ?>" />
            <input type="hidden" name="profile_image" value="<?php echo isset($customerDetails->profile_image)?$customerDetails->profile_image:''; ?>" />
                
            <div class="brand-wrap">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="mb-2">
                            <label class="brand-label text-orange"><?php echo $language['Name']; ?></label>
                            <input type="text" class="brand-input" id="name" name="name" value="<?php echo isset($customerDetails->name)?$customerDetails->name:''; ?>">
                        </div>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <div class="mb-2">
                            <label class="brand-label text-orange"><?php echo $language['Profile Picture']; ?></label>
                            <input type="file" name="profile_image" id="profile_image" class="brand-input" >
                        </div>
                    </div>

                    <div class="col-md-3 col-lg-2">
                        <div class="profile-image mb-3">
                            <?php if(isset($customerDetails->profile_image) && !empty($customerDetails->profile_image)){ ?>
                                <img src="<?php echo base_url('/uploads/customer_profile_picture/'); ?>/<?php echo isset($customerDetails->profile_image)?$customerDetails->profile_image:''; ?>" class="img img-responsive"  style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;">                                                            
                                <?php }else{ ?>
                                <img src="<?php echo base_url('store_admin/assets/images/profile_default_image.png'); ?>" class="img img-responsive"  style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;">
                            <?php } ?> 
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="brand-label text-orange"><?php echo $language['Email Address']; ?></label>
                            <input type="text" readonly class="form-control-plaintext b-none brand-input" value="<?php echo isset($customerDetails->email)?$customerDetails->email:''; ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="brand-label text-orange"><?php echo $language['Contact No.']; ?></label>
                            <input type="text" class="brand-input numberonly"  id="contact_no" name="contact_no" value="<?php echo isset($customerDetails->contact_no)?$customerDetails->contact_no:''; ?>" minlength="9" maxlength="10">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="brand-label text-orange"><?php echo $language['Address']; ?></label>
                        <textarea name="address" id="address" rows="2" maxlength ="52" class="brand-input" placeholder="<?php echo $language['Enter Address']; ?>..."><?php echo isset($customerDetails->address)?$customerDetails->address:''; ?></textarea>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <label class="brand-label text-orange"><?php echo $language['Country']; ?></label>
                        <select name="country_id" id="country_id" data-actionurl="<?php echo base_url('get-country-states'); ?>" class="brand-select">
                            <option value=""><?php echo $language['Select Country']; ?></option>
                            <?php 
                            if(isset($countryList) && !empty($countryList)){
                                foreach($countryList as $countryData){
                                    $selected = "";
                                    if(isset($customerDetails->country_id) && !empty($customerDetails->country_id)){
                                        if($countryData->id==$customerDetails->country_id){
                                            $selected = "selected";
                                        }
                                    }
                            ?>
                            <option value="<?php echo isset($countryData->id)?$countryData->id:''; ?>" <?php echo $selected; ?>><?php echo isset($countryData->name)?$countryData->name:''; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <label class="brand-label text-orange"><?php echo $language['State']; ?></label>                    
                        <select name="state_id" id="state_id" data-actionurl="<?php echo base_url('get-state-cities'); ?>" class="brand-select">
                            <option value=""><?php echo $language['Select State']; ?></option>
                            <?php 
                            if(isset($stateList) && !empty($stateList)){
                                foreach($stateList as $stateData){
                                    $selected = "";
                                    if(isset($customerDetails->state_id) && !empty($customerDetails->state_id)){
                                        if($stateData->id==$customerDetails->state_id){
                                            $selected = "selected";
                                        }
                                    }
                            ?>
                            <option value="<?php echo isset($stateData->id)?$stateData->id:''; ?>" <?php echo $selected; ?>><?php echo isset($stateData->name)?$stateData->name:''; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <label class="brand-label text-orange"><?php echo $language['City']; ?></label>                   
                        <select name="city_id" id="city_id" class="brand-select">
                            <option value=""><?php echo $language['Select City']; ?></option>
                            <?php 
                            if(isset($cityList) && !empty($cityList)){
                                foreach($cityList as $cityData){
                                    $selected = "";
                                    if(isset($customerDetails->city_id) && !empty($customerDetails->city_id)){
                                        if($cityData->id==$customerDetails->city_id){
                                            $selected = "selected";
                                        }
                                    }
                            ?>
                            <option value="<?php echo isset($cityData->id)?$cityData->id:''; ?>" <?php echo $selected; ?>><?php echo isset($cityData->name)?$cityData->name:''; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="mb-2">
                            <label class="brand-label text-orange"><?php echo $language['Zipcode']; ?></label>
                            <input type="text" name="zipcode" id="zipcode" class="brand-input mb-0 numberonly" value="<?php echo isset($customerDetails->zipcode)?$customerDetails->zipcode:''; ?>" placeholder="<?php echo $language['Enter Zipcode']; ?>." minlength="5" maxlength="6" >
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button class="brand-btn-orange"><?php echo $language['Save']; ?></button>
                <a href="<?php echo base_url('customer/change-password'); ?>" class="brand-btn-black"><?php echo $language['Change Password']; ?></a>
                <a href="<?php echo base_url('customer/my-account'); ?>" class="brand-btn-orange"><?php echo $language['Cancel']; ?></a>
            </div>
         
    </div>
</section>
<?php $this->endSection(); ?>