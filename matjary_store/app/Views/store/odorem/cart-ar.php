<?php
include("functions.php");
include("header-ar.php")
?>

<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> Cart <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>

<section class="section-spacing">
    <div class="container">
        <div class="product-cart-count">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="cart-table-title" scope="col">Sr.No.</th>
                            <th class="cart-table-title" scope="col">Product Name</th>
                            <th class="cart-table-title" scope="col">Variant Details</th>
                            <th class="cart-table-title" scope="col">Quantity</th>
                            <th class="cart-table-title" scope="col">Price</th>
                            <th class="cart-table-title" scope="col">Tax Included</th>
                            <th class="cart-table-title" scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-right" scope="row">1</th>
                            <td>
                                <div class="cart-prod-title">
                                    <h6>Product Name</h6>
                                </div>
                            </td>
                            <td class="text-right">--</td>
                            <td>
                                <div class="cart-qty">
                                    <select class="custom-select custom-select-sm">
                                        <option selected="">Quantity</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="cart-price">
                                    <h5>SAR 400.00</h5>
                                </div>
                            </td>
                            <td>
                                <h5 class="cart-tax">No</h5>
                            </td>
                            <td class="text-right">
                                <a href="#">
                                    <img src="https://atzshopp.sa-matjary.com/img/remove.png">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="cart-action-buttons">
            <div class="d-grid gap-2 d-md-block ms-auto text-right">
                <button class="btn btn-primary brand-btn" type="button">Update Cart</button>
                <button class="btn btn-primary brand-btn" type="button">Empty Cart</button>
                <button class="btn btn-primary  brand-btn" type="button">Continue Shopping</button>
            </div>
        </div>
    </div>
</section>

<section class="">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-title text-right">
                    <h2><i class="icofont-star-alt-1"></i> Cart total</h2>
                </div>
                <div class="cart-total-wrapper">
                    <div class="table-responsive">
                        <table class="table">
                            </table><table class="table">
                                <tbody>
                                    <tr>
                                        <td class="cart-structure-name">Subtotal</td>
                                        <td>
                                            <div class="cart-price">
                                                <h5>SAR 200.00</h5>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart-structure-name">Tax Amount</td>
                                        <td>
                                            <div class="cart-price">
                                                <h5>SAR 200.00</h5>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart-structure-name">Shipping Charge</td>
                                        <td>
                                            <div class="cart-price">
                                                <h5>SAR 200.00</h5>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart-structure-name">Total Payable Amount</td>
                                        <td>
                                            <div class="cart-price">
                                                <h5>SAR 200.00</h5>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart-structure-name">Grand Total</td>
                                        <td>
                                            <div class="cart-price">
                                                <h5>SAR 200.00</h5>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        
                    </div>
                </div>

                <div class="checkout-btn">
                    <button class="btn btn-primary brand-btn float-right">Proceed to checkout</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="promo-wrapper">
                    <div class="section-title mb-4 text-right">
                        <h2><i class="icofont-star-alt-1"></i> Promo code</h2>
                    </div>
                    <div class="promo-input">
                        <input class="form-control" type="text" placeholder="Enter Promo Code">
                        <button class="btn btn-primary brand-btn float-left">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-spacing">
    <div class="container">
        <div class="section-title text-center">
            <h4>Your cart is currently empty!</h4>
        </div>
        <button class="btn btn-primary brand-btn mx-auto d-block">Continue Shopping</button>
    </div>
</section>

<?php
include("footer-ar.php")
?>