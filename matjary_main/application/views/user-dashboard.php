<section class="">
    <div class="custom-container">
        <div class="user-sec-title">
            <h4><?php echo $this->lang->line('user-acc-txt-1'); ?></h4>
        </div>
        <div class="dash-wrap blue-bg">
            <div class="row">
                <?php
                if (count($user_domains_details) > 0) {
                    foreach ($user_domains_details as $key => $value) {
                ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="dash-card text-center">
                                <?php
                                $diffDt = (strtotime($value['plan_expiry_dt']) - strtotime(date('Y-m-d'))) / 60 / 60 / 24;
                                if ($diffDt <= DOMAIN_EXP_TRESHOLD) {
                                    if ($diffDt > '0') {
                                        ?>
                                        <div class="expiry-badge">
                                            <p><?php echo $this->lang->line('Expires-In'); ?> <?php echo $diffDt ?> <?php echo $this->lang->line('days'); ?></p>
                                        </div>
                                    <?php } else { ?>
                                        <div class="expired-badge">
                                            <p><?php echo $this->lang->line('Expired'); ?></p>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <h5><?php echo $this->lang->line('user-acc-txt-31'); ?></h5>
                                <a href="https://<?php echo $value['store_link']; ?>" target="_blank"><?php echo $value['store_link']; ?></a>
                                <p><?php echo $this->lang->line('user-acc-txt-32'); ?>: <?php echo $value['plan_expiry_dt']; ?></p>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="col-md-12 col-lg-12">
                        <div class="text-center"><?php echo $this->lang->line('no_store_found'); ?></div>
                        <a href="<?php echo base_url(); ?>pricing" target="_blank">
                            <button class="btn btn-primary btn-lg brand-btn-pink align-mid wow fadeIn" data-wow-delay="800ms"><?php echo $this->lang->line('index-txt-40'); ?></button>
                        </a>
                    </div>               
                <?php } ?>
            </div>
        </div>
    </div>
</section>
