<?php
if ($this->session->userdata('loggedInUsrData')) {
    $loggedInUsrData = $this->session->userdata('loggedInUsrData');
}
?>
<!DOCTYPE html>
<html <?php echo $_SESSION["site_lang"] == "en" ? "lang='en'" : "lang='ar' dir='rtl'"; ?>>
    <head>
        <title> Matjary - Ecommerce Store in Saudi Arabia</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="canonical" href="https://www.matjary.in">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/matjary_favicon_io/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/matjary_favicon_io/favicon-16x16.png">
        <link rel="manifest" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/matjary_favicon_io/site.webmanifest">
        <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/images/matjary_favicon_io/apple-touch-icon.png">
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/css/normalize.css">

        <!-- Iconfont Link -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>icofont/icofont.min.css" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>bootstrap/css/bootstrap.min.css">

        <!-- datatable css cdn-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css"/>

        <!-- loadind respective css files based on language selected -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/style.css">
        <?php if (isset($_SESSION['site_lang']) && !empty($_SESSION['site_lang']) && $_SESSION['site_lang'] == 'en') { ?>
            <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/matjary-styles.css" />
        <?php } else { ?>
            <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/matjary-styles-ar.css" />
        <?php } ?>

        <!-- Matjary Stylesheet -->

        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/responsive.css" />

        <!-- Font Styles -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/fonts.css" />
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/sweetalert.css" />

        <!-- Animate CSS & JS -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/animate.css" />
        <!-- Loader CSS -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/loader.css" />

    </head>
    <body>
        <header>
            <nav class="custom-container navbar navbar-expand-lg navbar-light nav-spacing fixed-top">
                <a class="navbar-brand" href="<?php echo base_url(); ?>"><img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/logo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav <?php echo $_SESSION['site_lang'] == 'ar' ? 'ml-auto' : 'mr-auto'; ?>">
                        <li class="nav-item <?= ($this->uri->uri_string() === '') ? 'nav-active' : '' ?>">
                            <a class="nav-link" href="<?php echo base_url(); ?>"><?php echo $this->lang->line('Begin'); ?></a>
                        </li>
                        <li class="nav-item <?= ($this->uri->segment(1) === 'about-us') ? 'nav-active' : '' ?>">
                            <a class="nav-link" href="<?php echo base_url('about-us'); ?>"><?php echo $this->lang->line('About Us'); ?></a>
                        </li>
                        <li class="nav-item <?= ($this->uri->segment(1) === 'services') ? 'nav-active' : '' ?>">
                            <a class="nav-link" href="<?php echo base_url('services'); ?>"><?php echo $this->lang->line('Services'); ?></a>
                        </li>
                        <li class="nav-item <?= ($this->uri->segment(1) === 'templates') ? 'nav-active' : '' ?>">
                            <a class="nav-link" href="<?php echo base_url('templates'); ?>"><?php echo $this->lang->line('Templates'); ?></a>
                        </li>
                        <li class="nav-item <?= ($this->uri->segment(1) === 'pricing') ? 'nav-active' : '' ?>">
                            <a class="nav-link" href="<?php echo base_url('pricing'); ?>"><?php echo $this->lang->line('Pricing'); ?></a>
                        </li>
                        <li class="nav-item <?= ($this->uri->segment(1) === 'contact') ? 'nav-active' : '' ?>">
                            <a class="nav-link" href="<?php echo base_url('contact'); ?>"><?php echo $this->lang->line('Contact'); ?></a>
                        </li>
                    </ul>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <?php if (isset($loggedInUsrData) && !empty($loggedInUsrData)) { ?>
                            <a class="header-btn-link" href="<?php echo base_url('user-dashboard'); ?>"><?php echo $this->lang->line('my-accout'); ?></a>
                            <a href="<?php echo base_url('usr-logout'); ?>"><button class="btn btn-primary me-md-2 nav-reg-btn" type="button"><?php echo $this->lang->line('logout'); ?></button></a>
                        <?php } else { ?>
                            <a class="header-btn-link" href="<?php echo base_url('login'); ?>"><?php echo $this->lang->line('login'); ?></a>
                            <a href="<?php echo base_url('register'); ?>"><button class="btn btn-primary me-md-2 nav-reg-btn" type="button"><?php echo $this->lang->line('register'); ?></button></a>
                        <?php } ?>

                        <!-- language Switcher -->
                        <?php
                        if(isset($pageTitle) && !empty($pageTitle)){
                            if(in_array($pageTitle,array('storeBillingPage','storeDetailsPage'))){
                            }else{
                                if (isset($_SESSION['site_lang']) && !empty($_SESSION['site_lang']) && $_SESSION['site_lang'] == 'en') { 
                        ?>
                                    <a class="header-btn-link language_switch_btn" href="javascript:void(0)">AR</a>
                        <?php
                                } else {
                        ?>
                                    <a class="header-btn-link language_switch_btn" href="javascript:void(0)">EN</a>
                        <?php 
                                }
                            }
                        }else{
                            if (isset($_SESSION['site_lang']) && !empty($_SESSION['site_lang']) && $_SESSION['site_lang'] == 'en') { 
                        ?>  
                                <a class="header-btn-link language_switch_btn" href="javascript:void(0)">AR</a>
                        <?php 
                            } else { 
                        ?>
                                <a class="header-btn-link language_switch_btn" href="javascript:void(0)">EN</a>
                        <?php } 
                        }
                        ?>
                    </div>
                </div>
            </nav>
        </header>
        <!-- FREE TRIAL MODAL STARTS -->
        <div class="modal fade" id="trialModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content trial-modal-content">
                    <div class="modal-header trial-modal-header">
                        <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/logo-2.png">
                        <button type="button" class="close trial-modal-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body trial-modal-body">
                        <h4 class="trial-modal-title"><?php echo $this->lang->line('start-free-trail-14'); ?></h4>
                        <div class="trial-modal-form">
                            <div class="mb-3">
                                <label class="control-label">Email:</label>
                                <input type="email" name="free_trail_email" id="free_trail_email" class="form-control" placeholder="<?php echo $this->lang->line('email-add'); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Password:</label>
                                <input type="password" name="free_trail_pass" id="free_trail_pass" minlength="8" maxlength="16" class="form-control" placeholder="<?php echo $this->lang->line('password'); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Store Name:</label>
                                <input type="text" name="free_trail_domain" id="free_trail_domain" class="form-control" placeholder="<?php echo $this->lang->line('ent-store-name'); ?>">
                            </div>
                            <button type="button" class="btn btn-primary brand-btn-pink-popup mx-auto d-block"><?php echo $this->lang->line('create-store-now'); ?></button>
                        </div>
                    </div>

                    <div class="modal-footer trial-modal-footer">
                        <small><?php echo $this->lang->line('powered_by'); ?> <a href="https://www.advancedelaf.com" target="_blank"><?php echo $this->lang->line('advanced-elaf'); ?></a></small>
                    </div>
                </div>
            </div>
        </div>
        <!-- FREE TRIAL MODAL ENDS -->
        <div class="preloaderBg" id="preloader" style="display: none;">
            <div class="preloader-position">
                <h3><?php echo $this->lang->line('processing'); ?></h3>
                <div class="preloader"></div>
                <div class="preloader2"></div>
            </div>
        </div>
    </body>

</html>