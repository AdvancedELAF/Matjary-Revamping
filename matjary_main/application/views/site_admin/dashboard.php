<?php
if ($this->session->userdata('loggedInSuperAdminData')) {
    $loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
}
$this->load->view('site_admin/layout/header.php');
$this->load->view('site_admin/layout/sidebar.php');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('site-admin/dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
			<!-- ./col -->
			<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php if(isset($dashboardAnalytics['totalUser']) && !empty($dashboardAnalytics['totalUser'])){ echo count($dashboardAnalytics['totalUser']) ; }else{ echo '0'; }?></h3>
                <p>Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url('site-admin/all-users'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php if(isset($dashboardAnalytics['totalOrders']) && !empty($dashboardAnalytics['totalOrders'])){ echo count($dashboardAnalytics['totalOrders']) ; }else{ echo '0'; }?></h3>
                <p>Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php if(isset($dashboardAnalytics['totalRevenue']) && !empty($dashboardAnalytics['totalRevenue'])){ echo $dashboardAnalytics['totalRevenue'][0]->total; }else{ echo '0'; }?></h3>
                <p>Revenue</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php if(isset($dashboardAnalytics['emailSubscribers']) && !empty($dashboardAnalytics['emailSubscribers'])){ echo count($dashboardAnalytics['emailSubscribers']) ; }else{ echo '0'; }?></h3>
                <p>Email Subscribers</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo base_url('site-admin/all-subscribers'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
		<div class="row">
			<!-- ./col -->
			<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php if(isset($dashboardAnalytics['totalResentUsers']) && !empty($dashboardAnalytics['totalResentUsers'])){ echo count($dashboardAnalytics['totalResentUsers']) ; }else{ echo '0'; }?></h3>
                <p>Current Month User Register</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url('site-admin/all-users'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php if(isset($dashboardAnalytics['totalResentOrders']) && !empty($dashboardAnalytics['totalResentOrders'])){ echo count($dashboardAnalytics['totalResentOrders']) ; }else{ echo '0'; }?></h3>
                <p>Current Month Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php if(isset($dashboardAnalytics['totalRecentRevenue']) && !empty($dashboardAnalytics['totalRecentRevenue'])){ echo $dashboardAnalytics['totalRecentRevenue'][0]->total; }else{ echo '0'; }?></h3>
                <p>Current Month Revenue</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
		<div class="row">
          <div class="col-md-6">
            <!-- Line chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Month On Month User Registration
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">				
				          <canvas id="myChartglobal" aria-label="chart" heigth="600" width="400"></canvas>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <!-- Bar chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Month On Month Orders
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">                
				<canvas id="myChart" heigth="400" width="400"></canvas>
              </div>
              <!-- /.card-body-->
            </div>    
          </div>
          <!-- /.col -->
        </div>  
		<div class="row">          
		  <div class="col-md-6">
            <!-- Line chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Month on Month sales /orders
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">                
				<canvas id="SalesOrders" aria-label="chart" heigth="400" width="400"></canvas>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
			<div class="col-md-6">
				<!-- Line chart -->
				<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">
					<i class="far fa-chart-bar"></i>
					Month on Month Revenue
					</h3>
					<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool" data-card-widget="remove">
						<i class="fas fa-times"></i>
					</button>
					</div>
				</div>
				<div class="card-body">                
					<canvas id="revenueCharts" aria-label="chart" heigth="400" width="400"></canvas>
				</div>
				<!-- /.card-body-->
				</div>
				<!-- /.card -->
			</div>
		</div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->    
</div>
<!-- /.content-wrapper -->  
<?php $this->load->view('site_admin/layout/footer.php'); ?>





