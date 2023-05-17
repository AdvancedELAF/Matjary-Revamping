<?php $server_site_path = base_url(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Mail</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kodchasan:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Quicksand:wght@300;400;500;600;700&display=swap');

        * {
            padding: 0;
            margin: 0;
            text-decoration: none;
            list-style: none;
            font-family: 'Quicksand', sans-serif;
        }

        .mail-header {
            padding: 1rem 0;
        }

        .mail-header img {
            width: 200px;
            height: auto;
            margin-left: auto;
            margin-right: auto;
            display: block;
            margin-bottom: 0.5rem;
        }

        .mail-header-title h1 {
            font-family: 'Kodchasan', sans-serif;
            text-align: center;
            color: #5294F7;
        }

        .mail-body {
            padding: 1rem 2rem;

        }

        .bg-wrap {
            background-color: #E9F6FE;
            padding: 1.5rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
        }

        .mail-title h3 {
            font-family: 'Kodchasan', sans-serif;
            font-weight: 700;
            color: #E63A7B;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .mail-details h5 {
            color: #8D4FDE;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.25rem;
        }

        .resp-align {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .mail-details p {
            color: #8D4FDE;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .orderDetails {
            text-align: right;
            margin-left:239px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
        }

        table {
            caption-side: bottom;
            border-collapse: collapse;
        }

        .table>thead {
            vertical-align: bottom;
        }

        thead {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }

        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }

        .mail-table {
            overflow-x: auto;
            text-align: left;
        }

        .mail-table th {
            padding: 0.5rem 0.5rem;
        }

        .mail-table thead {
            background-color: #8D4FDE;
            color: #FFFFFF;
            text-align: left;
        }

        .mail-table img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .mail-body tr {
            border-bottom: 1px solid #efefef;
        }

        .mail-body td {
            padding: 0.5rem;
        }

        .text-right {
            text-align: right;
        }

        .mail-back-btn a {
            padding: 0.5rem;
            background-color: #8D4FDE;
            border-radius: 1rem;
            margin-top: 1rem;
            color: #FFFFFF;
        }

        .mail-footer {
            text-align: center;
        }

        .mail-footer p {
            color: #E63A7B;
        }

        .mail-footer a {
            font-family: 'Kodchasan', sans-serif;
            color: #8D4FDE;
        }

        .mail-back-btn {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .place-right {
            text-align: right;
        }

        /* MEDIA QUERY STARTS */
        @media (max-width: 815px) {
            .resp-align {
                display: block;
            }
            .orderDetails {
                text-align: left;
                margin-top: 1.5rem;
            }
        } 
        /* MEDIA QUERY ENDS */
    </style>
</head>
<body>
    <div class="mail-header">
    <img src="<?php echo isset($storeLogo)?$storeLogo:''; ?>" style="width:auto;min-width:70px;max-width:70px;heihgt:auto;min-height:40px;max-height:40px;">
        <div class="mail-header-title">
            <h1>Invoice Mail</h1>
        </div>
    </div>
    <div class="mail-body">
        <div class="bg-wrap">
            <div class="resp-align">
                <div class="track-details">
                    <div class="mail-title">
                        <h3>Tracking Details</h3>
                    </div>
                        <?php if(isset($orderDetails['orderProductItemsInfo']) && !empty($orderDetails['orderProductItemsInfo'])){ ?>
                            <div class="mail-details">
                                <h5>Order Id: #<?php echo isset($orderDetails['orderInfo']->transaction_id)?$orderDetails['orderInfo']->transaction_id:'NA'; ?></h5>
                                <h5>Tracking Id: <?php echo isset($orderDetails['orderInfo']->shipping_id)?$orderDetails['orderInfo']->shipping_id:'NA'; ?></h5>
                            </div>
                        <?php } ?>
                        <?php if(!isset($orderDetails['orderGiftCardInfo']) && empty($orderDetails['orderGiftCardInfo'])){ ?>
                            <div class="mail-title">
                                <h3>Shipping Address</h3>
                            </div>
                            <div class="mail-details">
                                <p><?php echo isset($orderDetails['orderInfo']->address) ? $orderDetails['orderInfo']->address : ''; ?> <?php echo isset($orderDetails['orderInfo']->city_name) ? $orderDetails['orderInfo']->city_name : ''; ?> <?php echo isset($orderDetails['orderInfo']->state_name) ? $orderDetails['orderInfo']->state_name : ''; ?> <?php echo isset($orderDetails['orderInfo']->zipcode) ? $orderDetails['orderInfo']->zipcode : ''; ?> <?php echo isset($orderDetails['orderInfo']->country_name) ? $orderDetails['orderInfo']->country_name : ''; ?></p>
                            </div>
                        <?php } ?>
                </div>
                <div class="orderDetails">
                    <div class="mail-title">
                        <h3>Order Details</h3>
                    </div>
                    <div class="mail-details">
                        <p>Date: <?php echo isset($orderDetails['orderInfo']->created_at)?date("Y-m-d",strtotime($orderDetails['orderInfo']->created_at)):'NA'; ?></p>
                        <p>Payment Mode: <?php if($orderDetails['orderInfo']->payment_type==1){ echo 'Cash On Deliwary';}elseif($orderDetails['orderInfo']->payment_type==2){ echo 'Online Banking';}elseif($orderDetails['orderInfo']->payment_type==3){ echo 'Gift Cart'; }?></p>
                        <p>Transaction Id: <?php echo isset($orderDetails['orderInfo']->transaction_id)?$orderDetails['orderInfo']->transaction_id:'NA'; ?></p>
                        <p>
                            Payment Status:  
                                <?php 
                                    if($orderDetails['orderInfo']->payment_status==1){ 
                                        echo '<span class="text-success">Complete</span>';
                                    }elseif($orderDetails['orderInfo']->payment_status==2){ 
                                        echo '<span class="text-warning">Pending</span>';
                                    }elseif($orderDetails['orderInfo']->payment_status==3){ 
                                        echo '<span class="text-danger">Cancelled</span>';
                                    }
                                ?>
                        </p>
                        <p>
                            Order Status:  
                                <?php 
                                    if($orderDetails['orderInfo']->order_status==1){ 
                                        echo '<span class="text-success">Complete</span>';
                                    }elseif($orderDetails['orderInfo']->order_status==2){ 
                                        echo '<span class="text-warning">Pending</span>';
                                    }elseif($orderDetails['orderInfo']->order_status==3){ 
                                        echo '<span class="text-danger">Cancelled</span>';
                                    }else{ 
                                        echo 'NA';
                                    }
                                ?>
                        </p>
                        <p>Total Amount: SAR <?php echo isset($orderDetails['orderInfo']->total_price)?$orderDetails['orderInfo']->total_price:0.00; ?></p>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="mail-title">
            <h3>Item Details</h3>
        </div>
        <div class="mail-table">
            <table class="table"> 
            <?php if(isset($orderDetails['orderProductItemsInfo']) && !empty($orderDetails['orderProductItemsInfo'])){ ?>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Sales Tax</th>
                        <th>Total Price</th>
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
                        <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($values->image)?$values->image:''; ?>"  class="img img-responsive" style="width:auto;min-width:70px;max-width:70px;heihgt:auto;min-height:40px;max-height:40px;"></h5>
                        <?php }else{ ?>
                        <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Product image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                        <?php } ?>
                        </td>
                        <td><h6><?php echo isset($values->product_qty)?$values->product_qty:'NA'; ?></h6></td>
                        <td><h6>SAR <?php echo isset($values->qty_price)?$values->qty_price:'NA'; ?></h6></td>
                        <td><h6>SAR <?php echo isset($values->qty_sales_tax)?$values->qty_sales_tax:'NA'; ?></h6></td>
                        <td>
                            <h6>SAR 
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
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><h6><?php echo isset($orderDetails['orderGiftCardInfo']->name)?$orderDetails['orderGiftCardInfo']->name:''; ?></h6></td>
                        <td>
                        <?php if(isset($orderDetails['orderGiftCardInfo']->image) && !empty($orderDetails['orderGiftCardInfo']->image)){ ?>
                        <img src="<?php echo base_url('uploads/giftcards/'); ?>/<?php echo isset($orderDetails['orderGiftCardInfo']->image)?$orderDetails['orderGiftCardInfo']->image:''; ?>"  class="img img-responsive" style="width:auto;min-width:70px;max-width:70px;heihgt:auto;min-height:40px;max-height:40px;"></h5>
                        <?php }else{ ?>
                        <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Gift image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                        <?php } ?>
                        </td>
                        <td><h6>SAR <?php echo isset($orderDetails['orderGiftCardInfo']->giftcard_amount)?$orderDetails['orderGiftCardInfo']->giftcard_amount:''; ?></h6></td>
                        <td><h6>SAR <?php echo isset($orderDetails['orderGiftCardInfo']->total_price)?$orderDetails['orderGiftCardInfo']->total_price:''; ?></h6></td>
                    </tr>
                </tbody>
            <?php } ?>
            </table>
        </div>
        <div class="place-right">
            <div class="mail-title">
                <h3>Amount Paid</h3>
            </div>
            <div class="mail-details">
                <p>Grand Total: SAR <?php echo isset($orderDetails['orderInfo']->total_price)?$orderDetails['orderInfo']->total_price:0.00; ?></p>
            </div>
            <a href="javascript:window.print();" >Download/Invoice</a>


            <div class="mail-back-btn">
                <a href="<?php echo base_url('customer/my-orders'); ?>">Back to Orders</a>
            </div>
        </div>
        <div class="mail-footer">
                <p>&copy 2022.All Rights Reserved | Powered by <a href="#">Matjary</a></p>
        </div>
    </div>            
</body>
</html>