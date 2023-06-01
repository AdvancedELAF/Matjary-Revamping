<?php
$session = \Config\Services::session();
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
        <div class="trans-page-title">
            <h1><?php echo $language['Checkout']; ?></h1>
        </div>
    </div>
</section>
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
        <div class="ui-title text-black">
            <h4><?php echo $language['Add A New Address']; ?></h4>
        </div>
        <div class="address-wrap" id="addEditAddressFormRow">
            <div class="container">
                 <?php
                    $attributes1 = ['name' => 'save_customer_deliver_address_form', 'id' => 'save_customer_deliver_address_form', 'class' => 'customer_address_form', 'autocomplete' => 'off'];
                    echo form_open_multipart('customer/save-customer-deliver-address', $attributes1);
                    ?>
                    <input type="hidden" name="is_checkout_page" value="1">
                    <input type="hidden" name="server_site_path" id="server_site_path" value="<?php echo base_url(); ?>">
                    <input type="hidden" name="customer_id" value="<?php echo isset($ses_custmr_id) ? $ses_custmr_id : ''; ?>">
                    <input type="hidden" name="address_id" id="address_id">
                    <input type="hidden" name="locale" id="locale" value="<?php echo $locale; ?>">

                <div class="mb-2">
                    <label class="brand-label text-orange"><?php echo $language['Address']; ?></label>
                    <textarea name="address" id="address" maxlength="52" rows="5" style="width:100%;" class="brand-input" placeholder="<?php echo $language['Enter Deliver Address']; ?>..."></textarea>
                       
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <label class="brand-label text-orange"><?php echo $language['Country']; ?></label>
                        <select name="country_id" id="country_id" data-actionurl="<?php echo base_url('get-country-states'); ?>" class="brand-select">
                        <option value=""><?php echo $language['Select Country']; ?></option>
                                <?php
                                if (isset($countryList) && !empty($countryList)) {
                                    foreach ($countryList as $countryData) {
                                ?>
                                        <option value="<?php echo isset($countryData->id) ? $countryData->id : ''; ?>"><?php echo isset($countryData->name) ? $countryData->name : ''; ?></option>
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
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <label class="brand-label text-orange"><?php echo $language['City']; ?></label>
                        <select name="city_id" id="city_id" class="brand-select">
                         <option value=""><?php echo $language['Select City']; ?></option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <label class="brand-label text-orange"><?php echo $language['Zipcode']; ?></label>
                        <input type="text"  class="numberonly brand-input"  name="zipcode" id="zipcode" placeholder="<?php echo $language['Enter Zipcode']; ?>." data-error=".error1" minlength="5" maxlength="6">
                        <span class="error1"></span>
                    </div>                        
                </div>
                <div class="text-right mt-3">
                    <button type="submit" class="brand-btn-orange" id="saveUpdateBtn"><?php echo $language['Save']; ?></button>
                    <button type="reset" class="brand-btn-black" id="resetMyAddressFormBtn"><?php echo $language['Reset']; ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

        <?php
        $attributes = ['name' => 'proceed_checkout_form', 'id' => 'proceed_checkout_form', 'autocomplete' => 'off'];
        echo form_open_multipart('customer/proceed-checkout', $attributes);
        ?>
        <input type="hidden" name="is_coupon_applied" value="<?php echo isset($cartTotal['is_coupon_applied']) ? $cartTotal['is_coupon_applied'] : 0; ?>">
        <input type="hidden" name="coupon_id" value="<?php echo isset($cartTotal['coupon_id']) ? $cartTotal['coupon_id'] : 0; ?>">
        <input type="hidden" name="coupon_amount" value="<?php echo isset($cartTotal['coupon_amount']) ? $cartTotal['coupon_amount'] : 0; ?>">

        <input type="hidden" name="customer_id" value="<?php echo $ses_custmr_id; ?>">
        <input type="hidden" name="subtotal" value="<?php echo isset($_POST['subtotal']) ? $_POST['subtotal'] : ''; ?>">
        <input type="hidden" name="total_price" value="<?php echo isset($_POST['total_price']) ? $_POST['total_price'] : ''; ?>">
        <input type="hidden" name="lang" id="lang" value="<?php echo $locale; ?>">
        <div class="row">
            <div class="col-md-6 col-lg-7">

                <div class="ui-title text-black">
                    <h4><?php echo $language['Select A Delivery Address']; ?></h4>
                </div>
                <span id="deliveryAddressWrapper">
                    <?php
                    if (isset($customerAddressList) && !empty($customerAddressList)) {
                        $tmp = [];
                        $i = 0;
                        foreach ($customerAddressList as $values) {
                            $tmp[$i] = $values->id;
                            $i++;
                        }
                        $lastAddrId = (max($tmp));
                        foreach ($customerAddressList as $customerAddressData) {

                ?>
                <div class="select-add-wrapper">
                    <p class="text-black"><?php echo isset($customerAddressData->address) ? $customerAddressData->address : ''; ?> <?php echo isset($customerAddressData->city_name) ? $customerAddressData->city_name : ''; ?> <?php echo isset($customerAddressData->state_name) ? $customerAddressData->state_name : ''; ?> <?php echo isset($customerAddressData->zipcode) ? $customerAddressData->zipcode : ''; ?> <?php echo isset($customerAddressData->country_name) ? $customerAddressData->country_name : ''; ?></p>

                    <div class="form-check">
                        
                        <a href="javascript:void(0);"><input type="radio" name="customer_address_id" class="form-check-input cstmrAddrId" value="<?php echo $customerAddressData->id; ?>" data-error=".error1" <?php if ($lastAddrId == $customerAddressData->id) { echo 'checked'; } ?>> <?php echo $language['Deliver to this Address']; ?></a>
                    </div>
                    <p class="error1"></p>
                    <div class="mt-2 text-right">
                        <a href="javascript:void(0);" class="brand-btn-orange editMyAddress" data-customerid="<?php echo isset($ses_custmr_id) ? $ses_custmr_id : ''; ?>" data-actionurl="<?php echo base_url('customer/edit-customer-deliver-address'); ?>" data-id="<?php echo $customerAddressData->id; ?>" data-lang="<?php echo $locale; ?>"><?php echo $language['Edit']; ?></a>
                        <a href="javascript:void(0);" class="brand-btn-black removeMyAddressbtn" id="rempveAddress" data-actionurl="<?php echo base_url('customer/delete-customer-deliver-address'); ?>" data-id="<?php echo $customerAddressData->id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i> <?php echo $language['Delete']; ?></a>
                        
                    </div>
                </div>
                <?php
                        }
                    }else{
                    ?>
                        <div class="select-add-wrapper">
                            <h6 class="delivery-name"><?php echo $language['No Delivery Address Available']; ?>.</h6>
                        </div>
                    <?php
                    }
                    ?>
                </span>
            </div>

            <div class="col-md-6 col-lg-5">
                <div class="ui-title text-black">
                    <h4><?php echo $language['Choose A Shipping Company']; ?></h4>
                </div>

                <div class="shipping-wrap">
                    <label class="brand-label text-orange"><?php echo $language['Shipping Company List']; ?></label>                    
                    <select name="ship_cmp_id" id="ship_cmp_id" class="brand-select">
                        <option value=""><?php echo $language['Select Company']; ?></option>
                        <?php
                        if (isset($shippingCompanies) && !empty($shippingCompanies)) {
                            foreach ($shippingCompanies as $shipCmpData) {
                        ?>
                            <option value="<?php echo isset($shipCmpData->id) ? $shipCmpData->id : ''; ?>" <?php if ($shipCmpData->id == 1) { echo 'selected'; } ?>><?php echo isset($shipCmpData->name) ? $shipCmpData->name : ''; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <div class="text-right mt-3">
                        <button class="brand-btn-black" id="proceed_checkout_btn"><?php echo $language['Submit']; ?></button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection(); ?>