<?php
$session = \Config\Services::session();
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="ot-banner">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['Checkout']; ?></h1>
        </div>
    </div>
</section>
<!-- CHECKOUT STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-8">
                <div class="section-title mb-3">
                    <h4><?php echo $language['Select A Payment Method']; ?></h4>
                </div>
                <div class="payment-wrapper">
                    
                    <?php
                    $attributes = ['name' => 'proceed_payment_form', 'id' => 'proceed_payment_form', 'autocomplete' => 'off'];
                    echo form_open_multipart('customer/proceed-payment', $attributes);
                    ?>
                    <input type="hidden" name="is_giftcard_purchasing" value="<?php echo isset($cartTotal['is_giftcard_purchasing']) ? $cartTotal['is_giftcard_purchasing'] : 0; ?>">
                    <input type="hidden" name="gc_id" value="<?php echo isset($cartTotal['gc_id']) ? $cartTotal['gc_id'] : 0; ?>">

                    <input type="hidden" name="is_coupon_applied" value="<?php echo isset($cartTotal['is_coupon_applied']) ? $cartTotal['is_coupon_applied'] : 0; ?>">
                    <input type="hidden" name="coupon_id" value="<?php echo isset($cartTotal['coupon_id']) ? $cartTotal['coupon_id'] : 0; ?>">
                    <input type="hidden" name="coupon_amount" value="<?php echo isset($cartTotal['coupon_amount']) ? $cartTotal['coupon_amount'] : 0; ?>">

                    <input type="hidden" name="customer_address_id" value="<?php echo isset($cartTotal['customer_address_id']) ? $cartTotal['customer_address_id'] : ''; ?>">
                    <input type="hidden" name="ship_cmp_id" value="<?php echo isset($cartTotal['ship_cmp_id']) ? $cartTotal['ship_cmp_id'] : ''; ?>">

                    <input type="hidden" name="customer_id" value="<?php echo isset($cartTotal['customer_id']) ? $cartTotal['customer_id'] : ''; ?>">
                    <input type="hidden" name="subtotal" value="<?php echo isset($cartTotal['subtotal']) ? $cartTotal['subtotal'] : ''; ?>">
                    <input type="hidden" name="total_price" value="<?php echo isset($cartTotal['total_price']) ? $cartTotal['total_price'] : ''; ?>">
                    <input type="hidden" name="locale" id="locale" value="<?php echo $locale; ?>">
                   
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input paymentMethod" type="radio" name="payment_option" id="Radios1" value="2" checked>
                                <label class="form-check-label mr-4" for="Radios1"><?php echo $language['Online Payment']; ?></label>
                            </div>
                        </div>
                        <?php if (isset($cartTotal['is_giftcard_purchasing']) && $cartTotal['is_giftcard_purchasing'] == 1) { ?>
                        <?php } else { ?>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input paymentMethod" type="radio" name="payment_option" id="Radios2" value="1">
                                <label class="form-check-label mr-4" for="Radios2"><?php echo $language['Cash On Delivery']; ?></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input paymentMethod" type="radio" name="payment_option" id="Radios3" value="3">
                                <label class="form-check-label mr-4" for="Radios3"><?php echo $language['Gift Card Payment']; ?></label>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6" id="payment_gateway_div">
                            <div class="form-group">
                                <select name="payment_gateway" id="payment_gateway" class="brand-select">
                                    <option value=""><?php echo $language['Select Payment Gateway'];?></option>
                                    <?php
                                    if (isset($availablePaymentGatewayList) && !empty($availablePaymentGatewayList)) {
                                        foreach ($availablePaymentGatewayList as $availablePaymentGatewayData) {
                                    ?>
                                        <option value="<?php echo isset($availablePaymentGatewayData->id) ? $availablePaymentGatewayData->id : ''; ?>" <?php if ($availablePaymentGatewayData->id == 1) { echo 'selected'; } ?>><?php echo isset($availablePaymentGatewayData->gateway_name) ? $availablePaymentGatewayData->gateway_name : ''; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="gift_cart_payment_div" style="display: none;">
                            <div class="form-group">
                                <div class="promo-input">
                                    <input class="form-control" name="giftcard_code" id="giftcard_code" data-error=".error1" type="text" placeholder="<?php echo $language['Enter Gift Card Code']; ?>" maxlength="13" >
                                    <button class="g-brand-btn mt-1" data-actionurl="<?php echo base_url('customer/apply-giftcard-code'); ?>" data-customerid="<?php echo isset($cartTotal['customer_id']) ? $cartTotal['customer_id'] : ''; ?>" data-totalprice="<?php echo isset($cartTotal['total_price']) ? $cartTotal['total_price'] : ''; ?>" id="applyGCCodeBtn"><?php echo $language['Apply']; ?></button>
                                </div>
                                <span id="giftcard_code_applied_span" class="text-success error1"></span>
                            </div>
                            <input type="hidden" name="is_giftcard_applied" id="is_giftcard_applied">
                            <input type="hidden" name="giftcard_id" id="giftcard_id">
                            <input type="hidden" name="giftcard_prchsed_id" id="giftcard_prchsed_id">
                            <input type="hidden" name="giftcard_amount" id="giftcard_amount">
                        </div>
                    </div>

                    <button type="submit" class="g-brand-btn" id="payBtn"><?php echo $language['Pay']; ?></button>
                    <a href="<?php echo base_url('/home'); ?>" class="brand-btn"><?php echo $language['Cancel']; ?></a>
                    <?php echo form_close(); ?>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="section-title mb-3">
                    <h4><?php echo $language['Order Summary']; ?></h4>
                </div>
                <div class="checkout-wrapper">
                    <div class="row">
                        <label class="col-6 col-form-label"><?php echo $language['Cart Amount']?>:</label>
                        <div class="col-6 text-right">
                            <p><?php echo $language['SAR']; ?> <?php echo isset($cartTotal['total_price']) ? $cartTotal['total_price'] : '0'; ?></p>
                        </div>
                    </div>
                    <?php if (isset($cartTotal['is_giftcard_purchasing']) && $cartTotal['is_giftcard_purchasing'] == 1) { ?>
                    <?php } else { ?>
                    <div class="row">
                        <label class="col-6 col-form-label"><?php echo $language['Delivery']; ?>:</label>
                        <div class="col-6 text-right">
                            <p><?php echo $language['SAR']; ?> 0</p>
                        </div>
                    </div>
                    <?php } ?>  
                    <div class="cart-value text-center">
                        <h4><?php echo $language['Total Amount']; ?> : <?php echo $language['SAR']; ?> <?php echo isset($cartTotal['total_price']) ? $cartTotal['total_price'] : '0'; ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CHECKOUT ENDS -->
<?php $this->endSection(); ?>