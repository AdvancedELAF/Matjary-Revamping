<?php $this->extend('store/' . $storeActvTmplName . '/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['My Orders']; ?></h1>
        </div>
    </div>
</section>
<!-- PAGE BAR ENDS -->
<!-- MY ORDERS TABLE STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="order-table-count">
            <div class="table-responsive">
                <table class="table" id="viewAllMyOrderList">
                    <thead>
                        <tr>
                            <th class="order-table-title" scope="col">#</th>
                            <th class="order-table-title" scope="col"><?php echo $language['Order Reference']; ?></th>
                            <th class="order-table-title" scope="col"><?php echo $language['Order Date']; ?></th>
                            <th class="order-table-title" scope="col"><?php echo $language['Total']; ?></th>
                            <th class="order-table-title" scope="col"><?php echo $language['Payment Mode']; ?></th>
                            <th class="order-table-title" scope="col"><?php echo $language['Payment Status']; ?></th>
                            <th class="order-table-title" scope="col"><?php echo $language['Order Status']; ?></th>
                            <th class="order-table-title" scope="col"><?php echo $language['Action']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($customerOrderHistoryList) && !empty($customerOrderHistoryList)) {
                            $i = 1;
                            foreach ($customerOrderHistoryList as $value) { ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td class="order-number-data">
                                        <h5><?php echo isset($value->transaction_id) ? $value->transaction_id : 'NA'; ?></h5>
                                    </td>
                                    <td class="order-date">
                                        <h5><?php echo isset($value->created_at) ? date("d M Y", strtotime($value->created_at)) : 'NA'; ?></h5>
                                    </td>
                                    <td class="order-total">
                                        <h5><?php echo $language['SAR']; ?> <?php echo isset($value->total_price) ? $value->total_price : 'NA'; ?></h5>
                                    </td>
                                    <td class="order-payment">
                                        <h5>
                                        <?php 
                                            if($value->payment_type==1){ 
                                                echo $language['Cash On Delivery']; 
                                            }elseif($value->payment_type==2){ 
                                                echo $language['Online Banking'];
                                            }elseif($value->payment_type==3){
                                                echo $language['Gift Cart'];
                                            } 
                                        ?>
                                        </h5>
                                    </td>
                                    <td class="order-payment">
                                        <h5>
                                        <?php 
                                            if($value->payment_status==1){ 
                                                echo $language['Complete'];
                                            }elseif($value->payment_status==2){
                                                echo $language['Pending'];
                                            }elseif($value->payment_status==3){ 
                                                echo $language['Cancel'];
                                            }
                                            ?>
                                        </h5>
                                    </td>
                                    <td class="order-payment">
                                        <h5>
                                            <?php
                                                if ($value->order_status == 1) {
                                                    echo '<span class="badge badge-success">'.$language['Complete'].'</span>';
                                                } elseif ($value->order_status == 2) {
                                                    echo '<span class="badge badge-warning">'.$language['Pending'].'</span>';
                                                } elseif ($value->order_status == 3) {
                                                    echo '<span class="badge badge-danger">'.$language['Cancelled'].'</span>';
                                                } else {
                                                    echo '<span class="badge badge-secondary">'.$language['NA'].'</span>';
                                                }
                                            ?>
                                        </h5>
                                    </td>
                                    <td class="order-detail-link">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <?php echo $language['Action']; ?>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="<?php echo base_url('customer/order-details/' . $value->id); ?>" class="dropdown-item"><?php echo $language['Details']; ?></a>
                                                <?php if ($value->order_status == 2 && $value->pickup_req_flag == 0) { ?>
                                                    <a href="<?php echo base_url('customer/cancel-order-confirm/' . $value->id); ?>" class="dropdown-item"><?php echo $language['Cancel Order']; ?></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>
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
        <div class="text-center">
            <a href="<?php echo base_url('customer/my-account'); ?>" class="btn btn-primary brand-btn"><?php echo $language['Back']; ?></a>
        </div>
    </div>
</section>
<!-- MY ORDERS TABLE ENDS -->
<?php $this->endSection(); ?>
