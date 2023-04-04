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
                    <h4><?php echo $language['Edit User']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Users']; ?></a></li>                        
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Edit User']; ?></li>
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
                        $attributes = ['name' => 'update_user_form', 'id' => 'update_user_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/update-user',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="user_id" value="<?php echo isset($userDetails['id'])?$userDetails['id']:''; ?>" />
                    <div class="row">
                        <div class="col-md-6 ">
                            <label><?php echo $language['Name']; ?></label>
                            <div class="mb-2">
                            <input type="text" class="form-control" placeholder="<?php echo $language['Name']; ?>" name="name" id="name" value="<?php echo isset($userDetails['name'])?$userDetails['name']:''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label><?php echo $language['Email']; ?></label>
                            <div class="mb-2">
                            <input type="email" disabled class="form-control" placeholder="<?php echo $language['Email']; ?>*" name="email" id="email" value="<?php echo isset($userDetails['email'])?$userDetails['email']:''; ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label><?php echo $language['Residental Address']; ?></label>
                            <div class="mb-2">
                            <textarea class="form-control" placeholder="v" name="addr_residential" id="addr_residential"><?php echo isset($userDetails['addr_residential'])?$userDetails['addr_residential']:''; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label><?php echo $language['Permanent Address']; ?></label>
                            <div class="mb-2">
                            <textarea class="form-control" placeholder="<?php echo $language['Permanent Address']; ?>" name="addr_permanent" id="addr_permanent"><?php echo isset($userDetails['addr_permanent'])?$userDetails['addr_permanent']:''; ?></textarea>
                            </div>
                        </div>                                
                        <div class="col-md-6">   
                            <label><?php echo $language['Contact Number']; ?></label>
                            <div class="mb-2">
                                <input type="text" value="<?php echo isset($userDetails['contact_no'])?$userDetails['contact_no']:''; ?>" class="form-control numberonly" placeholder="<?php echo $language['Contact Number']; ?>" name="contact_no" id="contact_no" minlength="9" maxlength="10">
                            </div>                                  
                        </div>
                        <div class="col-md-6">
                            <label><?php echo $language['Role']; ?></label>
                            <div class="mb-2">
                                <select class="form-control" name="role_id" id="role_id" disabled>
                                    <option value=""><?php echo $language['User Type']; ?></option>                                             
                                    <?php 
                                        if (isset($UserroleList) && !empty($UserroleList)) {
                                            foreach ($UserroleList as $values ) { 
                                                $selected = '';
                                                if($userDetails['role_id']==$values->id){
                                                    $selected = 'selected';
                                                }
                                    ?>
                                    <option value="<?=$values->id; ?>" <?php echo $selected; ?>><?=$values->role_name;?></option>
                                    <?php 
                                            } 
                                        }
                                    ?>    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                        <button class="btn btn-primary" type="submit"><?php echo $language['Save']; ?></button>
                        <a href="<?php echo base_url('admin/all-users'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>

</div>
<?php $this->endSection(); ?>