<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?php echo $language['Update Coupon Code']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin'); ?>"><?php echo $language['Coupons']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Update Coupon Code']; ?></li>
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
                        $attributes = ['name' => 'update_coupon_form', 'id' => 'update_coupon_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/update-coupon',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="coupon_id" value="<?php echo isset($couponDetails['id'])?$couponDetails['id']:''; ?>" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Title']; ?></label>
                                <input type="text" <?php echo $ses_lang == 'en' ? 'name="coupon_title" id="coupon_title"' : 'name="coupon_title_ar" id="coupon_title_ar"'; ?>  value="<?php echo isset($couponDetails['coupon_title'])?$couponDetails['coupon_title']:''; ?>" class="form-control" placeholder="<?php echo $language['Title']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Coupon Code']; ?></label>
                                <input type="text" disabled name="coupon_code" id="coupon_code" value="<?php echo isset($couponDetails['coupon_code'])?$couponDetails['coupon_code']:''; ?>" class="form-control" placeholder="<?php echo $language['Coupon Code']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                        <label><?php echo $language['Start Date']; ?> </label>
                            <div class="mb-2">
                                <input type="date" class="form-control" placeholder="<?php echo $language['Start Date']; ?>" id="coupon_startdate" name="coupon_startdate" value="<?php echo isset($couponDetails['coupon_startdate'])?$couponDetails['coupon_startdate']:''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                        <label><?php echo $language['End Date']; ?></label>
                            <div class="mb-2">
                                <input type="date" class="form-control" placeholder="<?php echo $language['End Date']; ?>" id="coupon_expirydate" name="coupon_expirydate" value="<?php echo isset($couponDetails['coupon_expirydate'])?$couponDetails['coupon_expirydate']:''; ?>">                               
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <label>Number Of Times This Discount Can Be Used</label>
                            <div class="mb-2">
                                <input type="text" class="form-control" placeholder="Quantity" id="quantity" name="quantity" value="<?php echo isset($couponDetails['quantity'])?$couponDetails['quantity']:''; ?>">                               
                            </div>
                        </div> -->
                        </div>

                    <div class="row">    
                        <div class="col-md-6">
                            <label><?php echo $language['Discount Type']; ?> </label>
                            <div class="mb-2">
                                <select class="form-control"  name="discount_type" id="discount_type">
                                    <option value=""><?php echo $language['Select discount type']; ?></option>
                                    <option value = "1" <?php if($couponDetails['discount_type'] == '1') { echo 'selected' ; }?>><?php echo $language['Percentage']; ?></option>
                                    <option value = "2" <?php if($couponDetails['discount_type'] == '2') { echo 'selected' ; }?>><?php echo $language['Amount']; ?></option>                                                                                
                                </select>
                            </div>
                        </div>
                      
                        <div class="col-md-6">
                        <label><?php echo $language['Discount Value']; ?></label>
                            <div class="mb-2">
                                <input type="text" class="form-control numberonly" maxlength="2" placeholder="<?php echo $language['Discount Value']; ?>" id="discount_value" name="discount_value" value="<?php echo isset($couponDetails['discount_value'])?$couponDetails['discount_value']:''; ?>">                               
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label><?php echo $language['For']; ?>  </label>
                            <div class="mb-2">                               
                                    <select class="form-control"  name="for_orders" id="for_orders"> 
                                        <option value=""><?php echo $language['Select for']; ?></option>
                                       <option value="1" <?php if($couponDetails['for_orders'] === '1') { echo 'selected' ; }?>><?php echo $language['All Orders']; ?></option>
                                       <option value="2"<?php if($couponDetails['for_orders'] === '2') { echo 'selected' ; }?>><?php echo $language['Orders Over']; ?></option>                                                                                
                                    </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6" id="min_amount_div" style="display:none;">
                            <label><?php echo $language['Minimum Applicable Amount']; ?></label>
                            <div class="mb-2">
                                <input type="text" class="form-control floatNumberOnly" maxlength="8"  placeholder="<?php echo $language['Minimum Applicable Amount']; ?>" id="min_amount" name="min_amount" value="<?php echo isset($couponDetails['min_amount'])?$couponDetails['min_amount']:''; ?>">                               
                            </div>
                        </div>
                        <div class="col-md-6">  
                            <label><?php echo $language['Description']; ?></label>                      
                            <div class="mb-2">
                                <textarea class="form-control" name="coupon_desc" id="coupon_desc" placeholder="<?php echo $language['Description']; ?>"><?php echo isset($couponDetails['coupon_desc'])?$couponDetails['coupon_desc']:''; ?></textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                        <button class="btn btn-primary" type="submit"><?php echo $language['Update']; ?></button>
                        <a href="<?php echo base_url('admin/all-coupons'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>

</div>

<?php $this->endSection(); ?>
