<?php include("common/header.php"); ?>

<section>
    <div class="custom-container">
        <div class="contact-wrapper">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="contact-overview blue-bg">
                        <h3 class="wow fadeInDown"><?php echo $this->lang->line('contact-txt-1'); ?></h3>
                        <p class="wow fadeInUp"><?php echo $this->lang->line('contact-txt-2'); ?> <span class="matjary-font"><?php echo $this->lang->line('matjary'); ?></span> <?php echo $this->lang->line('team'); ?>.</p>
                        <div class="contact-details">
                            <h4 class="wow fadeInDown"><?php echo $this->lang->line('contact-txt-3'); ?></h4>
                            <p class="wow fadeInUp"><i class="icofont-envelope"></i><a href="mailto:support@matjary.com">support@matjary.com</a></p>
                            <h4 class="wow fadeInDown"><?php echo $this->lang->line('call-us'); ?></h4>
                            <p class="wow fadeInUp"><i class="icofont-ui-call"></i><a href="tel:+966114007960">+966 11 4007960</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-8">
                    <div class="contact-form">
                        <form method="POST" action="<?php echo base_url('submit-contact-form'); ?>" name="submit_contact_form" id="submit_contact_form" enctype="multipart/form-data">
                        <input type="hidden" name="ticket_id" value="<?php echo mt_rand(10000000,99999999); ?>" />
                        <input type="hidden" name="user_id" value="<?php echo isset($loggedInUsrData['id'])?$loggedInUsrData['id']:''; ?>" />       
                            <div class="form-wrapper">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="mb-3 wow fadeIn" data-wow-delay="400ms">
                                            <input type="text" name="cont_name" id="cont_name" class="form-control" placeholder="<?php echo $this->lang->line('your-name'); ?>" value="<?php echo isset($loggedInUsrData['fname'])?$loggedInUsrData['fname']:''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 wow fadeIn" data-wow-delay="600ms">
                                            <input type="email" name="cont_email" id="cont_email" class="form-control" placeholder="<?php echo $this->lang->line('email-add'); ?>" value="<?php echo isset($loggedInUsrData['email'])?$loggedInUsrData['email']:''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="mb-3 wow fadeIn" data-wow-delay="800ms">
                                            <input type="text" name="con_phone_no" id="con_phone_no" minlength="9" maxlength="10" class="form-control numberonly" placeholder="<?php echo $this->lang->line('phone-no'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 wow fadeIn" data-wow-delay="1000ms">
                                            <input type="text" name="cont_subject" id="cont_subject" class="form-control" placeholder="<?php echo $this->lang->line('subject'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row wow fadeInDown" data-wow-delay="1200ms">
                                    <textarea type="text" name="cont_message" id="cont_message" class="form-control" placeholder="<?php echo $this->lang->line('message'); ?>" rows="5"></textarea>
                                </div>
                                <?php if (isset($loggedInUsrData) && !empty($loggedInUsrData)) { ?>
                                <button type="submit" class="btn btn-primary btn-lg brand-btn-pink float-right mt-4 wow fadeInRight" data-wow-delay="1400ms"><?php echo $this->lang->line('submit'); ?></button>
                                <?php }else{ ?>
                                <a href="modal" class="btn btn-primary btn-lg brand-btn-pink float-right mt-4 wow" data-toggle="modal" data-target="#modal" class="edit-avatar"><?php echo $this->lang->line('submit'); ?></i></a>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="contact-map">
                <div style="width: 100%"><iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=400&amp;hl=en&amp;q=+(Advanced%20Elaf)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
            </div>
        </div>
    </div>
   

    <!--Customer Enquiry Model--->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content invoice-modal-content">
            <div class="modal-header invoice-modal-header">
                <h5 class="modal-title invoice-modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body invoice-modal-body">
                <div class="receipt-content">
                    <div class="container bootstrap snippets bootdey">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice-wrapper">
                                    <?php echo $this->lang->line('contact-txt-5'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Customer Enquiry Model End--->
</section>

<!-- Footer section  -->
<?php include("common/footer.php"); ?>