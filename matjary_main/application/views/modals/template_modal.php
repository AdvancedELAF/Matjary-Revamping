<!-- DEMO MODAL STARTS -->
<div class="modal fade" id="templateFullBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="templateFullBannerModalTITLE">Cosma Demo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="img-fluid templateFullBannerModalIMG" src="">
            </div>
        </div>
    </div>
</div>
<!-- DEMO MODAL ENDS -->

<!-- TEMPLATE DETAILS MODAL STARTS -->
<div class="modal fade" id="templateDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="demoModalTitle templateDetailsName"><?php echo $this->lang->line('temp_details'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-4">
                        <div class="tempDetailsImg">
                            <img class="img-fluid tempDetailsImg_tag" src="">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8">
                        <div class="templateBrief">
                            <h3 class="tempDetailsTitle"></h3>
                            <p class="tempDetailsDesc"></p>
                            <!-- <?php if ($value['free_paid_flag'] == 2 && $value['tmp_purchase_status']==false) { ?>
                                <button class="btn btn-primary btn-lg brand-btn-pink align-mid wow fadeIn addTempIddata tplBtn" data-tplid="" data-tplprice="" data-toggle="modal" data-target="#chooseDomainModal">Buy</button>
                            <?php }else{ ?>
                                <button class="btn btn-primary btn-lg brand-btn-pink align-mid wow fadeIn addTempIddata tplBtn" data-tplid="" data-tplprice="0" data-toggle="modal" data-target="#chooseDomainModal"><?php echo $this->lang->line('select_temp'); ?></button>
                            <?php } ?> -->  
                            <!-- <button class="btn btn-primary btn-lg brand-btn-pink align-mid addTempIddata tplBtn" id="templateDetailsModalSelectBuyBtn"  data-tplid="" data-tplprice="" data-toggle="modal" data-target="#chooseDomainModal"><?php echo $this->lang->line('select_temp'); ?></button>  -->
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- TEMPLATE DETAILS MODAL ENDS -->