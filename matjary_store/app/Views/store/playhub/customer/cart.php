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
<section <?php if($locale=='ar'){echo 'text-right';} ?>>
    <div class="container-fluid">
        <div class="trans-page-title">
            <h1><?php echo $language['Cart']; ?></h1>
        </div>
    </div>
</section>
<?php if(isset($customerCartData) && !empty($customerCartData)){ ?>
<!-- CART TABLE STARTS -->
<?php 
    $attributes = ['name' => 'proceed_cart_form', 'id' => 'proceed_cart_form', 'autocomplete' => 'off']; 
    echo form_open_multipart('customer/proceed-cart',$attributes); 
?>
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8" >
                <div class="tbody" id="cartItemsTbody">
                <input type="checkbox" name="chk_all_cart_items" id="chk_all_cart_items"> 
                    <?php 
                    $cartItemChekedTrue = false;
                    if(isset($customerCartData) && !empty($customerCartData)){
                        $i=1;
                        $index = 0;
                        foreach($customerCartData as $customerCartValues){                            
                            $productId = isset($customerCartValues->id)?$customerCartValues->id:'';
                            $product_price = isset($customerCartValues->product_price)?number_format((float)$customerCartValues->product_price, 2, '.', ''):'';
                            $sales_tax = isset($customerCartValues->sales_tax)?number_format((float)$customerCartValues->sales_tax, 2, '.', ''):'';
                            $product_weight = isset($customerCartValues->weight)?number_format((float)$customerCartValues->weight, 2, '.', ''):'';
                            
                            $cartItemCheked = '';
                            $cartBuyItem = $session->get('cartBuyItem');
                            if(isset($cartBuyItem) && !empty($cartBuyItem)){
                                if(isset($cartBuyItem['productid']) && !empty($cartBuyItem['productid'])){
                                    if($cartBuyItem['productid']==$productId){
                                        $cartItemCheked = 'checked';
                                        $cartItemChekedTrue = true;
                                    }
                                }
                            }
                    ?>
                    <div class="cart-wrap cartItemsTr">
                        <div class="prod-cart"> 
                            <?php if($customerCartValues->stock_quantity==0){ ?>
                            <?php }else{ ?>
                            <input type="checkbox" name="index[]" value="<?php echo $index; ?>" class="cartItem" data-productid="<?php echo $productId; ?>" <?php echo $cartItemCheked; ?>>
                            <?php } ?>

                        <img src="<?php echo base_url('/uploads/product/'); ?>/<?php echo isset($customerCartValues->image)?$customerCartValues->image:''; ?>">
                        <div class="prod-cart-detail">
                                <h4><?php //echo $i; ?>
                            <input type="hidden" name="product_id[]" value="<?php echo $productId; ?>"> </h4>
                            <h4>
                                <a href="<?php echo base_url('product/product-details/'.$productId); ?>" target="_blank">
                                    <?php echo $ses_lang=='en' ? $customerCartValues->title : $customerCartValues->title_ar;  ?> 
                                        <?php if($customerCartValues->stock_quantity==0){ ?>
                                            <span class="text-danger">(<?php echo $language['Out of Stock']; ?>)</span>
                                    <?php } ?>
                                </a>
                            </h4>
                            <div class="mb-2">
                                <input type="text" name="product_qty[]" id="product_qty_<?php echo $productId; ?>" data-productid="<?php echo $productId; ?>" data-actionurl="<?php echo base_url('single-product-details'); ?>" class="product_qty brand-input w-50 numberonly" value="1" maxlength="3">
                            </div>

                            <div class="cart-prod-price mb-2">
                                <h5><?php echo $language['SAR']; ?> <span id="product_price_<?php echo $productId; ?>_span"><?php echo $product_price; ?></span></h5>
                                <input type="hidden" id="product_price_<?php echo $productId; ?>" value="<?php echo $product_price; ?>">
                                <input type="hidden" name="product_price[]" id="new_product_price_<?php echo $productId; ?>" class="product_price" value="<?php echo $product_price; ?>">
                            </div>

                            <div class="mb-2">
                            <h5 style="display:none;" class="cart-tax"><span id="sales_tax_<?php echo $productId; ?>_span"><?php echo $sales_tax; ?></span></h5>
                            <input type="hidden" id="sales_tax_<?php echo $productId; ?>" value="<?php echo $sales_tax; ?>">
                            <input type="hidden" name="sales_tax[]" id="new_sales_tax_<?php echo $productId; ?>" class="sales_tax" value="<?php echo $sales_tax; ?>">

                            <input type="hidden" id="product_weight_<?php echo $productId; ?>" value="<?php echo isset($customerCartValues->weight)?$customerCartValues->weight:''; ?>">
                            <input type="hidden" name="product_weight[]" id="new_product_weight_<?php echo $productId; ?>" class="product_weight" value="<?php echo isset($customerCartValues->weight)?$customerCartValues->weight:''; ?>">
                            </div>
                            </div>
                        </div>                       
                        <a href="javascript:void(0);" id="rempveSnglProdFromCart" data-baseurl="<?php echo base_url(); ?>" data-actionurl="<?php echo base_url('customer/remove-product-cart'); ?>" data-customerid="<?php echo $ses_custmr_id; ?>" data-productid="<?php echo $productId; ?>"><div class="cart-prod-cancel">
                                <i class="icofont-ui-delete"></i>
                            </div></a>
                    </div>
                    <?php
                        $i++; $index++;
                        }
                    }
                    ?>
                    <div class="text-right mb-3">
                        <a href="javascript:void(0);" class="brand-btn-black -black" type="button" id="emptyCart" data-actionurl="<?php echo base_url('customer/empty-cart'); ?>" data-customerid="<?php echo $ses_custmr_id; ?>"><?php echo $language['Empty Cart']; ?></a>
                        <a href="<?php echo base_url('product/products'); ?>" class="brand-btn-orange" type="button"><?php echo $language['Continue Shopping']; ?></a>
           
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="ui-title text-black">
                    <h4><?php echo $language['Cart total']; ?></h4>
                </div>
                <div class="cart-total-wrap">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <input type="hidden" name="customerid" id="customerid" value="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>">
                                <tr>
                                    <td class="cart-structure-name"><?php echo $language['Tax Amount']; ?></td>
                                    <td>
                                        <div class="cart-price">                                      
                                            <h6><?php echo $language['SAR']; ?> <span id="sales_taxs_span"><?php if($cartItemChekedTrue==true){ echo isset($cartTotal['taxtotal'])?number_format((float)$cartTotal['taxtotal'], 2, '.', ''):0.00; }else{echo '0.00';} ?></span></h6>
                                            <input type="hidden" name="tax" id="tax" value="<?php if($cartItemChekedTrue==true){ echo isset($cartTotal['taxtotal'])?number_format((float)$cartTotal['taxtotal'], 2, '.', ''):0.00; }else{echo '0.00';} ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart-structure-name"><?php echo $language['Subtotal']; ?></td>
                                    <td>
                                        <div class="cart-price">
                                            <h6><?php echo $language['SAR']; ?> <span id="subtotal_span"><?php if($cartItemChekedTrue==true){ echo isset($cartTotal['subtotal'])?number_format((float)$cartTotal['subtotal'], 2, '.', ''):0.00; }else{echo '0.00';} ?></span></h6>
                                            <input type="hidden" name="subtotal" id="subtotal" value="<?php if($cartItemChekedTrue==true){ echo isset($cartTotal['subtotal'])?number_format((float)$cartTotal['subtotal'], 2, '.', ''):0.00; }else{echo '0.00';} ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr id="coupon_applied_tr" style="display: none;">
                                    <td class="cart-structure-name"><?php echo $language['Promotion Applied']; ?></td>
                                    <td><div class="cart-price"><h5><?php echo $language['SAR']; ?> <span id="promotion_applied_amount_span"></span></h5></div></td>
                                    <input type="hidden" name="discount_type" id="discount_type" value="">
                                    <input type="hidden" name="discount_value" id="discount_value" value="">
                                    <input type="hidden" name="is_coupon_applied" id="is_coupon_applied">
                                    <input type="hidden" name="coupon_id" id="coupon_id" >
                                    <input type="hidden" name="coupon_amount" id="coupon_amount">
                                </tr>  
                                <tr>
                                    <td class="cart-structure-name"><?php echo $language['Grand/Order Total']; ?></td>
                                    <td>
                                        <div class="cart-price">
                                            <h6><?php echo $language['SAR']; ?> <span id="total_price_span"><?php if($cartItemChekedTrue==true){ echo isset($cartTotal['total_price'])?number_format((float)$cartTotal['total_price'], 2, '.', ''):0.00; }else{echo '0.00';} ?></span></h6>
                                            <input type="hidden" name="total_price" id="total_price" value="<?php if($cartItemChekedTrue==true){ echo isset($cartTotal['total_price'])?number_format((float)$cartTotal['total_price'], 2, '.', ''):0.00; }else{echo '0.00';} ?>">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right mb-2">
                        <button type="submit" class="brand-btn-orange" id="proceedToCheckoutBtn"><?php echo $language['Proceed to checkout']; ?></button>
                    </div>
                </div>
                <div class="orange-bg">
                    <div class="coupon-wrap mb-2">
                        <div class="ui-title text-white">
                            <h4><?php echo $language['Promo coupon code']; ?></h4>
                        </div>
                        <div class="mb-2">
                            <input class="brand-input" type="text" name="coupon_code" id="coupon_code" placeholder="<?php echo $language['Enter Promo Code']; ?>">
                        </div>
                        <p id="couponCodeMsg"></p>
                        <div class="text-right mb-2">                            
                            <a href="javascript:void(0);" class="brand-btn-black" id="couponCodeApplyBtn" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>" data-actionurl="<?php echo base_url('customer/applied-coupon-code'); ?>"><?php echo $language['Apply']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6"></div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</section>
<?php echo form_close(); ?>
<?php }else{ ?>

<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="ui-title text-black text-center">
        <h4 class="mb-4"><?php echo $language['Your cart is currently empty']; ?>!</h4>
        <a href="<?php echo base_url('product/products'); ?>" class="brand-btn-orange"><?php echo $language['Continue Shopping']; ?></a>   
    </div>
</section>
<?php } ?>

<?php $this->endSection(); ?>