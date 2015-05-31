<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">MBuy a new hosting package - Domain Name</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-inline" role="form" action="/hosting/buy/complete/" method="post">
                    <input type="hidden" name="months" value="<?php echo $months; ?>" />
                    <input type="hidden" name="plan" value="<?php echo $plan; ?>" />

                    <p>Choose the domain name you wish to associate to this product.</p>
                    <div class="form-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="icheck-list">
                                    <div style="display: none;">
                                        <span id="domaindiv" style="font-size: 14px;"><br /><br />
                                            Domain Name:&nbsp;&nbsp;&nbsp;<input name="domainname" placeholder="yourdomain.com" size="60" style="float: none;" class="form-control" type="text" />
                                        <br /><br /></span>
                                    </div>
                                    <?php if ($months>=12 && $plan=="deluxe") { ?>
                                    <label>
                                        <input type="radio" name="domainsetting" class="icheck" data-radio="iradio_square-orange" value="freedomain"> I want to get a FREE domain<sup>1</sup> </label>
                                    <?php } ?>
                                    <label>
                                        <input type="radio" name="domainsetting" class="icheck" data-radio="iradio_square-orange" value="purchase"> I want to purchase a new domain </label>
                                    <label>
                                        <input type="radio" name="domainsetting" class="icheck" data-radio="iradio_square-orange" value="transfer"> I want to transfer my existing domain to Manic Host </label>
                                    <?php if (false) { ?>
                                    <label>
                                        <input type="radio" name="domainsetting" class="icheck" data-radio="iradio_square-orange" value="internaldomain"> I want to use a domain I own through Manic Host </label>
                                    <?php } ?>
                                    <label>
                                        <input type="radio" name="domainsetting" class="icheck" data-radio="iradio_square-orange" value="extregistrar"> I want to use a domain I own through another registrar </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn green-haze">Add To Cart</button>
                        <a href="/hosting/buy/"><button type="button" class="btn default">Cancel</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function() {
        $('.icheck').on('ifChecked', function (event) {
            $('#domaindiv').appendTo($(event.currentTarget).parent().parent());
        });
    }
</script>