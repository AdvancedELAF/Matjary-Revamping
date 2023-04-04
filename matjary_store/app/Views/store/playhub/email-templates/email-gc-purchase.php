<?php $server_site_path = base_url(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Mail</title>
</head>
<style>
    .mail-wrap {
        width: 400px;
        padding: 1.5rem;
        background-color: #FFFFFF;
    }
    @media (max-width: 400px) {
        .mail-wrap {
            width: 200px;
        }
    }
</style>
<body style="list-style: none; text-decoration: none; padding: 0; margin: 0; background-color: #FAFAFA; display: grid; place-content: center; min-height: 100vh;">
 <div class="mail-wrap" style="width: 98%; padding: 1%;background-color: #FFFFFF;">
        <div>
            <img src="<?php echo isset($storeLogo)?$storeLogo:''; ?>" style="width: auto; height: 100px; object-fit: contain; margin-bottom: 1rem; margin-left: auto; margin-right: auto; display: block;">
        </div>
        <div style="font-family: sans-serif;">
                <h2 style="text-align: center; margin-top: 0; margin-bottom: 10px; color: #4BB543; border-bottom: 1px solid #dfdfdf; padding-bottom: 1rem;"> Invoice Mail</h2>
                <h3 style="color: #5294F7; margin-bottom: 0;">Tracking Details</h3>
            <?php if(isset($orderDetails['orderProductItemsInfo']) && !empty($orderDetails['orderProductItemsInfo'])){ ?>
                <p style="margin-bottom: 3px; margin-top: 10px;">Order ID: # <?php echo isset($orderDetails['orderInfo']->transaction_id)?$orderDetails['orderInfo']->transaction_id:'NA'; ?></p>
                <p style="margin-bottom: 3px; margin-top: 10px;">Tracking ID: <?php echo isset($orderDetails['orderInfo']->shipping_id)?$orderDetails['orderInfo']->shipping_id:'NA'; ?></p>
            <?php } ?>
                <h3 style="color: #5294F7; margin-bottom: 0;">Shipping Address</h3>
            <?php if(!isset($orderDetails['orderGiftCardInfo']) && empty($orderDetails['orderGiftCardInfo'])){ ?>
                <p style="margin-bottom: 3px; line-height: 1.5; font-size: 14px; margin-top: 10px;"><?php echo isset($orderDetails['orderInfo']->address) ? $orderDetails['orderInfo']->address : ''; ?> <?php echo isset($orderDetails['orderInfo']->city_name) ? $orderDetails['orderInfo']->city_name : ''; ?> <?php echo isset($orderDetails['orderInfo']->state_name) ? $orderDetails['orderInfo']->state_name : ''; ?> <?php echo isset($orderDetails['orderInfo']->zipcode) ? $orderDetails['orderInfo']->zipcode : ''; ?> <?php echo isset($orderDetails['orderInfo']->country_name) ? $orderDetails['orderInfo']->country_name : ''; ?></p>
            <?php } ?>
            <hr>
            <div style="text-align: right;">
                <h3 style="color: #5294F7; margin-bottom: 0;">Order Details</h3>
                <p style="margin-bottom: 3px; margin-top: 10px;">Date: <?php echo isset($orderDetails['orderInfo']->created_at)?date("Y-m-d",strtotime($orderDetails['orderInfo']->created_at)):'NA'; ?></p>
                <p style="margin-bottom: 3px; margin-top: 10px;">Payment Mode: <?php if($orderDetails['orderInfo']->payment_type==1){ echo 'Cash On Deliwary';}elseif($orderDetails['orderInfo']->payment_type==2){ echo 'Online Banking';}elseif($orderDetails['orderInfo']->payment_type==3){ echo 'Gift Cart'; }?></p>
                <p style="margin-bottom: 3px; margin-top: 10px;">Transaction ID: <?php echo isset($orderDetails['orderInfo']->transaction_id)?$orderDetails['orderInfo']->transaction_id:'NA'; ?></p>
                <p style="margin-bottom: 3px; margin-top: 10px;">Payment Status: 
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
                <p style="margin-bottom: 3px; margin-top: 10px;">Order Status: 
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
                <p style="margin-bottom: 3px; margin-top: 10px;">Total Amount: SAR <?php echo isset($orderDetails['orderInfo']->total_price)?$orderDetails['orderInfo']->total_price:0.00; ?></p>
            </div>
            <hr>
            <h3 style="color: #5294F7; margin-bottom: 1rem;">Item Details</h3>
            <table style="border-collapse: collapse; width: 100%; margin-bottom: 1rem; text-align: left; overflow-x: auto;">
                <?php if(isset($orderDetails['orderProductItemsInfo']) && !empty($orderDetails['orderProductItemsInfo'])){ ?>
                <tr>
                    <th style="border: 1px solid #DDDDDD; padding: 8px; font-size: 13px;">#</th>
                    <th style="border: 1px solid #DDDDDD; padding: 8px; font-size: 13px;">Name</th>
                    <th style="border: 1px solid #DDDDDD; padding: 8px; font-size: 13px;">Image</th>
                    <th style="border: 1px solid #DDDDDD; padding: 8px; font-size: 13px;">Quantity</th>
                    <th style="border: 1px solid #DDDDDD; padding: 8px; font-size: 13px;">Price</th>
                    <th style="border: 1px solid #DDDDDD; padding: 8px; font-size: 13px;">Sales Tax</th>
                    <th style="border: 1px solid #DDDDDD; padding: 8px; font-size: 13px;">Total Price</th>
                </tr>
                <?php $i=1; 
                    foreach ($orderDetails['orderProductItemsInfo'] as $values) {
                ?>
                <tr>
                    <td style="border: 1px solid #DDDDDD; padding: 8px; font-size: 11px;">
                        <?php echo $i; ?>
                    </td>
                    <td style="border: 1px solid #DDDDDD; padding: 8px; font-size: 11px;">
                        <?php echo isset($values->product_title)?$values->product_title:''; ?>
                    </td>                    
                    <td style="border: 1px solid #DDDDDD; padding: 8px; font-size: 11px;">
                    <?php if(isset($values->image) && !empty($values->image)){ ?>
                        <img style="width: 80px; height: 80px; object-fit: contain;" src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($values->image)?$values->image:''; ?>">
                    <?php }else{ ?>
                        <img style="width: 80px; height: 80px; object-fit: contain;" src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Product image | Default" >
                    <?php } ?>
                    </td>
                    <td style="border: 1px solid #DDDDDD; padding: 8px; font-size: 11px;"><?php echo isset($values->product_qty)?$values->product_qty:'NA'; ?></td>
                    <td style="border: 1px solid #DDDDDD; padding: 8px; font-size: 11px;">SAR <?php echo isset($values->qty_price)?$values->qty_price:'NA'; ?></td>
                    <td style="border: 1px solid #DDDDDD; padding: 8px; font-size: 11px;">SAR <?php echo isset($values->qty_sales_tax)?$values->qty_sales_tax:'NA'; ?></td>
                    <<td style="border: 1px solid #DDDDDD; padding: 8px; font-size: 11px;">SAR <?php $qty_price = isset($values->qty_price)?$values->qty_price:0; $qty_sales_tax = isset($values->qty_sales_tax)?$values->qty_sales_tax:0; $total_price = $qty_price + $qty_sales_tax; echo $total_price;?></td>
                </tr>
                <?php  $i++; } ?>
                <?php }elseif(isset($orderDetails['orderGiftCardInfo']) && !empty($orderDetails['orderGiftCardInfo'])){ ?>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total Price</th>
                    </tr>
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
            <?php } ?>
            </table>

            <div style="text-align:right">
                <h3 style="color: #5294F7; margin-bottom: 0;">Amount Paid</h3>
                <p style="margin-bottom: 3px; margin-top: 10px;">Grand Total: SAR <?php echo isset($orderDetails['orderInfo']->total_price)?$orderDetails['orderInfo']->total_price:0.00; ?></p>
            </div>
            <p>Regards,</p>
            <p>Team <?php echo $storeName; ?></p>
            <div style="text-align: center; margin-top: 1rem; border-top: 5px solid #f5f5f5">
                <p style="margin-bottom: 5px;">Powered by <a href="<?php echo $supportEmail;?>" target="_blank" style="text-decoration: none; color: #5294F7;"><?php echo $storeName; ?></a></p>
                <small>Address: <?php echo $address; ?> | <a href="mailto:<?php echo $supportEmail;?>" style="text-decoration: none; color: #5294F7;"><?php echo $supportEmail;?></a></small>
                <div style="display: block; margin-left: auto; margin-right: auto; padding-top: 0.5rem;">
                    <a href="<?php echo $sociaFB; ?>"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;" src="<?php echo $server_site_path; ?>/store/<?php echo $templateName; ?>/assets/images/facebook.png"></a>
                    <a href="<?php echo $socialInstagram; ?>"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;" src="<?php echo $server_site_path; ?>/store/<?php echo $templateName; ?>/assets/images/instagram.png"></a>
                    <a href="<?php echo $socialTwitter; ?>"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;" src="<?php echo $server_site_path; ?>/store/<?php echo $templateName; ?>/assets/images/twitter.png"></a>
                    <a href="<?php echo $socialYoutube; ?>"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;" src="<?php echo $server_site_path; ?>/store/<?php echo $templateName; ?>/assets/images/youtube.png"></a>
                    <a href="<?php echo $socialLinkedin; ?>"><img style="width: auto; height: 40px; object-fit: contain; margin: 2px;" src="<?php echo $server_site_path; ?>/store/<?php echo $templateName; ?>/assets/images/linkedin.png"></a>
                </div>
                <small>Disclaimer: This email was sent from an email address that can't receive emails. Please don't  reply to this email. </small>
            </div>
        </div>
    </div>
</body>
</html>