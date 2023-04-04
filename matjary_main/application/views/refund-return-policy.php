<?php include("common/header.php"); ?>
<!-- REFUND & RETURN POLICY SECTION ONE STARTS -->

<section>
    <div class="custom-container">
        <div class="rrp-title-wrapper">
            <div class="rrp-title-section blue-bg">
                <h3><?php echo $this->lang->line('return-txt-1'); ?></h3>
                <p><?php echo $this->lang->line('return-txt-2'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- REFUND & RETURN POLICY SECTION ONE ENDS -->

<!-- REFUND & RETURN POLICY SECTION TWO STARTS -->

<section class="section-spacing">
    <div class="custom-container">
        <div class="rrp-content">
            <ul class="rrp-list">
                <li><i class="icofont-dotted-right"></i><?php echo $this->lang->line('return-txt-3'); ?></li>
                <li><i class="icofont-dotted-right"></i><?php echo $this->lang->line('return-txt-4'); ?></li>
                <li><i class="icofont-dotted-right"></i><?php echo $this->lang->line('return-txt-5'); ?></li>
                <li><i class="icofont-dotted-right"></i><?php echo $this->lang->line('return-txt-6'); ?></li>
                <li><i class="icofont-dotted-right"></i><?php echo $this->lang->line('return-txt-7'); ?></li>
            </ul>
        </div>
        <a <?php if (isset($_SESSION['site_lang']) && !empty($_SESSION['site_lang']) && $_SESSION['site_lang'] == 'arabic') { ?>class="float-right"<?php } ?> href="#"><?php echo $this->lang->line('return-txt-8'); ?></a>
    </div>
</section>

<!-- REFUND & RETURN POLICY SECTION TWO ENDS -->

<!-- Footer section  -->
<?php include("common/footer.php"); ?>