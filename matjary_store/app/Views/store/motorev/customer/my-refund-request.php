<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['My Orders']; ?></h1>
        </div>
    </div>
</section><!-- PAGE BAR ENDS -->
<!-- MY ORDERS TABLE STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="order-table-count">
            <div class="table-responsive">
            <table class="data-table table nowrap" id="viewAllCustomerOrderList">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $language['Order Date']; ?></th>
                        <th scope="col" title="Order Refference"><?php echo $language['Order Ref']; ?>.</th>
                        <th scope="col"><?php echo $language['Total']; ?></th>
                        <th scope="col"><?php echo $language['Refund Amount']; ?></th>
                        <th scope="col"><?php echo $language['Payment Status']; ?></th>
                        <th scope="col"><?php echo $language['Order Status']; ?></th>
                        <th scope="col"><?php echo $language['Refund Status']; ?></th>
                        <th scope="col"><?php echo $language['Action']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($reFundDetails) && !empty($reFundDetails)){
                        $i = 1;
                        foreach ($reFundDetails as $value) {
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo isset($value->created_at)?date("Y-m-d",strtotime($value->created_at)):'NA'; ?></td>
                            <td><?php echo isset($value->transaction_id)?$value->transaction_id:'NA'; ?></td>
                            <td><?php echo $language['SAR']; ?> <?php echo isset($value->total_price)?$value->total_price:'NA'; ?></td>                            
                            <td><?php echo $language['SAR']; ?> <?php echo isset($value->refund_amount)?$value->refund_amount:'NA'; ?></td>
                            <td><?php if($value->payment_status==1){ echo '<span class="text-success">'.$language['Complete'].'</span>'; }elseif($value->payment_status==2){ echo '<span class="text-warning">'.$language['Pending'].'</span>'; }elseif($value->payment_status==3){ echo '<span class="text-danger">'.$language['Cancelled'].'</span>'; } ?></td>
                            <td><?php if($value->order_status==1){ echo '<span class="text-success">'.$language['Complete'].'</span>'; }elseif($value->order_status==2){ echo '<span class="text-warning">'.$language['Pending'].'</span>'; }elseif($value->order_status==3){ echo '<span class="text-danger">'.$language['Cancelled'].'</span>'; }else{ echo 'NA';} ?></td>
                            <td><?php if($value->refund_status==0){ echo '<span class="text-warning">'.$language['Pending'].'</span>'; }elseif($value->refund_status==1){ echo '<span class="text-info">'.$language['Refund Initiated'].'</span>'; }elseif($value->refund_status==2){ echo '<span class="text-success">'.$language['Refunded'].'</span>'; }else{ echo 'NA';} ?></td>
                            <td class="order-detail-link">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <?php echo $language['Action']; ?>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="<?php echo base_url('customer/single-refund-details/'.$value->id); ?>" title="view Refund details" class="dropdown-item"><i class="dw dw-eye"></i>  <?php echo $language['Details']; ?></a>
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
        <a href="<?php echo base_url('customer/my-account'); ?>" class="btn btn-primary brand-btn mx-auto "><?php echo $language['Back']; ?></a> 
    </div>
</section>
<!-- MY ORDERS TABLE ENDS -->
<?php $this->endSection(); ?>
