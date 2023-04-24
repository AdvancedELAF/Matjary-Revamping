<?php include("common/header.php"); ?>

<section>
    <div class="custom-container">
        <div class="pp-title-wrapper">
            <div class="pp-title-section blue-bg">               
                <?php //echo '<pre>'; print_r($getContactEnquieryData); die;?>   
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="code"><strong> <?php echo $this->lang->line('user-acc-txt-46'); ?> : </strong>  <?php echo isset($getContactData->ticket_id)?$getContactData->ticket_id:''; ?></label> 
                            </div>
                        </div> 
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="code"><strong> <?php echo $this->lang->line('subject'); ?> : </strong>  <?php echo isset($getContactData->cont_subject)?$getContactData->cont_subject:''; ?></label> 
                            </div>
                        </div>                        
                        <div class="row">
                        <?php
                            foreach ($getContactEnquieryData as $msg) {
                                if ($msg->role_id == 3) {
                                    echo '
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="alert alert-success">
                                            <strong>User : </strong> '.$msg->message.'
                                        </div>
                                    </div>';                                           
                                } else {
                                    echo '                                                
                                    <div class="col-md-6">
                                        <div class="alert alert-info">
                                            <strong>Support : </strong> '.$msg->message.'
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>';                                            
                                }
                            } 
                        ?> 
                        <div class="col-md-12 ">  
                            <div class="d-grid gap-2 d-md-block text-right mt-4">
                                <button class="btn btn-primary" type="submit" id="replayadmin" ><?php echo $this->lang->line('Reply'); ?> </button>
                            </div>
                            <div id="replayEmail" style="display:none;">                        
                                <div class="contact-form">
                                    <form method="POST" action="<?php echo base_url('submit-customer-enquiry-form'); ?>" name="submit_customer_enquiry_form" id="submit_customer_form" enctype="multipart/form-data">
                                        
                                        <input type="hidden" name="id" value="<?php echo isset($getContactData->id)?$getContactData->id:''; ?>" />
                                        <input type="hidden" name="ticket_id" value="<?php echo isset($getContactData->ticket_id)?$getContactData->ticket_id:''; ?>" />
                                        <input type="hidden" name="cont_email" value="<?php echo isset($getContactData->cont_email)?$getContactData->cont_email:''; ?>" />
                                        <input type="hidden" name="con_phone_no" value="<?php echo isset($getContactData->con_phone_no)?$getContactData->con_phone_no:''; ?>" />
                                        <input type="hidden" name="cont_name" value="<?php echo isset($getContactData->cont_name)?$getContactData->cont_name:''; ?>" />
                                        <input type="hidden" name="cont_message" value="<?php echo isset($getContactData->message)?$getContactData->message:''; ?>" />
                                            
                                        <div class="form-wrapper">                                                       
                                            <div class="form-row wow fadeInDown" data-wow-delay="400ms">
                                                <textarea type="text" name="cont_message" id="cont_message" class="form-control" placeholder="<?php echo $this->lang->line('message'); ?>" rows="5"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-lg brand-btn-pink float-right mt-1 wow fadeInRight" data-wow-delay="600ms">Submit</button>
                                        
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
</section>

<!-- Footer section  -->
<?php include("common/footer.php"); ?>