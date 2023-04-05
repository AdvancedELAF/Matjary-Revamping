<?php
if ($this->session->userdata('loggedInSuperAdminData')) {
	$loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
} 
$this->load->view('site_admin/layout/header.php');
$this->load->view('site_admin/layout/sidebar.php');
$this->load->view('modals/invoice_modal.php');
?>
<style>
	.table {
  border-collapse: collapse;
  border: 1px solid;
}
</style>
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
				<?php echo '==-'.$GetUsrInvoiceDetails->store_link; ?>
			    <?php //echo '<pre>'; print_r($GetUsrInvoiceDetails->store_link); ?>
				<div id="printableArea">
					<div class="row" style="margin:0;padding:0;">
						<div class="col-md">
							<table class="table table-bordered table-striped">
								<thead colspan="2" style="font"><strong style>Store Basic Details</strong></thead>
								<tbody>
									<tr>
										<td>Store Name</td>
										<td><?php echo isset($GetUsrInvoiceDetails->template_name)?$GetUsrInvoiceDetails->template_name:'NA'; ?></td>
									</tr>
									<tr>
										<td>Store Link</td>
										<td><a target="_blank" href="<?php echo "https://" . $GetUsrInvoiceDetails->store_link; ?>"> <?php echo $GetUsrInvoiceDetails->store_link; ?></a>
											</a>
										</td>
									</tr>
									<tr>
										<td>Store Owner</td>
										<td><?php echo isset($GetUsrInvoiceDetails->fname)?$GetUsrInvoiceDetails->fname.' '.$GetUsrInvoiceDetails->lname:'NA'; ?></td>
									</tr>
									<tr>
										<td>Store Created Datetime</td>
										<td>
											<?php 
												$datepstrt = date_format (new DateTime($GetUsrInvoiceDetails->plan_start_dt), 'd M Y');
												echo isset($datepstrt)?$datepstrt:'NA'; 
											?>
										</td>
									</tr>
									<tr style="height:50px;">
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md">
							<table class="table table-bordered table-striped">
								<thead colspan="2" style="font"><strong style>Store Plan Details</strong></thead>
								<tbody>
									<tr>
										<td>Plan Name</td>
										<td><?php echo isset($GetUsrInvoiceDetails->plan_name)?$GetUsrInvoiceDetails->plan_name:'NA'; ?></td>
									</tr>
									<tr>
										<td>Plan Validity</td>
										<td><?php 
												if(isset($GetUsrInvoiceDetails->subscription_type) && $GetUsrInvoiceDetails->subscription_type==1){
													echo $GetUsrInvoiceDetails->validity_in_months.' Days'; 
												}else{
													echo $GetUsrInvoiceDetails->validity_in_months.' Months'; 
												}
											?>
										</td>
									</tr>
									<tr>
										<td>Plan Expiry</td>
										<td><?php //echo isset($GetUsrInvoiceDetails->plan_expiry_dt)?$GetUsrInvoiceDetails->plan_expiry_dt:'NA'; ?>
									    	<?php 
												$datependt = date_format (new DateTime($GetUsrInvoiceDetails->plan_expiry_dt), 'd M Y');
												echo isset($datependt)?$datependt:'NA'; 
											?>
										</td>
									</tr>
									<tr>
										<td>Plan Cost</td>
										<td><?php echo isset($GetUsrInvoiceDetails->price)?$GetUsrInvoiceDetails->price.' SAR':'NA'; ?></td>
									</tr>
									<tr>
										<td>Subscription Type</td>
										<td>
											<?php 
												if(isset($GetUsrInvoiceDetails->subscription_type) && $GetUsrInvoiceDetails->subscription_type==1){
													echo 'Free Plan';
												}else{
													echo 'Paid Plan';
												}
											?> 
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row" style="margin:0;padding:0;">
						<div class="col-md">
							<table class="table table-bordered ">
								<thead colspan="2" style="font"><strong style>Store Template Details</strong></thead>
								<tbody>
									<tr>
										<td>Template Name</td>
										<td><?php echo isset($GetUsrInvoiceDetails->template_name)?$GetUsrInvoiceDetails->template_name:'NA'; ?></td>
									</tr>
									<tr>
										<td>Template Cost</td>
										<td><?php echo isset($GetUsrInvoiceDetails->template_cost)?$GetUsrInvoiceDetails->template_cost.' SAR':'0.00'; ?></td>
									</tr>
									<tr style="height:50px;">
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md">
							<table class="table table-bordered ">
								<thead colspan="2" style="font"><strong style>Payment Details</strong></thead>
								<tbody>
									<tr>
										<td>Payment Method</td>
										<td>
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
									</tr>
									<tr>
										<td>Payment Status</td>
										<td><?php 
													if(isset($GetUsrInvoiceDetails->payment_status) && !empty($GetUsrInvoiceDetails->payment_status)){
													if($GetUsrInvoiceDetails->payment_status==0){
														echo 'Free Trail.';
													}elseif($GetUsrInvoiceDetails->payment_status==1){
														//echo 'Authorised';
														echo '<span class="text-success">Authorised</span>';
													}elseif($GetUsrInvoiceDetails->payment_status==2){
														//echo 'Cancelled';
														echo '<span class="text-danger">Cancelled</span>';
													}elseif($GetUsrInvoiceDetails->payment_status==3){
														//echo 'Payment Rejected or no response';
														echo '<span class="text-warning">Payment Rejected or no response</span>';
													}
												}
												?> 
											</td>
									</tr>
									<tr style="height:50px;">
										<td></td>
										<td></td>
									</tr>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="text-center">
				<a href="javascript:void(0);" onclick="printPageArea('printableArea')" class="btn btn-primary brand-btn mb-2" >Invoice</a>
				<a href="<?php echo base_url('site-admin/all-stores'); ?>" class="btn btn-primary brand-btn mb-2" >Back to Store</a>
			</div>
		</div>										
	</div>
</section>
<script>
    function printPageArea(areaID){
    var printContent = document.getElementById(areaID).innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
    }
</script>
<?php  $this->load->view('site_admin/layout/footer.php'); ?>
