<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?php echo $language['All Shipping Orders']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Manage']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['All Shipping Orders']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-box mb-30">
        <?php if (isset($shippingOrders) && !empty($shippingOrders)) { ?>
            <div class="pd-20">
                <a href="<?php echo base_url('admin/create-pickup-request'); ?>" class="btn btn-primary pull-<?php echo $locale == 'en'?'right':'left'; ?>"><?php echo $language['Create Pickup Request']; ?></a>
            </div>
        <?php } ?>
        <div class="table-responsive pd-20">
            <table class="data-table table table-bordered nowrap" id="viewAllShippingOrderList">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $language['Order Reference']; ?></th>
                        <th scope="col"><?php echo $language['Order Date']; ?></th>
                        <th scope="col"><?php echo $language['Total']; ?></th>
                        <th scope="col"><?php echo $language['Payment Mode']; ?></th>
                        <th scope="col"><?php echo $language['Payment Status']; ?></th>
                        <th scope="col"><?php echo $language['Order Status']; ?></th>
                        <th scope="col"><?php echo $language['Action']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($shippingOrders) && !empty($shippingOrders)) {
                        $i = 1;
                        foreach ($shippingOrders as $value) {
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo isset($value->transaction_id) ? $value->transaction_id : 'NA'; ?></td>
                                <td><?php echo isset($value->created_at) ? $value->created_at : 'NA'; ?></td>
                                <td><?php echo $language['SAR']; ?> <?php echo isset($value->total_price) ? $value->total_price : 'NA'; ?></td>
                                <td><?php if ($value->payment_type == 1) {
                                        echo $language['Cash On Delivery'];
                                    } elseif ($value->payment_type == 2) {
                                        echo $language['Online Banking'];
                                    } elseif ($value->payment_type == 3) {
                                        echo $language['Gift Cart'];
                                    } ?></td>
                                <td><?php if ($value->payment_status == 1) {
                                        echo $language['Complete'];
                                    } elseif ($value->payment_status == 2) {
                                        echo $language['Pending'];
                                    } elseif ($value->payment_status == 3) {
                                        echo $language['Cancel'];
                                    } ?></td>
                                <td><?php if ($value->order_status == 1) {
                                        echo $language['Complete'];
                                    } elseif ($value->order_status == 2) {
                                        echo $language['Pending'];
                                    } elseif ($value->order_status == 3) {
                                        echo $language['Cancelled'];
                                    } elseif ($value->order_status == 4) {
                                        echo $language['Deleted'];
                                    } else {
                                        echo $language['NA'];
                                    } ?></td>
                                <td><a href="<?php echo base_url('admin/order-details/' . $value->id); ?>" title="view order details"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            </tr>
                        <?php
                            $i++;
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="8"><?php echo $language['No record found']; ?>.</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>