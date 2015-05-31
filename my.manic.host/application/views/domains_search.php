    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Dashboard <small>account overview</small></h1>
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
            Dashboard
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->

    <div class="row margin-top-10">
        <div class="col-md-12">
            <form action="/domains/search/" method="post" class="alert alert-success alert-borderless">
                <div class="input-group">
                    <div class="input-cont">
                        <input type="text" name="q"<?php if ($q) echo ' value="'.$q.'"'; ?> placeholder="Enter your search term or domain name..." class="form-control">
                    </div>
												<span class="input-group-btn">
												<button type="submit" class="btn green-haze">
                                                    Search
                                                </button>
												</span>
                </div>
            </form>
        </div>
    </div>
    <?php if ($q) { ?>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart theme-font-color hide"></i>
                        <span class="caption-subject theme-font-color bold uppercase">Search Results</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-advance table-hover" style="text-align: center;">
                            <thead>
                            <tr>
                                <th><b>Domain</b></th>
                                <th><b>Availability</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- <i class="fa fa-check"></i> -->
                            <?php
                            $i = 0;
                            foreach ($results as $result) {
                                echo '<tr style="height: 51px;"><td><div style="font-size: 14px; font-weight: bold; margin-top: 8px;">'.$result['domain'].'</div></td><td>';
                                if ($result['available']) {
                                    if ($result['in_cart']==true)
                                        echo '<button id="cell-'.$i.'" onclick="removeDomainFromCart(\''.$result['domain'].'\','.$result['rawprice'].','.$i.')" style="width: 100px;" type="button" class="btn green"><i class="fa fa-check"></i> <b>'.$result['price'].'</b></button>';
                                    else
                                        echo '<button id="cell-'.$i.'" onclick="addDomainToCart(\''.$result['domain'].'\','.$result['rawprice'].','.$i.')" style="width: 100px;" type="button" class="btn green"><b>'.$result['price'].'</b></button>';
                                } else
                                    echo '<div style="font-size: 14px; font-weight: bold; margin-top: 8px; color: #ff0000;">Unavailable</div>';
                                echo '</td></tr>';
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <br />
                    <center>
                    <a href="/checkout/"><button type="button" class="btn blue">Proceed To Checkout</button></a>
                    </center>
                    <br />
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <?php } else { ?>
    <div style="margin-bottom: 20px; text-align: center;"><img style="height: auto; width: auto; max-width: 100%;" src="/assets/img/tlds.png" /></div>
    <?php } ?>
    <script>
        function addDomainToCart(domain,price,rowid) {
            $.post("/checkout/add/", { type: "domain_registration_1yr", domain: domain, price: price } );
            $('#cell-' + rowid).html('<i class="fa fa-check"></i> <b>$' + price.toFixed(2) + '</b>');
            $('#cell-' + rowid).removeAttr('onclick');
            $('#cell-' + rowid).attr('onclick','removeDomainFromCart(\'' + domain + '\',' + price + ',' + rowid + ')');
        }

        function removeDomainFromCart(domain,price,rowid) {
            $.post("/checkout/remove/", { type: "domain_registration_1yr", domain: domain, price: price } );
            $('#cell-' + rowid).html('<b>$' + price.toFixed(2) + '</b>');
            $('#cell-' + rowid).removeAttr('onclick');
            $('#cell-' + rowid).attr('onclick','addDomainToCart(\'' + domain + '\',' + price + ',' + rowid + ')');
        }
    </script>