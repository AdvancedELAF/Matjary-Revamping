<?php include("common/header.php"); ?>

<!-- REGISTER SECTION STARTS -->
<section>
    <div class="custom-container">
        <div class="register-wrapper wow fadeIn" data-wow-delay="200ms">
            <div class="register-box wow slideInDown" data-wow-delay="400ms">
                <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/logo-2.png">
                <h4><?php echo $this->lang->line('registration-txt-1'); ?></h4>
                <form method="POST" action="<?php echo base_url('save-user'); ?>" name="save_user_form" id="save_user_form" enctype="multipart/form-data">
                    <div class="form-wrapper">
                        <div class="mb-3">
                            <input type="text" name="fname" id="fname" class="form-control nospecialchars" maxlength="20" placeholder="<?php echo $this->lang->line('registration-txt-2'); ?> *">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="lname" id="lname" class="form-control nospecialchars" maxlength="20" placeholder="<?php echo $this->lang->line('registration-txt-3'); ?> *">
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo $this->lang->line('registration-txt-4'); ?> *">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="phone_no" id="phone_no" minlength="9" maxlength="10" class="form-control numberonly" placeholder="<?php echo $this->lang->line('registration-txt-5'); ?>* ">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" id="password" minlength="8" maxlength="16" class="form-control" placeholder="<?php echo $this->lang->line('registration-txt-6'); ?> *">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="passconf" id="passconf" minlength="8" maxlength="16" class="form-control" placeholder="<?php echo $this->lang->line('registration-txt-7'); ?> *">
                        </div>
                        <button class="btn btn-primary brand-btn-pink w-100 mx-auto d-block" type="submit" onclick="preloader()"><?php echo $this->lang->line('register'); ?></button>
                        <div class="text-center mt-2">
                            <p><?php echo $this->lang->line('registration-txt-8'); ?> <a href="<?php echo base_url('login'); ?>"><?php echo $this->lang->line('login'); ?></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- REGISTER SECTION ENDS -->

<!-- Footer section  -->
<?php include("common/footer.php"); ?>