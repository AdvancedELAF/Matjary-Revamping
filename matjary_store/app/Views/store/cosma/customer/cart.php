<?php
$session = \Config\Services::session();
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store/' . $storeActvTmplName . '/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<?php if (isset($customerCartData) && !empty($customerCartData)) { ?>
    <!-- CART TABLE STARTS -->
    <?php
    $attributes = ['name' => 'proceed_cart_form', 'id' => 'proceed_cart_form', 'autocomplete' => 'off'];
    echo form_open_multipart('customer/proceed-cart', $attributes);
    ?>
    <section class="section-spacing <?php if ($locale == 'ar') { echo 'text-right';} ?>">
        <div class="container">
            <div class="product-cart-count">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="cart-table-title" scope="col"><input type="checkbox" name="chk_all_cart_items" id="chk_all_cart_items"></th>
                                <th class="cart-table-title" scope="col">#</th>
                                <th class="cart-table-title" scope="col"><?php echo $language['Product Name']; ?></th>
                                <th class="cart-table-title" scope="col"><?php echo $language['Quantity']; ?></th>
                                <th class="cart-table-title" scope="col"><?php echo $language['Price']; ?></th>
                                <th class="cart-table-title" scope="col"><?php echo $language['Tax Included']; ?></th>
                                <th class="cart-table-title" scope="col"><?php echo $language['Option']; ?></th>
                            </tr>
                        </thead>
                        <tbody id="cartItemsTbody">
                            <?php
                            $cartItemChekedTrue = false;
                            if (isset($customerCartData) && !empty($customerCartData)) {
                                $i = 1;
                                $index = 0;
                                foreach ($customerCartData as $customerCartValues) {
                                    $productId = isset($customerCartValues->id) ? $customerCartValues->id : '';
                                    $product_price = isset($customerCartValues->product_price) ? number_format((float)$customerCartValues->product_price, 2, '.', '') : '';
                                    $sales_tax = isset($customerCartValues->sales_tax) ? number_format((float)$customerCartValues->sales_tax, 2, '.', '') : '';
                                    $product_weight = isset($customerCartValues->weight) ? number_format((float)$customerCartValues->weight, 2, '.', '') : '';
                                    
                                    $cartItemCheked = '';
                                    $cartBuyItem = $session->get('cartBuyItem');
                                    if (isset($cartBuyItem) && !empty($cartBuyItem)) {
                                        if (isset($cartBuyItem['productid']) && !empty($cartBuyItem['productid'])) {
                                            if ($cartBuyItem['productid'] == $productId) {
                                                $cartItemCheked = 'checked';
                                                $cartItemChekedTrue = true;
                                            }
                                        }
                                    }
                            ?>
                                    <tr class="cartItemsTr">
                                        <th>
                                            <?php if ($customerCartValues->stock_quantity == 0) { ?>
                                                <!-- <span class="text-danger">Out of Stock</span> -->
                                            <?php } else { ?>
                                                <input type="checkbox" name="index[]" value="<?php echo $index; ?>" class="cartItem" data-productid="<?php echo $productId; ?>" <?php echo $cartItemCheked; ?>>
                                            <?php } ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $i; ?>
                                            <input type="hidden" name="product_id[]" value="<?php echo $productId; ?>">
                                        </th>
                                        <td>
                                            <div class="cart-prod-title">
                                                <h6>
                                                    <?php echo $ses_lang == 'en' ? $customerCartValues->title : $customerCartValues->title_ar;  ?>
                                                    <?php if ($customerCartValues->stock_quantity == 0) { ?>
                                                        <span class="text-danger">(<?php echo $language['Out of Stock']; ?>)</span>
                                                    <?php } ?>
                                                </h6>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="product_qty[]" id="product_qty_<?php echo $productId; ?>" data-productid="<?php echo $productId; ?>" data-actionurl="<?php echo base_url('single-product-details'); ?>" class="product_qty numberonly" value="1" maxlength="3">
                                        </td>
                                        <td>
                                            <div class="cart-price">
                                                <h5><?php echo $language['SAR']; ?> <span id="product_price_<?php echo $productId; ?>_span"><?php echo $product_price; ?></span></h5>
                                                <input type="hidden" id="product_price_<?php echo $productId; ?>" value="<?php echo $product_price; ?>">
                                                <input type="hidden" name="product_price[]" id="new_product_price_<?php echo $productId; ?>" class="product_price" value="<?php echo $product_price; ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="cart-tax"><span id="sales_tax_<?php echo $productId; ?>_span"><?php echo $sales_tax; ?></span></h5>
                                            <input type="hidden" id="sales_tax_<?php echo $productId; ?>" value="<?php echo $sales_tax; ?>">
                                            <input type="hidden" name="sales_tax[]" id="new_sales_tax_<?php echo $productId; ?>" class="sales_tax" value="<?php echo $sales_tax; ?>">

                                            <input type="hidden" id="product_weight_<?php echo $productId; ?>" value="<?php echo isset($customerCartValues->weight) ? $customerCartValues->weight : ''; ?>">
                                            <input type="hidden" name="product_weight[]" id="new_product_weight_<?php echo $productId; ?>" class="product_weight" value="<?php echo isset($customerCartValues->weight) ? $customerCartValues->weight : ''; ?>">

                                        </td>
                                        <td><a href="javascript:void(0);" id="rempveSnglProdFromCart" data-baseurl="<?php echo base_url(); ?>" data-actionurl="<?php echo base_url('customer/remove-product-cart'); ?>" data-customerid="<?php echo $ses_custmr_id; ?>" data-productid="<?php echo $productId; ?>"><i class="icofont-trash text-danger"></i></a></td>
                                    </tr>
                            <?php
                                    $i++;
                                    $index++;
                                }
                            }
                            ?>                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="cart-action-buttons">
                <div class="d-grid gap-2 d-md-block ms-auto">
                    <a href="javascript:void(0);" class="btn btn-primary brand-btn-black-outline" id="emptyCart" data-actionurl="<?php echo base_url('customer/empty-cart'); ?>" data-customerid="<?php echo $ses_custmr_id; ?>"><?php echo $language['Empty Cart']; ?></a>
                    <a href="<?php echo base_url('product/products'); ?>" class="btn btn-primary brand-btn-black" type="button"><?php echo $language['Continue Shopping']; ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="section-spacing <?php if ($locale == 'ar') {
                                        echo 'text-right';
                                    } ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="section-title">
                        <h4><?php echo $language['Cart total']; ?></h4>
                    </div>
                    <div class="cart-total-wrapper">
                        <div class="table-responsive">
                            <table class="table">
                                <table class="table">
                                    <tbody>
                                <input type="hidden" name="tax" id="tax" value="<?php if($cartItemChekedTrue==true){ echo isset($cartTotal['taxtotal'])?number_format((float)$cartTotal['taxtotal'], 2, '.', ''):0.00; }else{echo '0.00';} ?>">
                                <input type="hidden" name="customerid" id="customerid" value="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>">
                                        <tr>
                                            <td class="cart-structure-name"><?php echo $language['Subtotal']; ?></td>
                                            <td>
                                                <div class="cart-price">
                                                    <h5><?php echo $language['SAR']; ?> <span id="subtotal_span">
                                                        <?php if ($cartItemChekedTrue == true) {
                                                                echo isset($cartTotal['subtotal']) ? number_format((float)$cartTotal['subtotal'], 2, '.', '') : 0.00;
                                                            } else {
                                                                echo '0.00';
                                                            } ?></span></h5>
                                                </div>
                                            </td>
                                            <input type="hidden" name="subtotal" id="subtotal" value="<?php if ($cartItemChekedTrue == true) {
                                                                echo isset($cartTotal['subtotal']) ? number_format((float)$cartTotal['subtotal'], 2, '.', '') : 0.00;
                                                            } else {
                                                                echo '0.00';
                                                            } ?>">
                                        </tr>
                                        <tr id="coupon_applied_tr" style="display: none;">
                                            <td class="cart-structure-name"><?php echo $language['Promotion Applied']; ?></td>
                                            <td>
                                                <div class="cart-price">
                                                    <h5><?php echo $language['SAR']; ?> <span id="promotion_applied_amount_span"></span></h5>
                                                </div>
                                            </td>
					                        <input type="hidden" name="discount_type" id="discount_type" value="">
                                            <input type="hidden" name="discount_value" id="discount_value" value="">
                                       
                                            <input type="hidden" name="is_coupon_applied" id="is_coupon_applied">
                                            <input type="hidden" name="coupon_id" id="coupon_id">
                                            <input type="hidden" name="coupon_amount" id="coupon_amount">
                                        </tr>
                                        <tr>
                                            <td class="cart-structure-name"><?php echo $language['Grand/Order Total']; ?></td>
                                            <td>
                                                <div class="cart-price">
                                                    <h5><?php echo $language['SAR']; ?> <span id="total_price_span"><?php if ($cartItemChekedTrue == true) {
                                                                                                                        echo isset($cartTotal['total_price']) ? number_format((float)$cartTotal['total_price'], 2, '.', '') : 0.00;
                                                                                                                    } else {
                                                                                                                        echo '0.00';
                                                                                                                    } ?></span></h5>
                                                </div>
                                            </td>
                                            <input type="hidden" name="total_price" id="total_price" value="<?php if ($cartItemChekedTrue == true) {
                                                                                                                echo isset($cartTotal['total_price']) ? number_format((float)$cartTotal['total_price'], 2, '.', '') : 0.00;
                                                                                                            } else {
                                                                                                                echo '0.00';
                                                                                                            } ?>">
                                        </tr>
                                    </tbody>
                                </table>
                            </table>
                        </div>
                    </div>
                    <div class="checkout-btn">
                        <button type="submit" class="btn btn-primary brand-btn-black" id="proceedToCheckoutBtn"><?php echo $language['Proceed to checkout']; ?></button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="promo-wrapper">
                        <div class="section-title mb-4">
                            <h4><?php echo $language['Promo coupon code']; ?></h4>
                        </div>
                        <div class="promo-input">
                            <input class="form-control" type="text" name="coupon_code" id="coupon_code" placeholder="<?php echo $language['Enter Promo Code']; ?>">
                            <a href="javascript:void(0);" class="btn btn-primary brand-btn-black" id="couponCodeApplyBtn" data-customerid="<?php echo isset($ses_custmr_id) ? $ses_custmr_id : ''; ?>" data-actionurl="<?php echo base_url('customer/applied-coupon-code'); ?>"><?php echo $language['Apply']; ?></a>
                        </div>
                        <p id="couponCodeMsg"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php echo form_close(); ?>

<?php } else { ?>

    <section class="section-spacing <?php if ($locale == 'ar') {
                                        echo 'text-right';
                                    } ?>">
        <div class="container">
            <div class="section-title text-center">
                <h4><?php echo $language['Your cart is currently empty']; ?>!</h4>
                <a href="<?php echo base_url('product/products'); ?>" class="btn btn-primary brand-btn-black-outline"><?php echo $language['Continue Shopping']; ?></a>
            </div>
        </div>
    </section>

<?php } ?>

<?php $this->endSection(); ?>