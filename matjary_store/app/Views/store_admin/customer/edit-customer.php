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
                    <h4><?php echo $language['Update Customer']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Customers']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Update Customer']; ?></li>
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
                        $attributes = ['name' => 'update_customer_form', 'id' => 'update_customer_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/update-customer',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="cus_id" value="<?php echo isset($customerDetails['id'])?$customerDetails['id']:''; ?>" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Name']; ?></label>
                                <input type="text" name="name" id="name" value="<?php echo isset($customerDetails['name'])?$customerDetails['name']:''; ?>" class="form-control" placeholder="<?php echo $language['Name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Email']; ?></label>
                                <input type="email" disabled name="email" id="email" value="<?php echo isset($customerDetails['email'])?$customerDetails['email']:''; ?>"  class="form-control" placeholder="<?php echo $language['Email']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Contact Number']; ?></label>
                                <input type="text" name="contact_no" id="contact_no" value="<?php echo isset($customerDetails['contact_no'])?$customerDetails['contact_no']:''; ?>"  class="form-control numberonly" minlength="9" maxlength="10" placeholder="<?php echo $language['Contact Number']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                        <button class="btn btn-primary" type="submit"><?php echo $language['Update']; ?></button>
                        <a href="<?php echo base_url('admin/all-customers'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>

</div>
<?php $this->endSection(); ?>