<?php 
$session = \Config\Services::session(); 
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
                                <h4><?php echo $language['Shipping Settings']; ?></h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Settings']; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Shipping Settings']; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                        <div class="pd-20 card-box">
                            <?php 
                            if(!empty($shippingInfo)){
                                $attributes = ['name' => 'update_shipping_setting_form', 'id' => 'update_shipping_setting_form', 'autocomplete' => 'off',]; 
                                echo form_open_multipart('admin/update-shipping-settings',$attributes);
                            }else{
                                $attributes = ['name' => 'save_shipping_setting_form', 'id' => 'save_shipping_setting_form', 'autocomplete' => 'off',]; 
                                echo form_open_multipart('admin/save-shipping-setting',$attributes); 
                            }
                            ?> 
                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <h5 class="h4 text-blue mt-3 mb-20"><?php echo $language['Shipping Service Companies']; ?></h5>
                                <?php
                                    if(isset($shippingCompanies) && !empty($shippingCompanies)){
                                        $i=1;
                                        foreach($shippingCompanies as $values){
                                            
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <?php 
                                            $shipCmpChk = '';
                                            if(isset($shippingInfo) && !empty($shippingInfo)){
                                                foreach ($shippingInfo as $key => $val) {
                                                    if($val->ship_cmp_id==$values->id){
                                                        $shipCmpChk = 'checked';
                                                    }
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" class="shipCmp" data-shipcmpid="<?php echo isset($values->id)?$values->id:''; ?>" <?php echo $shipCmpChk; ?>>
                                            <label for="aramexShippingCheck"><?php echo isset($values->name)?$values->name:''; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div id="shipping_setting_form_<?php echo isset($values->id)?$values->id:0; ?>_wrapper">
                                    <?php
                                    if(isset($shippingInfo) && !empty($shippingInfo)){
                                        foreach ($shippingInfo as $key => $val) {
                                            if($val->ship_cmp_id==$values->id){
                                                $shipCmpInfo = unserialize($val->ship_cmp_data);
                                                if($val->ship_cmp_id==1){
                                    ?>
                                                    <div class="row ship_cmp_form_div" id="Form<?php echo isset($val->ship_cmp_id)?$val->ship_cmp_id:''; ?>">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-11">
                                                            <div class="row">
                                                                <input type="hidden" name="ship_cmp_id[]" value="<?php echo isset($val->ship_cmp_id)?$val->ship_cmp_id:''; ?>">
                                                                <input type="hidden" name="ship_cmp_city[]" value="Riyadh">
                                                                <input type="hidden" name="ship_cmp_country_code[]" value="SA">
                                                                
                                                                <div class="col-md-12">
                                                                    <label><?php echo $language['Shipping Address (Note : Only 50 charactors are allowed)']; ?></label>
                                                                    <div class="mb-2">
                                                                        <textarea name="address[]" class="form-control" maxlength ="52" rows="2" placeholder="<?php echo $language['Shipping Address']; ?>" id="address"  ><?php echo isset($shipCmpInfo['address'])?$shipCmpInfo['address']:''; ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label><?php echo $language['Zipcode']; ?></label>
                                                                    <div class="mb-2">
                                                                        <input type="text" name="zipcode[]" class="form-control numberonly" value="<?php echo isset($shipCmpInfo['zipcode'])?$shipCmpInfo['zipcode']:''; ?>" placeholder="<?php echo $language['Zipcode']; ?>" id="zipcode"  minlength="5" maxlength="6">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label><?php echo $language['Shipping Cost in Flat Price']; ?></label>
                                                                    <div class="mb-2">
                                                                        <input type="text" name="cost[]" class="form-control floatNumberOnly" value="<?php echo isset($shipCmpInfo['cost'])?$shipCmpInfo['cost']:''; ?>" maxlength="8" placeholder="<?php echo $language['Shipping Cost in Flat Price']; ?>" id="cost"  >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label><?php echo $language['Aramex Account Number']; ?></label>
                                                                    <div class="mb-2">
                                                                        <input type="text" name="ac_no[]" id="ac_no" class="form-control numberonly"  maxlength="15" value="<?php echo isset($shipCmpInfo['ac_no'])?$shipCmpInfo['ac_no']:''; ?>" placeholder="<?php echo $language['Aramex Account Number']; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label><?php echo $language['Aramex Account Pin']; ?></label>
                                                                    <div class="mb-2">
                                                                        <input type="text" name="ac_pin[]" id="ac_pin" class="form-control numberonly" value="<?php echo isset($shipCmpInfo['ac_pin'])?$shipCmpInfo['ac_pin']:''; ?>" placeholder="<?php echo $language['Aramex Account Pin']; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label><?php echo $language['Aramex Username']; ?></label>
                                                                    <div class="mb-2">
                                                                        <input type="text" name="username[]" id="username" class="form-control" value="<?php echo isset($shipCmpInfo['username'])?$shipCmpInfo['username']:''; ?>" placeholder="<?php echo $language['Aramex Username']; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label><?php echo $language['Aramex Password']; ?></label>
                                                                    <div class="mb-2">
                                                                        <input type="password" name="password[]" id="password" class="form-control" value="<?php echo isset($shipCmpInfo['password'])?$shipCmpInfo['password']:''; ?>" placeholder="<?php echo $language['Aramex Password']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                    <?php
                                                }elseif($val->ship_cmp_id==2){
                                    ?>
                                                    <div class="row ship_cmp_form_div" id="Form<?php echo isset($val->ship_cmp_id)?$val->ship_cmp_id:''; ?>">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-11">
                                                            <div class="row">
                                                                <input type="hidden" name="ship_cmp_id[]" value="<?php echo isset($val->ship_cmp_id)?$val->ship_cmp_id:''; ?>">
                                                                <div class="col-md-12">
                                                                    <label><?php echo $language['Shipping Address']; ?></label>
                                                                    <div class="mb-2">
                                                                        <textarea name="address[]" class="form-control" rows="2" placeholder="<?php echo $language['Shipping Address']; ?>" id="address"  ><?php echo isset($shipCmpInfo['address'])?$shipCmpInfo['address']:''; ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label><?php echo $language['Shipping Cost']; ?></label>
                                                                    <div class="mb-2">
                                                                        <input type="text" name="cost[]" class="form-control" value="<?php echo isset($shipCmpInfo['cost'])?$shipCmpInfo['cost']:''; ?>" placeholder="<?php echo $language['Shipping Cost']; ?><" id="cost"  >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label><?php echo $language['ZipShip Account Number']; ?></label>
                                                                    <div class="mb-2">
                                                                        <input type="text" name="ac_no[]" id="ac_no" class="form-control" value="<?php echo isset($shipCmpInfo['ac_no'])?$shipCmpInfo['ac_no']:''; ?>" placeholder="<?php echo $language['ZipShip Account Number']; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label><?php echo $language['ZipShip Username']; ?></label>
                                                                    <div class="mb-2">
                                                                        <input type="text" name="username[]" id="username" class="form-control" value="<?php echo isset($shipCmpInfo['username'])?$shipCmpInfo['username']:''; ?>" placeholder="ZipShip Username">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label><?php echo $language['ZipShip Password']; ?></label>
                                                                    <div class="mb-2">
                                                                        <input type="password" name="password[]" id="password" class="form-control" value="<?php echo isset($shipCmpInfo['password'])?$shipCmpInfo['password']:''; ?>" placeholder="ZipShip Password">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                    <?php
                                                }
                                    ?>
                                                
                                    <?php
                                            }
                                        }
                                    }
                                    ?>

                                </div>
                                <hr>
                                <?php
                                            $i++;
                                        }
                                    }else{
                                        echo $language['No Shipping Services Available Now.'];
                                    }
                                ?>
                                <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                                    <?php 
                                    $submitBtnTxt = $language['Save'];
                                    if(isset($shippingInfo) && !empty($shippingInfo)){ 
                                        $submitBtnTxt = $language['Update'];
                                    }
                                    ?>
                                    <button class="btn btn-primary" type="submit"><?php echo $submitBtnTxt; ?></button>
                                    <a href="<?php echo base_url('admin/shipping-settings'); ?>" class="btn btn-secondary" ><?php echo$language['Cancel']; ?></a>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
<?php $this->endSection(); ?>


