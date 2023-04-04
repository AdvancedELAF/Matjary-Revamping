<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="row">
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">           
            <a href="<?php echo base_url('admin/all-users'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalUser']) && !empty($dashboardAnalytics['totalUser'])){ echo count($dashboardAnalytics['totalUser']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Total Users']; ?></div>
                </div>
            </a>            
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <a href="<?php echo base_url('admin/all-products'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalProduct']) && !empty($dashboardAnalytics['totalProduct'])){ echo count($dashboardAnalytics['totalProduct']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Listed Products']; ?></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">        
            <a href="<?php echo base_url('admin/all-orders'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalOrders']) && !empty($dashboardAnalytics['totalOrders'])){ echo count($dashboardAnalytics['totalOrders']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Total Orders']; ?></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">            
            <a href="<?php echo base_url('admin/all-product-categories'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalCategories']) && !empty($dashboardAnalytics['totalCategories'])){ echo count($dashboardAnalytics['totalCategories']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Total Categories']; ?></div>
                </div>
            </a>          
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">           
            <a href="<?php echo base_url('admin/all-product-brands'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalBrands']) && !empty($dashboardAnalytics['totalBrands'])){ echo count($dashboardAnalytics['totalBrands']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Total Brands']; ?></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">          
            <a href="<?php echo base_url('admin/all-coupons'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalCoupons']) && !empty($dashboardAnalytics['totalCoupons'])){ echo count($dashboardAnalytics['totalCoupons']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Total Coupons']; ?></div>
                </div>
            </a>            
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">           
            <a href="<?php echo base_url('admin/all-customers'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalCustomers']) && !empty($dashboardAnalytics['totalCustomers'])){ echo count($dashboardAnalytics['totalCustomers']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Total Customers']; ?></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">           
            <a href="<?php echo base_url('admin/all-subscribes'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalSubscribers']) && !empty($dashboardAnalytics['totalSubscribers'])){ echo count($dashboardAnalytics['totalSubscribers']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Total Subscribers']; ?></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">           
            <a href="<?php echo base_url('admin/all-gift-cards'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalGiftCards']) && !empty($dashboardAnalytics['totalGiftCards'])){ echo count($dashboardAnalytics['totalGiftCards']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Total Gift Cards']; ?></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">           
            <a href="<?php echo base_url('admin/ship-orders'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalShippingOrders']) && !empty($dashboardAnalytics['totalShippingOrders'])){ echo count($dashboardAnalytics['totalShippingOrders']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Total Shipments']; ?></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">           
            <a href="<?php echo base_url('admin/shipment-pickups'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalShippmentPickups']) && !empty($dashboardAnalytics['totalShippmentPickups'])){ echo count($dashboardAnalytics['totalShippmentPickups']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Total Pickups']; ?></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">         
            <a href="<?php echo base_url('admin/all-banners'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalBanners']) && !empty($dashboardAnalytics['totalBanners'])){ echo count($dashboardAnalytics['totalBanners']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Total Banner']; ?></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">          
            <a href="<?php echo base_url('admin/all-advertisements'); ?>">
                <div class="widget-data">                   
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalAdvertisements']) && !empty($dashboardAnalytics['totalAdvertisements'])){ echo count($dashboardAnalytics['totalAdvertisements']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Total Advertisements']; ?></div>                   
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">            
            <a href="<?php echo base_url('admin/all-customers'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalResentCustomers']) && !empty($dashboardAnalytics['totalResentCustomers'])){ echo count($dashboardAnalytics['totalResentCustomers']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Resent Customers']; ?></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">           
            <a href="<?php echo base_url('admin/all-users'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalResentUsers']) && !empty($dashboardAnalytics['totalResentUsers'])){ echo count($dashboardAnalytics['totalResentUsers']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Resent Users']; ?></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <a href="<?php echo base_url('admin/all-subscribes'); ?>">
                <div class="widget-data">
                    <div class="h4 mb-0"><?php if(isset($dashboardAnalytics['totalResentSubcrs']) && !empty($dashboardAnalytics['totalResentSubcrs'])){ echo count($dashboardAnalytics['totalResentSubcrs']) ; }else{ echo '0'; }?></div>
                    <div class="weight-600 font-14"><?php echo $language['Resent Subscribers']; ?></div>
                </div>
            </a>
        </div>
    </div>    
