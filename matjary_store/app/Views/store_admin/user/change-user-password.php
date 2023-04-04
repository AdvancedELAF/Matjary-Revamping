<?php 
$session = \Config\Services::session(); 
$ses_user_logged_in = $session->get('ses_user_logged_in');
$ses_user_name = $session->get('ses_user_name');
$ses_user_id = $session->get('ses_user_id');
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
?>
<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
    
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="title">
                                <h4><?php echo $language['Change Password']; ?></h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><?php echo $language['Profile']; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Change Password']; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                        <div class="pd-20 card-box">
                        <?php                     
                        $attributes = ['name' => 'update_user_change_password_form', 'id' => 'update_user_change_password_form', 'autocomplete' => 'off',]; 
                        echo form_open_multipart('admin/save-change-password',$attributes);                     
                        ?> 
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <input type="hidden" name="user_id" value="<?php echo isset($ses_user_id)?$ses_user_id:''; ?>" />  
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <h5 class="h4 text-blue mb-20"><?php echo $language['Change Password']; ?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label><?php echo $language['Old Password']; ?></label>
                                        <div class="mb-2">
                                            <input type="password" class="form-control" placeholder="<?php echo $language['Old Password']; ?>*" id="oldpassword" name="oldpassword">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label><?php echo $language['New Password']; ?></label>
                                        <div class="mb-2">
                                            <input type="password" class="form-control" placeholder="<?php echo $language['New Password']; ?>*" id="password" name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <label><?php echo $language['Confirm Password']; ?></label>
                                        <div class="mb-2">
                                            <input type="password" class="form-control" placeholder="<?php echo $language['Confirm New Password']; ?>*" id="cnf_password" name="cnf_password">
                                        </div>
                                    </div>
                                </div>                              

                                <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                                    <button class="btn btn-primary" type="submit"><?php echo $language['Update']; ?></button>
                                    <a href="<?php echo base_url('admin/dashboard'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    <?php $this->endSection(); ?>