<?php
if ($this->session->userdata('loggedInSuperAdminData')) {
    $loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
}

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
                        <h1 class="m-0">All Employees</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">All Employees</li>
                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <div class="row"><!-- /.row -->
                <div class="col-12">
                    <div class="card">     
                            <div class="card-body" id="listingWrapper">
                                <table class="table table-bordered table-striped" id="viewAllEmployeeList">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Email </th>
                                            <th>Contact No.</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (isset($getEmployeeData) && !empty($getEmployeeData)) {
                                        $i = 1;
                                        foreach ($getEmployeeData as $value) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo isset($value->fname) ? $value->fname : 'NA'; ?></td>
                                        <td>
                                            <?php 
                                                if($value->usr_role == 1){
                                                    echo 'Super Admin';
                                                }elseif($value->usr_role == 2){
                                                echo 'Admin';
                                                }elseif($value->usr_role == 3){
                                                echo 'User';
                                                }elseif($value->usr_role == 4){
                                                echo 'Manager';
                                                }elseif($value->usr_role == 5){
                                                echo 'Customer Support Executive';
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo isset($value->email) ? $value->email : 'NA'; ?></td>                                        
                                        <td><?php echo isset($value->phone_no) ? $value->phone_no : 'NA'; ?></td>
                                        <td><?php if ($value->is_active == 1) {
                                                echo 'Active';
                                            } else {
                                                echo 'Deactivated';
                                            } ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-align-justify" aria-hidden="true"></i>
                                                </button>

                                                <div class="dropdown-menu">
                                                    <?php if ($value->is_active == 1) { ?>
                                                        <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('site-admin/deactivate-employee'); ?>" data-id="<?php echo $value->id; ?>" data-operation="deactivate"><i class="dw dw-check"></i> Deactivate</a>
                                                    <?php } else { ?>
                                                        <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('site-admin/activate-employee'); ?>" data-id="<?php echo $value->id; ?>" data-operation="activate"><i class="dw dw-check"></i>Activate</a>
                                                    <?php } ?>
                                                    <a class="dropdown-item" href="<?php echo base_url('site-admin/edit-employee/' . $value->id); ?>"><i class="dw dw-edit2"></i>Edit</a>
                                                    <a class="dropdown-item actionBtn" href="javascript:void(0);" data-actionurl="<?php echo base_url('site-admin/delete-employee'); ?>" data-id="<?php echo $value->id; ?>" data-operation="delete"><i class="dw dw-delete-3"></i> Delete</a>
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
                                    <td colspan="7"><?php echo $language['No record found']; ?>.</td>
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
<?php 
include(APPPATH.'views/site_admin/layout/footer.php'); 
?>