</div>
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card-box height-100-p pd-20">
            <h2 class="h4 mb-20"><?php echo $language['Anual Revenue Statistics']; ?></h2>
            <div id="chart5"></div>
        </div>
    </div>
</div>
<div class="card-box mb-30">
    <h2 class="h4 pd-20"><?php echo $language['Best Selling Products']; ?></h2>
    <table class="data-table table nowrap">
        <thead>
            <tr>
                <th class="table-plus datatable-nosort"><?php echo $language['Product']; ?></th>
                <th><?php echo $language['Name']; ?></th>              
                <th><?php echo $language['Price']; ?></th>
                <th><?php echo $language['Quantity']; ?></th>
            </tr>
        </thead>
        <tbody>
        <?php 
                if(isset($getSellingProducts) && !empty($getSellingProducts)){
                    foreach($getSellingProducts as $productData){
                ?>
            <tr>
                <td class="table-plus">
                <a href="<?php echo base_url('product/product-details/'.$productData[0]->id); ?>">
                    <img width="70" height="70" src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($productData[0]->image)?$productData[0]->image:''; ?>">
                </a>
                </td>
                <td>
                    <h5 class="font-16"><a href="#"><?php echo isset($productData[0]->title)?$productData[0]->title:''; ?> </a></h5>
                 
                </td>             
                <td><?php echo isset($productData[0]->product_price)?number_format((float)$productData[0]->product_price, 2, '.', ''):''; ?></td>
                <td><?php echo isset($productData[0]->stock_quantity)?$productData[0]->stock_quantity:''; ?></td>
              
            </tr>
            <?php
                    }
                }
                ?>
           
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
   jQuery('document').ready(function(){
        var options5 = {
            chart: {
                height: 350,
                type: 'bar',
                parentHeightOffset: 0,
                fontFamily: 'Poppins, sans-serif',
                toolbar: {
                    show: false,
                },
            },
            colors: ['#1b00ff', '#f56767'],
            grid: {
                borderColor: '#c7d2dd',
                strokeDashArray: 5,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '25%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            series: [{
                name: 'Total Profit',
                data: [<?php echo isset($getCurrentTotal)?$getCurrentTotal:'0'; ?>]
            }],
            xaxis: {
                title: {
                    text: 'Anual Months'
                },
                //categories: [<?php //echo isset($getCurrentMonth)?$getCurrentMonth:'0';?>],
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                labels: {
                    style: {
                        colors: ['#353535'],
                        fontSize: '16px',
                    },
                },
                axisBorder: {
                    color: '#8fa6bc',
                },
            },
            yaxis: {
                title: {
                    text: 'Currency in SAR'
                },
                labels: {
                    style: {
                        colors: '#353535',
                        fontSize: '16px',
                    },
                },
                axisBorder: {
                    color: '#f00',
                }
            },
            legend: {
                horizontalAlign: 'right',
                position: 'top',
                fontSize: '16px',
                offsetY: 0,
                labels: {
                    colors: '#353535',
                },
                markers: {
                    width: 10,
                    height: 10,
                    radius: 15,
                },
                itemMargin: {
                    vertical: 0
                },
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                style: {
                    fontSize: '15px',
                    fontFamily: 'Poppins, sans-serif',
                },
                y: {
                    formatter: function (val) {
                        return val
                    }
                }
            }
        }
        var chart5 = new ApexCharts(document.querySelector("#chart5"), options5);
        chart5.render();
    });
</script>
<?php $this->endSection(); ?>

