<?php $this->extend('store/' . $storeActvTmplName . '/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section>
    <div class="container-fluid <?php if($locale=='ar'){echo 'text-right';} ?>">
        <div class="trans-page-title">
            <h1><?php echo $language['My Orders']; ?></h1>
        </div>
    </div>
</section>
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
<div class="container-fluid">
    <div class="order-table-count">
        <div class="table-wrap">
                <div class="brand-table">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <table class="table" id="viewAllMyOrderList">
                                <thead>
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
                                    if(isset($customerOrderHistoryList) && !empty($customerOrderHistoryList)){
                                        $i = 1;
                                        foreach ($customerOrderHistoryList as $value) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td scope="col"><h6><?php echo isset($value->transaction_id)?$value->transaction_id:'NA'; ?></h6></td>
                                        <td scope="col"><h6><?php echo isset($value->created_at)?date("d M Y",strtotime($value->created_at)):'NA'; ?></h6></td>
                                        <td scope="col"><h6><?php echo $language['SAR']; ?> <?php echo isset($value->total_price)?$value->total_price:'NA'; ?></h6></td>
                                        <td scope="col">
                                            <h6>
                                                <?php 
                                                if($value->payment_type==1){ 
                                                    echo $language['Cash On Delivery']; 
                                                }elseif($value->payment_type==2){ 
                                                    echo $language['Online Banking'];
                                                }elseif($value->payment_type==3){
                                                    echo $language['Gift Cart'];
                                                } 
                                                ?>
                                            </h6>
                                        </td>
                                        <td scope="col">
                                            <h6>
                                                <?php 
                                                if($value->payment_status==1){ 
                                                    echo $language['Complete'];
                                                }elseif($value->payment_status==2){ 
                                                    echo $language['Pending'];
                                                }elseif($value->payment_status==3){ 
                                                    echo $language['Cancel'];
                                                }
                                                ?>
                                            </h6>
                                        </td>
                                        <td scope="col">
                                            <h6>
                                                <?php 
                                                if($value->order_status==1){ 
                                                    echo '<span class="badge badge-success">'.$language['Complete'].'</span>';
                                                }elseif($value->order_status==2){ 
                                                        echo '<span class="badge badge-warning">'.$language['Pending'].'</span>';
                                                }elseif($value->order_status==3){ 
                                                    echo '<span class="badge badge-danger">'.$language['Cancelled'].'</span>';
                                                }else{ 
                                                    echo '<span class="badge badge-secondary">'.$language['NA'].'</span>';
                                                }
                                                ?>
                                            </h6>
                                        </td>
                                        <td scope="col">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                <?php echo $language['Action']; ?>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="<?php echo base_url('customer/order-details/'.$value->id); ?>" class="dropdown-item"><?php echo $language['Details']; ?></a>
                                                    <?php if($value->order_status==2 && $value->pickup_req_flag==0){ ?>
                                                    <a href="<?php echo base_url('customer/cancel-order-confirm/'.$value->id); ?>" class="dropdown-item"><?php echo $language['Cancel Order']; ?></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                        }
                                    }else{
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
            </div>
            <div class="text-<?php if($locale=='ar'){echo 'left';}else{echo 'right';} ?>">
            <a href="<?php echo base_url('customer/my-account'); ?>" class="brand-btn-black"><?php echo $language['Back']; ?></a>
            </div>
        </div>
        </div>        
    </div>
</div>
</section>
<?php $this->endSection(); ?>