<?php 
$session = \Config\Services::session(); 
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['My Address']; ?></h1>
        </div>
    </div>
</section>
<!-- CONTACT US SECTION SPACING STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="row" id="deliveryAddressWrapper">
            <?php 
            if(isset($GetCstmrAddressList) && !empty($GetCstmrAddressList)){
                foreach($GetCstmrAddressList as $customerAddressData){
            ?>
            <div class="col-md-4" >
                <div class="checkout-wrapper mb-3">
                    <!-- <h6 class="delivery-name">Address Type</h6> -->
                    <p class="delivery-address"><?php echo isset($customerAddressData->address) ? $customerAddressData->address : ''; ?> <?php echo isset($customerAddressData->city_name) ? $customerAddressData->city_name : ''; ?> <?php echo isset($customerAddressData->state_name) ? $customerAddressData->state_name : ''; ?> <?php echo isset($customerAddressData->zipcode) ? $customerAddressData->zipcode : ''; ?> <?php echo isset($customerAddressData->country_name) ? $customerAddressData->country_name : ''; ?></p>
                    <p class="error1"></p>
                    <button class="g-brand-btn editMyAddress" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>" data-actionurl="<?php echo base_url('customer/edit-customer-deliver-address'); ?>" data-id="<?php echo $customerAddressData->id; ?>"><?php echo $language['Edit']; ?></button>
                    <a href="javascript:void(0);" id="rempveAddress" data-baseurl="<?php echo base_url(); ?>" data-actionurl="<?php echo base_url('customer/delete-customer-deliver-address'); ?>" class="brand-btn removeMyAddressbtn"   data-id="<?php echo $customerAddressData->id; ?>"><i class="dw dw-delete-3"></i> <?php echo $language['Delete']; ?></a>                   
                </div>
            </div>   
            <?php
                }
            }
            ?>
        </div>
        <div class="section-title mb-3">
            <h4 id="address_heading"><?php echo $language['Add a new address']; ?></h4>
        </div>
        <div class="address-wrapper">
        <div class="row" id="addEditAddressFormRow">
            <div class="col-md-12">
                <div class="mb-2">
                    <?php 
                        $attributes = ['name' => 'save_customer_deliver_address_form', 'id' => 'save_customer_deliver_address_form', 'class' => 'customer_address_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('customer/save-customer-deliver-address',$attributes); 
                    ?>
                    <input type="hidden" name="is_checkout_page" value="0">
                    <input type="hidden" name="server_site_path" id="server_site_path" value="<?php echo base_url(); ?>">
                    <input type="hidden" name="customer_id" value="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>">
                    <input type="hidden" name="address_id" id="address_id" >
                    <input type="hidden" name="lang" id="lang" value="<?php echo $locale; ?>">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-12 col-form-label"><?php echo $language['Address']; ?></label>
                        <div class="col-sm-12 col-md-12">
                            <textarea name="address" id="address" rows="2" maxlength ="52" style="width:100%;" class="brand-textarea" placeholder="<?php echo $language['Enter Deliver Address']; ?>..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-12 col-form-label"><?php echo $language['Country']; ?></label>
                                <div class="col-sm-12 col-md-12">
                                    <select name="country_id" id="country_id" data-actionurl="<?php echo base_url('get-country-states'); ?>" class="brand-select">
                                        <option value=""><?php echo $language['Select Country']; ?></option>
                                        <?php 
                                        if(isset($countryList) && !empty($countryList)){
                                            foreach($countryList as $countryData){
                                        ?>
                                        <option value="<?php echo isset($countryData->id)?$countryData->id:''; ?>"><?php echo isset($countryData->name)?$countryData->name:''; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-12 col-form-label"><?php echo $language['State']; ?></label>
                                <div class="col-sm-12 col-md-12">
                                    <select name="state_id" id="state_id" data-actionurl="<?php echo base_url('get-state-cities'); ?>" class="brand-select">
                                        <option value=""><?php echo $language['Select State']; ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-12 col-form-label"><?php echo $language['City']; ?></label>
                                <div class="col-sm-12 col-md-12">
                                    <select name="city_id" id="city_id" class="brand-select">
                                        <option value=""><?php echo $language['Select City']; ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-12 col-form-label"><?php echo $language['Zipcode']; ?></label>
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" class="numberonly brand-input" name="zipcode" id="zipcode" data-error=".error1" placeholder="<?php echo $language['Enter Zipcode']; ?>.." minlength="5" maxlength="6">
                                </div>
                                <span class="error1"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="g-brand-btn" id="saveUpdateBtn"><?php echo $language['Save']; ?></button>
                    <button type="reset" class="brand-btn" id="resetMyAddressFormBtn"><?php echo $language['Reset']; ?></button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div> 
        </div>
    </div>
</section>
<!-- CONTACT US SECTION SPACING ENDS -->
<?php $this->endSection(); ?>