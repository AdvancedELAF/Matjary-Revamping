<?php $this->extend('store_admin/layouts/dashboard_layout'); ?>
<?php $this->section('content'); ?>
<style>
    @media print {
  /* style sheet for print goes here */
  .hide-from-printer{  display:none; }
}
</style>
<div class="min-height-200px">
<div id="printableArea"><!--Print Div Start-->
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><?php echo $language['Order Details']; ?></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><?php echo $language['Manage']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Orders']; ?></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $language['Order Details']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card-box pd-20 mb-30">
        <h5 class="h4 text-blue mb-20"><?php echo $language['Order Information']; ?></h5>
        <div class="order-detail-table">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?php echo $language['Datetime']; ?></th>
                            <th scope="col"><?php echo $language['Payment Mode']; ?></th>
                            <th scope="col"><?php echo $language['Transaction ID']; ?></th>
                            <th scope="col"><?php echo $language['Payment Status']; ?></th>
                            <th scope="col"><?php echo $language['Order Status']; ?></th>
                            <th scope="col"><?php echo $language['Total Amount']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo isset($orderDetails['orderInfo']->created_at) ? date("Y-m-d", strtotime($orderDetails['orderInfo']->created_at)) : 'NA'; ?></td>
                            <td><?php if ($orderDetails['orderInfo']->payment_type == 1) {
                                    echo $language['Cash On Delivery'];
                                } elseif ($orderDetails['orderInfo']->payment_type == 2) {
                                    echo $language['Online Banking'];
                                } elseif ($orderDetails['orderInfo']->payment_type == 3) {
                                    echo $language['Gift Cart'];
                                } ?></td>
                            <td>#<?php echo isset($orderDetails['orderInfo']->transaction_id) ? $orderDetails['orderInfo']->transaction_id : 'NA'; ?></td>
                            <td><?php if ($orderDetails['orderInfo']->payment_status == 1) {
                                    echo '<span class="text-success">' . $language['Complete'] . '</span>';
                                } elseif ($orderDetails['orderInfo']->payment_status == 2) {
                                    echo '<span class="text-warning">' . $language['Pending'] . '</span>';
                                } elseif ($orderDetails['orderInfo']->payment_status == 3) {
                                    echo '<span class="text-danger">' . $language['Cancelled'] . '</span>';
                                } else {
                                    echo 'NA';
                                } ?></td>
                            <td><?php if ($orderDetails['orderInfo']->order_status == 1) {
                                    echo '<span class="text-success">' . $language['Complete'] . '</span>';
                                } elseif ($orderDetails['orderInfo']->order_status == 2) {
                                    echo '<span class="text-warning">' . $language['Pending'] . '</span>';
                                } elseif ($orderDetails['orderInfo']->order_status == 3) {
                                    echo '<span class="text-danger">' . $language['Cancelled'] . '</span>';
                                } else {
                                    echo 'NA';
                                } ?></td>
                            <td><?php echo $language['SAR']; ?> <?php echo isset($orderDetails['orderInfo']->total_price) ? $orderDetails['orderInfo']->total_price : 0.00; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-box pd-20 mb-30">
        <h5 class="h4 text-blue mb-20"><?php echo $language['Items Details']; ?></h5>
        <div class="order-detail-table">
            <div class="table-responsive">
                <table class="table">
                    <?php if (isset($orderDetails['orderProductItemsInfo']) && !empty($orderDetails['orderProductItemsInfo'])) { ?>
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
                            $i = 1;
                            foreach ($orderDetails['orderProductItemsInfo'] as $values) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td>
                                        <h6><?php echo isset($values->product_title) ? $values->product_title : ''; ?></h6>
                                    </td>
                                    <td>
                                        <?php if (isset($values->image) && !empty($values->image)) { ?>
                                            <img src="<?php echo base_url('uploads/product/'); ?>/<?php echo isset($values->image) ? $values->image : ''; ?>" class="img img-responsive" style="width:auto;min-width:70px;max-width:70px;heihgt:auto;min-height:40px;max-height:40px;"></h5>
                                        <?php } else { ?>
                                            <img src="https://products.ideadunes.com/assets/images/default_product.jpg" alt="Product image | Default" class="img img-responsive" style="width:auto;min-width:100px;max-width:100px;height:auto;min-height:100px;max-height:100px;">
                                        <?php } ?>
                                    </td>
                                    <td><?php echo isset($values->product_qty) ? $values->product_qty : 'NA'; ?></td>
                                    <td><?php echo $language['SAR']; ?> <?php echo isset($values->qty_price) ? $values->qty_price : 'NA'; ?></td>
                                    <td><?php echo $language['SAR']; ?> <?php echo isset($values->qty_sales_tax) ? $values->qty_sales_tax : 'NA'; ?></td>
                                    <td><?php echo $language['SAR']; ?>
                                        <?php
                                        $qty_price = isset($values->qty_price) ? $values->qty_price : 0;
                                        $qty_sales_tax = isset($values->qty_sales_tax) ? $values->qty_sales_tax : 0;
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
                    <?php } elseif (isset($orderDetails['orderGiftCardInfo']) && !empty($orderDetails['orderGiftCardInfo'])) { ?>
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
                                <td><?php echo isset($orderDetails['orderGiftCardInfo']->name) ? $orderDetails['orderGiftCardInfo']->name : ''; ?></td>
                                <td><?php echo $language['SAR']; ?> <?php echo isset($orderDetails['orderGiftCardInfo']->giftcard_amount) ? $orderDetails['orderGiftCardInfo']->giftcard_amount : ''; ?></td>
                                <td><?php echo $language['SAR']; ?> <?php echo isset($orderDetails['orderGiftCardInfo']->total_price) ? $orderDetails['orderGiftCardInfo']->total_price : ''; ?></td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <?php if (!isset($orderDetails['orderGiftCardInfo']) && empty($orderDetails['orderGiftCardInfo'])) { ?>
            <div class="col-lg-6">
                <div class="card-box pd-20 mb-30">
                    <h5 class="h4 text-blue mt-3 mb-3"><?php echo $language['Shipping Address']; ?></h5>
                    <div class="cart-total-wrapper">
                        <p class="delivery-address"><?php echo isset($orderDetails['orderInfo']->address) ? $orderDetails['orderInfo']->address : ''; ?> <?php echo isset($orderDetails['orderInfo']->city_name) ? $orderDetails['orderInfo']->city_name : ''; ?> <?php echo isset($orderDetails['orderInfo']->state_name) ? $orderDetails['orderInfo']->state_name : ''; ?> <?php echo isset($orderDetails['orderInfo']->zipcode) ? $orderDetails['orderInfo']->zipcode : ''; ?> <?php echo isset($orderDetails['orderInfo']->country_name) ? $orderDetails['orderInfo']->country_name : ''; ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="col-lg-6">
            <div class="card-box pd-20 mb-30">
                <h5 class="h4 text-blue mt-3 mb-3"><?php echo $language['Amount Paid']; ?></h5>
                <div class="cart-total-wrapper">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="cart-structure-name"><?php echo $language['Grand total']; ?></td>
                                    <td>
                                        <div class="cart-price">
                                            <h5><?php echo $language['SAR']; ?> <?php echo isset($orderDetails['orderInfo']->total_price) ? $orderDetails['orderInfo']->total_price : 0.00; ?></h5>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-<?php echo $locale=='ar'?'left':'right'; ?> mb-4">
                <a  href="javascript:void(0);" onclick="printPageArea('printableArea')"  class="btn btn-primary m-1"><?php echo $language['Download/Invoice']; ?></a>
                <a href="<?php echo base_url('admin/all-orders'); ?>" class="btn btn-secondary m-1"><?php echo $language['Back to orders']; ?></a>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function printPageArea(areaID){
    var printContent = document.getElementById(areaID).innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
    }
</script>
<?php $this->endSection(); ?>