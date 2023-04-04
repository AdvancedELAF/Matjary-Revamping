<?php include("common/header.php"); ?>
<section>
    <div class="custom-container">
        <div class="free-trial-wrapper blue-bg">
            <?php if ($free_store_created_flag == '1') { ?>
                <div class="alert alert-info alert-dismissible fade show mx-auto text-center free-trial-alert" role="alert">
                    <strong> <?php echo $this->lang->line('free_trail_msg_1'); ?></strong>
                </div>
            <?php } ?>
            <div class="section-title text-center wow fadeInDown" data-wow-delay="100ms">
                <h2 class="pb-0">@<?php echo $this->lang->line('matjary'); ?> <?php echo $this->lang->line('index-txt-35'); ?></h2>
            </div>
            <div class="section-two-subtitle text-center wow fadeInUp" data-wow-delay="300ms">
                <h3><?php echo $this->lang->line('index-txt-36'); ?></h3>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-7">
                    <div class="free-trial-content">
                        <form method="POST" action="<?php echo base_url('free-trial-form'); ?>" name="free_trial_form" id="free_trial_form" enctype="multipart/form-data" autocomplete="off">
                            <h2 class="wow fadeInDown" data-wow-delay="100ms"><?php echo $this->lang->line('index-txt-9'); ?></h2>
                            <h3 class="wow fadeInUp" data-wow-delay="200ms"><?php echo $this->lang->line('index-txt-10'); ?> <span class="matjary-font"><?php echo $this->lang->line('matjary'); ?></span></h3>

                            <div class="list-title wow fadeInLeft" data-wow-delay="300ms">
                                <?php echo $this->lang->line('index-txt-11'); ?>
                                <ul class="index-list">
                                    <li><i class="icofont-dotted-right"></i><?php echo $this->lang->line('index-txt-12'); ?></li>
                                    <li><i class="icofont-dotted-right"></i><?php echo $this->lang->line('index-txt-13'); ?></li>
                                    <li><i class="icofont-dotted-right"></i><?php echo $this->lang->line('index-txt-14'); ?></li>
                                </ul>
                            </div>

                            <div class="row align-items-center">
                                <!-- Registration fields start -->
                                <?php if (!($usr_data)) { ?>
                                    <div class="col-md-6">
                                        <div class="form-wrapper wow fadeIn" data-wow-delay="200ms">
                                            <label class="control-label trial-label"><?php echo $this->lang->line('registration-txt-2'); ?></label>
                                            <input type="text" name="fname" class="form-control nospecialchars" maxlength="20" placeholder="<?php echo $this->lang->line('registration-txt-2'); ?> *">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-wrapper wow fadeIn" data-wow-delay="200ms">
                                            <label class="control-label trial-label"><?php echo $this->lang->line('registration-txt-3'); ?></label>
                                            <input type="text" name="lname" id="lname" class="form-control nospecialchars" maxlength="20" placeholder="<?php echo $this->lang->line('registration-txt-3'); ?> *">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-wrapper wow fadeIn" data-wow-delay="200ms">
                                            <label class="control-label trial-label"><?php echo $this->lang->line('registration-txt-4'); ?></label>
                                            <input type="email" name="email" id="email" class="form-control"  placeholder="<?php echo $this->lang->line('registration-txt-4'); ?> *">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-wrapper wow fadeIn" data-wow-delay="200ms">
                                            <label class="control-label trial-label"><?php echo $this->lang->line('registration-txt-5'); ?></label>
                                            <input type="text" name="phone_no" id="phone_no" minlength="9" maxlength="10" class="form-control numberonly" placeholder="<?php echo $this->lang->line('registration-txt-5'); ?>* ">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-wrapper wow fadeIn" data-wow-delay="200ms">
                                            <label class="control-label trial-label"><?php echo $this->lang->line('registration-txt-6'); ?></label>
                                            <input type="password" name="password" id="password" minlength="8" maxlength="16" class="form-control" placeholder="<?php echo $this->lang->line('registration-txt-6'); ?> *">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-wrapper wow fadeIn" data-wow-delay="200ms">
                                            <label class="control-label trial-label"><?php echo $this->lang->line('registration-txt-7'); ?></label>
                                            <input type="password" name="passconf" id="passconf" minlength="8" maxlength="16" class="form-control" placeholder="<?php echo $this->lang->line('registration-txt-7'); ?> *">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg brand-btn-pink align-mid wow fadeIn" id="free_trial_form_btn" data-wow-delay="800ms"><?php echo $this->lang->line('submit'); ?></button>
                                <?php } ?>
                                <?php if ($free_store_created_flag == '0') { ?>
                                    <div class="col-md-6">
                                        <div class="form-wrapper wow fadeIn" data-wow-delay="200ms">
                                            <label class="control-label trial-label"><?php echo $this->lang->line('ent-store-name'); ?></label>
                                            <input type="text" name="free_trial_domain" id="free_trial_domain" class="form-control nospecialchars" data-token="<?php
                                            if (isset($free_trial_tkn)) {
                                                echo $free_trial_tkn;
                                            }
                                            ?>" minlength="3" maxlength="20" <?php
                                                   if (isset($domain)) {
                                                       echo "value='" . $domain . "'";
                                                   }
                                                   ?> placeholder="<?php echo $this->lang->line('index-txt-37'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-lg brand-btn-pink align-mid wow fadeIn mt-3" id="free_trial_form_btn" data-wow-delay="800ms"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                <?php } ?>
                                <!-- Registration fields ends-->
                            </div>
                        </form>
                    </div>
                    <div id="ft_domain_alert" class="alert mt-5" role="alert"></div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">
                    <!-- <div class="features-wrapper wow fadeIn" data-wow-delay="500ms">
                        <div class="matjary-features">
                            <div class="features-align">
                                <div class="features-image">
                                    <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/feature-1.png">
                                </div>

                                <div class="features-content">
                                    <h4><?php echo $this->lang->line('index-txt-15'); ?></h4>
                                    <p><?php echo $this->lang->line('index-txt-16'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="features-wrapper wow fadeIn" data-wow-delay="700ms">
                        <div class="matjary-features">
                            <div class="features-align">
                                <div class="features-image">
                                    <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/feature-2.png">
                                </div>

                                <div class="features-content">
                                    <h4><?php echo $this->lang->line('index-txt-17'); ?></h4>
                                    <p><?php echo $this->lang->line('index-txt-18'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="features-wrapper wow fadeIn" data-wow-delay="900ms">
                        <div class="matjary-features">
                            <div class="features-align">
                                <div class="features-image">
                                    <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/feature-3.png">
                                </div>
                                <div class="features-content">
                                    <h4><?php echo $this->lang->line('index-txt-19'); ?></h4>
                                    <p><?php echo $this->lang->line('index-txt-20'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="free-trial-banner wow fadeIn" data-wow-delay="500ms">
                        <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/free-trial-ban.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer section  -->
<?php include("common/footer.php"); ?>