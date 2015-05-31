<!-- BEGIN PAGE HEAD -->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Settings <small>configuration options for your account</small></h1>
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

<?php
    if ($accountUpdate)
        echo '<div class="alert alert-success"><strong>Success!</strong> Your account settings have been updated.</div>';
?>

<div class="row margin-top-10">
    <div class="col-md-6">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">Account Settings</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" action="/settings/" method="post">
                    <input type="hidden" name="account" value="true" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Login Notification</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="icheck-inline">
                                        <label>
                                            <input<?php if ($loginnotify) echo " checked"; ?> name="loginnotify" type="checkbox" class="icheck" data-checkbox="icheckbox_square-orange">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">API Key</label>
                            <div class="col-md-8">
                                <a onclick="revealApiKey(this)" class="btn btn-primary">Reveal</a>
                                <div id="apiblock" style="display: none;" class="input-group">
                                    <pre id="apikey" class="form-control-static"></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn blue">Update Settings</button>
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
                    <span class="caption-subject theme-font-color bold uppercase">Profile Information</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" action="/settings/" method="post">
                    <div class="form-body">
                        <?php if ($type=='internal') { ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Account Type</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <b>Internal</b>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Username</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <b><?php echo $username; ?></b>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Full Name</label>
                            <div class="col-md-9">
                                <input<?php if ($name) echo ' value="'.$name.'"'; ?> name="name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email Address</label>
                            <div class="col-md-9">
                                <input<?php if ($email) echo ' value="'.$email.'"'; ?> name="email" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Update Details</button>
                            </div>
                        </div>
                    </div>
                    <?php } elseif ($type=='facebook') { ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Account Type</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <b>Facebook</b>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Full Name</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <b><?php echo $name; ?></b>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">E-mail Address</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <b><?php echo $email; ?></b>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function revealApiKey(element) {
        $.get("/settings/apikey", function (key) {
            $("#apikey").html(key);
            element.remove();
            $('#apiblock').css('display','block');
        });
    }
</script>
