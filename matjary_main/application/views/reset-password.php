<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Matjary - Reset Password</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/matjary_favicon_io/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/matjary_favicon_io/favicon-16x16.png">
        <link rel="manifest" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/matjary_favicon_io/site.webmanifest">
        <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/images/matjary_favicon_io/apple-touch-icon.png">
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/css/normalize.css">

        <!-- Iconfont Link -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/icofont/icofont.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/css/style.css">

        <!-- Matjary Stylesheet -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/css/matjary-styles.css" />
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/css/responsive.css" />

        <!-- Font Styles -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/css/fonts.css" />

        <!-- Animate CSS & JS -->
        <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/css/animate.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/js/wow.min.js"></script>
    </head>
    <body>
        <div class="reset-password-box">
            <div class="reset-password-body">
                <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/images/logo.png">
                <h3 class="reset-password-title">Reset Password</h3>
                <form method="POST" action="<?php echo base_url('set-usr-reset-password'); ?>" name="set_usr_reset_password" id="set_usr_reset_password" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-wrapper">
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_rst_pwd" id="new_rst_pwd" minlength="8" maxlength="16" class="form-control" placeholder="Enter New Password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="cnf_new_rst_pwd" id="cnf_new_rst_pwd" minlength="8" maxlength="16" data-tnk="<?php echo $rst_pwd_tkn; ?>" class="form-control" placeholder="Confirm New Password">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="reset-pwd-btn" class="btn btn-primary brand-btn-pink" type="button">Set Password</button>
                    </div>
                    <br/>
                    <div id="Reset_Pwd_Message"></div>
                </form>
            </div>
        </div>
    </body>
    <!-- JQuery Integration Link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/wow.min.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/sweetalert.min.js"></script>

    <!-- form validate js -->
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/jquery-validate.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/form-validation.js"></script>
    <?php if (isset($_SESSION['site_lang']) && !empty($_SESSION['site_lang']) && $_SESSION['site_lang'] == 'ar') { ?>
        <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js//validate_msg_ar.js" />
    <?php } ?>
    <!-- datatable js cdn -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>

    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/ajax-call.js"></script>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/data-table-page.js"></script>
    <!-- Bootstrap JS -->
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>bootstrap/js/bootstrap.min.js"></script>

    <!-- Popper Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- Local Script -->
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/main.js"></script>
    <!-- Loader Script -->
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/loader.js"></script>
    <!-- Common js Script -->
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/common.js"></script>

    <script>
        /*WOW JS INTITATED*/
        new WOW().init();
    </script>

</html>