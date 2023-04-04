<?php $this->load->view("common/header.php"); ?>
<?php $this->load->view("modals/template_modal.php"); ?>
<!-- THEMES SECTION ONE STARTS -->
<section>
    <div class="custom-container">
        <div class="theme-sec-one">
            <div class="theme-wrapper blue-bg">
                <div class="theme-page-title">
                    <h3 class="wow fadeInDown" data-wow-delay="200ms"><?php echo $this->lang->line('Themes We Offer'); ?></h3>
                    <h5 class="wow fadeInUp" data-wow-delay="200ms"><?php echo $this->lang->line('Professional'); ?> <span class="purple-highlighter matjary-font"><?php echo $this->lang->line('Matjary'); ?></span> <?php echo $this->lang->line('Themes for any business that can sell products online.'); ?></h5>
                    <h5 class="wow fadeInUp" data-wow-delay="200ms"><?php echo $this->lang->line('Our ambition is to provide unique and beautiful templates, that can enhance your business.'); ?></h5>
                    <a href="<?php echo base_url(); ?>free-trial-store">
                        <button class="btn btn-primary mt-3 brand-btn-purple align-mid wow fadeIn" data-wow-delay="300ms"><?php echo $this->lang->line('start-free-trail'); ?></button>
                    </a>
                </div>
            </div>
        </div>
</section>
<!-- THEMES SECTION ONE ENDS -->
<!-- THEMES SECTION TWO STARTS -->
<div class="section-spacing">
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
                    <?php foreach ($templateData as $templateValues) { ?>
                        <div class="col-md-6 col-lg-4 cat_column <?php echo $templateValues['category_name']; ?> <?php if ($templateValues['free_paid_flag'] == 2) { ?> cat_column_paid <?php } else if ($templateValues['free_paid_flag'] == 1) { ?> cat_column_free <?php } ?> d-none" >
                            <div class="template-card">
                                <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_UPLOADS; ?>template_half_banners/<?php echo isset($templateValues['template_half_banner']) ? $templateValues['template_half_banner'] : "matjary-default-banner.png"; ?>">
                                <h4><?php echo ($_SESSION["site_lang"] == "ar" ? $templateValues->name_ar : $templateValues->name); ?></h4>
                                <p><?php echo ($_SESSION["site_lang"] == "ar" ? $templateValues->description_ar : $templateValues->description); ?></p>
                                <p class="text-center mb-1">
                                    <a href="#" data-toggle="modal" onclick="show_template_details(<?php echo $templateValues['id']; ?>, <?php echo $templateValues['template_cost']; ?>,<?php echo $templateValues['free_paid_flag']; ?>, <?php if($templateValues['tmp_purchase_status']==false){echo'false';}else{echo'true';}; ?>, 'read', '<?php echo $_SESSION['site_lang']; ?>');"><?php echo $this->lang->line('return-txt-8'); ?></a>
                                    <?php if ($templateValues['free_paid_flag'] == 2) { ?> 
                                        <?php if ($templateValues['free_paid_flag'] == 2 && $templateValues['tmp_purchase_status']==false) { ?>
                                            <span class="paid-tag"><?php echo $this->lang->line('PAID'); ?> (<?php echo $templateValues['template_cost']; ?> <?php echo $this->lang->line('SAR'); ?>)</span> 
                                        <?php }else{ ?> 
                                            <span class="paid-tag"><?php echo $this->lang->line('PURCHASED'); ?></span> 
                                        <?php } ?>
                                    <?php } else if ($templateValues['free_paid_flag'] == 1) { ?> 
                                        <span class="free-tag"><?php echo $this->lang->line('FREE'); ?></span> 
                                    <?php } ?>
                                </p>
                                <div class="d-grid gap-2 d-md-block text-center">
                                    <button class="btn btn-primary brand-btn-purple" onclick="show_template_details(<?php echo $templateValues['id']; ?>, <?php echo $templateValues['template_cost']; ?>,<?php echo $templateValues['free_paid_flag']; ?>, <?php if($templateValues['tmp_purchase_status']==false){echo'false';}else{echo'true';}; ?>, 'view', '<?php echo $_SESSION['site_lang']; ?>');"><?php echo $this->lang->line('view_txt'); ?></button>
                                    <a class="btn btn-primary brand-btn-purple" target="_blank" href="<?php echo $templateValues['demo_link']; ?>"><?php echo $this->lang->line('demo'); ?></a>
                                </div>
                                <?php if ($templateValues['free_paid_flag'] == 2 && $templateValues['tmp_purchase_status']==false) { ?>
                                    <a data-tmplid="<?php echo $templateValues['id'] ?>" data-userid="<?php echo $user_id; ?>" id="check_template_purchased" href="<?php echo base_url('buy-template/') . "?buy=" . $templateValues['enc_id']; ?>">
                                        <button class="btn btn-primary brand-btn-purple align-mid"><?php echo $this->lang->line('Buy'); ?></button>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- THEMES SECTION TWO ENDS -->
<div class="section-spacing d-none">
    <div class="custom-container">
        <div id="myBtnContainer">
            <button class="btn active" onclick="filterSelection('all')"> Show all</button>
            <?php foreach ($categoryData as $val) { ?>
                <button class="btn" onclick="filterSelection('<?php echo $val->theme_cat_name; ?>')"><?php echo $val->theme_cat_name; ?></button>
            <?php } ?>
        </div>
        <div class="row">
            <?php foreach ($templateData as $value) { ?>
                <div class="column <?php echo $value['category_name']; ?> ">
                    <div class="col-md-6 col-lg-4">
                        <div class="template-card wow fadeIn" data-wow-delay="300ms">
                            <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_UPLOADS; ?>template_half_banners/<?php echo isset($value['template_half_banner']) ? $value['template_half_banner'] : "matjary-default-banner.png"; ?>">
                            <h4><?php echo ($_SESSION["site_lang"] == "en" ? $value['name'] : $value['name_ar']); ?></h4>
                            <p><?php echo ($_SESSION["site_lang"] == "en" ? $value['description'] : $value['description_ar']); ?></p>
                            <button class="btn btn-primary brand-btn-purple align-mid" data-toggle="modal" data-target="#chooseDomainModal"><?php echo $this->lang->line('select_temp'); ?></button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
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