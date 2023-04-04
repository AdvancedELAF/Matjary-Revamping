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
						<h1 class="m-0">Store Details</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
						<li class="breadcrumb-item active">Store Details</li>
						</ol>
					</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
            </div>
			<?php if(isset($GetUsrInvoiceDetails) && !empty($GetUsrInvoiceDetails)){ ?>
			<!-- /.card -->
			<section class="content">
                <!-- Default box -->
                <div class="card">
					<div class="card-header">
						<h3 class="card-title">Store Invoice Details</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<table class="table table-bordered table-striped">
							<thead>
								
							</thead>
								<tbody>
								<tr>
								    <tr>
										<td><b>Store Name : </b>  <?php echo isset($GetUsrInvoiceDetails->template_name)?$GetUsrInvoiceDetails->template_name:'NA'; ?> </td>
										<td><b>Store Link : </b>  <?php echo isset($GetUsrInvoiceDetails->store_link)?$GetUsrInvoiceDetails->store_link:'NA'; ?> </td>
									</tr>
									<tr>										
										<td><b>Store Created Date : </b>  <?php echo isset($GetUsrInvoiceDetails->plan_start_dt)?$GetUsrInvoiceDetails->plan_start_dt:'NA'; ?> </td>
										<td><b>Plan Name : </b>  <?php echo isset($GetUsrInvoiceDetails->plan_name)?$GetUsrInvoiceDetails->plan_name:'NA'; ?> </td>
									</tr>
									<tr>										
										<td><b>Store Active Template Name : </b>  <?php echo isset($GetUsrInvoiceDetails->template_name)?$GetUsrInvoiceDetails->template_name:'NA'; ?> </td>
										<td><b>Transaction No : </b>  <?php echo isset($GetUsrInvoiceDetails->tranRef)?$GetUsrInvoiceDetails->tranRef:'NA'; ?></td>
									</tr>             
									<tr>										
										
										<td><b>Plan Name : </b>  <?php echo isset($GetUsrInvoiceDetails->plan_name)?$GetUsrInvoiceDetails->plan_name:'NA'; ?> </td>
										<td><b>Plan Cost : </b> <?php echo isset($GetUsrInvoiceDetails->price)?$GetUsrInvoiceDetails->price.' SAR':'NA'; ?> </td>
									</tr>
									<tr>										
										
										<td><b>Plan Validity : </b> 
											<?php 
												if(isset($GetUsrInvoiceDetails->subscription_type) && $GetUsrInvoiceDetails->subscription_type==1){
													echo $GetUsrInvoiceDetails->validity_in_months.' Days'; 
												}else{
													echo $GetUsrInvoiceDetails->validity_in_months.' Months'; 
												}
											?>
									    </td>
										<td><b>Plan Expiry Date : </b>  <?php echo isset($GetUsrInvoiceDetails->plan_expiry_dt)?$GetUsrInvoiceDetails->plan_expiry_dt:'NA'; ?></td>
										<td><b>Template Name : </b> <?php echo isset($GetUsrInvoiceDetails->template_name)?$GetUsrInvoiceDetails->template_name:'NA'; ?> </td>

									</tr>
									<tr>										
										
										<td><b>Template Cost : </b> <?php echo isset($GetUsrInvoiceDetails->template_cost)?$GetUsrInvoiceDetails->template_cost:'NA'; ?> </td>
										<td><b>Discount : </b> <?php echo '0' ?> </td>
									</tr>
									<tr>										
										
										<td><b>Total :  </b> <?php echo isset($GetUsrInvoiceDetails->total_price)?$GetUsrInvoiceDetails->total_price . ' SAR':'NA'; ?> </td>
										<td><b>Subscription Type : </b> 
										<?php 
											if(isset($GetUsrInvoiceDetails->subscription_type) && $GetUsrInvoiceDetails->subscription_type==1){
												echo 'Free Plan';
											}else{
												echo 'Paid Plan';
											}
										?> 
									    </td>
									</tr>									
									<tr>										
										
										<td><b>Payment Method : </b>
											<?php 
												if(isset($GetUsrInvoiceDetails->payment_type) && $GetUsrInvoiceDetails->payment_type==1){
													echo 'Online Payment';
												}elseif($GetUsrInvoiceDetails->payment_type==2){
													echo 'Gift Card';
												}elseif($GetUsrInvoiceDetails->payment_type==3){
													echo 'COD';
												}
											?> 
									    </td>
										<td><b>Payment Status : </b>
											<?php 
												if(isset($GetUsrInvoiceDetails->payment_status) && !empty($GetUsrInvoiceDetails->payment_status)){
												if($GetUsrInvoiceDetails->payment_status==0){
													echo 'Free Trail.';
												}elseif($GetUsrInvoiceDetails->payment_status==1){
													echo 'Authorised';
												}elseif($GetUsrInvoiceDetails->payment_status==2){
													echo 'Cancelled';
												}elseif($GetUsrInvoiceDetails->payment_status==3){
													echo 'Payment Rejected or no response';
												}
											}
											?> 
										</td>
									</tr>
									<tr>										
										
										<td><b>Blling Address : </b> <br>
											<?php 
												if(isset($billingAddress) && !empty($billingAddress)){
													$customer_name =  isset($billingAddress['b_fname'])?$billingAddress['b_fname'].' ':'';
													$customer_name .=  isset($billingAddress['b_lname'])?$billingAddress['b_lname'].', ':'';
													echo '<b> Customer Name : </b>'.$customer_name.' </br>';
													$customer_email = isset($billingAddress['b_email'])?$billingAddress['b_email'].', ':'';
													echo '<b> Customer Email </b>: '.$customer_email.' </br>';
													echo '<b> Customer Address </b>: </br>';
													echo isset($billingAddress['b_tel'])?$billingAddress['b_tel'].', ':'';
													echo isset($billingAddress['b_address'])?$billingAddress['b_address'].', ':'';
													echo isset($billingAddress['b_zipcode'])?$billingAddress['b_zipcode'].'.':'';
												}else{
													echo 'No Billing Information Available.';
												}
											?> 
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
                <!-- /.card-body -->
			</div>
			<!-- /.card -->
			<?php } ?>
		</div>										
	</div>
</section>
<?php  $this->load->view('site_admin/layout/footer.php'); ?>
