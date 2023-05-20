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
                            <h1 class="m-0">View Coupon</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">View Coupon</li>
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
                    <form method="POST" action="<?php echo base_url('update-coupon'); ?>" name="update_coupon" id="update_coupon" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo isset($GetSingleCouponDetails->id)?$GetSingleCouponDetails->id:''; ?>" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="code">Code :</label> </br>
                                            <p for="code"><?php echo isset($GetSingleCouponDetails->code)?$GetSingleCouponDetails->code:''; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="discount_in_percent">Discount In (%) : </label> </br>
                                            <p for="code"><?php echo isset($GetSingleCouponDetails->discount_in_percent)?$GetSingleCouponDetails->discount_in_percent:''; ?></p>
                                        </div>  
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="start_date">Start Date : </label> </br>
                                            <?php $start_date = date_format (new DateTime($GetSingleCouponDetails->start_date), 'd M Y'); ?>
                                            <p for="code"><?php echo isset($start_date)?$start_date:'NA'; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="expiry_date">End Date : </label> </br>
                                            <?php $expiry_date = date_format (new DateTime($GetSingleCouponDetails->expiry_date), 'd M Y');?>
                                            <p for="code"><?php echo isset($expiry_date)?$expiry_date:'NA'; ?></p>
                                        </div>
                                    </div>                
                                    <div class="col-md-6"> 
                                        <label for="is_active">Is Active :</label>
                                        <?php 
                                            $today = date("d M Y");
                                            $checkExpiryDate = date_format (new DateTime($GetSingleCouponDetails->expiry_date), 'd M Y');
                                            if($checkExpiryDate >= $today){
                                                if($GetSingleCouponDetails->is_active == '1'){
                                                    echo '<p> Active </p>'; 
                                                }else if($GetSingleCouponDetails->is_active == '2'){
                                                    echo '<p> Deactive </p>';
                                                }
                                            }else{
                                                echo '<p class="text-danger"> Expired </p>';  
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="<?php echo base_url('site-admin/all-coupons'); ?>" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div> <!-- /.card -->
            </div>
          <!--/.col (left) -->
        </div>
    </div>
</section>
<?php  $this->load->view('site_admin/layout/footer.php'); ?>
