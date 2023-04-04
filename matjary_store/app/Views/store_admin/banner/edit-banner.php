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
                    <h4><?php echo $language['Update Banner']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Manage']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Banners']; ?></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Update Banner']; ?></li>
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
                        $attributes = ['name' => 'update_banner_form', 'id' => 'update_banner_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/update-banner',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="banner_id" value="<?php echo isset($bannerDetails['id'])?$bannerDetails['id']:''; ?>" />
                    <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                                <label><?php echo $language['Title']; ?></label>
                                <input type="text" <?php echo $ses_lang == 'en' ? 'name="title" id="title"' : 'name="title_ar" id="title_ar"'; ?> class="form-control" placeholder="<?php echo $language['Title']; ?>" value="<?php echo $ses_lang == 'en' ? $bannerDetails['title'] : $bannerDetails['title_ar']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Sub Title']; ?></label>
                                <input type="text" <?php echo $ses_lang == 'en' ? 'name="sub_title" id="sub_title"' : 'name="sub_title_ar" id="sub_title_ar"'; ?> class="form-control" placeholder="<?php echo $language['Sub Title']; ?>" value="<?php echo $ses_lang == 'en' ? $bannerDetails['sub_title'] : $bannerDetails['sub_title_ar']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Banner Image']; ?></label>
                                <input type="file" name="image" id="image" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php if(isset($bannerDetails['image']) && !empty($bannerDetails['image'])){ ?>
                                <img src="<?php echo base_url('uploads/banners/'); ?>/<?php echo isset($bannerDetails['image'])?$bannerDetails['image']:''; ?>" alt="Banner image | <?php echo isset($bannerDetails['title'])?$bannerDetails['title']:''; ?>" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;">
                                <a href="<?php echo base_url('uploads/banners/'); ?>/<?php echo isset($bannerDetails['image'])?$bannerDetails['image']:''; ?>" target="_blank">click to view</a> 
                                <a href="javascript:void(0);" class="btn btn-danger btn-xs removeImg" data-actionurl="<?php echo base_url('admin/delete-image'); ?>" data-imgname="<?php echo isset($bannerDetails['image'])?$bannerDetails['image']:''; ?>" data-id="<?php echo $bannerDetails['id']; ?>" data-tablename="banners" data-tablecolumn="image"><i class="dw dw-delete-3"></i></a>
                            <?php }else{ ?>
                                <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="<?php echo $language['Banner Image']; ?> | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                            <?php } ?> 
                        </div>
                        <div class="col-md-6">
                                <div class="mb-2">
                                    <label>URL</label>
                                    <input type="url" class="form-control" placeholder="URL" id="banner_url" name="banner_url" value="<?php echo isset($bannerDetails['banner_url'])?$bannerDetails['banner_url']:''; ?>" >
                                </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                        <button class="btn btn-primary" type="submit"><?php echo $language['Update']; ?></button>
                        <a href="<?php echo base_url('admin/all-banners'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>