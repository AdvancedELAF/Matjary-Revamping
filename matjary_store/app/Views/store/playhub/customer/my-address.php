<?php 
$session = \Config\Services::session(); 
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section <?php if($locale=='ar'){echo 'text-right';} ?>>
    <div class="container-fluid">
        <div class="trans-page-title">
            <h1><?php echo $language['My Address']; ?></h1>
        </div>
    </div>
</section>

<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
        <div class="row mb-2" id="deliveryAddressWrapper">
            <?php 
            if(isset($GetCstmrAddressList) && !empty($GetCstmrAddressList)){
                foreach($GetCstmrAddressList as $customerAddressData){
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="brand-wrap mb-2">
                        <div class="my-add text-black">
                            <p><?php echo isset($customerAddressData->address) ? $customerAddressData->address : ''; ?> <?php echo isset($customerAddressData->city_name) ? $customerAddressData->city_name : ''; ?> <?php echo isset($customerAddressData->state_name) ? $customerAddressData->state_name : ''; ?> <?php echo isset($customerAddressData->zipcode) ? $customerAddressData->zipcode : ''; ?> <?php echo isset($customerAddressData->country_name) ? $customerAddressData->country_name : ''; ?></p>
                            <p class="error1"></p>
                        </div>
                        <div class="text-right">                            
                            <button class="brand-btn-orange m-1 editMyAddress" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>" data-actionurl="<?php echo base_url('customer/edit-customer-deliver-address'); ?>" data-id="<?php echo $customerAddressData->id; ?>"><?php echo $language['Edit']; ?></button>
                            <a href="javascript:void(0);" id="rempveAddress" data-baseurl="<?php echo base_url(); ?>" data-actionurl="<?php echo base_url('customer/delete-customer-deliver-address'); ?>" class="brand-btn-black m-1 removeMyAddressbtn"   data-id="<?php echo $customerAddressData->id; ?>"><i class="dw dw-delete-3"></i> <?php echo $language['Delete']; ?></a>                   
                        </div>
                    </div>
                </div>
                <?php
                }
            }
            ?>            
        </div>

        <div class="ui-title text-black">
            <h4><?php echo $language['Add a new address']; ?></h4>
        </div>

        <div class="brand-wrap" id="addEditAddressFormRow">
                <?php 
                    $attributes = ['name' => 'save_customer_deliver_address_form', 'id' => 'save_customer_deliver_address_form', 'class' => 'customer_address_form', 'autocomplete' => 'off']; 
                    echo form_open_multipart('customer/save-customer-deliver-address',$attributes); 
                ?>
                <input type="hidden" name="is_checkout_page" value="0">
                <input type="hidden" name="server_site_path" id="server_site_path" value="<?php echo base_url(); ?>">
                <input type="hidden" name="customer_id" value="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>">
                <input type="hidden" name="address_id" id="address_id" >
                <input type="hidden" name="lang" id="lang" value="<?php echo $locale; ?>">
            <div class="row">                
                <div class="col-md-12">
                    <div class="mb-2">
                        <label class="brand-label text-orange"><?php echo $language['Address']; ?></label>
                        <textarea name="address" id="address" rows="3" maxlength ="52" style="width:100%;" class="brand-input" placeholder="<?php echo $language['Enter Deliver Address']; ?>..."></textarea>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="mb-2">
                        <label class="brand-label text-orange"><?php echo $language['Country']; ?></label>                        
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

                <div class="col-md-6 col-lg-3">
                    <div class="mb-2">
                        <label class="brand-label text-orange"><?php echo $language['State']; ?></label>                        
                        <select name="state_id" id="state_id" data-actionurl="<?php echo base_url('get-state-cities'); ?>" class="brand-select">
                            <option value=""><?php echo $language['Select State']; ?></option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="mb-2">
                        <label class="brand-label text-orange"><?php echo $language['City']; ?></label>
                        <select name="city_id" id="city_id" class="brand-select">
                            <option><?php echo $language['Select City']; ?></option>
                        </select>                       
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="mb-2">
                        <label class="brand-label text-orange"><?php echo $language['Zipcode']; ?></label>
                        <input type="text" class="numberonly brand-input" name="zipcode" id="zipcode" data-error=".error1" placeholder="<?php echo $language['Enter Zipcode']; ?>.." minlength="5" maxlength="6">
                    </div>
                    <span class="error1"></span>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="brand-btn-orange m-1"><?php echo $language['Save']; ?></button>
                <button type="reset" class="brand-btn-black m-1"><?php echo $language['Reset']; ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>
<?php $this->endSection(); ?>