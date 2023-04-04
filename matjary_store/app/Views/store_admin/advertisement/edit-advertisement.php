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
                    <h4><?php echo $language['Update Advertisement']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Manage']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Advertisements']; ?></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Update Advertisement']; ?></li>
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
                        $attributes = ['name' => 'update_advertisement_form', 'id' => 'update_advertisement_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/update-advertisement',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="id" value="<?php echo isset($advertisementDetails['id'])?$advertisementDetails['id']:''; ?>" />
                    <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                                <label><?php echo $language['Title']; ?></label>
                                <input type="text" <?php echo $ses_lang == 'en' ? 'name="title" id="title"' : 'name="title_ar" id="title_ar"'; ?>  class="form-control" placeholder="<?php echo $language['Title']; ?>" value="<?php echo  $ses_lang == 'en' ? $advertisementDetails['title'] : $advertisementDetails['title_ar']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Sub Title']; ?></label>
                                <input type="text" <?php echo $ses_lang == 'en' ? 'name="sub_title" id="sub_title"' : 'name="sub_title_ar" id="sub_title_ar"'; ?>  class="form-control" placeholder="<?php echo $language['Sub Title']; ?>" value="<?php echo  $ses_lang == 'en' ? $advertisementDetails['sub_title'] : $advertisementDetails['sub_title_ar']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Advertisement Image']; ?></label>
                                <input type="file" name="add_img" id="add_img" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php if(isset($advertisementDetails['add_img']) && !empty($advertisementDetails['add_img'])){ ?>
                                <img src="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementDetails['add_img'])?$advertisementDetails['add_img']:''; ?>" alt="Advertisement image | <?php echo isset($advertisementDetails['title'])?$advertisementDetails['title']:''; ?>" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;">
                                <a href="<?php echo base_url('uploads/advertisement/'); ?>/<?php echo isset($advertisementDetails['add_img'])?$advertisementDetails['add_img']:''; ?>" target="_blank">click to view</a> 
                                <a href="javascript:void(0);" class="btn btn-danger btn-xs removeImg" data-actionurl="<?php echo base_url('admin/delete-image'); ?>" data-imgname="<?php echo isset($advertisementDetails['add_img'])?$advertisementDetails['add_img']:''; ?>" data-id="<?php echo $advertisementDetails['id']; ?>" data-tablename="Advertisements" data-tablecolumn="add_img"><i class="dw dw-delete-3"></i></a>
                            <?php }else{ ?>
                                <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="<?php echo $language['Advertisement Image']; ?> | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                            <?php } ?> 
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Advertisement Link']; ?></label>
                                <input type="url" name="advertise_link" id="advertise_link" class="form-control" placeholder="<?php echo $language['Advertisement Link']; ?>" value="<?php echo isset($advertisementDetails['advertise_link'])?$advertisementDetails['advertise_link']:''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="mb-2">
                                <label><?php echo $language['Select Position']; ?></label>
                                    <select class="form-control"  name="add_position" id="add_position">
                                        <option value=""><?php echo $language['Select Position']; ?></option>
                                        <option value = "1" <?php if($advertisementDetails['add_position'] == '1') { echo 'selected' ; }?>>1</option>
                                        <option value = "2" <?php if($advertisementDetails['add_position'] == '2') { echo 'selected' ; }?>>2</option>                                                                                
                                        <option value = "3" <?php if($advertisementDetails['add_position'] == '3') { echo 'selected' ; }?>>3</option>  
                                        <option value = "4" <?php if($advertisementDetails['add_position'] == '4') { echo 'selected' ; }?>>4</option>  
                                        <option value = "5" <?php if($advertisementDetails['add_position'] == '5') { echo 'selected' ; }?>>5</option>  
                                    </select>
                             </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                        <button class="btn btn-primary" type="submit"><?php echo $language['Update']; ?> </button>
                        <a href="<?php echo base_url('admin/all-advertisements'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>