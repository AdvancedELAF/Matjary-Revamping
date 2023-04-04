<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?php echo $language['All Refund Request']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Manage']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['All Refund Request']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <?php
    //echo '<pre>'; print_r($reFundDetails); ?>
    <div class="card-box mb-30">
        <div class="table-responsive pd-20">
            <table class="data-table table nowrap" id="viewAllCustomerOrderList">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $language['Order Reference']; ?></th>
                        <th scope="col"><?php echo $language['Total']; ?></th>
                        <th scope="col"><?php echo $language['Refund Amount']; ?></th>
                        <th scope="col"><?php echo $language['Refund Status']; ?></th>
                        <th scope="col"><?php echo $language['Action']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php //echo '<pre>'; print_r($all_refund_request); 
                    if(isset($all_refund_request) && !empty($all_refund_request)){
                        $i = 1;
                        foreach ($all_refund_request as $value) {
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo isset($value->transaction_id)?$value->transaction_id:'NA'; ?></td>
                            <td><?php echo $language['SAR']; ?> <?php echo isset($value->refund_amount)?$value->refund_amount:'NA'; ?></td>                            
                            <td><?php echo $language['SAR']; ?> <?php echo isset($value->refund_amount)?$value->refund_amount:'NA'; ?></td>
                            <td><?php if($value->refund_status==0){ echo '<span class="text-warning">'.$language['Pending'].'</span>'; }elseif($value->refund_status==1){ echo '<span class="text-info">'.$language['Refund Initiated'].'</span>'; }elseif($value->refund_status==2){ echo '<span class="text-success">'.$language['Refunded'].'</span>'; }else{ echo $language['NA'];} ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="<?php echo base_url('admin/single-refund-details/'.$value->order_id); ?>" title="view Refund details"><i class="dw dw-eye"></i> <?php echo $language['Details']; ?></a>
                                        <!-- <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('admin/delete-order'); ?>" data-id="<?php echo $value->id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i> Delete</a> -->
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
                            <td colspan="7"><?php echo $language['No record found']; ?>.</td>
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