<?php
include("functions.php");
include("header.php")
?>

<section class="section-spacing">
    <div class="container">
        <div class="section-title mb-4">
            <h4>Cart</h4>
        </div>
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
                            <th scope="row">1</th>
                            <td>
                                <div class="cart-prod-title">
                                    <h6>Product Name</h6>
                                </div>
                            </td>
                            <td>--</td>
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
                            <td>
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
            <div class="d-grid gap-2 d-md-block ms-auto">
                <button class="btn btn-primary brand-btn" type="button">Update Cart</button>
                <button class="btn btn-primary brand-btn" type="button">Empty Cart</button>
                <button class="btn btn-primary  brand-btn" type="button">Continue Shopping</button>
            </div>
        </div>

        <section class="section-spacing">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-title mb-4">
                            <h4>Cart total</h4>
                        </div>
                        <div class="cart-total-wrapper">
                            <div class="table-responsive">
                                <table class="table">
                                </table>
                                <table class="table">
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

                        <div class="checkout-btn mt-3">
                            <button class="btn btn-primary brand-btn">Proceed to checkout</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="promo-wrapper">
                            <div class="section-title mb-4">
                                <h4>Promo code</h4>
                            </div>
                            <div class="promo-input">
                                <input class="form-control" type="text" placeholder="Enter Promo Code">
                                <button class="btn btn-primary brand-btn float-right mt-3">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

<?php
include("footer.php")
?>