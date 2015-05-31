<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">Buy a new VPS package</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" action="/vps/buy/complete/" method="post">
                    <input type="hidden" name="plan" value="<?php echo $plan; ?>" />
                    <input type="hidden" name="months" value="<?php echo $months; ?>" />
                    <div class="form-group">
                        <label class="col-md-4 control-label">Plan</label>
                        <div class="col-md-8">
                            <p class="form-control-static"><b>VPS <?php echo $plan; ?></b></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Hostname</label>
                        <div class="col-md-8">
                            <input name="hostname" type="text" class="form-control" placeholder="yourdomain.com" />
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="col-md-4"></label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <button type="submit" class="btn blue">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>