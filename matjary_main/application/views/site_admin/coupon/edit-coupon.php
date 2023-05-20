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
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Coupon</h3>
                    </div> <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="<?php echo base_url('update-coupon'); ?>" name="update_coupon" id="update_coupon" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo isset($GetSingleCouponDetails->id)?$GetSingleCouponDetails->id:''; ?>" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="code">Code </label>
                                            <input type="text" class="form-control" disabled id="code" name="code" placeholder="Enter Code." value="<?php echo isset($GetSingleCouponDetails->code)?$GetSingleCouponDetails->code:''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="discount_in_percent">Discount In (%)</label>
                                            <input type="text" class="form-control numberonly" id="discount_in_percent" maxlength="2" name="discount_in_percent" placeholder="Discount In Percentage" value="<?php echo isset($GetSingleCouponDetails->discount_in_percent)?$GetSingleCouponDetails->discount_in_percent:''; ?>">
                                        </div>  
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="start_date">Start Date </label>
                                            <input type="date" class="form-control date" placeholder="Start Date>" id="start_date" name="start_date" value="<?php echo isset($GetSingleCouponDetails->start_date)?$GetSingleCouponDetails->start_date:''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="expiry_date">End Date </label>
                                            <input type="date" class="form-control date" placeholder="Start Date>" id="expiry_date" name="expiry_date" value="<?php echo isset($GetSingleCouponDetails->expiry_date)?$GetSingleCouponDetails->expiry_date:''; ?>">
                                        </div>
                                    </div>                
                                    <div class="col-md-6"> 
                                        <label for="is_active">Is Active</label>
                                        <select class="form-control"  name="is_active" id="is_active">
                                            <option disabled selected >Select</option>
                                            <option <?php if($GetSingleCouponDetails->is_active == '1'){ echo ' selected="selected"'; } ?> value="1" >Active</option> 
                                            <option <?php if($GetSingleCouponDetails->is_active == '2'){ echo ' selected="selected"'; } ?> value="2" >Deactivate</option>    
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="<?php echo base_url('site-admin/all-coupons'); ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                    </form>
                </div> <!-- /.card -->
            </div>
          <!--/.col (left) -->
        </div>
    </div>
</section>
<?php  $this->load->view('site_admin/layout/footer.php'); ?>
