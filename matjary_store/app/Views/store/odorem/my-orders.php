<?php
include("functions.php");
include("header.php")
?>

<section class="ot-banner-bg">
    <div class="container">
        <div class="section-title text-center">
            <h2><i class="icofont-star-alt-1"></i> My Orders <i class="icofont-star-alt-1"></i> </h2>
        </div>
    </div>
</section>

<div class="section-spacing">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="order-filter-wrapper">
                    <select class="custom-select">
                        <option selected="">Order Number</option>
                        <option>Order Status</option>
                        <option>Payment Method</option>
                        <option>Date of Order (mm-dd-yy)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="order-filter-wrapper">
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-inline">
                    <button class="btn btn-primary brand-btn">Search</button>
                    <button class="btn btn-primary brand-btn ml-1">Clear</button>
                </div>
            </div>
        </div>

        <div class="order-table-count">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="order-table-title" scope="col">#</th>
                            <th class="order-table-title" scope="col">Order Number</th>
                            <th class="order-table-title" scope="col">Order Date</th>
                            <th class="order-table-title" scope="col">Total</th>
                            <th class="order-table-title" scope="col">Payment Menthod</th>
                            <th class="order-table-title" scope="col">Order Status</th>
                            <th class="order-table-title" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td class="order-number-data">
                                <h5><a href="#">11</a></h5>
                            </td>
                            <td class="order-date">
                                <h5>28th March, 06:03 PM, 2022</h5>
                            </td>
                            <td class="order-total">
                                <h5>20.00</h5>
                            </td>
                            <td class="order-payment">
                                <h5>PayTabs</h5>
                            </td>
                            <td class="order-status">
                                <h5>Completed</h5>
                            </td>
                            <td class="order-detail-link">
                                <a href="order-details.php">Details</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <button class="btn btn-primary brand-btn mx-auto d-block">Back</button>
    </div>
</div>

<?php
include("footer.php")
?>