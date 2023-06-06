<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?php echo $language['All Shipment Pickups']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Manage']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['All Shipment Pickups']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-box mb-30">
        <div class="table-responsive pd-20">
            <table class="data-table table nowrap" id="viewAllShipmentPickupList">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo $language['Datetime']; ?></th>
                        <th scope="col"><?php echo $language['Refference ID']; ?></th>
                        <th scope="col">GUID</th>
                        <th scope="col"><?php echo $language['Total Shipments']; ?></th>  
                        <th scope="col"><?php echo $language['Shipment Weight']; ?></th> 
                        <th scope="col"><?php echo $language['Number Of Pieces']; ?></th> 
                        <th scope="col"><?php echo $language['Pickup Status']; ?></th>
                        <th scope="col"><?php echo $language['Action']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($shippingPickups) && !empty($shippingPickups)){
                        $i = 1;
                        foreach ($shippingPickups as $value) {
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo isset($value->pickup_datetime)?$value->pickup_datetime:'NA'; ?></td>
                            <td><?php echo isset($value->pickup_res->ProcessedPickup->ID)?$value->pickup_res->ProcessedPickup->ID:'NA'; ?></td>
                            <td><?php echo isset($value->pickup_res->ProcessedPickup->GUID)?$value->pickup_res->ProcessedPickup->GUID:'NA'; ?></td>
                            <td><?php echo isset($value->pickup_req->Pickup->PickupItems[0]->NumberOfShipments)?$value->pickup_req->Pickup->PickupItems[0]->NumberOfShipments:'NA'; ?></td>
                            <td><?php echo isset($value->pickup_req->Pickup->PickupItems[0]->ShipmentWeight->Value)?$value->pickup_req->Pickup->PickupItems[0]->ShipmentWeight->Value:'NA'; ?> KG</td>
                            <td><?php echo isset($value->pickup_req->Pickup->PickupItems[0]->NumberOfPieces)?$value->pickup_req->Pickup->PickupItems[0]->NumberOfPieces:'NA'; ?></td>
                            <td><?php echo isset($value->pickupStatus)?$value->pickupStatus:''; ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item cancelPickupBtn" href="javascript:void(0);" data-guid="<?php echo $value->pickup_res->ProcessedPickup->GUID; ?>" data-shipcmpid="<?php echo isset($value->ship_cmp_id)?$value->ship_cmp_id:''; ?>" data-actionurl="<?php echo base_url('admin/cancel-pickup'); ?>" class="cancelPickupBtn" title="Cancel Pickup Request"><?php echo $language['Cancel']; ?></a>
                                        <a class="dropdown-item" href="https://www.aramex.com/us/en/track/pickup-requests/pickup-details?GUID=<?php echo $value->pickup_res->ProcessedPickup->GUID; ?>" target="_blank" title="Track Pickup Request"><?php echo $language['Track']; ?></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                        $i++;
                        }
                    }else{
                    ?>
                        <tr>
                            <td colspan="9"><?php echo $language['No record found.']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>