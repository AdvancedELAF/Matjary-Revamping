<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<!-- PAGE BAR STARTS -->
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['My Orders']; ?></h1>
        </div>
    </div>
</section>><!-- PAGE BAR ENDS -->
<!-- MY ORDERS TABLE STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="section-title mb-3"><h4><?php echo $language['Order Information']; ?></h4></div>
            <div class="order-detail-table">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $language['Date']; ?></th>
                                <th scope="col"><?php echo $language['Payment Mode']; ?></th>
                                <th scope="col"><?php echo $language['Transaction ID']; ?></th>
                                <th scope="col"><?php echo $language['Payment Status']; ?></th>
                                <th scope="col"><?php echo $language['Order Status']; ?></th>
                                <th scope="col"><?php echo $language['Total Amount']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td><?php echo isset($orderDetails['orderInfo']->created_at)?date("d M Y",strtotime($orderDetails['orderInfo']->created_at)):'NA'; ?></td>
                                <td><?php if($orderDetails['orderInfo']->payment_type==1){ $language['Cash On Delivery']; }elseif($orderDetails['orderInfo']->payment_type==2){ echo $language['Online Banking']; }elseif($orderDetails['orderInfo']->payment_type==3){ echo $language['Gift Cart']; } ?></td>
                                <td><?php echo isset($orderDetails['orderInfo']->transaction_id)?$orderDetails['orderInfo']->transaction_id:'NA'; ?></td>
                                <td><?php if($orderDetails['orderInfo']->payment_status==1){ echo '<span class="text-success">'.$language['Complete'].'</span>'; }elseif($orderDetails['orderInfo']->payment_status==2){ echo '<span class="text-warning">'.$language['Pending'].'</span>'; }elseif($orderDetails['orderInfo']->payment_status==3){ echo '<span class="text-danger">Cancelled</span>'; } ?></td>
                                <td><?php if($orderDetails['orderInfo']->order_status==1){ echo '<span class="text-success">'.$language['Complete'].'</span>'; }elseif($orderDetails['orderInfo']->order_status==2){ echo '<span class="text-warning">'.$language['Pending'].'</span>'; }elseif($orderDetails['orderInfo']->order_status==3){  echo '<span class="text-danger">'.$language['Cancelled'].'</span>'; }else{ echo 'NA'; } ?></td>
                                <td><?php echo $language['SAR']; ?> <?php echo isset($orderDetails['orderInfo']->total_price)?$orderDetails['orderInfo']->total_price:0.00; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section-title mb-3"><h4><?php echo $language['Items Details']; ?></h4></div>
            <div class="order-detail-table">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <?php if(isset($orderDetails['orderProductItemsInfo']) && !empty($orderDetails['orderProductItemsInfo'])){ ?>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"><?php echo $language['Name']; ?></th>
                                    <th scope="col"><?php echo $language['Image']; ?></th>
                                    <th scope="col"><?php echo $language['Quantity']; ?></th>
                                    <th scope="col"><?php echo $language['Price']; ?></th>
                                    <th scope="col"><?php echo $language['Sales Tax']; ?></th>
                                    <th scope="col"><?php echo $language['Total Price']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=1;
                                    foreach ($orderDetails['orderProductItemsInfo'] as $values) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><h6><?php echo isset($values->product_title)?$values->product_title:''; ?></h6></td>
                                    <td>
                                    <?php if(isset($values->image) && !empty($values->image)){ ?>
                                    <img src="<?php echo base_url('/uploads/product/'); ?>/<?php echo isset($values->image)?$values->image:''; ?>"  class="img img-responsive" style="width:auto;min-width:70px;max-width:70px;heihgt:auto;min-height:40px;max-height:40px;"></h5>
                                    <?php }else{ ?>
                                    <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Product image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                                    <?php } ?>
                                    </td>
                                    <td><?php echo isset($values->product_qty)?$values->product_qty:'NA'; ?></td>
                                    <td><?php echo $language['SAR']; ?> <?php echo isset($values->qty_price)?$values->qty_price:'NA'; ?></td>
                                    <td><?php echo $language['SAR']; ?> <?php echo isset($values->qty_sales_tax)?$values->qty_sales_tax:'NA'; ?></td>
                                    <td><?php echo $language['SAR']; ?> 
                                        <?php 
                                            $qty_price = isset($values->qty_price)?$values->qty_price:0; 
                                            $qty_sales_tax = isset($values->qty_sales_tax)?$values->qty_sales_tax:0; 
                                            $total_price = $qty_price + $qty_sales_tax;
                                            echo $total_price;
                                        ?>
                                    </td>
                                </tr>
                                <?php     
                                    $i++;                  
                                    }
                                ?>
                            </tbody>
                        <?php }elseif(isset($orderDetails['orderGiftCardInfo']) && !empty($orderDetails['orderGiftCardInfo'])){ ?>
                            <thead>
                                <tr>
                                    <th scope="col">*</th>
                                    <th scope="col"><?php echo $language['Name']; ?></th>
                                    <th scope="col"><?php echo $language['Price']; ?></th>
                                    <th scope="col"><?php echo $language['Total Price']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><?php echo $language['GiftCard Detail']; ?></th>
                                    <td><?php echo isset($orderDetails['orderGiftCardInfo']->name)?$orderDetails['orderGiftCardInfo']->name:''; ?></td>
                                    <td><?php echo $language['SAR']; ?> <?php echo isset($orderDetails['orderGiftCardInfo']->giftcard_amount)?$orderDetails['orderGiftCardInfo']->giftcard_amount:''; ?></td>
                                    <td><?php echo $language['SAR']; ?> <?php echo isset($orderDetails['orderGiftCardInfo']->total_price)?$orderDetails['orderGiftCardInfo']->total_price:''; ?></td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="row">
                <?php if(!isset($orderDetails['orderGiftCardInfo']) && empty($orderDetails['orderGiftCardInfo'])){ ?>
                    <div class="col-lg-6">
                <div class="section-title mb-3">
                    <h4><?php echo $language['Shipping Address']; ?></h4>
                </div>
                <div class="cart-total-wrapper">
                <p class="delivery-address"><?php echo isset($orderDetails['orderInfo']->address) ? $orderDetails['orderInfo']->address : ''; ?> <?php echo isset($orderDetails['orderInfo']->city_name) ? $orderDetails['orderInfo']->city_name : ''; ?> <?php echo isset($orderDetails['orderInfo']->state_name) ? $orderDetails['orderInfo']->state_name : ''; ?> <?php echo isset($orderDetails['orderInfo']->zipcode) ? $orderDetails['orderInfo']->zipcode : ''; ?> <?php echo isset($orderDetails['orderInfo']->country_name) ? $orderDetails['orderInfo']->country_name : ''; ?></p>
                </div>
            </div>
                <?php } ?>
                <div class="col-lg-6">
                    <div class="section-title mb-3">
                        <h4><?php echo $language['Amount Paid']; ?></h4>
                    </div>
                    <div class="cart-total-wrapper">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="cart-structure-name"><?php echo $language['Grand total']; ?></td>
                                        <td>
                                            <div class="cart-price">
                                                <h5><?php echo $language['SAR']; ?> <?php echo isset($orderDetails['orderInfo']->total_price)?$orderDetails['orderInfo']->total_price:0.00; ?></h5>
                                            </div>
                                        </td>
                                    </tr>                         
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    <?php if($checkrefundApproved->refund_status != 0){ ?>
                        <hr>
                        <div class="section-title mb-3">
                            <h4><?php echo $language['Refund Request Information']; ?></h4>
                        </div>
                        <div class="cart-total-wrapper">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="cart-structure-name"><?php echo $language['Refund Status']; ?></td>
                                            <td>
                                                <div class="cart-price">
                                                    <h5>
                                                        <?php  
                                                        if($checkrefundApproved->refund_status == 0){
                                                            echo $language['Refund Request Raised by Customer.'];
                                                        }elseif($checkrefundApproved->refund_status == 1){
                                                            echo $language['Refund Approved.'];
                                                        }elseif($checkrefundApproved->refund_status == 2){
                                                            echo $language['Refunded Amount Received by Customer.'];
                                                        }
                                                        ?>
                                                    </h5>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart-structure-name"><?php echo $language['Refund Amount']; ?></td>
                                            <td>
                                                <div class="cart-price">
                                                    <h5><?php echo $language['SAR']; ?> <?php echo isset($orderDetails['orderInfo']->total_price)?$orderDetails['orderInfo']->total_price:0.00; ?></h5>
                                                </div>
                                            </td>
                                        </tr>                          
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>                   
                </div>
            </div>
            <div class="back-btn">
                <a href="<?php echo base_url('customer/my-refund-request'); ?>" class="g-brand-btn float-right" ><?php echo $language['Back']; ?></a>
            </div>
        </div>
</section>
<!-- MY ORDERS TABLE ENDS -->
<?php $this->endSection(); ?>
