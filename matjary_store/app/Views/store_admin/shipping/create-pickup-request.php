<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?php echo $language['Create Delivery Pickup Request']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Manage']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Create Delivery Pickup Request']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 card-box">

                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <?php 
                        $attributes = ['name' => 'submit_create_pickup_request_form', 'id' => 'submit_create_pickup_request_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/submit-pickup-request',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">                            
                                <label><?php echo $language['Select Shipping Company For Customer Product Delivery']; ?></label>
                                <select name="shipping_company_id" id="shipping_company_id" class="form-control">
                                    <option value=""><?php echo $language['Select Shipping Company']; ?></option>
                                    <?php 
                                    if(isset($shippingCmpList) && !empty($shippingCmpList)){
                                        if($defaultShipping == 1){
                                    ?>
                                    <option value="1"><?php echo $language['Aramex']; ?></option>
                                    <?php 
                                        }else{
                                            foreach($shippingCmpList as $values){
                                    ?>
                                                <option value="<?php echo $values->ship_cmp_id; ?>"><?php echo $values->ship_cmp_name; ?></option>
                                    <?php 
                                            }
                                        }
                                    }else{ 
                                    ?> 
                                        <option value="1"><?php echo $language['Aramex']; ?></option>
                                    <?php 
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block text-<?php echo $locale == 'en'?'right':'left'; ?> mt-4">
                        <button class="btn btn-primary" type="submit"><?php echo $language['Submit']; ?></button>
                        <a href="<?php echo base_url('admin/ship-orders'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $this->endSection(); ?>