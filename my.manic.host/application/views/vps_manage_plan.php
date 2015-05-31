<!-- BEGIN PAGE HEAD -->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Manage VPS <small>manage virtual private servers under your account</small></h1>
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
        VPS
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
                    <span class="caption-subject theme-font-color bold uppercase">Manage VPS</span>
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
                                <a id="removeConfirm">
                                    Remove VPS </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <?php if ($stats['error']!=false) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <strong>Error!</strong> There was an error retrieving this VPS. Please contact support if the error persists.
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-muted" style="font-size: 18px; font-weight: bold; margin-bottom: 20px;"><?php echo $stats['hostname']." (".$stats['primary_ip'].")"; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-bordered table-advance" style="margin-bottom: 0px !important; text-align: center;">
                                <colgroup>
                                    <col style="width: 40%" />
                                    <col />
                                </colgroup>
                                <tbody>
                                <tr style="height: 25px;">
                                    <td bgcolor="#F9F9F9"><div style="font-weight: bold; ">Status</div></td>
                                    <td><div id="vps_status" style=""><?php echo $stats['status']; ?></div></td>
                                </tr>
                                <tr style="height: 25px;">
                                    <td bgcolor="#F9F9F9"><div style="font-weight: bold; ">IP Addresses</div></td>
                                    <td><div style=""><?php echo implode(",",$stats['ip_addresses']); ?></div></td>
                                </tr>
                                <tr style="height: 25px;">
                                    <td bgcolor="#F9F9F9"><div style="font-weight: bold; ">Operating System</div></td>
                                    <td><div>Ubuntu Server 14.04 (64-bit)</div></td>
                                </tr>
                                <tr style="height: 25px;">
                                    <td bgcolor="#F9F9F9"><div style="font-weight: bold; ">Hostname</div></td>
                                    <td><div style=""><?php echo $stats['hostname']; ?></div></td>
                                </tr>
                            </table>
                        </div>
                        <br />
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-bordered table-advance" style="margin-bottom: 0px !important; text-align: center;">
                                <colgroup>
                                    <col style="width: 40%" />
                                    <col />
                                </colgroup>
                                <tbody>
                                <tr style="height: 25px;">
                                    <td bgcolor="#F9F9F9"><div style="font-weight: bold; ">Plan</div></td>
                                    <td><div style="">VPS 1</div></td>
                                </tr>
                                <tr style="height: 25px;">
                                    <td bgcolor="#F9F9F9"><div style="font-weight: bold; ">Disk Space</div></td>
                                    <td><div>20 GB</div></td>
                                </tr>
                                <tr style="height: 25px;">
                                    <td bgcolor="#F9F9F9"><div style="font-weight: bold; ">Bandwidth</div></td>
                                    <td><div>750 GB</div></td>
                                </tr>
                                <tr style="height: 25px;">
                                    <td bgcolor="#F9F9F9"><div style="font-weight: bold; ">Memory</div></td>
                                    <td><div>256 MB</div></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row margin-top-20">
                    <div class="col-md-2">
                        <p><b>Bandwidth Usage</b></p>
                    </div>
                    <div class="col-md-6">
                        <div class="progress">
                            <div id="vps_bw_percent" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $stats['bandwidth']['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $stats['bandwidth']['percent']; ?>%">
									<span id="vps_bw_usagetext" class="sr-only">
									<?php echo $stats['bandwidth']['percent']; ?>% Usage </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p id="vps_bw_used"><?php echo $stats['bandwidth']['used']; ?> of <?php echo $stats['bandwidth']['total']; ?> Used (<?php echo $stats['bandwidth']['free']; ?> Free)</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <p><b>Memory Usage</b></p>
                    </div>
                    <div class="col-md-6">
                        <div class="progress">
                            <div id="vps_mem_percent" class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $stats['memory']['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $stats['memory']['percent']; ?>%">
									<span id="vps_mem_usagetext" class="sr-only">
									<?php echo $stats['memory']['percent']; ?>% Usage </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p id="vps_mem_used"><?php echo $stats['memory']['used']; ?> of <?php echo $stats['memory']['total']; ?> Used (<?php echo $stats['memory']['free']; ?> Free)</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <p><b>Disk Usage</b></p>
                    </div>
                    <div class="col-md-6">
                        <div class="progress">
                            <div id="vps_disk_percent" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $stats['disk']['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $stats['disk']['percent']; ?>%">
									<span id="vps_disk_usagetext" class="sr-only">
									<?php echo $stats['disk']['percent']; ?>% Usage </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p id="vps_disk_used"><?php echo $stats['disk']['used']; ?> of <?php echo $stats['disk']['total']; ?> Used (<?php echo $stats['disk']['free']; ?> Free)</p>
                    </div>
                </div>
                <div class="row margin-top-20">
                    <div class="col-md-12">
                        <div class="tiles">
                            <div onclick="confirmStartServer()" class="tile bg-green">
                                <div class="tile-body">
                                    <i class="fa fa-play"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name">
                                        Start Server
                                    </div>
                                    <div class="number">
                                    </div>
                                </div>
                            </div>
                            <div onclick="confirmStopServer()" class="tile bg-red">
                                <div class="tile-body">
                                    <i class="fa fa-stop"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name">
                                        Stop Server
                                    </div>
                                    <div class="number">
                                    </div>
                                </div>
                            </div>
                            <div onclick="confirmRestartServer()" class="tile bg-yellow">
                                <div class="tile-body">
                                    <i class="fa fa-repeat"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name">
                                        Restart Server
                                    </div>
                                    <div class="number">
                                    </div>
                                </div>
                            </div>
                            <div onclick="reinstallServer()" class="tile bg-purple">
                                <div class="tile-body">
                                    <i class="fa fa-rocket"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name">
                                        Reinstall Server
                                    </div>
                                    <div class="number">
                                    </div>
                                </div>
                            </div>
                            <div onclick="serialConsole()" class="tile bg-black">
                                <div class="tile-body">
                                    <i class="fa fa-terminal"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name">
                                        Virtual Console
                                    </div>
                                    <div class="number">
                                    </div>
                                </div>
                            </div>
                            <div class="tile bg-green-seagreen">
                                <div class="tile-body">
                                    <i class="fa fa-file-text-o"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name">
                                        View Logs
                                    </div>
                                    <div class="number">
                                    </div>
                                </div>
                            </div>
                            <div onclick="confirmNetworkReset()" class="tile bg-blue">
                                <div class="tile-body">
                                    <i class="fa fa-heartbeat"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name">
                                        Reset Network
                                    </div>
                                    <div class="number">
                                    </div>
                                </div>
                            </div>
                            <div class="tile bg-grey-gallery">
                                <div class="tile-body">
                                    <i class="fa fa-cogs"></i>
                                </div>
                                <div class="tile-object">
                                    <div class="name">
                                        Settings
                                    </div>
                                    <div class="number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmNetworkReset() {
        bootbox.confirm("Are you sure you want to re-configure this virtual server?<br /><br />The virtual server will be shutdown then probed. If a compatible operating system is detected the networking will be configured and the virtual server rebooted.", function (result) {
            if (result==true) {
                $.get("/vps/action/resetnetwork/", { id: "<?php echo $id; ?>" } );
            }
        });
    }

    function confirmStartServer() {
        bootbox.confirm("Are you sure you want to start this virtual server?", function (result) {
            if (result==true) {
                $.get("/vps/action/startserver/", { id: "<?php echo $id; ?>" } );
            }
        });
    }

    function confirmStopServer() {
        bootbox.confirm("Are you sure you want to stop this virtual server?", function (result) {
            if (result==true) {
                $.get("/vps/action/stopserver/", { id: "<?php echo $id; ?>" } );
            }
        });
    }

    function confirmRestartServer() {
        bootbox.confirm("Are you sure you want to restart this virtual server?", function (result) {
            if (result==true) {
                $.get("/vps/action/restartserver/", { id: "<?php echo $id; ?>" } );
            }
        });
    }

    function reinstallServer() {
        bootbox.dialog({
            message: 'Select the operating system to install. Note this will <b>wipe all data</b> from the existing system.<br /><br /><form id="reinstall-form" action="/vps/reinstall/" method="post" class="bootbox-form"><div class="form-group"><div class="input-group"><div class="icheck-list">' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="3" /> CentOS 5 (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="4" /> CentOS 5 (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="5" /> CentOS 6 (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="2" /> CentOS 6 (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="82" /> CentOS 6.5 Minimal (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="83" /> CentOS 6.5 Minimal (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="88" /> CentOS 7 Minimal (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="6" /> Debian 6 (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="28" /> Debian 7 (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="29" /> Debian 7 (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="80" /> Debian 7 Minimal (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="81" /> Debian 7 Minimal (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="58" /> Fedora 19 (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="59" /> Fedora 19 (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="73" /> Fedora 20 (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="74" /> Fedora 20 (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="67" /> OpenSUSE 12.3 (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="68" /> OpenSUSE 12.3 (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="72" /> OpenSUSE 13.1 (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="71" /> OpenSUSE 13.1 (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="52" /> Scientific Linux (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="53" /> Scientific Linux (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="19" /> Ubuntu 12.04 (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="20" /> Ubuntu 12.04 (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="91" /> Ubuntu 12.04 Minimal (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="92" /> Ubuntu 12.04 Minimal (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="30" /> Ubuntu 13.04 (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="31" /> Ubuntu 13.04 (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="61" /> Ubuntu 13.10 (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="62" /> Ubuntu 13.10 (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="77" /> Ubuntu 14.04 (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="76" /> Ubuntu 14.04 (64-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="89" /> Ubuntu 14.04 Minimal (32-bit)</label>' +
            '<label><input name="osid" type="radio" class="icheck" data-checkbox="iradio_square-orange" value="90" /> Ubuntu 14.04 Minimal (64-bit)</label>' +
            '</div></div></div><input type="hidden" name="id" value="<?php echo $id; ?>" /></form>',
            title: "Reinstall Server",
            buttons: {
                danger: {
                    label: "Cancel",
                    className: "default",
                    callback: function() {

                    }
                },
                main: {
                    label: "Reinstall",
                    className: "blue",
                    callback: function() {
                        $('#reinstall-form').submit();
                    }
                }
            }
        });
        $('.icheck').each(function () {
            var checkboxClass = $(this).attr('data-checkbox') ? $(this).attr('data-checkbox') : 'icheckbox_minimal-grey';
            var radioClass = $(this).attr('data-radio') ? $(this).attr('data-radio') : 'iradio_minimal-grey';

            if (checkboxClass.indexOf('_line') > -1 || radioClass.indexOf('_line') > -1) {
                $(this).iCheck({
                    checkboxClass: checkboxClass,
                    radioClass: radioClass,
                    insert: '<div class="icheck_line-icon"></div>' + $(this).attr("data-label")
                });
            } else {
                $(this).iCheck({
                    checkboxClass: checkboxClass,
                    radioClass: radioClass
                });
            }
        });
    }

    function serialConsole() {
        $.get("/vps/action/serialconsole/<?php echo $id; ?>", function(data) {
            console.log(data);
        });
    }

    function updateStats() {
        $.get( "/vps/stats/<?php echo $id; ?>", function(data) {
            $("#vps_status").html(data.status);

            $("#vps_bw_used").html(data.bandwidth.used + ' of ' + data.bandwidth.total + ' Used (' + data.bandwidth.free + ' Free)');
            $("#vps_mem_used").html(data.memory.used + ' of ' + data.memory.total + ' Used (' + data.memory.free + ' Free)');
            $("#vps_disk_used").html(data.disk.used + ' of ' + data.disk.total + ' Used (' + data.disk.free + ' Free)');

            $("#vps_bw_percent").attr('aria-valuenow',data.bandwidth.percent);
            $("#vps_bw_percent").attr('style','width: ' + data.bandwidth.percent + "%;");
            $("#vps_bw_usagetext").html(data.bandwidth.percent + "% Usage");
            $("#vps_mem_percent").attr('aria-valuenow',data.memory.percent);
            $("#vps_mem_percent").attr('style','width: ' + data.memory.percent + "%;");
            $("#vps_mem_usagetext").html(data.memory.percent + "% Usage");
            $("#vps_disk_percent").attr('aria-valuenow',data.disk.percent);
            $("#vps_disk_percent").attr('style','width: ' + data.disk.percent + "%;");
            $("#vps_disk_usagetext").html(data.disk.percent + "% Usage");

        }, "json");
    }

    $(function() {
        setInterval(updateStats,3000);
    });

    $('#removeConfirm').click(function(){
        bootbox.confirm("Are you sure you want to remove this VPS?", function(result) {
            if (result==true)
                window.location = "/vps/remove/<?php echo $id; ?>";
        });
    });
</script>
