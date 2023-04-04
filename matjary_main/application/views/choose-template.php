<?php
if ($this->session->userdata('loggedInUsrData')) {
    $loggedInUsrData = $this->session->userdata('loggedInUsrData');
}
?>
<?php $this->load->view("common/header.php"); ?>
<?php $this->load->view("modals/template_modal.php"); ?>
<!-- CHOOSE DOMAIN MODAL STARTS -->
<div class="modal fade" id="chooseDomainModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content chooseDomain-modal-content">
            <div class="modal-header chooseDomain-modal-header">
                <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/logo-2.png">
                <button type="button" class="close chooseDomain-modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body chooseDomain-modal-body">
                <div class="chooseDomain-modal-form">
                    <form method="post" action="<?php echo base_url('user-billing'); ?>" name="save_user_plan_form" id="save_user_plan_form" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo isset($loggedInUsrData['id']) ? $loggedInUsrData['id'] : ''; ?>">
                        <input type="hidden" name="plan_id" id="plan_id" value="<?php echo isset($_POST['plan_id']) ? $_POST['plan_id'] : ''; ?>">
                        <input type="hidden" name="plan_price" id="plan_price" value="<?php echo sprintf('%.2f', $_POST['plan_price']); ?>">
                        <input type="hidden" name="template_price" id="template_price" value="">
                        <input type="hidden" name="plan_months" id="plan_months" value="<?php echo isset($_POST['plan_months']) ? $_POST['plan_months'] : ''; ?>">
                        <input type="hidden" name="template_id" id="template_id" value="">
                        <h4 class="chooseDomain-modal-title"><?php echo $this->lang->line('choose_domain'); ?></h4>
                        <h4 class="chooseDomain-modal-title"><?php echo $this->lang->line('plan_selected'); ?>: <span class="pink-highlighter font-weight-bold"><?php echo $this->lang->line('SAR'); ?> <?php echo sprintf('%.2f', $_POST['plan_price']); ?></span></h4>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="domain-checkbox-one" value="option1" checked="">
                            <label class="form-check-label" for="domain-checkbox-one"><?php echo $this->lang->line('use_domain_1') ?></label>
                        </div>
                        <div class="input-group mb-3 input-ltr">
                            <div class="input-group-prepend">
                                <span class="input-group-text domain-group-text">https://</span>
                            </div>
                            <input type="text" class="form-control nospecialchars" name="sub_domain_name" id="sub_domain_name" minlength="3" maxlength="20" required>
                            <div class="input-group-append">
                                <span class="input-group-text domain-group-text">.<?php echo $domain = str_ireplace('www.', '', parse_url(base_url(), PHP_URL_HOST)); ?></span>
                            </div>
                        </div>
                        <p id="isThisSubdomainAvailableMessage" class="text-center"></p>
                    </form>
                    <button class ="btn btn-primary mt-2 brand-btn-pink-popup mx-auto d-block" id="subDomainAvailSbtBtn" data-action = "<?php echo base_url('check-subdomain-availability'); ?>"><?php echo $this->lang->line('proceed'); ?></button>
                </div>
            </div>
            <div class="modal-footer chooseDomain-modal-footer">                
                <small><?php echo $this->lang->line('powered_by'); ?> <a href = "https://www.advancedelaf.com" target="_blank"><?php echo $this->lang->line('advanced-elaf'); ?></a></small>
            </div>
        </div>
    </div>
</div>
<!--CHOOSE DOMAIN MODAL ENDS-->
<!--TEMPLATE SECTION ONE STARTS-->
<section>
    <div class="custom-container">
        <div class="template-wrapper">
            <div class="template-title-wrapper blue-bg">
                <h3 class="wow fadeInDown"><?php echo $this->lang->line('choose-temp-txt-1'); ?></h3>
                <h5 class="wow fadeInUp"><?php echo $this->lang->line('choose-temp-txt-2'); ?></h5>
            </div>
        </div>
    </div>
