<?php
$session = \Config\Services::session();
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> <?php echo $language['Shipping Address']; ?> <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>
<!-- CHECKOUT STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title mb-3">
            <h2 id="address_heading"><?php echo $language['Add A New Address']; ?> <i class="icofont-star-alt-1"></i></h2>
        </div>
        <div class="row" id="addEditAddressFormRow">
            <div class="col-md-12">
                <div class="checkout-wrapper">
                    <?php
                    $attributes1 = ['name' => 'save_customer_deliver_address_form', 'id' => 'save_customer_deliver_address_form', 'class' => 'customer_address_form', 'autocomplete' => 'off'];
                    echo form_open_multipart('customer/save-customer-deliver-address', $attributes1);
                    ?>
                    <input type="hidden" name="is_checkout_page" value="1">
                    <input type="hidden" name="server_site_path" id="server_site_path" value="<?php echo base_url(); ?>">
                    <input type="hidden" name="customer_id" value="<?php echo isset($ses_custmr_id) ? $ses_custmr_id : ''; ?>">
                    <input type="hidden" name="address_id" id="address_id">
                    <input type="hidden" name="locale" id="locale" value="<?php echo $locale; ?>">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-12 col-form-label"><?php echo $language['Address']; ?></label>
                        <div class="col-sm-12 col-md-12">
                            <textarea name="address" id="address" maxlength="52" rows="2" style="width:100%;" class="form-control" placeholder="<?php echo $language['Enter Deliver Address']; ?>..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-12 col-form-label"><?php echo $language['Country']; ?></label>
                                <div class="col-sm-12 col-md-12">
                                    <select name="country_id" id="country_id" data-actionurl="<?php echo base_url('get-country-states'); ?>" class="form-control">
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
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-12 col-form-label"><?php echo $language['State']; ?></label>
                                <div class="col-sm-12 col-md-12">
                                    <select name="state_id" id="state_id" data-actionurl="<?php echo base_url('get-state-cities'); ?>" class="form-control">
                                        <option value=""><?php echo $language['Select State']; ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-12 col-form-label"><?php echo $language['City']; ?></label>
                                <div class="col-sm-12 col-md-12">
                                    <select name="city_id" id="city_id" class="form-control">
                                        <option value=""><?php echo $language['Select City']; ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-12 col-form-label"><?php echo $language['Zipcode']; ?></label>
                                <div class="col-sm-12 col-md-12">
                                    <input type="text"  class="numberonly form-control"  name="zipcode" id="zipcode" placeholder="<?php echo $language['Enter Zipcode']; ?>." data-error=".error1" minlength="5" maxlength="6">
                                </div>
                                <span class="error1"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm brand-btn" id="saveUpdateBtn"><?php echo $language['Save']; ?></button>
                    <button type="reset" class="btn btn-secondary btn-sm brand-btn" id="resetMyAddressFormBtn"><?php echo $language['Reset']; ?></button>
                    <?php echo form_close(); ?>
                </div>
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
            <div class="col-md-6 col-lg-7" >
                <div class="section-title mb-3">
                    <h2><?php echo $language['Select A Delivery Address']; ?> <i class="icofont-star-alt-1"></i></h2>
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
                    <div class="checkout-wrapper">
                        <!-- <h6 class="delivery-name">Address Type</h6> -->
                        <p class="delivery-address"><?php echo isset($customerAddressData->address) ? $customerAddressData->address : ''; ?> <?php echo isset($customerAddressData->city_name) ? $customerAddressData->city_name : ''; ?> <?php echo isset($customerAddressData->state_name) ? $customerAddressData->state_name : ''; ?> <?php echo isset($customerAddressData->zipcode) ? $customerAddressData->zipcode : ''; ?> <?php echo isset($customerAddressData->country_name) ? $customerAddressData->country_name : ''; ?></p>
                        <div class="deliver-add-btn">
                            <a href="javascript:void(0);"><input type="radio" name="customer_address_id" class="cstmrAddrId" value="<?php echo $customerAddressData->id; ?>" data-error=".error1" <?php if ($lastAddrId == $customerAddressData->id) { echo 'checked'; } ?>> <?php echo $language['Deliver To This Address']; ?></a>
                        </div>
                        <p class="error1"></p>
                        <a href="javascript:void(0);" class="btn btn-secondary btn-sm brand-btn editMyAddress" data-customerid="<?php echo isset($ses_custmr_id) ? $ses_custmr_id : ''; ?>" data-actionurl="<?php echo base_url('customer/edit-customer-deliver-address'); ?>" data-id="<?php echo $customerAddressData->id; ?>" data-lang="<?php echo $locale; ?>" ><?php echo $language['Edit']; ?></a>
                        <a href="javascript:void(0);" class="btn btn-secondary btn-sm brand-btn removeMyAddressbtn" id="rempveAddress" data-actionurl="<?php echo base_url('customer/delete-customer-deliver-address'); ?>" data-id="<?php echo $customerAddressData->id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i> <?php echo $language['Delete']; ?></a>
                    </div>
                <?php
                    }
                }else{
                ?>
                <div class="checkout-wrapper">
                    <h6 class="delivery-name"><?php echo $language['No Delivery Address Available']; ?>.</h6>
                </div>
                <?php
                }
                ?>
                </span>
            </div>
            <div class="col-md-6 col-lg-5">
                <div class="section-title mb-3">
                    <h2><?php echo $language['Choose A Shipping Company']; ?> <i class="icofont-star-alt-1"></i></h2>
                </div>
                <div class="ship-comp">
                    <label><?php echo $language['Shipping Company List']; ?></label>
                    <select name="ship_cmp_id" id="ship_cmp_id" class="custom-select">
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
                    <div class="text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-2">
                        <button class="btn btn-primary btn-sm brand-btn btn-block" id="proceed_checkout_btn"><?php echo $language['Submit']; ?></button>
                        
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<!-- CHECKOUT ENDS -->
<?php $this->endSection(); ?>