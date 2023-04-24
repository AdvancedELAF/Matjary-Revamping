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
                        <h1 class="m-0">All User Tickets</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">All User Tickets</li>
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
                    <?php //echo '<pre>'; print_r($getContactEnquieryData); die;?>
                    <div class="card-body" id="listingWrapper">
                        <table class="table table-bordered table-striped" id="viewAllSubscribersList">
                            <thead>
                                <tr>
                                <th>ID</th> 
                                <th>Ticket ID</th> 
                                <th>Name</th>                             
                                <th>Email</th>
                                <th>Contact No.</th>   
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($getContactEnquieryData) && !empty($getContactEnquieryData)) {
                                        $i = 1;
                                        foreach ($getContactEnquieryData as $value) {
                                    ?>
                                <tr>
                                    <td scope="row"><?php echo $i; ?></td>
                                    <td><?php echo isset($value->ticket_id ) ? $value->ticket_id : 'NA'; ?></td> 
                                    <td><?php echo isset($value->cont_name ) ? $value->cont_name : 'NA'; ?></td>                                    
                                    <td><?php echo isset($value->cont_email ) ? $value->cont_email : 'NA'; ?></td>
                                    <td><?php echo isset($value->con_phone_no ) ? $value->con_phone_no : 'NA'; ?></td>                                   
                                    <td>                              
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-align-justify" aria-hidden="true"></i>
                                            </button>
                                            <div class="dropdown-menu">                                          
                                            <a class="dropdown-item" href="<?php echo base_url('site-admin/view-coustomer-enquiry/' . $value->ticket_id); ?>"><i class="dw dw-edit2"></i>Details</a>
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
                                        <td colspan="5"><?php echo 'No record found'; ?></td>
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