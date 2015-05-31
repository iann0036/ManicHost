<!-- BEGIN PAGE HEAD -->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Manage Billing <small>manage billing under your account</small></h1>
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
        Billing
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->

<div class="row margin-top-10">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">My Invoices</span>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    <thead>
                    <tr>
                        <th class="table-checkbox">
                            <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes"/>
                        </th>
                        <th id="invoice_id_column">
                            Invoice #
                        </th>
                        <th>
                            Invoice Date
                        </th>
                        <th>
                            Due Date
                        </th>
                        <th>
                            Total
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($invoices as $invoice) {
                    ?>
                        <tr class="odd gradeX">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1"/>
                            </td>
                            <td>
                               <?php echo $invoice->id; ?>
                            </td>
                            <td>
                                <?php echo date('j F Y',strtotime($invoice->date)); ?>
                            </td>
                            <td>
                                <?php echo date('j F Y',strtotime($invoice->duedate)); ?>
                            </td>
                            <td>
                                $<?php echo number_format($invoice->total,2); ?>
                            </td>
                            <td>
                                <?php
                                if ($invoice->status=="PAID") {
                                    ?>
                                    <span class="label label-sm label-success">
									Paid </span>
                                <?php
                                } else {
                                ?>
                                    <span class="label label-sm label-warning">
									Unknown </span>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a target="_blank" href="/billing/view/<?php echo $invoice->id; ?>" class="btn btn-xs blue">View Invoice</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row margin-top-10">
    <div class="col-md-6">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">Add a Card</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="addcc-form" class="form-horizontal" role="form" action="/billing/cc/add/" method="post">
                    <span style="color: #ff0000" class="addcc-errors"></span>
                    <div class="creditcard-payment">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Accepted Card Types</label>
                            <div class="col-md-8" style="vertical-align: middle;">
                                <img src="/assets/img/visa_32.png" />
                                <img src="/assets/img/mastercard_32.png" />
                                <img src="/assets/img/american_express_32.png" />
                                <img src="/assets/img/diners_club_32.png" />
                                <img src="/assets/img/jcb_32.png" />
                                <img src="/assets/img/discover_32.png" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Card Number</label>
                            <div class="col-md-8">
                                <input style="max-width: 250px;" data-stripe="number" type="text" maxlength="20" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">CVC</label>
                            <div class="col-md-8">
                                <input style="max-width: 60px;" data-stripe="cvc" type="text" maxlength="4" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Expiry</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input style="max-width: 50px;" data-stripe="exp-month" type="text" maxlength="2" class="form-control" placeholder="MM">
                                    <input style="max-width: 60px;" data-stripe="exp-year" type="text" maxlength="4" class="form-control" placeholder="YYYY">
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="form-group">
                            <label class="col-md-4"></label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="creditcard-payment"><button type="submit" class="btn blue"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Add Card</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">My Cards</span>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    <thead>
                    <tr>
                        <th class="table-checkbox">
                            <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes"/>
                        </th>
                        <th id="invoice_id_column">
                            Card ID
                        </th>
                        <th>
                            Card Type
                        </th>
                        <th>
                            Expiration Date
                        </th>
                        <th>
                        </th>
                    </tr>
                    </thead>
                    <tbody style="vertical-align: middle;">
                    <?php foreach ($cards as $card) { ?>
                    <tr>
                    <td>
                        <input type="checkbox" class="checkboxes" value="1"/>
                    </td>
                    <td>
                        <?php echo $card->id; if ($card->id == $default) echo " <span style='vertical-align: middle;' class='badge badge-primary badge-roundless'>DEFAULT</span>"; ?>
                    </td>
                    <td>
                        <?php echo $card->brand; ?> ending in <?php echo $card->last4; ?>
                    </td>
                    <td>
                        <?php echo str_pad($card->exp_month, 2, "0", STR_PAD_LEFT); ?>/<?php echo $card->exp_year; ?>
                    </td>
                    <td>
                        <a target="_blank" href="/billing/cc/delete/<?php echo $card->id; ?>" class="btn btn-xs red">Delete</a>
                    </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(window).load(function() {
        $('#invoice_id_column').click();
    });
</script>