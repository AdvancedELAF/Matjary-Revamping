<?php $this->load->view("common/header.php"); ?>

<!-- INDEX PAGE: HERO SECTION STARTS -->
<section>
    <div class="custom-container">
        <div class="hero-section blue-bg">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="hero-content wow fadeInLeft" data-wow-delay="200ms">
                        <h2><?php echo $this->lang->line('index-txt-1'); ?></h2>
                        <h3><?php echo $this->lang->line('index-txt-2'); ?></h3>
                        <p><span class="purple-highlighter"><?php echo $this->lang->line('index-txt-3'); ?></span> <?php echo $this->lang->line('index-txt-4'); ?></p>
                    </div>
                    <div class="hero-banner-btn wow fadeIn" data-wow-delay="300ms">                       
                        <a href="<?php echo base_url(); ?>free-trial-store">
                            <button class="btn btn-primary brand-btn-purple start-trial-btn-index"><?php echo $this->lang->line('start-free-trail'); ?></button>
                        </a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="hero-banner wow fadeInRight" data-wow-delay="600ms">
                        <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/image-1.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- INDEX PAGE: HERO SECTION ENDS -->

<!-- INDEX PAGE: SECTION ONE STARTS -->

<section class="section-spacing">
    <div class="custom-container">
        <div class="section-title text-center wow fadeIn" data-wow-delay="100ms">
            <h2>
                <?php echo $this->lang->line('index-txt-5'); ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="matjary-video wow slideInLeft" data-wow-delay="200ms">
                    <video autoplay loop src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/matjary-video-mob-lap.mp4">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="section-one-content">
                    <h2 class="wow fadeIn" data-wow-delay="400ms"><?php echo $this->lang->line('index-txt-6'); ?></h2>
                    <h2 class="wow fadeIn" data-wow-delay="600ms"><?php echo $this->lang->line('index-txt-7'); ?></h2>
                    <h3 class="wow fadeIn" data-wow-delay="800ms"><?php echo $this->lang->line('index-txt-8'); ?></h3>
                </div>
                <a href="<?php echo base_url(); ?>free-trial-store">
                    <button class="btn btn-primary brand-btn-purple wow slideInRight start-trial-btn-index" data-wow-delay="300ms"><?php echo $this->lang->line('start-free-trail') ?></button>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- INDEX PAGE: SECTION ONE ENDS -->

<!-- INDEX PAGE: SECTION TWO STARTS -->

<section>
    <div class="custom-container">
        <div class="home-section-two blue-bg">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-7">
                    <div class="section-two-content">
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
                        <a href="<?php echo base_url(); ?>free-trial-store">
                            <button class="btn btn-primary brand-btn-purple wow fadeIn" data-wow-delay="400ms"><?php echo $this->lang->line('start-free-trail'); ?></button>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">
                    <div class="features-wrapper wow fadeIn" data-wow-delay="500ms">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- INDEX PAGE: SECTION TWO ENDS -->

<!-- INDEX PAGE: SECTION THREE STARTS -->

