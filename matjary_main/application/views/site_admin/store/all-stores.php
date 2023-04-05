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
                    <h1 class="m-0">All Stores</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">All Stores</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <?php //echo '<pre>'; print_r($getStoresList); die; ?>
            <div class="row"><!-- /.row -->
                <div class="col-12">
                    <div class="card">        
                    <!-- /.card-header -->
                    <div class="card-body" id="listingWrapper">
                        <table class="table table-bordered table-striped" id="viewAllStoreList">
                            <thead>
                                <tr>
                                <th>ID</th>                                
                                <th>Name</th>                                 
                                <th>Link</th>
                                <th>Owner</th>                                 
                                <th>Plan</th>
                                <th>Expiry date</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($getStoresList) && !empty($getStoresList)) {
                                        $i = 1;
                                        foreach ($getStoresList as $value) {
                                    ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo isset($value->fname ) ? $value->fname : 'NA'; ?></td>                                     
                                    <td><a href="<?php echo $value->store_link; ?>" target="_blank"><?php echo $value->store_link; ?></td>
                                    <td><?php echo isset($value->fname ) ? $value->fname.' '.$value->lname : 'NA'; ?></td>
                                    <td><?php echo isset($value->plan_name ) ? $value->plan_name : 'NA'; ?></td>
                                    <td><?php //echo isset($value->plan_expiry_dt ) ? $value->plan_expiry_dt : 'NA'; ?>
                                        <?php 
                                            $dateexp = date_format (new DateTime($value->plan_expiry_dt), 'd M Y');
                                            echo isset($dateexp)?$dateexp:'NA'; 
                                        ?>
                                    </td>                                                               
                                   
                                    <td><?php if ($value->is_active == 1) {
                                            echo 'Active';
                                        }elseif ($value->is_active == 2) { 
                                            echo 'Inactive';
                                        }elseif ($value->is_active == 3){
                                            echo 'Deleted';
                                        } ?>
                                    </td>
                                    <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-align-justify" aria-hidden="true"></i>
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?php echo base_url('site-admin/store-details/'.$value->id); ?>"><i class="dw dw-edit2"></i>Details</a>
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
                                        <td colspan="6"><?php echo $language['No record found']; ?>.</td>
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
<?php $this->load->view('site_admin/layout/footer.php'); ?>