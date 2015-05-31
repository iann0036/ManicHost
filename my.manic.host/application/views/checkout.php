<!-- BEGIN PAGE HEAD -->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Checkout <small>finalize your purchase</small></h1>
    </div>
    <!-- END PAGE TITLE -->
    <!-- BEGIN PAGE TOOLBAR -->
    <div class="page-toolbar">
        <!-- Theme Panel was here. RIP. -->
    </div>
    <!-- END PAGE TOOLBAR -->
</div>
<!-- END PAGE HEAD -->
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb hide">
    <li>
        <a href="#">Home</a><i class="fa fa-circle"></i>
    </li>
    <li class="active">
        Checkout
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row margin-top-10">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">Shopping Cart</span>
                </div>
            </div>
            <div class="portlet-body">
                <?php if ($this->cart->total_items()>0) { ?>
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th>
                                Product
                            </th>
                            <th class="hidden-xs">
                                Term
                            </th>
                            <th>
                                Qty
                            </th>
                            <th>
                                Total
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->cart->contents() as $item): ?>
                            <?php foreach ($this->cart->product_options($item['rowid']) as $option_name => $option_value) { $item[$option_name] = $option_value; } ?>
                            <tr id="cartrow-<?php echo $item['rowid']; ?>">
                                <td class="highlight">
                                    <?php echo $item['name']; if (isset($item['domain'])) { ?> - <i><?php echo $item['domain']; } if (isset($item['email_address'])) { ?> - <i><?php echo $item['email_address']; } if (isset($item['hostname'])) { ?> - <i><?php echo $item['hostname']; } ?></i>
                                </td>
                                <td class="hidden-xs">
                                    <?php echo $item['months']; ?> Months
                                </td>
                                <td class="hidden-xs">
                                    <?php echo $item['qty']; ?>
                                </td>
                                <td>
                                    $<?php echo number_format($item['price'],2); ?> USD
                                </td>
                                <td>
                                    <a onclick="deleteItem('<?php echo $item['rowid']; ?>')" class="btn default btn-xs red">
                                        <i class="fa fa-trash-o"></i> Delete </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row margin-top-10">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <div class="well" style="font-size: 12pt;">
                            <table>
                            <tr><td><b>Sub-total:&nbsp;&nbsp;</b></td><td style="text-align: right;">$<?php echo number_format($this->cart->total(),2); ?> USD</td></tr>
                            <tr><td><b>Tax: </b></td><td style="text-align: right;">$<?php echo number_format('0',2); ?> USD</td></tr>
                            <tr><td><b>Total: </b></td><td style="text-align: right;">$<?php echo number_format($this->cart->total(),2); ?> USD</td></tr>
                            </table>
                        </div>
                        <p><a href="/checkout/paypal/" class="btn blue" style="margin-bottom: 10px; width: 184px;">
                            <i class="fa fa-paypal"></i>&nbsp;&nbsp;Pay with PayPal
                        </a>
                        &nbsp;
                        <a href="/checkout/creditcard/" class="btn green" style="margin-bottom: 10px; width: 184px;">
                            <i class="fa fa-credit-card"></i>&nbsp;&nbsp;Pay with Credit Card
                        </a></p>
                    </div>
                </div>
            </div>
            <?php } else { ?>
                <div class="note note-info">
                    <h4 class="block">Nothing to see here</h4>
                    <p>
                        Your shopping cart is currently empty.
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    function deleteItem(id) {
        $.get("/checkout/remove/", { id: id }).done(function(){
            location.reload();
        });
    }
</script>