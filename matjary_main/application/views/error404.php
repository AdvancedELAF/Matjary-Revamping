<?php include("common/header.php"); ?>

<!-- ERROR SECTION STARTS -->
testing
<section>
    <div class="custom-container">
        <div class="error-wrapper text-center">

            <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?><?php echo $this->lang->line('404-pg-txt-1'); ?>">
            <div class="mt-3">
                <h4><?php echo $this->lang->line('404-pg-txt-2'); ?></h4>
                <h4><?php echo $this->lang->line('404-pg-txt-3'); ?></h4>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-primary brand-btn-pink"><?php echo $this->lang->line('404-pg-txt-4'); ?></button>
            </div>   
        </div>
    </div>
</section>
<!-- ERROR SECTION ENDS -->

<!-- Footer section  -->
<?php include("common/footer.php"); ?>