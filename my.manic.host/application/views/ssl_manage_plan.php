<!-- BEGIN PAGE HEAD -->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Manage SSL <small>manage ssl certificates under your account</small></h1>
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
        SSL
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->

<div class="row margin-top-10">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">SSL Certificate Details</span>
                </div>
                <div class="actions">
                    <div class="btn-group">
                        <a class="btn btn-default btn-circle" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
									<span class="hidden-480">
									Actions </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;">
                                    Reissue Certificate</a>
                            </li>
                            <li>
                                <a href="https://www.ssllabs.com/ssltest/analyze.html?d=<?php echo $cert['domain']; ?>" target="_blank">
                                    Run SSL Test</a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                                <a id="removeConfirm">
                                    Remove Certificate </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <h4>Primary Domain</h4>
                <p><?php echo $cert['domain']; ?></p>
                <br />
                <h4>SSL Test</h4>
                <p>
                    <a id="sslTestButton" target="_blank" href="https://www.ssllabs.com/ssltest/analyze.html?d=<?php echo $cert['domain']; ?>" class="btn purple"><img src="/assets/img/qualys.png" /> Run an SSL test </a>
                </p>
                <!--
                    <h6>Status</h6>
                    <p id="sslTest_status"></p>
                    <div id="sslTestResults_section" style="display: none;">
                        <h6>Grade</h6>
                        <div class="tiles">
                            <div id="sslTest_gradeTile" class="tile bg-grey">
                                <div id="sslTest_grade" class="tile-body" style="font-weight: bold; margin-top: 17px; font-size: 56px; line-height: 56px; text-align: center;">

                                </div>
                                <div class="tile-object">
                                    <div class="name">
                                    </div>
                                    <div class="number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5>Miscellaneous</h5>
                        <h6>Server Hostname</h6>
                        <p id="sslTest_serverHostname"></p>
                    </div>
                <div id="sslTestErrors_section" style="display: none;">
                    <h6>SSL Test Errors</h6>
                    <p style="color: #FF0000" id="sslTestErrors"></p>
                </div>
                -->
            </div>
        </div>
    </div>
</div>
<script>
    function startSSLTest() {
        $('#sslTestButton').attr('disabled','disabled');
        $('#sslTestButton').html('<i class="fa fa-key"></i> Running test (this will take a minute)...');
        $('#sslTestErrors_section').attr('style','display: none;');

        $.get('/ssl/test/start/<?php echo $cert['domain']; ?>', function(data) {
            updateResults(data);
        }, 'json');
    }

    function updateSSLTest() {
        $.get('/ssl/test/status/<?php echo $cert['domain']; ?>', function(data) {
            updateResults(data);
        }, 'json');
    }

    function updateResults(data) {
        console.log(data);
        if (data.status=="READY") {
            $('#sslTest_status').html(data.endpoints[0].statusMessage);

            $('#sslTestButton').removeAttr('disabled');
            $('#sslTestButton').html('<i class="fa fa-key"></i> Re-run an SSL test on https://<?php echo $cert['domain']; ?>/');

            $('#sslTestResults_section').attr('style','display: block;');
            $('#sslTest_grade').html(data.endpoints[0].grade);
            if (data.endpoints[0].grade=="A-" || data.endpoints[0].grade=="A" || data.endpoints[0].grade=="A+")
                $('#sslTest_gradeTile').attr('class','tile bg-green-jungle');
            else if (data.endpoints[0].grade=="B-" || data.endpoints[0].grade=="B" || data.endpoints[0].grade=="B+" || data.endpoints[0].grade=="C-" || data.endpoints[0].grade=="C" || data.endpoints[0].grade=="C+")
                $('#sslTest_gradeTile').attr('class','tile bg-yellow-lemon');
            else
                $('#sslTest_gradeTile').attr('class','tile bg-red-intense');
            $('#sslTest_serverHostname').html(data.endpoints[0].serverName);

        } else if (data.status=="ERROR") {
            $('#sslTest_status').html(data.endpoints[0].statusMessage);

            $('#sslTestErrors').html(data.statusMessage);
            $('#sslTestErrors_section').attr('style','display: block;');
            $('#sslTestButton').removeAttr('disabled');
            $('#sslTestButton').html('<i class="fa fa-key"></i> Re-run an SSL test on https://<?php echo $cert['domain']; ?>/');
        } else {
            $('#sslTest_status').html(data.endpoints[0].statusMessage);

            setTimeout(updateSSLTest, 3000);
        }
    }

    $('#removeConfirm').click(function(){
        bootbox.confirm("Are you sure you want to remove this SSL certificate?", function(result) {
            if (result==true)
                window.location = "/ssl/remove/<?php echo $id; ?>";
        });
    });
</script>