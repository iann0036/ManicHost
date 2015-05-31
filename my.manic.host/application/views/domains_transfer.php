<!-- BEGIN PAGE HEAD -->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Transfer Domains <small>transfer a domain into your account</small></h1>
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
        Domains
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->

<div class="row margin-top-10">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">Transfer Domain</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="transferdomain-form" class="form-horizontal" role="form" action="/domains/transfer/" method="post">
                    <div id="minperiodalert" style="display: none;" class="alert alert-warning">
                        <strong>Minimum Period:</strong> This transfer would require a minimum of <b id="num_years"></b> years registration, at a cost of <b id="duration_cost"></b> for the duration.
                    </div>
                    <div id="failurealert" style="display: none;" class="alert alert-danger">
                        <strong>Error:</strong> Sorry, we cannot validate this transfer. Contact support for further information.
                    </div>
                    <input id="min_years" name="min_years" type="hidden" />
                    <div class="form-group">
                        <label class="col-md-2 control-label">Domain Name</label>
                        <div class="col-md-10">
                            <input id="domain" onchange="fieldChange()" name="domain" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">EPP Code</label>
                        <div class="col-md-10">
                            <input id="epp" onchange="fieldChange()" name="epp" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Price</label>
                        <div class="col-md-10">
                            <p id="price" class="form-control-static"><i>Unknown</i></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2"></label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <button id="validateButton" onclick="validateTransfer()" type="button" class="btn purple-soft">Check Price and Validate</button>
                                <button style="display: none;" id="submitButton" type="submit" class="btn blue">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function validateTransfer() {
        $('#validateButton').attr('disabled','disabled');
        $('#validateButton').html('Checking...');
        $.post("/domains/checktransfer/", { domain: $('#domain').val(), epp: $('#epp').val() }).done(function(data) {
            var json = JSON.parse(data);
            if (json.success==true) {
                $('#num_years').html(json.min_years);
                $('#duration_cost').html("$" + (json.min_years*json.price).toFixed(2));
                $('#price').html("<b>$" + json.price.toFixed() + "</b>");
                if (json.min_years>1)
                    $('#minperiodalert').attr('style','display: block;');
                else
                    $('#minperiodalert').attr('style','display: none;');
                $('#min_years').val(json.min_years);
            } else {
                $('#failurealert').attr('style','display: block;');
            }

            $('#validateButton').attr('style','display: none;');
            $('#submitButton').attr('style','display: block;');
        });
    }

    function fieldChange() {
        $('#validateButton').html('Check Price and Validate');
        $('#validateButton').removeAttr('disabled');
        $('#validateButton').attr('style','display: block;');
        $('#submitButton').attr('style','display: none;');

        $('#minperiodalert').attr('style','display: none;');
        $('#failurealert').attr('style','display: none;');
    }
</script>