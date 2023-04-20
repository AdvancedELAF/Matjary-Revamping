<?php
if ($this->session->userdata('loggedInSuperAdminData')) {
    $loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
}
?>
<?php  
    $this->load->view('site_admin/layout/header.php');
    $this->load->view('site_admin/layout/sidebar.php');
?>
<section class="content">
    <div class="container-fluid">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Coupons</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">All Coupons</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <div class="row"><!-- /.row -->
                <div class="col-12">
                    <div class="card">                       
                                              
                    <!-- /.card-header -->
                            <div class="card-body" id="listingWrapper">
                                <table class="table table-bordered table-striped" id="viewAllCouponList">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Code</th>
                                            <th>Start Date</th>
                                            <th>Expiry Date</th>
                                            <th>Discount In (%)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if (isset($getCouponsList) && !empty($getCouponsList)) {
                                                $i = 1;
                                                foreach ($getCouponsList as $value) {
                                            ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td><?php echo isset($value->code) ? $value->code : 'NA'; ?></td>
                                            <td>
                                                <?php 
                                                    $datstrt = date_format (new DateTime($value->start_date), 'd M Y');
                                                    echo isset($datstrt)?$datstrt:'NA'; 
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $dateexp = date_format (new DateTime($value->expiry_date), 'd M Y');
                                                    echo isset($dateexp)?$dateexp:'NA'; 
                                                ?>
                                            </td>
                                            <td><?php echo isset($value->discount_in_percent) ? $value->discount_in_percent.' %' : 'NA'; ?></td>
                                            
                                            <td>
                                                <?php                                                
                                                    $today = date("d M Y");
                                                    $checkExpiryDate = date_format (new DateTime($value->expiry_date), 'd M Y');
                                                    if ($checkExpiryDate >= $today) {
                                                        if ($value->is_active == 1) {
                                                            echo 'Active';
                                                        } else {
                                                            echo 'Deactivated';
                                                        }
                                                    } else {
                                                        echo '<p class="text-danger"> Expired </p>';
                                                    }                                                 
                                                ?> 
                                            </td>
                                            <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-align-justify" aria-hidden="true"></i>
                                                </button>

                                                <div class="dropdown-menu">
                                                    <?php 
                                                    if($checkExpiryDate >= $today) {
                                                        if($value->is_active == 1) { ?>
                                                            <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('site-admin/deactivate-coupon'); ?>" data-id="<?php echo $value->id; ?>" data-operation="deactivate"><i class="dw dw-check"></i> Deactivate</a>
                                                        <?php } else { ?>
                                                            <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('site-admin/activate-coupon'); ?>" data-id="<?php echo $value->id; ?>" data-operation="activate"><i class="dw dw-check"></i>Activate</a>
                                                    <?php } } ?>
                                                    <a class="dropdown-item" href="<?php echo base_url('site-admin/view-coupon/' . $value->id); ?>"><i class="dw dw-edit2"></i>View</a>
                                                    <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('site-admin/delete-coupon'); ?>" data-id="<?php echo $value->id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i> Delete</a>
                                                </div>
                                            </div>
                                                    
                                                </td>
                                            </tr>
                                            <?php
                                                $i++;
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6">No record found.</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div><!-- /.row -->                
        </div>
    </div>
</section>
<?php  $this->load->view('site_admin/layout/footer.php'); ?>