</section>
<!-- TEMPLATE SECTION ONE ENDS -->
<!-- TEMPLATE SECTION TWO STARTS -->
<section class="section-spacing">
    <div class="custom-container">
        <ul class="nav nav-pills justify-content-center mb-3 mx-auto" id="pills-tab" role="tablist">
            <li class="nav-item nav_link_btn active" role="presentation">
                <a onclick="filterSelection('all');" class ="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true"><?php echo $this->lang->line('All'); ?></a>
            </li>
            <?php 
            if(isset($categoryData) && !empty($categoryData)){
                foreach ($categoryData as $values) { 
                    if($values->is_active==2 || $values->is_active==3){
                        continue;
                    }
            ?>
                <li class="nav-item nav_link_btn" role="presentation">
                    <a onClick="filterSelection('<?php echo $values->theme_cat_name; ?>');" class="nav-link" id="pills-<?php echo $values->theme_cat_name; ?>-tab" data-toggle="pill" href="javascript:void(0);" role="tab" aria-controls="pills-<?php echo $values->theme_cat_name; ?>" aria-selected="true">
                    <?php 
                        if($site_lang=='ar'){
                            echo $values->theme_cat_name_ar; 
                        }else{
                            echo $values->theme_cat_name; 
                        }
                    ?>
                    </a>
                </li>
            <?php } } ?>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                <div class="row" id="themeCartboxWrapper">
                    <?php
                    $i = 1;
                    foreach ($templateData as $value) {
                        $i++;
                        $wowdelay = $i * 1;
                        ?>
                        <div class="col-md-6 col-lg-4 cat_column <?php echo $value['category_name']; ?> <?php if ($value['free_paid_flag'] == "2") { ?> cat_column_paid <?php } else if ($value['free_paid_flag'] == "1") { ?> cat_column_free <?php } ?> d-none">
                            <div class="template-card wow fadeIn" data-wow-delay="<?php echo $wowdelay; ?>00ms">
                                <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_UPLOADS; ?>template_half_banners/<?php echo isset($value['template_half_banner']) ? $value['template_half_banner'] : "matjary-default-banner.png"; ?>">
                                <h4><?php echo ($_SESSION["site_lang"] == "en" ? $value['name'] : $value['name_ar']); ?></h4>
                                <p><?php echo ($_SESSION["site_lang"] == "en" ? $value['description'] : $value['description_ar']); ?></p>
                                <p class="text-center mb-1">
                                    <a href="#" data-toggle="modal" onclick="show_template_details(<?php echo $value['id'] ?>, <?php echo $value['template_cost']; ?>,<?php echo $value['free_paid_flag']; ?>, <?php if($value['tmp_purchase_status']==false){echo'false';}else{echo'true';}; ?>, 'read', '<?php echo $_SESSION['site_lang']; ?>');"><?php echo $this->lang->line('return-txt-8'); ?></a>
                                    <?php if ($value['free_paid_flag'] == "2") { ?> 
                                        <?php if ($value['free_paid_flag'] == "2" && $value['tmp_purchase_status']==false) { ?>
                                            <span class="paid-tag"><?php echo $this->lang->line('PAID'); ?> (<?php echo $value['template_cost']; ?> <?php echo $this->lang->line('SAR'); ?>)</span> 
                                        <?php }else{ ?> 
                                            <span class="paid-tag"><?php echo $this->lang->line('PURCHASED'); ?></span> 
                                        <?php } ?>
                                    <?php } else if ($value['free_paid_flag'] == "1") { ?> 
                                        <span class="free-tag"><?php echo $this->lang->line('FREE'); ?></span> 
                                    <?php } ?>
                                </p>
                                <div class="d-grid gap-2 d-md-block text-center">
                                    <button class="btn btn-primary brand-btn-purple" onclick="show_template_details(<?php echo $value['id'] ?>, <?php echo $value['template_cost']; ?>,<?php echo $value['free_paid_flag']; ?>, <?php if($value['tmp_purchase_status']==false){echo'false';}else{echo'true';}; ?>, 'view', '<?php echo $_SESSION['site_lang']; ?>');"><?php echo $this->lang->line('view_txt'); ?></button>
                                    <a class="btn btn-primary brand-btn-purple" target="_blank" href="<?php echo $value['demo_link']; ?>"><?php echo $this->lang->line('demo'); ?></a>
                                </div>
                                <?php if ($value['free_paid_flag'] == 2 && $value['tmp_purchase_status']==false) { ?>
                                    <button class="btn btn-primary brand-btn-purple align-mid tplBtn" data-tplid="<?php echo $value['id']; ?>" data-tplprice="<?php echo $value['template_cost']; ?>" data-toggle="modal" data-target="#chooseDomainModal"><?php echo $this->lang->line('Buy'); ?></button>
                                <?php }else{ ?>
                                    <button class="btn btn-primary brand-btn-purple align-mid tplBtn" data-tplid="<?php echo $value['id']; ?>" data-tplprice="0" data-toggle="modal" data-target="#chooseDomainModal"><?php echo $this->lang->line('select_temp'); ?></button>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer section  -->
<?php $this->load->view("common/footer.php"); ?>
<script type="text/javascript">
    /* themes page js start */
        filterSelection("all")
        function filterSelection(c) {
            var x, i;
            x = document.getElementsByClassName("cat_column");
            if (c == "all") c = "";
            for (i = 0; i < x.length; i++) {
                w3RemoveClass(x[i], "d-block");
                if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "d-block");
            }
        }

        function w3AddClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
            }
        }

        function w3RemoveClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);     
                }
            }
            element.className = arr1.join(" ");
        }

        /* Add active class to the current button (highlight it) */
        var btnContainer = document.getElementById("pills-tab");
        var btns = btnContainer.getElementsByClassName("nav_link_btn");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function(){
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }
    /* themes page js end */
