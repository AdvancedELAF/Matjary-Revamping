<?php include("common/header.php"); ?>
<section>
    <div class="custom-container">
        <div class="fp-wrapper align-items-center blue-bg">
            <div class="w-50 mx-auto">
                <div class="fp-logo">
                    <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/images/logo-2.png">   
                </div>
                <div class="fp-headline">
                    <h4><?php echo $this->lang->line('pwd-reset-txt-1'); ?></h4>
                </div>
                <form method="POST" action="<?php echo base_url('send-reset-password-link'); ?>" name="send_reset_password_link" id="send_reset_password_link" autocomplete="off" enctype="multipart/form-data">
                    <div class="fp-form">
                        <div class="form-wrapper mb-3">
                            <input type="text" class="form-control" name="reset_pwd_email" id="reset_pwd_email" width="100" placeholder="<?php echo $this->lang->line('index-txt-38'); ?>"> 
                        </div>
                        <button type="submit" id="forgot-pwd-btn" class="btn btn-primary brand-btn-pink mx-auto d-block"><?php echo $this->lang->line('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Footer section  -->
<?php include("common/footer.php"); ?>
