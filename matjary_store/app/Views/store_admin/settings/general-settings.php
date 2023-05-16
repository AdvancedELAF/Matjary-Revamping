<?php 
$session = \Config\Services::session(); 
$lang_session = $session->get('lang_session');
$ses_lang = $session->get('ses_lang');
$name ="";
$description ="";
if($ses_lang == 'en'){
    if(isset($settingModel[0]['name']) && !empty($settingModel[0]['name'])){
        $name = $settingModel[0]['name'];
    }else{
        $name = isset($settingModel[0]['name_ar']) ? $settingModel[0]['name_ar'] : '' ;
    }

    if(isset($settingModel[0]['address']) && !empty($settingModel[0]['address'])){
        $address = $settingModel[0]['address'];
    }else{
        $address = isset($settingModel[0]['address_ar']) ? $settingModel[0]['address_ar'] : '' ;
    }  
    
    if(isset($settingModel[0]['short_desc']) && !empty($settingModel[0]['short_desc'])){
        $short_desc = $settingModel[0]['short_desc'];
    }else{
        $short_desc = isset($settingModel[0]['short_desc_ar']) ? $settingModel[0]['short_desc_ar'] : '' ;
    }

    if(isset($settingModel[0]['long_desc']) && !empty($settingModel[0]['long_desc'])){
        $long_desc = $settingModel[0]['long_desc'];
    }else{
        $long_desc = isset($settingModel[0]['long_desc_ar']) ? $settingModel[0]['long_desc_ar'] : '' ;
    }
    
}else{
    if(isset($settingModel[0]['name_ar']) && !empty($settingModel[0]['name_ar'])){
        $name = $settingModel[0]['name_ar'];
    }else{
        $name = isset($settingModel[0]['name']) ? $settingModel[0]['name'] : '' ;
    }

    if(isset($settingModel[0]['address_ar']) && !empty($settingModel[0]['address_ar'])){
        $address = $settingModel[0]['address_ar'];
    }else{
        $address = isset($settingModel[0]['address']) ? $settingModel[0]['address'] : '' ;
    }

    if(isset($settingModel[0]['short_desc_ar']) && !empty($settingModel[0]['short_desc_ar'])){
        $short_desc = $settingModel[0]['short_desc_ar'];
    }else{
        $short_desc = isset($settingModel[0]['short_desc']) ? $settingModel[0]['short_desc'] : '' ;
    }

    if(isset($settingModel[0]['long_desc_ar']) && !empty($settingModel[0]['long_desc_ar'])){
        $long_desc = $settingModel[0]['long_desc_ar'];
    }else{
        $long_desc = isset($settingModel[0]['long_desc']) ? $settingModel[0]['long_desc'] : '' ;
    }
    
}
?>
<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4><?php echo $language['General Settings']; ?></h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Settings']; ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $language['General Settings']; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 card-box">
                <?php 
                if(!empty($settingModel)){
                    $attributes = ['name' => 'update_general_setting_form', 'id' => 'update_general_setting_form', 'autocomplete' => 'off',]; 
                    echo form_open_multipart('admin/update-general-settings',$attributes); 
                }else{
                    $attributes = ['name' => 'save_general_setting_form', 'id' => 'save_general_setting_form', 'autocomplete' => 'off',]; 
                    echo form_open_multipart('admin/save-general-setting',$attributes); 
                }
                ?> 
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="setting_id" value="<?php echo isset($settingModel[0]['id'])?$settingModel[0]['id']:''; ?>" />
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <h5 class="h4 text-blue mb-20"><?php echo $language['Store Basic Settings']; ?></h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label><?php echo $language['Logo']; ?></label>
                                    <input type="file" class="form-control"  name="logo"  value="<?php echo isset($settingModel[0]['logo'])?$settingModel[0]['logo']:''; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <?php if(isset($settingModel[0]['logo']) && !empty($settingModel[0]['logo'])){ ?>
                                    <img src="<?php echo base_url('uploads/logo/'); ?>/<?php echo isset($settingModel[0]['logo'])?$settingModel[0]['logo']:''; ?>"  class="img img-responsive" style="width:auto;min-width:70px;max-width:70px;heihgt:auto;min-height:70px;max-height:70px;"></h5></td>
                                    <a href="javascript:void(0);" class="btn btn-danger btn-xs removeImg" data-actionurl="<?php echo base_url('admin/delete-image'); ?>" data-imgname="<?php echo isset($settingModel[0]['logo'])?$settingModel[0]['logo']:''; ?>" data-id="<?php echo $settingModel[0]['id']; ?>" data-tablename="Setting" data-tablecolumn="logo"><i class="dw dw-delete-3"></i></a>
                                    <?php }else{ ?>
                                    <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Logo | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                                <?php } ?> 
                            </div> 
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label><?php echo $language['favicon']; ?></label>
                                    <input type="file" class="form-control"   name="favicon" id="favicon" value="<?php echo isset($settingModel[0]['favicon'])?$settingModel[0]['favicon']:''; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <?php if(isset($settingModel[0]['favicon']) && !empty($settingModel[0]['favicon'])){ ?>
                                    <img src="<?php echo base_url('uploads/favicon/'); ?>/<?php echo isset($settingModel[0]['favicon'])?$settingModel[0]['favicon']:''; ?>"  class="img img-responsive" style="width:auto;min-width:70px;max-width:70px;heihgt:auto;min-height:70px;max-height:70px;"></h5></td>
                                    <a href="javascript:void(0);" class="btn btn-danger btn-xs removeImg" data-actionurl="<?php echo base_url('admin/delete-image'); ?>" data-imgname="<?php echo isset($settingModel[0]['favicon'])?$settingModel[0]['favicon']:''; ?>" data-id="<?php echo $settingModel[0]['id']; ?>" data-tablename="Settings" data-tablecolumn="favicon"><i class="dw dw-delete-3"></i></a>
                                    <?php }else{ ?>
                                    <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="favicon | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                                <?php } ?> 
                            </div> 
            
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label><?php echo $language['Store Name']; ?></label>
                                    <input type="text" class="form-control" placeholder="<?php echo $language['Store Name']; ?>" <?php echo $ses_lang == 'en' ? 'name="name" id="name"' : 'name="name_ar" id="name_ar"'; ?> value="<?php echo $name; ?>" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label><?php echo $language['Store Email']; ?></label>
                                    <input type="email" class="form-control" placeholder="<?php echo $language['Store Email']; ?>" id="site_email" name="site_email"  value="<?php echo isset($settingModel[0]['site_email'])?$settingModel[0]['site_email']:''; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label><?php echo $language['Choose Store Template']; ?></label>
                                    <select name="template_id" id="template_id" class="form-control">
                                        <option value=""><?php echo $language['Select Template']; ?></option>
                                        <?php 
                                        if(isset($matjaryTmpltList) && !empty($matjaryTmpltList)){
                                            foreach($matjaryTmpltList as $matjaryTmpltData){
                                                 
                                        ?>
                                        <option value="<?php echo $matjaryTmpltData['id']; ?>" <?php if($settingModel[0]['template_id']==$matjaryTmpltData['id']){echo'selected';} ?>><?php echo $matjaryTmpltData['name']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label><?php echo $language['Address']; ?></label>
                                    <textarea class="form-control" placeholder="<?php echo $language['Store Address']; ?>" <?php echo $ses_lang == 'en' ? 'name="address" id="address"' : 'name="address_ar" id="address_ar"'; ?> maxlength ="52" ><?php echo $address; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label><?php echo $language['Short Description']; ?></label>
                                    <textarea class="form-control" rows="4" placeholder="<?php echo $language['Short Description']; ?>" <?php echo $ses_lang == 'en' ? 'name="short_desc" id="short_desc"' : 'name="short_desc_ar" id="short_desc_ar"'; ?> ><?php echo $short_desc; ?></textarea>
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label><?php echo $language['Long Description']; ?></label>
                                    <textarea class="form-control" rows="4" placeholder="<?php echo $language['Long Description']; ?>" <?php echo $ses_lang == 'en' ? 'name="long_desc" id="long_desc"' : 'name="long_desc_ar" id="long_desc_ar"'; ?>><?php echo $long_desc; ?></textarea>
                                </div>
                                
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label><?php echo $language['Administrator Email']; ?></label>
                                    <input type="email" class="form-control" placeholder="<?php echo $language['Administrator Email']; ?>" id="administraitor_email" name="administraitor_email"  value="<?php echo isset($settingModel[0]['administraitor_email'])?$settingModel[0]['administraitor_email']:''; ?>">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label><?php echo $language['Contact Number']; ?></label>
                                    <input type="tel" class="form-control numberonly" placeholder="<?php echo $language['Contact Number']; ?>" id="contact_no" name="contact_no" minlength="9" maxlength="10" value="<?php echo isset($settingModel[0]['contact_no'])?$settingModel[0]['contact_no']:''; ?>" >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label><?php echo $language['Support Email Address']; ?></label>
                                    <input type="email" class="form-control" placeholder="<?php echo $language['Support Email Address']; ?>" id="support_email" name="support_email" value="<?php echo isset($settingModel[0]['support_email'])?$settingModel[0]['support_email']:''; ?>">
                                </div>
                            </div>

                        </div>                              
                        <h5 class="h4 text-blue mb-20 mt-3"><?php echo $language['Store Social Media Settings']; ?></h5>
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-2">
                                    <label><?php echo $language['Facebook URL']; ?></label>
                                    <input type="url" class="form-control" placeholder="Facebook URL" id="social_fb_link" name="social_fb_link" value="<?php echo isset($settingModel[0]['social_fb_link'])?$settingModel[0]['social_fb_link']:''; ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-2">
                                    <label>Instagram URL</label>
                                    <input type="url" class="form-control" placeholder="Instagram URL" id="social_instagram_link" name="social_instagram_link" value="<?php echo isset($settingModel[0]['social_instagram_link'])?$settingModel[0]['social_instagram_link']:''; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-2">
                                    <label>YouTube URL</label>
                                    <input type="url" class="form-control" placeholder="YouTube URL" id="social_youtube_link" name="social_youtube_link" value="<?php echo isset($settingModel[0]['social_youtube_link'])?$settingModel[0]['social_youtube_link']:''; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-2">
                                    <label>Twitter URL</label>
                                    <input type="url" class="form-control" placeholder="Twitter URL" id="social_twitter_link" name="social_twitter_link" value="<?php echo isset($settingModel[0]['social_twitter_link'])?$settingModel[0]['social_twitter_link']:''; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-2">
                                    <label>Linkedin URL</label>
                                    <input type="url" class="form-control" placeholder="Linkedin URL" id="social_linkedin_link" name="social_linkedin_link" value="<?php echo isset($settingModel[0]['social_linkedin_link'])?$settingModel[0]['social_linkedin_link']:''; ?>">
                                </div>
                            </div>
                        </div>                        
                        <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                            <?php if(!empty($settingModel)){ ?>
                            <button class="btn btn-primary" type="submit"><?php echo $language['Update']; ?></button>
                            <?php }else { ?>
                                <button class="btn btn-primary" type="submit"><?php echo $language['Save']; ?></button>
                            <?php } ?>
                            
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>