</script>
<style>
    /* free/paid tag css start */
        .free-tag {
            display: inline-block;
            float: right;
            width: auto;
            height: 38px;
            
            background-color: #8D4FDE;
            -webkit-border-radius: 3px 4px 4px 3px;
            -moz-border-radius: 3px 4px 4px 3px;
            border-radius: 3px 4px 4px 3px;
            
            border-left: 1px solid #8D4FDE;

            /* This makes room for the triangle */
            margin-left: 19px;
            
            position: relative;
            
            color: white;
            font-weight: 300;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 11px;
            line-height: 38px;

            padding: 0 10px 0 10px;
        }

        /* Makes the triangle */
        .free-tag:before {
            content: "";
            position: absolute;
            display: block;
            left: -19px;
            width: 0;
            height: 0;
            border-top: 19px solid transparent;
            border-bottom: 19px solid transparent;
            border-right: 19px solid #8D4FDE;
        }

        /* Makes the circle */
        .free-tag:after {
            content: "";
            background-color: white;
            border-radius: 50%;
            width: 4px;
            height: 4px;
            display: block;
            position: absolute;
            left: -9px;
            top: 17px;
        }

        .paid-tag {
            display: inline-block;
            float: right;
            width: auto;
            height: 38px;
            
            background-color: #53923A;
            -webkit-border-radius: 3px 4px 4px 3px;
            -moz-border-radius: 3px 4px 4px 3px;
            border-radius: 3px 4px 4px 3px;
            
            border-left: 1px solid #53923A;

            /* This makes room for the triangle */
            margin-left: 19px;
            
            position: relative;
            
            color: white;
            font-weight: 300;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 11px;
            line-height: 38px;

            padding: 0 10px 0 10px;
        }

        /* Makes the triangle */
        .paid-tag:before {
            content: "";
            position: absolute;
            display: block;
            left: -19px;
            width: 0;
            height: 0;
            border-top: 19px solid transparent;
            border-bottom: 19px solid transparent;
            border-right: 19px solid #53923A;
        }

        /* Makes the circle */
        .paid-tag:after {
            content: "";
            background-color: white;
            border-radius: 50%;
            width: 4px;
            height: 4px;
            display: block;
            position: absolute;
            left: -9px;
            top: 17px;
        }
    /* free/paid tag css start */
</style>
