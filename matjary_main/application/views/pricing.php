<?php include("common/header.php"); ?>

<!-- PRICING SECTION ONE STARTS -->
<section>
    <div class="custom-container">
        <div class="pricing-info-wrapper">
            <div class="pricing-info blue-bg">
                <h3 class="wow fadeInDown"><?php echo $this->lang->line('pricing-txt-1'); ?><br> <?php echo $this->lang->line('pricing-txt-2'); ?></h3>
                <h5 class="wow fadeInUp"><?php echo $this->lang->line('pricing-txt-3'); ?> <span class="matjary-font"><?php echo $this->lang->line('matjary'); ?>.</span><br><?php echo $this->lang->line('pricing-txt-4'); ?></h5>
                <a href="<?php echo base_url(); ?>free-trial-store">
                    <button class="btn btn-primary brand-btn-purple align-mid wow fadeIn"><?php echo $this->lang->line('start-free-trail'); ?></button>
                </a>
            </div>
            <div class="ribbon">
                <span class="ribbon__content"><marquee>Get 14 days Free Trial</marquee></span>
            </div>
        </div>
    </div>
</section>

<!-- PRICING SECTION ONE ENDS -->

<!-- PRICING SECTION TWO STARTS -->
<section class="section-spacing">
    <div class="row">
        <div class="toggle-switch wow slideInDown">
            <div class="control">
                <!-- switch button -->
                <?php if (isset($_SESSION['site_lang']) && !empty($_SESSION['site_lang']) && $_SESSION['site_lang'] == 'arabic') { ?>
                    <p><?php echo $this->lang->line('monthly'); ?></p><!-- monthly -->                   
                    <label class="switch">
                        <input class="switcher" type="checkbox" checked="" data-toggle="toggle" data-on="Annually" data-off="Monthly">
                        <span class="slider"></span>
                    </label>
                    <p><?php echo $this->lang->line('yearly'); ?></p><!-- yearly -->    
                <?php } else { ?>
                    <p><?php echo $this->lang->line('yearly'); ?></p><!-- yearly -->
                    <label class="switch">
                        <input class="switcher" type="checkbox" checked="" data-toggle="toggle" data-on="Annually" data-off="Monthly">
                        <span class="slider"></span>
                    </label>
                    <p><?php echo $this->lang->line('monthly'); ?></p><!-- monthly -->     
                <?php } ?>

            </div>
        </div>
    </div>
    <div class="custom-container">
        <div class="row">
            <?php
            if (isset($planData) && !empty($planData)) {
                foreach ($planData as $value) {
                    ?>
                    <div class="col-lg-4">
                        <form method="post" action="<?php echo base_url('choose-template'); ?>" enctype="multipart/form-data">
                            <input type="hidden" name="plan_months" id="plan_months" value="<?php echo $value->validity_in_months; ?>">
                            <input type="hidden" name="plan_id" id="plan_id" value="<?php echo isset($value->id) ? $value->id : ''; ?>">
                            <input type="hidden" name="plan_price" id="plan_price" value="<?php echo sprintf('%.2f', $value->price); ?>">
                            <div class="pricing-wrapper wow fadeIn <?php if ($value->validity_in_months == 12 || $value->id == 7) { ?>d-none<?php } ?>" id="pricing_div_<?php echo $value->id ?>" data-wow-delay="400ms">
                                <div class="pricing-head">
                                    <h4><?php echo $this->lang->line('matjary') . ' ' . $value->plan_name; ?></h4>
                                    <h6>Best for new businesses. <br>You can upgrade anytime.</h6>
                                </div>
                                <div class="plan-price">
                                    <sup><?php echo $this->lang->line('SAR'); ?></sup>
                                    <div id="<?php echo strtolower($value->plan_name); ?>-matjary-plan" class="amount" data-price="<?php echo sprintf('%.2f', $value->price); ?>">
                                        <?php echo sprintf('%.2f', $value->price); ?>
                                    </div>
                                    <div class="amount-duration">
                                        <?php if ($value->validity_in_months == 1) { ?>
                                            / <?php echo $this->lang->line('month'); ?>
                                        <?php } elseif ($value->validity_in_months == 12) { ?>
                                            / <?php echo $this->lang->line('year'); ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if (isset($loggedInUsrData) && !empty($loggedInUsrData)) { ?>
                                    <button type="submit" class="btn btn-primary brand-btn-purple align-mid"><?php echo $this->lang->line('pricing-txt-5'); ?></button>
                                <?php } else { ?>
                                    <a href="<?php echo base_url('login'); ?>" class="btn btn-primary brand-btn-purple align-mid"><?php echo $this->lang->line('pricing-txt-5'); ?></a>
                                <?php } ?>
                                <div class="features-list">
                                    <ul>
                                        <li><i class="icofont-tick-boxed"></i>Online Store</li>
                                        <li><i class="icofont-tick-boxed"></i>Unlimited Products</li>
                                        <li><i class="icofont-tick-boxed"></i>2 Staff Accounts</li>
                                        <li><i class="icofont-tick-boxed"></i>24x7 Support</li>
                                        <li><i class="icofont-tick-boxed"></i>Sales Channels</li>
                                        <li><i class="icofont-tick-boxed"></i>Manual Order Creation</li>
                                        <li><i class="icofont-tick-boxed"></i>Discount Codes</li>
                                        <li><i class="icofont-tick-boxed"></i>Free SSL Certificate</li>
                                        <li><i class="icofont-tick-boxed"></i>Gift Cards</li>
                                        <li><i class="icofont-tick-boxed"></i>2.0% Transaction Fees</li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>
<!-- Footer section  -->
<?php include("common/footer.php"); ?>