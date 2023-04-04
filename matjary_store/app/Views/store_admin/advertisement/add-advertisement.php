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
                    <h4><?php echo $language['Add Advertisement']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Manage']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Advertisements']; ?></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Add Advertisement']; ?></li>
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
                        $attributes = ['name' => 'save_advertisement_form', 'id' => 'save_advertisement_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/save-advertisement',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <div class="row">
                    <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Advertisement Image']; ?></label>
                                <input type="file" name="add_img" id="add_img" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Title']; ?></label>
                                <input type="text" <?php echo $ses_lang == 'en' ? 'name="title" id="title"' : 'name="title_ar" id="title_ar"'; ?>  class="form-control" placeholder="<?php echo $language['Title']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Sub Title']; ?></label>
                                <input type="text" <?php echo $ses_lang == 'en' ? 'name="sub_title" id="sub_title"' : 'name="sub_title_ar" id="sub_title_ar"'; ?>  class="form-control" placeholder="<?php echo $language['Sub Title']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Advertisement Link']; ?></label>
                                <input type="url" name="advertise_link" id="advertise_link" class="form-control" placeholder="<?php echo $language['Advertisement Link']; ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                                <div class="mb-2">
                                <label><?php echo $language['Select Position']; ?>*</label>
                                    <select class="custom-select" id="add_position" name="add_position">
                                        <option value=""><?php echo $language['Select Position']; ?> </option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                        <button class="btn btn-primary" type="submit"><?php echo $language['Save']; ?></button>
                        <a href="<?php echo base_url('admin/all-advertisements'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>

</div>
<?php $this->endSection(); ?>