<section class="section-spacing">
    <div class="custom-container">
        <div class="section-title text-center wow fadeIn" data-wow-delay="100ms">
            <h2><?php echo $this->lang->line('index-txt-21'); ?></h2>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <div class="matjary-offer-wrapper wow fadeIn" data-wow-delay="200ms">
                    <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/offers-1.png">
                    <h4><?php echo $this->lang->line('index-txt-22'); ?></h4>
                    <p><?php echo $this->lang->line('index-txt-23'); ?></p>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <div class="matjary-offer-wrapper wow fadeIn" data-wow-delay="400ms">
                    <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/offers-2.png">
                    <h4><?php echo $this->lang->line('index-txt-24'); ?></h4>
                    <p><?php echo $this->lang->line('index-txt-25'); ?></p>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <div class="matjary-offer-wrapper wow fadeIn" data-wow-delay="600ms">
                    <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/offers-3.png">
                    <h4><?php echo $this->lang->line('index-txt-26'); ?></h4>
                    <p><?php echo $this->lang->line('index-txt-27'); ?></p>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <div class="matjary-offer-wrapper wow fadeIn" data-wow-delay="800ms">
                    <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/offers-4.png">
                    <h4><?php echo $this->lang->line('index-txt-28'); ?></h4>
                    <p><?php echo $this->lang->line('index-txt-29'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- INDEX PAGE: SECTION THREE ENDS -->

<!-- INDEX PAGE: SECTION FOUR STARTS -->
<section>
    <div class="custom-container">
        <div class="home-section-four blue-bg">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-four-image wow fadeInLeft" data-wow-delay="100ms">
                        <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/image-2.jpeg">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="section-four-content">
                        <div class="section-title arabic-right">
                            <h2 class="pb-0 wow fadeInDown" data-wow-delay="200ms"><?php echo $this->lang->line('index-txt-30'); ?> </h2>
                            <h2 class="purple-highlighter wow fadeInUp" data-wow-delay="300ms"><?php echo $this->lang->line('index-txt-31'); ?></h2>
                        </div>
                        <div class="list-title wow fadeInRight" data-wow-delay="500ms">
                            <ul class="index-list">
                                <li><i class="icofont-dotted-right"></i><?php echo $this->lang->line('index-txt-32'); ?></li>
                                <li><i class="icofont-dotted-right"></i><?php echo $this->lang->line('index-txt-33'); ?></li>
                                <li><i class="icofont-dotted-right"></i><?php echo $this->lang->line('index-txt-34'); ?></li>
                            </ul>
                        </div>
                        <a href="<?php echo base_url(); ?>free-trial-store">
                            <button class="btn btn-primary brand-btn-purple wow fadeIn" data-wow-delay="800ms"><?php echo $this->lang->line('start-free-trail'); ?></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- INDEX PAGE: SETION FOUR ENDS -->

<!-- INDEX PAGE: SECTION FIVE STARTS -->

<section class="section-spacing">
    <div class="custom-container">
        <div class="section-title text-center wow fadeIn" data-wow-delay="100ms">
            <h2><?php echo $this->lang->line('our-partners'); ?></h2>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-4">
                <div class="partners wow fadeIn" data-wow-delay="200ms">
                    <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/paytabs_logo.png">
                </div>
            </div>

            <div class="col-4">
                <div class="partners wow fadeIn" data-wow-delay="300ms">
                    <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/aramex-logo.png">
                </div>
            </div>

            <div class="col-4">
                <div class="partners wow fadeIn" data-wow-delay="400ms">
                    <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/hyperpay-logo.png">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- INDEX PAGE: SECTION FIVE ENDS -->

<!-- INDEX PAGE: SECTION SIX STARTS -->

<section>
    <div class="custom-container">
        <div class="home-section-six blue-bg" id="store-free-trail">
            <!-- <form method="POST" action="<?php echo base_url('free-trial-form'); ?>" name="free_trial_form" id="free_trial_form" enctype="multipart/form-data" autocomplete="off">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-wrapper wow fadeIn" data-wow-delay="200ms">
                            <label class="control-label trial-label"><?php echo $this->lang->line('ent-store-name'); ?>:</label>
                            <input type="text" name="free_trial_domain" id="free_trial_domain" class="form-control" placeholder="<?php echo $this->lang->line('index-txt-37'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-wrapper wow fadeIn" data-wow-delay="400ms">
                            <label class="control-label trial-label"><?php echo $this->lang->line('email-add'); ?>:</label>
                            <input type="email" name="free_trial_email" id="free_trial_email" class="form-control" placeholder="<?php echo $this->lang->line('index-txt-38'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-wrapper wow fadeIn" data-wow-delay="600ms">
                            <label class="control-label trial-label"><?php echo $this->lang->line('password'); ?>:</label>
                            <input type="password" name="free_trial_pass" id="free_trial_pass" minlength="8" maxlength="16" class="form-control" placeholder="<?php echo $this->lang->line('index-txt-39'); ?>">
                        </div>
                    </div>
                    <div id="ft_domain_alert" class="alert" role="alert"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg brand-btn-pink align-mid wow fadeIn" id="free_trial_form_btn" data-wow-delay="800ms"><?php echo $this->lang->line('index-txt-40'); ?></button>
            </form> 
            -->
            <div class="form-group row">
                <div class="col-md-6 col-lg-5">
                    <div class="nl-banner">
                        <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>/images/newsletter-image.png">
                    </div>
                </div>
                <div class="col-md-6 col-lg-7">
                    <div class="section-title wow fadeInDown" data-wow-delay="100ms">
                        <!--<h2 class="pb-0">@<?php echo $this->lang->line('matjary'); ?> <?php echo $this->lang->line('index-txt-35'); ?></h2>-->
                        <h2 class="pb-0 arabic-right"><?php echo $this->lang->line('index-txt-41'); ?></h2>
                    </div>
                    <div class="section-two-subtitle wow fadeInUp" data-wow-delay="300ms">
                        <!--<h3><?php echo $this->lang->line('index-txt-36'); ?></h3>-->
                        <h3 class="arabic-right"><?php echo $this->lang->line('index-txt-42'); ?></h3>
                    </div>
                    <form action="<?php echo base_url('save-newsletter-email'); ?>" name="save_newsletter_email_form" id="save_newsletter_email_form" method="post" enctype="multipart/form-data">
                        <div class="form-wrapper">
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo $this->lang->line('user-acc-txt-15'); ?>">
                        </div>
                        <div id="newsletter_msgs"></div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary brand-btn-pink btn-block mt-1"><?php echo $this->lang->line('index-txt-43'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- INDEX PAGE: SECTION SIX ENDS -->
<!-- Footer section  -->
<?php $this->load->view("common/footer.php"); ?>