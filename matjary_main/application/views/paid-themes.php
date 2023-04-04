<?php include("common/header.php"); ?>
<?php include("modals/template_modal.php"); ?>
<!-- THEMES SECTION ONE STARTS -->
<section>
    <div class="custom-container">
        <div class="theme-sec-one">
            <div class="theme-wrapper blue-bg">
                <div class="theme-page-title">
                    <h3 class="wow fadeInDown" data-wow-delay="200ms">Themes We Offer</h3>
                    <h5 class="wow fadeInUp" data-wow-delay="200ms">Professional <span class="purple-highlighter matjary-font">Matjary</span> Themes for any business that can sell products online.</h5>
                    <h5 class="wow fadeInUp" data-wow-delay="200ms">Our ambition is to provide unique and beautiful templates, that can enhance your business.</h5>
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
                <a onclick="filterSelection('all');" class ="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">All</a>
            </li>
            <?php foreach ($categoryData as $k => $val) { ?>
                <li class="nav-item nav_link_btn" role="presentation">
                    <a onClick="filterSelection('<?php echo $val; ?>');" class="nav-link" id="pills-<?php echo $val; ?>-tab" data-toggle="pill" href="javascript:void(0);" role="tab" aria-controls="pills-<?php echo $val; ?>" aria-selected="true"><?php echo $val; ?></a>
                </li>
            <?php } ?>
        </ul>
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                <div class="row">
                    <div class="toggle-switch wow fadeIn">
                        <div class="control">
                            <!-- switch button -->
                            <p>Free</p><!-- yearly -->
                            <label class="switch">
                                <input class="switcher template_free_paid_switch" type="checkbox" checked="checked" data-toggle="toggle" data-on="Paid" data-off="Free">
                                <span class="slider"></span>
                            </label>
                            <p>Paid</p><!-- monthly -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php foreach ($templateData as $key => $value) { ?>
                        <div class="col-md-6 col-lg-4 cat_column <?php echo $value['category_name']; ?> <?php if ($value['free_paid_flag'] == "2") { ?> cat_column_paid <?php } else if ($value['free_paid_flag'] == "1") { ?> cat_column_free <?php } ?>">
                            <div class="template-card">
                                <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/matjary_templates/<?php echo isset($value['template_half_banner']) ? $value['template_half_banner'] : "matjary-default-banner.png"; ?>">
                                <h4><?php echo ($_SESSION["site_lang"] == "ar" ? $value->name_ar : $value->name); ?></h4>
                                <p><?php echo ($_SESSION["site_lang"] == "ar" ? $value->description_ar : $value->description); ?></p>
                                <p class="text-center mb-1"><a href="#" data-toggle="modal" onclick="show_template_details(<?php echo $value['id'] ?>, 'read', '<?php echo $_SESSION["site_lang"]; ?>');"><?php echo $this->lang->line('return-txt-8'); ?></a></p>
                                <div class="d-grid gap-2 d-md-block text-center">
                                    <button class="btn btn-primary brand-btn-purple" onclick="show_template_details(<?php echo $value['id'] ?>, 'view', '<?php echo $_SESSION["site_lang"]; ?>');"><?php echo $this->lang->line('view_txt'); ?></button>
                                    <a class="btn btn-primary brand-btn-purple" target="_blank" href="<?php echo $value['demo_link']; ?>"><?php echo $this->lang->line('demo'); ?></a>
                                </div>
                                <?php if ($value['free_paid_flag'] == "2") { ?>
                                    <a onclick="check_template_purchased(<?php echo $value['id'] ?>,<?php echo $user_id; ?>); return false;" id="check_template_purchased" href="<?php echo base_url('buy-template') . "?buy=" . $value['enc_id']; ?>">
                                        <button class="btn btn-primary brand-btn-purple align-mid">Buy</button>
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
            <?php foreach ($categoryData as $k => $val) { ?>
                <button class="btn" onclick="filterSelection('<?php echo $val; ?>')"><?php echo $val; ?></button>
            <?php } ?>
        </div>
        <div class="row">
            <?php foreach ($templateData as $key => $value) { ?>
                <div class="column <?php echo $value['category_name']; ?> d-none">
                    <div class="col-md-6 col-lg-4">
                        <div class="template-card wow fadeIn" data-wow-delay="300ms">
                            <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/matjary_templates/<?php echo isset($value['template_half_banner']) ? $value['template_half_banner'] : "matjary-default-banner.png"; ?>">
                            <h4><?php echo ($_SESSION["site_lang"] == "en" ? $value['name'] : $value['name_ar']); ?></h4>
                            <p><?php echo ($_SESSION["site_lang"] == "en" ? $value['description'] : $value['description_ar']); ?></p>
                            <button class="btn btn-primary brand-btn-purple align-mid" data-toggle="modal" data-target="#chooseDomainModal">Select Template</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Footer section  -->
<?php include("common/footer.php"); ?>
<script type="text/javascript">
    filterSelection("all")
    function filterSelection(c) {
        var check_fp = document.getElementsByClassName("template_free_paid_switch")[0].value;

        var x, i;
        x = document.getElementsByClassName("cat_column");
        if (c == "all")
            c = "";
        for (i = 0; i < x.length; i++) {
            w3RemoveClass(x[i], "d-block");
            if (x[i].className.indexOf(c) > -1) {
                if (check_fp == 'on') {
                    w3AddClass(x[i], "d-block");
                }
            } else {
                w3AddClass(x[i], "d-none");
            }
        }
    }

    function w3AddClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
                element.className += " " + arr2[i];
            }
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

    function check_template_purchased(template_id, user_id) {
        let base_url = window.location.origin;
        $.ajax({
            url: window.location.origin + '/check-template-purchased',
            type: "POST",
            data: {
                template_id: template_id,
                user_id: user_id
            },
            beforeSend: function () {
                swal({
                    title: "",
                    imageUrl: base_url + "/assets/images/loader/matjary-loader.gif",
                    buttons: false,
                    closeOnClickOutside: false,
                    showConfirmButton: false
                });
            },
            success: function (resp) {
                resp = JSON.parse(resp);
                if (resp.responseCode == 404) {
                    window.location = $("#check_template_purchased").attr("href");
                } else {
                    swal({title: "", html: true, closeOnClickOutside: false, text: resp.responseMessage, type: "info"});
                    return false;
                }
            }
        });
    }


    /*// Add active class to the current button (highlight it)*/
    var btnContainer = document.getElementById("pills-tab");
    var btns = btnContainer.getElementsByClassName("nav_link_btn");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function () {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }

    $(".template_free_paid_switch").click(function () {
        if (this.checked) {
            $(".cat_column_paid").removeClass('d-none').addClass('d-block');
            $('.cat_column_free').removeClass('d-block').addClass('d-none');
        } else {
            $(".cat_column_paid").removeClass('d-block').addClass('d-none');
            $('.cat_column_free').removeClass('d-none').addClass('d-block');
        }
    });
    $(".template_free_paid_switch").first().trigger("click");
</script>