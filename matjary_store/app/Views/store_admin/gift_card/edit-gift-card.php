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
                    <h4><?php echo $language['Update Gift Card']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Gift Card']; ?></a></li>                        
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Update Gift Card']; ?></li>
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
                        $attributes = ['name' => 'update_gift_card_form', 'id' => 'update_gift_card_form', 'autocomplete' => 'off']; 
                        echo form_open_multipart('admin/update-gift-card',$attributes); 
                    ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="id" value="<?php echo isset($GiftCardDetails['id'])?$GiftCardDetails['id']:''; ?>" />
                    <div class="row">
                        <div class="col-md-12">
                           <div class="mb-2">
                                <label><?php echo $language['Name']; ?></label>
                                <input type="text" <?php echo $ses_lang == 'en' ? 'name="name" id="name"' : 'name="name_ar" id="name_ar"'; ?> class="form-control" placeholder="<?php echo $language['Title']; ?>" value="<?php echo  $ses_lang == 'en' ? $GiftCardDetails['name'] : $GiftCardDetails['name_ar']; ?>">
                            </div>
                        </div>                        
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label><?php echo $language['Gift Image']; ?></label>
                                <input type="file" name="image" id="image" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php if(isset($GiftCardDetails['image']) && !empty($GiftCardDetails['image'])){ ?>
                                <img src="<?php echo base_url('uploads/giftcards/'); ?>/<?php echo isset($GiftCardDetails['image'])?$GiftCardDetails['image']:''; ?>"  class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;heihgt:auto;min-height:100px;max-height:100px;">
                                <a href="<?php echo base_url('uploads/giftcards/'); ?>/<?php echo isset($GiftCardDetails['image'])?$GiftCardDetails['image']:''; ?>" target="_blank">click to view</a> 
                                <a href="javascript:void(0);" class="btn btn-danger btn-xs removeImg" data-actionurl="<?php echo base_url('admin/delete-image'); ?>" data-imgname="<?php echo isset($GiftCardDetails['image'])?$GiftCardDetails['image']:''; ?>" data-id="<?php echo $GiftCardDetails['id']; ?>" data-tablename="giftcards" data-tablecolumn="image"><i class="dw dw-delete-3"></i></a>
                            <?php }else{ ?>
                                <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Banner image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                            <?php } ?> 
                        </div>
                        <div class="col-md-6">
                                <div class="mb-2">
                                    <label><?php echo $language['Start Date']; ?></label>
                                    <input type="date" class="form-control" placeholder="<?php echo $language['Start Date']; ?>" id="start_date" name="start_date" value="<?php echo isset($GiftCardDetails['start_date'])?$GiftCardDetails['start_date']:''; ?>" >
                                </div>
                        </div>
                        <div class="col-md-6">
                                <div class="mb-2">
                                    <label><?php echo $language['Expiry Date']; ?></label>
                                    <input type="date" class="form-control" placeholder="<?php echo $language['Expiry Date']; ?>" id="expiry_date" name="expiry_date" value="<?php echo isset($GiftCardDetails['expiry_date'])?$GiftCardDetails['expiry_date']:''; ?>" >
                                </div>
                        </div>                      
                    </div>
                    <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                        <button class="btn btn-primary" type="submit"><?php echo $language['Update']; ?></button>
                        <a href="<?php echo base_url('admin/all-gift-cards'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>