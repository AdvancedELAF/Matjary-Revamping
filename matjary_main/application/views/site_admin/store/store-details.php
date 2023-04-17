<?php
if ($this->session->userdata('loggedInSuperAdminData')) {
	$loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
} 
$this->load->view('site_admin/layout/header.php');
$this->load->view('site_admin/layout/sidebar.php');
?>
<style id="table_style" type="text/css">
    body
    {
        font-family: Arial;
        font-size: 10pt;
    }
    table
    {
        border: 1px solid #ccc;
        border-collapse: collapse;
		width:100% !important;
    }
    table th
    {
        background-color: #F7F7F7;
        color: #333;
        font-weight: bold;
    }
    table th, table td
    {
        padding: 5px;
        border: 1px solid #ccc;
    }
	.green{
         color:#008000 !important;
	}
	@media print
      {
         @page {
           margin-top: 0;
           margin-bottom: 0;
         }
         body  {
           padding-top: 72px;
           padding-bottom: 10px;
         }
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
				<?php //echo '<pre>'; print_r($storeDetails); die; ?>
				<div id="printableArea">					
					<div id="dvContents">
						
					<div class="row" style="margin:0;padding:0;">
						<div class="col-md" id="listingWrapper">
							<table class="table table-bordered" cellspacing="0" rules="all" border="1">							
								<!-- <thead colspan="2" style="font"><strong style>Store Basic Details</strong></thead> -->
								<tbody>
								    <tr>
										<td colspan="2" style="font" scope="col"><strong>Store Basic Details</strong></td>
									</tr>
									<tr>
										<td scope="col">Store Name</td>
										<td scope="col"><?php echo isset($storeDetails->store_sub_domain)?$storeDetails->store_sub_domain:'NA'; ?></td>
									</tr>
									<tr>
										<td scope="col">Store Link</td>
										<td scope="col"><a target="_blank" href="<?php echo "https://" . $storeDetails->store_link; ?>"> <?php echo $storeDetails->store_link; ?></a>
											</a>
										</td>
									</tr>
									<tr>
										<td scope="col">Store Owner</td>
										<td scope="col"><?php echo isset($storeDetails->fname)?$storeDetails->fname.' '.$storeDetails->lname:'NA'; ?></td>
									</tr>
									<tr>
										<td scope="col">Store Created Datetime</td>
										<td scope="col">
											<?php 
												$datepstrt = date_format (new DateTime($storeDetails->plan_start_dt), 'd M Y');
												echo isset($datepstrt)?$datepstrt:'NA'; 
											?>
										</td>
									</tr>
									<tr style="height:50px;">
										<td scope="col"></td>
										<td scope="col"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md">
							<table class="table table-bordered" cellspacing="0" rules="all" border="1">
								<!-- <thead colspan="2" style="font"><strong style>Store Plan Details</strong></thead> -->
								<tbody>
								    <tr>
										<td colspan="2" style="font" scope="col"><strong>Store Plan Details</strong></td>
									</tr>
									<tr>
										<td>Plan Name</td>
										<td><?php echo isset($storeDetails->plan_name)?$storeDetails->plan_name:'NA'; ?></td>
									</tr>
									<tr>
										<td>Plan Validity</td>
										<td><?php 
												if(isset($storeDetails->subscription_type) && $storeDetails->subscription_type==1){
													echo $storeDetails->validity_in_months.' Days'; 
												}else{
													echo $storeDetails->validity_in_months.' Months'; 
												}
											?>
										</td>
									</tr>
									<tr>
										<td>Plan Expiry</td>
										<td><?php //echo isset($storeDetails->plan_expiry_dt)?$storeDetails->plan_expiry_dt:'NA'; ?>
									    	<?php 
												$datependt = date_format (new DateTime($storeDetails->plan_expiry_dt), 'd M Y');
												echo isset($datependt)?$datependt:'NA'; 
											?>
										</td>
									</tr>
									<tr>
										<td>Plan Cost</td>
										<td><?php echo isset($storeDetails->price)?$storeDetails->price.' SAR':'NA'; ?></td>
									</tr>
									<tr>
										<td>Subscription Type</td>
										<td>
											<?php 
												if(isset($storeDetails->subscription_type) && $storeDetails->subscription_type==1){
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
					</br>
					<div class="row" style="margin:0;padding:0;">
						<div class="col-md">
							<table class="table table-bordered" cellspacing="0" rules="all" border="1">
								<!-- <thead colspan="2" style="font"><strong style>Store Template Details</strong></thead> -->
								<tbody>
								    <tr>
										<td colspan="2" style="font" scope="col"><strong>Store Template Details</strong></td>
									</tr>
									<tr>
										<td>Template Name</td>
										<td><?php echo isset($storeDetails->template_name)?$storeDetails->template_name:'NA'; ?></td>
									</tr>
									<tr>
										<td>Template Cost</td>
										<td><?php echo isset($storeDetails->template_cost)?$storeDetails->template_cost.' SAR':'0.00'; ?></td>
									</tr>
									<tr style="height:50px;">
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md">
							<table class="table table-bordered" cellspacing="0" rules="all" border="1">
								<!-- <thead colspan="2" style="font"><strong style>Payment Details</strong></thead> -->
								<tbody>
								    <tr>
										<td colspan="2" style="font" scope="col"><strong>Payment Details</strong></td>
									</tr>
									<tr>
										<td>Payment Method</td>
										<td>
											<?php 
												if(isset($storeDetails->payment_type) && $storeDetails->payment_type==1){
													echo 'Online Payment';
												}elseif($storeDetails->payment_type==2){
													echo 'Gift Card';
												}elseif($storeDetails->payment_type==3){
													echo 'COD';
												}
												?>
											</td>
									</tr>
									<tr>
										<td>Payment Status</td>
										<td><?php 
												if(isset($storeDetails->payment_status) && !empty($storeDetails->payment_status)){
													if($storeDetails->payment_status==0){
														echo 'Free Trail.';
													}elseif($storeDetails->payment_status==1){
														echo '<span class="text-success green">Authorised</span>';
													}elseif($storeDetails->payment_status==2){
														echo '<span class="text-danger">Cancelled</span>';
													}elseif($storeDetails->payment_status==3){
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
				</div>
					<br/>
				<div class="text-center">
				<input type="button" class="btn btn-primary brand-btn mb-2" onclick="PrintTable();" value="Invoice"/>	
				<!-- <a href="javascript:void(0);" onclick="printPageArea('printableArea')" class="btn btn-primary brand-btn mb-2" >Invoice</a> -->
				<a href="<?php echo base_url('site-admin/all-stores'); ?>" class="btn btn-primary brand-btn mb-2" >Back to Store</a>
			</div>
		</div>										
	</div>
</section>
<script type="text/javascript">
    function PrintTable() {
        var printWindow = window.open('', '', 'height=200,width=400');
        printWindow.document.write('<html><head><title>Store Details</title>');
 
        //Print the Table CSS.
        var table_style = document.getElementById("table_style").innerHTML;
        printWindow.document.write('<style type = "text/css">');
        printWindow.document.write(table_style);
        printWindow.document.write('</style>');
        printWindow.document.write('</head>');
 
        //Print the DIV contents i.e. the HTML Table.
        printWindow.document.write('<body>');
        var divContents = document.getElementById("dvContents").innerHTML;
        printWindow.document.write(divContents);
        printWindow.document.write('</body>');
 
        printWindow.document.write('</html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
<?php  $this->load->view('site_admin/layout/footer.php'); ?>

