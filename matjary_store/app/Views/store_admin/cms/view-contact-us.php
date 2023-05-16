<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?php echo $language['View Contact Us']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">CMS</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['View Contact Us']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 card-box">

                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><b><?php echo $language['Name']; ?></b></label>
                                <p><?php echo isset($ContactUsInfo->name)?$ContactUsInfo->name:''; ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><b><?php echo $language['Email']; ?></b></label>
                                <p><?php echo isset($ContactUsInfo->email)?$ContactUsInfo->email:''; ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><b><?php echo $language['Contact No.']; ?></b></label>
                                <p><?php echo isset($ContactUsInfo->contact_no)?$ContactUsInfo->contact_no:''; ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><b><?php echo $language['Meassage']; ?></b></label>
                                <p><?php echo isset($ContactUsInfo->massage)?$ContactUsInfo->massage:''; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block text-right mt-4">
                        <button class="btn btn-primary" type="submit" id="replay" ><?php echo $language['Reply']; ?> </button>
                    </div>
                    <div id="replayEmail" style="display:none;">
                        <?php 
                            $attributes = ['name' => 'reply_contact_form', 'id' => 'reply_contact_form', 'autocomplete' => 'off']; 
                            echo form_open_multipart('admin/reply-contact-admin',$attributes); 
                        ?>
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <input type="hidden" name="id" value="<?php echo isset($ContactUsInfo->id)?$ContactUsInfo->id:''; ?>" />
                        <input type="hidden" name="email" value="<?php echo isset($ContactUsInfo->email)?$ContactUsInfo->email:''; ?>" />
                        <input type="hidden" name="contact_no" value="<?php echo isset($ContactUsInfo->contact_no)?$ContactUsInfo->contact_no:''; ?>" />
                        <input type="hidden" name="name" value="<?php echo isset($ContactUsInfo->name)?$ContactUsInfo->name:''; ?>" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label><b><?php echo $language['To']; ?></b></label>
                                    <p><?php echo isset($ContactUsInfo->email)?$ContactUsInfo->email:''; ?></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label><b><?php echo $language['Meassage']; ?></b></label>
                                    <textarea class="form-control" rows="3" placeholder="<?php echo $language['Your Message']; ?>*" id="admin_reply" name="admin_reply"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-block text-right mt-4">
                            <button class="btn btn-primary" type="submit"><?php echo $language['Submit']; ?></button>
                            <a href="<?php echo base_url('admin/all-contact-us'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>