<?php
if ($this->session->userdata('loggedInSuperAdminData')) {
    $loggedInSuperAdminData = $this->session->userdata('loggedInSuperAdminData');
}
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('site-admin/dashboard'); ?>" class="brand-link">
      <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>site_admin/dist/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $loggedInSuperAdminData['fname'].' '.$loggedInSuperAdminData['lname'];?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) --> 
      <!-- Sidebar Menu --> 
      <?php //echo '<pre>'; print_r($this->menuArray); ?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php if (in_array( 1, $this->menuArrayValues)){ ?>
          <li class="nav-item menu-open">          
            <ul class="nav nav-treeview">              
              <li class="nav-item">
                <a href="<?php echo base_url('site-admin/dashboard'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==1){echo'active';}else{echo'';} ?>">
                <i class="fa fa-address-card" aria-hidden="true"></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <?php if (in_array(2, $this->menuArrayValues)){ ?>
          <li class="nav-item <?php if(isset($pageId) && $pageId==2 || isset($pageId) && $pageId==3 || isset($pageId) && $pageId==4 ){echo'menu-open';}else{echo'';} ?>">
              <a href="#" class="nav-link <?php if(isset($pageId) && $pageId==2 || isset($pageId) && $pageId==3 || isset($pageId) && $pageId==4){echo'active';}else{echo'';} ?>">
              <i class="fa fa-user" aria-hidden="true"></i>
                <p>
                  Users
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('site-admin/all-users'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==2 || isset($pageId) && $pageId==4){echo'active';}else{echo'';} ?>">
                    <i class="fa fa-list" aria-hidden="true"></i>
                      <p>All Users</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('site-admin/create'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==3){echo'active';}else{echo'';} ?>">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                      <p>Add Users</p>
                    </a>
                  </li>                          
              </ul>
          </li>
          <?php } ?>
          <?php if (in_array(3, $this->menuArrayValues)){ ?>
          <li class="nav-item <?php if(isset($pageId) && $pageId==25 || isset($pageId) && $pageId==26 || isset($pageId) && $pageId==27 ){echo'menu-open';}else{echo'';} ?>">
              <a href="#" class="nav-link <?php if(isset($pageId) && $pageId==25 || isset($pageId) && $pageId==26 || isset($pageId) && $pageId==27){echo'active';}else{echo'';} ?>">
              <i class="fa fa-user" aria-hidden="true"></i>
                <p>
                  Employee
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('site-admin/all-employees'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==25 || isset($pageId) && $pageId==27){echo'active';}else{echo'';} ?>">
                    <i class="fa fa-list" aria-hidden="true"></i>
                      <p>All Employees</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('site-admin/add-employee'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==26){echo'active';}else{echo'';} ?>">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                      <p>Add Employee</p>
                    </a>
                  </li>                          
              </ul>
          </li>
          <?php } ?>
          <?php if (in_array(4, $this->menuArrayValues)){ ?>
          <li class="nav-item <?php if(isset($pageId) && $pageId==5 || isset($pageId) && $pageId==6 || isset($pageId) && $pageId==7){echo'menu-open';}else{echo'';} ?>"> 
              <a href="#" class="nav-link <?php if(isset($pageId) && $pageId==5 || isset($pageId) && $pageId==6 || isset($pageId) && $pageId==7){echo'active';}else{echo'';} ?>">
              <i class="fa fa-list-alt" aria-hidden="true"></i>
                <p>
                  Template Categories
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('site-admin/all-categorys'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==5 || isset($pageId) && $pageId==7){echo'active';}else{echo'';} ?>">
                    <i class="fa fa-list" aria-hidden="true"></i>
                      <p>All Template Categories</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('site-admin/add-category'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==6){echo'active';}else{echo'';} ?>">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                      <p>Add Category</p>
                    </a>
                  </li>                          
              </ul>
          </li>
          <?php } ?>
          <?php if (in_array(5, $this->menuArrayValues)){ ?>
          <li class="nav-item <?php if(isset($pageId) && $pageId==10 ){echo'menu-open';}else{echo'';} ?>">
              <a href="#" class="nav-link <?php if(isset($pageId) && $pageId==10 ){echo'active';}else{echo'';} ?>">
              <i class="fa fa-envelope"></i>
              <p>
                Email Subscribers
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('site-admin/all-subscribers'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==10){echo'active';}else{echo'';} ?>">
                    <i class="fa fa-list" aria-hidden="true"></i>
                      <p>All Subscribers</p>
                    </a>
                  </li>                                           
              </ul>
          </li>
          <?php } ?> 
          <?php if (in_array(6, $this->menuArrayValues)){ ?>   
          <li class="nav-item <?php if(isset($pageId) && $pageId==8 || isset($pageId) && $pageId==11 || isset($pageId) && $pageId==9 ){echo'menu-open';}else{echo'';} ?>">
            <a href="#" class="nav-link <?php if(isset($pageId) && $pageId==8 || isset($pageId) && $pageId==11 || isset($pageId) && $pageId==9 ){echo'active';}else{echo'';} ?>">
            <i class="fas fa-address-book"></i>
              <p>
              Manage Template
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('site-admin/all-templates'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==8 || isset($pageId) && $pageId==9){echo'active';}else{echo'';} ?>">
                <i class="fa fa-list" aria-hidden="true"></i>
                  <p>All Template</p>
                </a>
              </li>
              <li class="nav-item">
                    <a href="<?php echo base_url('site-admin/add-template'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==11){echo'active';}else{echo'';} ?>">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                      <p>Add Template</p>
                    </a>
              </li>                          
            </ul>
          </li> 
          <?php } ?>
          <?php if (in_array(7, $this->menuArrayValues)){ ?>
          <li class="nav-item <?php if(isset($pageId) && $pageId==13 || isset($pageId) && $pageId==14 || isset($pageId) && $pageId==17){echo'menu-open';}else{echo'';} ?>">
            <a href="#" class="nav-link <?php if(isset($pageId) && $pageId==13 || isset($pageId) && $pageId==14 || isset($pageId) && $pageId==17){echo'active';}else{echo'';} ?>">
            <i class="fas fa-dollar-sign"></i>
              <p>
                Matjary Plans
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('site-admin/all-plans'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==13 || isset($pageId) && $pageId==17 ){echo'active';}else{echo'';} ?>">
                <i class="fa fa-list" aria-hidden="true"></i>
                  <p>All Matjary Plans</p>
                </a>
              </li> 
              <li class="nav-item">
                  <a href="<?php echo base_url('site-admin/add-plan'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==14){echo'active';}else{echo'';} ?>">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                    <p>Add Matjary Plan</p>
                  </a>
              </li>                          
            </ul>
          </li>
          <?php } ?>
          <?php if (in_array(8, $this->menuArrayValues)){ ?>
          <li class="nav-item <?php if(isset($pageId) && $pageId==18 ){echo'menu-open';}else{echo'';} ?>">
            <a href="#" class="nav-link <?php if(isset($pageId) && $pageId==18 ){echo'active';}else{echo'';} ?>">
            <i class="fas fa-store"></i>
              <p>
                Stores
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('site-admin/all-stores'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==18 ){echo'active';}else{echo'';} ?>">
			        <i class="fas fa-store-alt"></i>
                  <p>All Stores</p>
                </a>
              </li> 
                                      
            </ul>
          </li>
          <?php } ?>
          <?php if (in_array(9, $this->menuArrayValues)){ ?>
		    <li class="nav-item <?php if(isset($pageId) && $pageId==20 || isset($pageId) && $pageId==21|| isset($pageId) && $pageId==22){echo'menu-open';}else{echo'';} ?>">
            <a href="#" class="nav-link <?php if(isset($pageId) && $pageId==20 || isset($pageId) && $pageId==21|| isset($pageId) && $pageId==22){echo'active';}else{echo'';} ?>">
            <i class="fas fa-ticket-alt"></i>
              <p>
                Coupons
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('site-admin/all-coupons'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==20 ){echo'active';}else{echo'';} ?>">
				<i class="fa fa-list" aria-hidden="true"></i>
                  <p>All Coupons</p>
                </a>
              </li>
			  <li class="nav-item">
                  <a href="<?php echo base_url('site-admin/add-coupon'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==21){echo'active';}else{echo'';} ?>">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                    <p>Add Coupon</p>
                  </a>
              </li> 
                                      
            </ul>
          </li>
          <?php } ?>
          <?php if (in_array(11, $this->menuArrayValues)){ ?>
          <li class="nav-item <?php if(isset($pageId) && $pageId==10 ){echo'menu-open';}else{echo'';} ?>">
              <a href="#" class="nav-link <?php if(isset($pageId) && $pageId==10 ){echo'active';}else{echo'';} ?>">
              <i class="fas fa-comment"></i>
              <p>
                  User Tickets
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('site-admin/all-customer-enquiry'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==10){echo'active';}else{echo'';} ?>">
                    <i class="fa fa-list" aria-hidden="true"></i>
                      <p>All User Tickets</p>
                    </a>
                  </li>                                           
              </ul>
          </li> 
          <?php } ?>
          <?php if (in_array(10, $this->menuArrayValues)){ ?>
        <li class="nav-item menu-open">          
              <ul class="nav nav-treeview">              
                <li class="nav-item <?php if(isset($pageId) && $pageId==15 ){echo'menu-open';}else{echo'';} ?>">
                  <a href="<?php echo base_url('site-admin/profile'); ?>" class="nav-link <?php if(isset($pageId) && $pageId==15 ){echo'active';}else{echo'';} ?>">
                  <i class="fa fa-users" aria-hidden="true"></i>
                    <p>Profile</p>
                  </a>
                </li>
              </ul>
            </li>  
            <?php } ?>             
          <li class="nav-item menu-open">            
            <ul class="nav nav-treeview">              
              <li class="nav-item">
                <a href="<?php echo base_url('site-admin-logout'); ?>" class="nav-link">
                <i class="fas fa-sign-out-alt"></i>
                  <p>Logout</p>
                </a>                
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

