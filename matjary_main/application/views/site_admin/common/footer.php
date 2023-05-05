<footer>
    <div class="custom-container">
        <div class="dark-blue-bg">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-title"><?php echo $this->lang->line('footer-txt-1'); ?></div>
                    <ul class="footer-list">
                        <li><a href="<?php echo base_url(); ?>about-us"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-2'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>privacy-policy"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-3'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>terms-conditions"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-4'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>refund-return-policy"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-5'); ?></a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <div class="footer-title"><?php echo $this->lang->line('footer-txt-6'); ?></div>
                    <ul class="footer-list">
                        <li><a href="#"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-11'); ?></a></li>
                        <!--
                        <li><a href="#"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-7'); ?></a></li>
                        <li><a href="#"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-8'); ?></a></li>
                        <li><a href="#"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-9'); ?></a></li>
                        <li><a href="#"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-10'); ?></a></li>
                        <li><a href="#"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-12'); ?></a></li>
                        -->
                    </ul>
                </div>
                <div class="col-lg-3">
                    <div class="footer-title"><?php echo $this->lang->line('footer-txt-13'); ?></div>
                    <ul class="footer-list">
                        <li><a href="<?php echo base_url(); ?>help"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-14'); ?></a></li>
                        <!--
                        <li><a href="#"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-15'); ?></a></li>
                        <li><a href="#"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-16'); ?></a></li>
                        -->
                    </ul>
                </div>
                <div class="col-lg-3">
                    <div class="footer-title"><?php echo $this->lang->line('footer-txt-17'); ?></div>
                    <ul class="footer-list">
                        <li><a href="#"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-18'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>faq"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-19'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>contact"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-20'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>pricing"><i class="icofont-caret-right"></i><?php echo $this->lang->line('footer-txt-21'); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="row">
                <div class="col-lg-4">
                    <ul class="social-list mb-2">
                        <li><a href="#" target="_blank"><i class="icofont-facebook"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icofont-whatsapp"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icofont-twitter"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icofont-linkedin"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icofont-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <img class="img-fluid" src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>images/cards.png">
                </div>
                <div class="col-lg-4">
                    <div class="copyright-text">
                        © <?php echo $this->lang->line('advanced-elaf'); ?> | </i><?php echo $this->lang->line('footer-txt-22'); ?> | <a href="#"></i><?php echo $this->lang->line('footer-txt-23'); ?></a>
                    </div>
                </div>
            </div>
            <div class="legal-title">
                <?php echo $this->lang->line('footer-txt-24'); ?>
                <br>
                <?php echo $this->lang->line('footer-txt-25'); ?>
            </div>

        </div>
    </div> 
</footer>

<!-- LOGIN SUCCESSFULL MODAL START -->
<div class="modal fade" id="loginSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-modal-dialog">
        <div class="modal-content login-modal-content">
            <div class="modal-header login-modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <!--<span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body login-modal-body">
                <div class="success-checkmark">
                    <div class="check-icon">
                        <span class="icon-line line-tip"></span>
                        <span class="icon-line line-long"></span>
                        <div class="icon-circle"></div>
                        <div class="icon-fix"></div>
                    </div>
                </div>

                <div class="login-msg text-center">
                    <h4><?php echo $this->lang->line('usr_cntr_msg_40'); ?></h4>
                    <p><?php echo $this->lang->line('usr_cntr_msg_41'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- LOGIN SUCCESSFULL MODAL ENDS -->

<!-- jQuery -->
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>dist/js/adminlte.min.js"></script>


<!-- JQuery Integration Link -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/wow.min.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/sweetalert.min.js"></script>

<!-- form validate js -->
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/jquery-validate.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/form-validation.js"></script>
<?php
if (isset($_SESSION['site_lang']) && !empty($_SESSION['site_lang']) && $_SESSION['site_lang'] == 'en') {
    
} else {
    ?>
    <script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/validate_msg_ar.js"></script>
<?php } ?>
<!-- datatable js cdn -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/data-table-page.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/ajax-call.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>bootstrap/js/bootstrap.min.js"></script>

<!-- Popper Link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<!-- Loader Script -->
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/loader.js"></script>
<!-- Common js Script -->
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/common.js"></script>
<script src="https://rawgit.com/beaver71/Chart.PieceLabel.js/master/build/Chart.PieceLabel.min.js"></script>

<script>
    /*WOW JS INTITATED*/
    new WOW().init();
</script>