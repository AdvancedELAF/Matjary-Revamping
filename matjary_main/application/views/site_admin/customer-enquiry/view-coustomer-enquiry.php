<?php
$this->load->view('site_admin/layout/header.php');
$this->load->view('site_admin/layout/sidebar.php');
if ($this->session->userdata('loggedInSuperAdminData')) {
    $loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="content-wrapper">
        <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">View Enquiry</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">View Enquiry</li>
                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">&nbsp;</h3>
                    </div> <!-- /.card-header -->
                    <!-- form start -->
                    <?php //echo '<pre>'; print_r($GetSingleEnquiryDetails); die;?>
                    <input type="hidden" name="id" value="<?php echo isset($GetSingleEnquiryDetails->id)?$GetSingleEnquiryDetails->id:''; ?>" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="code">Name :</label> </br>
                                            <p for="code"><?php echo isset($GetSingleEnquiryDetails->cont_name)?$GetSingleEnquiryDetails->cont_name:''; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="code">Email :</label> </br>
                                            <p for="code"><?php echo isset($GetSingleEnquiryDetails->cont_email)?$GetSingleEnquiryDetails->cont_email:''; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="code">Contact No. :</label> </br>
                                            <p for="code"><?php echo isset($GetSingleEnquiryDetails->con_phone_no)?$GetSingleEnquiryDetails->con_phone_no:''; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="code">Meassage :</label> </br>
                                            <p for="code"><?php echo isset($GetSingleEnquiryDetails->cont_message)?$GetSingleEnquiryDetails->cont_message:''; ?></p>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        <!-- /.card-body -->
                        <div class="d-grid gap-2 d-md-block text-right mt-4">
                        <button class="btn btn-primary" type="submit" id="replayadmin" >Reply </button>
                        </div>
                        <div id="replayEmail" style="display:none;">                        
                            <form method="POST" action="<?php echo base_url('reply-contact-admin'); ?>" name="reply_contact_form" id="reply_contact_form" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo isset($GetSingleEnquiryDetails->id)?$GetSingleEnquiryDetails->id:''; ?>" />
                                <input type="hidden" name="email" value="<?php echo isset($GetSingleEnquiryDetails->cont_email)?$GetSingleEnquiryDetails->cont_email:''; ?>" />
                                <input type="hidden" name="contact_no" value="<?php echo isset($GetSingleEnquiryDetails->con_phone_no)?$GetSingleEnquiryDetails->con_phone_no:''; ?>" />
                                <input type="hidden" name="name" value="<?php echo isset($GetSingleEnquiryDetails->cont_name)?$GetSingleEnquiryDetails->cont_name:''; ?>" />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-2">
                                            <label><b>To</b></label>
                                            <p><?php echo isset($GetSingleEnquiryDetails->email)?$GetSingleEnquiryDetails->email:''; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-2">
                                            <label><b>Meassage</b></label>
                                            <textarea class="form-control" rows="3" placeholder="Your Message*" id="admin_reply" name="admin_reply"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-block text-right mt-4">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <a href="<?php echo base_url('admin/all-contact-us'); ?>" class="btn btn-secondary" >Cancel</a>
                                </div>
                            </form>
                        </div>                       
                </div> <!-- /.card -->
            </div>
          <!--/.col (left) -->
        </div>
    </div>
</section>
<?php  $this->load->view('site_admin/layout/footer.php'); ?>
