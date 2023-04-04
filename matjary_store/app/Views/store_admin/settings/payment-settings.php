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
                                <h4><?php echo $language['Payment Settings']; ?></h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Settings']; ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Payment Settings']; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
               
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                        <div class="pd-20 card-box">
                            <?php 
                            if(!empty($paymentInfo)){
                                $attributes = ['name' => 'update_payment_setting_form', 'id' => 'update_payment_setting_form', 'autocomplete' => 'off',]; 
                                echo form_open_multipart('admin/update-payment-settings',$attributes);
                            }else{
                                $attributes = ['name' => 'save_payment_setting_form', 'id' => 'save_payment_setting_form', 'autocomplete' => 'off',]; 
                                echo form_open_multipart('admin/save-payment-setting',$attributes); 
                            }
                            ?> 
                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <h5 class="h4 text-blue mt-3 mb-20"><?php echo $language['Payment Gateway Service Companies']; ?></h5>
                                <?php
                                    if(isset($paymentCompanies) && !empty($paymentCompanies)){
                                        $i=1;
                                        foreach($paymentCompanies as $values){
                                            
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <?php 
                                            $payCmpChk = '';
                                            if(isset($paymentInfo) && !empty($paymentInfo)){
                                                foreach ($paymentInfo as $key => $val) {
                                                    if($val->pay_cmp_id==$values->id){
                                                        $payCmpChk = 'checked';
                                                    }
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" class="payCmp" data-paycmpid="<?php echo isset($values->id)?$values->id:''; ?>" <?php echo $payCmpChk; ?>>
                                            <label for="aramexShippingCheck"><?php echo isset($values->name)?$values->name:''; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div id="payment_setting_form_<?php echo isset($values->id)?$values->id:0; ?>_wrapper">
                                    <?php
                                    if(isset($paymentInfo) && !empty($paymentInfo)){
                                        foreach ($paymentInfo as $key => $val) {
                                            if($val->pay_cmp_id==$values->id){
                                                $payCmpInfo = isset($val->pay_cmp_data)?unserialize($val->pay_cmp_data):'';
                                                if($val->pay_cmp_id==1){
                                    ?>
                                                <div class="row pay_cmp_form_div" id="Form<?php echo $val->pay_cmp_id; ?>">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <input type="hidden" name="pay_cmp_id[]" value="<?php echo $val->pay_cmp_id; ?>">
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Account Number']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="ac_no[]" id="ac_no" class="form-control numberonly" maxlength="15" value="<?php echo $payCmpInfo['ac_no']; ?>" placeholder="<?php echo $language['Payment Account Number']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Username']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="username[]" id="username" class="form-control" value="<?php echo $payCmpInfo['username']; ?>" placeholder="<?php echo $language['Payment Username']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Password']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="password" name="password[]" id="password" class="form-control" value="<?php echo $payCmpInfo['password']; ?>" placeholder="<?php echo $language['Payment Password']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                                }elseif($val->pay_cmp_id==2){
                                    ?>
                                                <div class="row pay_cmp_form_div" id="Form<?php echo $val->pay_cmp_id; ?>">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <input type="hidden" name="pay_cmp_id[]" value="<?php echo $val->pay_cmp_id; ?>">
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Account Number']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="ac_no[]" id="ac_no" class="form-control" value="<?php echo $payCmpInfo['ac_no']; ?>" placeholder="<?php echo $language['Payment Account Number']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Username']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="username[]" id="username" class="form-control" value="<?php echo $payCmpInfo['username']; ?>" placeholder="<?php echo $language['Payment Username']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Password']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="password" name="password[]" id="password" class="form-control" value="<?php echo $payCmpInfo['password']; ?>" placeholder="<?php echo $language['Payment Password']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                                }elseif($val->pay_cmp_id==3){
                                    ?>
                                                <div class="row pay_cmp_form_div" id="Form<?php echo $val->pay_cmp_id; ?>">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <input type="hidden" name="pay_cmp_id[]" value="<?php echo $val->pay_cmp_id; ?>">
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Account Number']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="ac_no[]" id="ac_no" class="form-control" value="<?php echo $payCmpInfo['ac_no']; ?>" placeholder="<?php echo $language['Payment Account Number']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Username']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="username[]" id="username" class="form-control" value="<?php echo $payCmpInfo['username']; ?>" placeholder="<?php echo $language['Payment Username']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Password']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="password" name="password[]" id="password" class="form-control" value="<?php echo $payCmpInfo['password']; ?>" placeholder="<?php echo $language['Payment Password']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php 
                                                }elseif($val->pay_cmp_id==4){
                                    ?>
                                                <div class="row pay_cmp_form_div" id="Form<?php echo $val->pay_cmp_id; ?>">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <input type="hidden" name="pay_cmp_id[]" value="<?php echo $val->pay_cmp_id; ?>">
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Account Number']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="ac_no[]" id="ac_no" class="form-control" value="<?php echo $payCmpInfo['ac_no']; ?>" placeholder="<?php echo $language['Payment Account Number']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Username']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="username[]" id="username" class="form-control" value="<?php echo $payCmpInfo['username']; ?>" placeholder="<?php echo $language['Payment Username']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Password']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="password" name="password[]" id="password" class="form-control" value="<?php echo $payCmpInfo['password']; ?>" placeholder="<?php echo $language['Payment Password']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php 
                                                }elseif($val->pay_cmp_id==5){ //echo '<pre>'; print_r($payCmpInfo); exit;
                                    ?>
                                                <div class="row pay_cmp_form_div" id="Form<?php echo $val->pay_cmp_id; ?>">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <input type="hidden" name="pay_cmp_id[]" value="<?php echo $val->pay_cmp_id; ?>">
                                                            <div class="col-md-4">
                                                                <label>Profile ID</label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="profile_id[]" id="profile_id" class="form-control" value="<?php echo isset($payCmpInfo['profile_id'])?$payCmpInfo['profile_id']:''; ?>" placeholder="PayTabs Profile ID">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>API Key</label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="apikey[]" id="apikey" class="form-control" value="<?php echo isset($payCmpInfo['apikey'])?$payCmpInfo['apikey']:''; ?>" placeholder="API KEY">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php 
                                                }elseif($val->pay_cmp_id==6){
                                    ?>
                                                <div class="row pay_cmp_form_div" id="Form<?php echo $val->pay_cmp_id; ?>">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <input type="hidden" name="pay_cmp_id[]" value="<?php echo $val->pay_cmp_id; ?>">
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Account Number']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="ac_no[]" id="ac_no" class="form-control" value="<?php echo $payCmpInfo['ac_no']; ?>" placeholder="<?php echo $language['Payment Account Number']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Username']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="username[]" id="username" class="form-control" value="<?php echo $payCmpInfo['username']; ?>" placeholder="<?php echo $language['Payment Username']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Password']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="password" name="password[]" id="password" class="form-control" value="<?php echo $payCmpInfo['password']; ?>" placeholder="<?php echo $language['Payment Password']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php 
                                                }elseif($val->pay_cmp_id==7){
                                    ?>
                                                <div class="row pay_cmp_form_div" id="Form<?php echo $val->pay_cmp_id; ?>">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <input type="hidden" name="pay_cmp_id[]" value="<?php echo $val->pay_cmp_id; ?>">
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Account Number']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="ac_no[]" id="ac_no" class="form-control" value="<?php echo $payCmpInfo['ac_no']; ?>" placeholder="<?php echo $language['Payment Account Number']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Username']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="username[]" id="username" class="form-control" value="<?php echo $payCmpInfo['username']; ?>" placeholder="<?php echo $language['Payment Username']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Password']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="password" name="password[]" id="password" class="form-control" value="<?php echo $payCmpInfo['password']; ?>" placeholder="<?php echo $language['Payment Password']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php 
                                                }elseif($val->pay_cmp_id==8){
                                    ?>
                                                <div class="row pay_cmp_form_div" id="Form<?php echo $val->pay_cmp_id; ?>">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <input type="hidden" name="pay_cmp_id[]" value="<?php echo $val->pay_cmp_id; ?>">
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Account Number']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="ac_no[]" id="ac_no" class="form-control" value="<?php echo $payCmpInfo['ac_no']; ?>" placeholder="<?php echo $language['Payment Account Number']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Username']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="username[]" id="username" class="form-control" value="<?php echo $payCmpInfo['username']; ?>" placeholder="<?php echo $language['Payment Username']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Password']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="password" name="password[]" id="password" class="form-control" value="<?php echo $payCmpInfo['password']; ?>" placeholder="<?php echo $language['Payment Password']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php 
                                                }elseif($val->pay_cmp_id==9){
                                    ?>
                                                <div class="row pay_cmp_form_div" id="Form<?php echo $val->pay_cmp_id; ?>">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <input type="hidden" name="pay_cmp_id[]" value="<?php echo $val->pay_cmp_id; ?>">
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Account Number']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="ac_no[]" id="ac_no" class="form-control" value="<?php echo $payCmpInfo['ac_no']; ?>" placeholder="<?php echo $language['Payment Account Number']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Username']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="username[]" id="username" class="form-control" value="<?php echo $payCmpInfo['username']; ?>" placeholder="<?php echo $language['Payment Username']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Password']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="password" name="password[]" id="password" class="form-control" value="<?php echo $payCmpInfo['password']; ?>" placeholder="<?php echo $language['Payment Password']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php 
                                                }elseif($val->pay_cmp_id==10){
                                    ?>
                                                <div class="row pay_cmp_form_div" id="Form<?php echo $val->pay_cmp_id; ?>">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <input type="hidden" name="pay_cmp_id[]" value="<?php echo $val->pay_cmp_id; ?>">
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Account Number']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="ac_no[]" id="ac_no" class="form-control" value="<?php echo $payCmpInfo['ac_no']; ?>" placeholder="<?php echo $language['Payment Account Number']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Username']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="username[]" id="username" class="form-control" value="<?php echo $payCmpInfo['username']; ?>" placeholder="<?php echo $language['Payment Username']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Password']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="password" name="password[]" id="password" class="form-control" value="<?php echo $payCmpInfo['password']; ?>" placeholder="<?php echo $language['Payment Password']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php 
                                                }elseif($val->pay_cmp_id==11){
                                    ?>
                                                <div class="row pay_cmp_form_div" id="Form<?php echo $val->pay_cmp_id; ?>">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <input type="hidden" name="pay_cmp_id[]" value="<?php echo $val->pay_cmp_id; ?>">
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Account Number']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="ac_no[]" id="ac_no" class="form-control" value="<?php echo $payCmpInfo['ac_no']; ?>" placeholder="<?php echo $language['Payment Account Number']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Username']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="username[]" id="username" class="form-control" value="<?php echo $payCmpInfo['username']; ?>" placeholder="<?php echo $language['Payment Username']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Password']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="password" name="password[]" id="password" class="form-control" value="<?php echo $payCmpInfo['password']; ?>" placeholder="<?php echo $language['Payment Password']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php 
                                                }elseif($val->pay_cmp_id==12){
                                    ?>
                                                <div class="row pay_cmp_form_div" id="Form<?php echo $val->pay_cmp_id; ?>">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <input type="hidden" name="pay_cmp_id[]" value="<?php echo $val->pay_cmp_id; ?>">
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Account Number']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="ac_no[]" id="ac_no" class="form-control" value="<?php echo $payCmpInfo['ac_no']; ?>" placeholder="<?php echo $language['Payment Account Number']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Username']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="username[]" id="username" class="form-control" value="<?php echo $payCmpInfo['username']; ?>" placeholder="<?php echo $language['Payment Username']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Password']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="password" name="password[]" id="password" class="form-control" value="<?php echo $payCmpInfo['password']; ?>" placeholder="<?php echo $language['Payment Password']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php 
                                                }elseif($val->pay_cmp_id==13){
                                    ?>
                                                <div class="row pay_cmp_form_div" id="Form<?php echo $val->pay_cmp_id; ?>">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <input type="hidden" name="pay_cmp_id[]" value="<?php echo $val->pay_cmp_id; ?>">
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Account Number']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="ac_no[]" id="ac_no" class="form-control" value="<?php echo $payCmpInfo['ac_no']; ?>" placeholder="Payment Account Number">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Username']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="text" name="username[]" id="username" class="form-control" value="<?php echo $payCmpInfo['username']; ?>" placeholder="<?php echo $language['Payment Username']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label><?php echo $language['Payment Password']; ?></label>
                                                                <div class="mb-2">
                                                                    <input type="password" name="password[]" id="password" class="form-control" value="<?php echo $payCmpInfo['password']; ?>" placeholder="<?php echo $language['Payment Password']; ?>">
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
                                        echo 'No Payment Gateway Services Available Now.';
                                    }
                                ?>
                                <div class="d-grid gap-2 d-md-block text-<?php echo $ses_lang == 'en'?'right':'left'; ?> mt-4">
                                    <?php 
                                    $submitBtnTxt = $language['Save'];
                                    if(isset($paymentInfo) && !empty($paymentInfo)){ 
                                        $submitBtnTxt = $language['Update'];
                                    }
                                    ?>
                                    <button class="btn btn-primary" type="submit"><?php echo $submitBtnTxt; ?></button>
                                    <a href="<?php echo base_url('admin/payment-settings'); ?>" class="btn btn-secondary" ><?php echo $language['Cancel']; ?></a>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
<?php $this->endSection(); ?>


