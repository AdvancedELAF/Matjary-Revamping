<?php 
$session = \Config\Services::session(); 
$ses_logged_in = $session->get('ses_logged_in');
$ses_custmr_name = $session->get('ses_custmr_name');
$ses_custmr_id = $session->get('ses_custmr_id');
?>
<?php $this->extend('store/'.$storeActvTmplName.'/layouts/store_layout'); ?>
<?php $this->section('content'); ?>
<section class="ot-banner <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
        <div class="page-title">
            <h1><?php echo $language['Order Cancel Confirmation']; ?></h1>
        </div>
    </div>
</section>
<!-- ORDER DETAIL TABLE STARTS -->
<section class="section-spacing <?php if($locale=='ar'){echo 'text-right';} ?>">
    <div class="container">
    <div class="section-title mb-3">
            <h4><?php echo $language['Tracking details']; ?></h4>
        </div>        
        <div class="order-detail-table">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo $language['Order Id']; ?></th>
                            <th scope="col"><?php echo $language['Tracking Id']; ?></th>                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h6>#<?php echo isset($orderDetails['orderInfo']->transaction_id)?$orderDetails['orderInfo']->transaction_id:'NA'; ?></h6>
                            </td>                           
                            <td>
                                <h6><a href="https://trackcourier.io/track-and-trace/aramex-courier/<?php echo isset($orderDetails['orderInfo']->shipping_id)?$orderDetails['orderInfo']->shipping_id:'NA'; ?>" target="_blank"><?php echo isset($orderDetails['orderInfo']->shipping_id)?$orderDetails['orderInfo']->shipping_id:'NA'; ?> <span class="badge badge-primary"><?php echo $language['Click here to track']; ?></span> </a></h6>
                            </td>                           
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="section-title mb-3">
            <h4><?php echo $language['Order Details']; ?></h4>
        </div>
        <div class="order-detail-table">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo $language['Datetime']; ?></th>
                            <th scope="col"><?php echo $language['Payment Method']; ?></th>
                            <th scope="col"><?php echo $language['Transaction ID']; ?></th>
                            <th scope="col"><?php echo $language['Payment Status']; ?></th>
                            <th scope="col"><?php echo $language['Order Status']; ?></th>
                            <th scope="col"><?php echo $language['Total Amount']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h6><?php echo isset($orderDetails['orderInfo']->created_at)?$orderDetails['orderInfo']->created_at:'NA'; ?></h6>
                            </td>
                            <td>
                                <h6>
                                    <?php  
                                    if($orderDetails['orderInfo']->payment_type==1){ 
                                        echo $language['Cash On Delivery'];
                                    }elseif($orderDetails['orderInfo']->payment_type==2){ 
                                        echo $language['Online Banking'];
                                    }elseif($orderDetails['orderInfo']->payment_type==3){
                                        echo $language['Gift Cart'];
                                    }
                                    ?>
                                </h6>
                            </td>
                            <td>
                                <h6><?php echo isset($orderDetails['orderInfo']->transaction_id)?$orderDetails['orderInfo']->transaction_id:'NA'; ?></h6>
                            </td>
                            <td>
                                <h6>
                                    <?php 
                                    if($orderDetails['orderInfo']->payment_status==1){ 
                                        echo '<span class="text-success">'.$language['Complete'].'</span>';
                                    }elseif($orderDetails['orderInfo']->payment_status==2){ 
                                            echo '<span class="text-warning">'.$language['Pending'].'</span>';
                                    }elseif($orderDetails['orderInfo']->payment_status==3){ 
                                        echo '<span class="text-danger">'.$language['Cancelled'].'</span>';
                                    }
                                    ?>
                                </h6>
                            </td>
                            <td>
                                <h6>
                                    <?php
                                    if($orderDetails['orderInfo']->order_status==1){ 
                                        echo '<span class="text-success">'.$language['Complete'].'</span>';
                                    }elseif($orderDetails['orderInfo']->order_status==2){ 
                                        echo '<span class="text-warning">'.$language['Pending'].'</span>';
                                    }elseif($orderDetails['orderInfo']->order_status==3){ 
                                        echo '<span class="text-danger">'.$language['Cancelled'].'</span>';
                                    }else{ 
                                        echo $language['NA'];
                                    }
                                    ?>
                                </h6>
                            </td>
                            <td>
                                <h6><?php echo $language['SAR']; ?> <?php echo isset($orderDetails['orderInfo']->total_price)?$orderDetails['orderInfo']->total_price:0.00; ?></h6>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="section-title mb-3">
            <h4><?php echo $language['Items Details']; ?></h4>
        </div>
        <div class="order-detail-table">
            <div class="table-responsive">
                <table class="table table-striped">
                    <?php if(isset($orderDetails['orderProductItemsInfo']) && !empty($orderDetails['orderProductItemsInfo'])){ ?>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><?php echo $language['Image']; ?></th>
                                <th scope="col"><?php echo $language['Name']; ?></th>
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
                                <td>
                                    <?php if(isset($values->image) && !empty($values->image)){ ?>
                                    <img src="<?php echo base_url('/uploads/product/'); ?>/<?php echo isset($values->image)?$values->image:''; ?>"  class="img img-responsive" style="width:auto;min-width:70px;max-width:70px;heihgt:auto;min-height:40px;max-height:40px;"></h5>
                                    <?php }else{ ?>
                                    <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Product image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                                    <?php } ?>
                                </td>
                                <td><h6><?php echo isset($values->product_title)?$values->product_title:''; ?></h6></td>
                                <td><h6><?php echo isset($values->product_qty)?$values->product_qty:'NA'; ?></h6></td>
                                <td><h6><?php echo $language['SAR']; ?> <?php echo isset($values->qty_price)?$values->qty_price:'NA'; ?></h6></td>
                                <td><h6><?php echo $language['SAR']; ?> <?php echo isset($values->qty_sales_tax)?$values->qty_sales_tax:'NA'; ?></h6></td>
                                <td>
                                    <h6><?php echo $language['SAR']; ?> 
                                        <?php 
                                            $qty_price = isset($values->qty_price)?$values->qty_price:0; 
                                            $qty_sales_tax = isset($values->qty_sales_tax)?$values->qty_sales_tax:0; 
                                            $total_price = $qty_price + $qty_sales_tax;
                                            echo $total_price;
                                        ?>
                                    </h6>
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
                                <th scope="col"><?php echo $language['Gift Card Name']; ?></th>
                                <th scope="col"><?php echo $language['Price']; ?>Price</th>
                                <th scope="col"><?php echo $language['Total Price']; ?>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                
                                    //echo '<pre>'; print_r($orderDetails['orderGiftCardInfo']->name); exit;
                            ?>
                            <tr>
                                <th scope="row"><?php echo $language['GiftCard Detail']; ?></th>
                                <td><h6><?php echo isset($orderDetails['orderGiftCardInfo']->name)?$orderDetails['orderGiftCardInfo']->name:''; ?></h6></td>
                                <td><h6><?php echo $language['SAR']; ?> <?php echo isset($orderDetails['orderGiftCardInfo']->giftcard_amount)?$orderDetails['orderGiftCardInfo']->giftcard_amount:''; ?></h6></td>
                                <td><h6><?php echo $language['SAR']; ?> <?php echo isset($orderDetails['orderGiftCardInfo']->total_price)?$orderDetails['orderGiftCardInfo']->total_price:''; ?></h6></td>
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
                        <table class="table table-striped">
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <strong><?php echo $language['Warning']; ?>!</strong> <?php echo $language['Order Cancelation Terms & Conditions.']; ?>
                    <ul>
                        <li><?php echo $language['20 days for some banks']; ?></li>
                        <li><?php echo $language['5 to 7 working']; ?></li>
                        <li><?php echo $language['10-15 working days for a debit card.']; ?></li>
                        <li><?php echo $language['If the refund']; ?></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <select name="cancel_reason" id="cancel_reason" class="form-control">
                            <option value=""><?php echo $language['Select Cancel Reason']; ?></option>
                            <option value="I Changed My Mind"><?php echo $language['I Changed My Mind']; ?></option>
                            <option value="High Shipping Costs And Long Delivery Time"><?php echo $language['High shipping costs']; ?></option>
                            <option value="Because The Item Will Not Be Shipped On Time"><?php echo $language['Because The Item Will Not Be Shipped On Time']; ?></option>
                            <option value="The Item Has Not Yet Been Shipped"><?php echo $language['The Item Has Not Yet Been Shipped']; ?></option>
                            <option value="Any Other Reason"><?php echo $language['Any Other Reason']; ?></option>
                        </select>
                        <span class="text-danger" id="cancel_reason_error_msg" ></span>
                    </div>                    
                    <div class="col-md-6">
                        <div class="back-btn">
                            <a href="javascript:void(0);" class="btn btn-primary g-brand-btn" id="cnfrmCnclBtn" data-cancelreason="Cancel Reason" data-actionurl="<?php echo base_url('customer/cancel-order'); ?>" data-orderid="<?php echo isset($orderDetails['orderInfo']->id)?$orderDetails['orderInfo']->id:''; ?>" data-customerid="<?php echo isset($ses_custmr_id)?$ses_custmr_id:''; ?>"><?php echo $language['Confirm & Cancel']; ?></a>
                            <a href="<?php echo base_url('customer/my-orders'); ?>" class="btn btn-primary brand-btn" ><?php echo $language['Back to orders']; ?></a>
                        </div>
                    </div>                   
                </div>                
            </div>
            <div class="col-md-12" id="otherReason" style="display:none;" >
                <div class="row">
                    <div class="col-md-6">                        
                        <textarea name="other_reason" id="other_reason" rows="2" maxlength ="52" style="width:100%;" class="form-control" placeholder="<?php echo $language['Enter Other Reason']; ?>..."></textarea>
                    </div>               
                </div>
                <span class="text-danger" id="cancel_reason_error_msgs" ></span>
            </div>
        </div>
        
    </div>
</section>
<!-- ORDER DETAIL TABLE ENDS -->
<?php $this->endSection(); ?>