<?php
if ($this->session->userdata('loggedInUsrData')) {
    $loggedInUsrData = $this->session->userdata('loggedInUsrData');
}
?>
<!DOCTYPE html>
<html <?php echo ($_SESSION["site_lang"] == "en" ? "lang='en'" : "lang='ar' dir='rtl'"); ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Matjary - Ecommerce Store in Saudi Arabia</title>
       
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>admin/plugins/fontawesome-free/css/all.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>admin/dist/css/adminlte.min.css">


        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/sweetalert.css" />

        <!-- Animate CSS & JS -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/animate.css" />
        <!-- Loader CSS -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/loader.css" />

    </head>
    <body>
        <header>
            
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