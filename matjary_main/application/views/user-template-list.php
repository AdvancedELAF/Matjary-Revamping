<?php include("modals/template_modal.php"); ?>

<section class="">
    <div class="custom-container">
        <div class="user-sec-title">
            <h4><?php echo $this->lang->line('user-acc-txt-4'); ?></h4>
        </div>

        <div class="dash-wrap blue-bg mb-4">

            <div class="alert <?php echo isset($msg_class)?$msg_class:''; ?> alert-dismissible fade show mx-auto text-center billing-alert" role="alert">
                <strong>
                    <?php
                    if ($msg = $this->session->flashdata('msg')) {
                        $msg_class = $this->session->flashdata('msg_class');
                        echo $msg;
                    }
                    ?>
                </strong>
            </div> 

            <div class="row">
                <?php
                if (isset($user_purchased_templates)) {
                    $i = 1;
                    foreach ($user_purchased_templates as $value) {
                        $i++;
                        $wowdelay = $i * 3;
                        //echo '<pre>'; print_r($value); exit;
                        $templateName = 'NA';
                        $templateDescription = 'NA';
                        $site_lang = isset($_SESSION["site_lang"])?$_SESSION["site_lang"]:'ar';
                        if($site_lang=='en'){
                            if(isset($value->name) && !empty($value->name)){
                                $templateName = $value->name;
                            }else{
                                if(isset($value->name_ar) && !empty($value->name_ar)){
                                    $templateName = $value->name_ar;
                                }
                            }
                        }else{
                            if(isset($value->name_ar) && !empty($value->name_ar)){
                                $templateName = $value->name_ar;
                            }else{
                                if(isset($value->name) && !empty($value->name)){
                                    $templateName = $value->name;
                                }
                            }
                        }

                        if($site_lang=='en'){
                            if(isset($value->description) && !empty($value->description)){
                                $templateDescription = $value->description;
                            }else{
                                if(isset($value->description_ar) && !empty($value->description_ar)){
                                    $templateDescription = $value->description_ar;
                                }
                            }
                        }else{
                            if(isset($value->description_ar) && !empty($value->description_ar)){
                                $templateDescription = $value->description_ar;
                            }else{
                                if(isset($value->description) && !empty($value->description)){
                                    $templateDescription = $value->description;
                                }
                            }
                        }
                        
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="template-card wow fadeIn" data-wow-delay="<?php echo $wowdelay; ?>00ms">
                                <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/matjary_templates/<?php echo isset($value->template_half_banner) ? $value->template_half_banner : "matjary-default-banner.png"; ?>">
                                <h4><?php echo $templateName; ?></h4>
                                <p><?php echo $templateDescription; ?></p>
                                <p class="text-center mb-1"><a href="#" data-toggle="modal" onclick="show_template_details(<?php echo $value->id; ?>, <?php echo $value->template_cost; ?>,<?php echo $value->free_paid_flag; ?>, <?php if($value->tmp_purchase_status==false){echo'false';}else{echo'true';}; ?>, 'read', '<?php echo $_SESSION['site_lang']; ?>');"><?php echo $this->lang->line('return-txt-8'); ?></a></p>
                                <div class="d-grid gap-2 d-md-block text-center">
                                    <button class="btn btn-primary brand-btn-purple" onclick="show_template_details(<?php echo $value->id; ?>, <?php echo $value->template_cost; ?>,<?php echo $value->free_paid_flag; ?>, <?php if($value->tmp_purchase_status==false){echo'false';}else{echo'true';}; ?>, 'view', '<?php echo $_SESSION['site_lang']; ?>');"><?php echo $this->lang->line('view_txt'); ?></button>
                                    <a class="btn btn-primary brand-btn-purple" target="_blank" href="<?php echo $value->demo_link; ?>"><?php echo $this->lang->line('demo'); ?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <p><?php echo $this->lang->line('no_data_found'); ?></p>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
</section>