<?php $this->load->view("common/header"); ?>

<!-- LOGIN SECTION STARTS -->
<section>
    <div class="custom-container">
        <div class="login-wrapper wow fadeIn" data-wow-delay="200ms">
            <div class="login-box wow slideInDown" data-wow-delay="400ms">
                <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/logo-2.png">
                <h4><?php echo $this->lang->line('login_to_acc'); ?></h4>
                <form method="POST" action="<?php echo base_url('usr-login'); ?>" name="user_login_form" id="user_login_form" enctype="multipart/form-data">
                    <div class="form-wrapper">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="<?php echo $this->lang->line('email-add'); ?> *">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="<?php echo $this->lang->line('password'); ?>*">
                        </div>
                        <div class="text-right">
                            <p><a href="<?php echo base_url(); ?>request-reset-pwd"><?php echo $this->lang->line('forgot_password'); ?></a></p>
                        </div>
                        <button class="btn btn-primary brand-btn-pink w-100 mx-auto d-block" type="submit"><?php echo $this->lang->line('login'); ?></button>
                        <div class="text-center mt-2">
                            <p><?php echo $this->lang->line('dont_have_acc'); ?> <a href="<?php echo base_url('register'); ?>"><?php echo $this->lang->line('register_now'); ?></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Footer section  -->
<?php $this->load->view("common/footer"); ?>