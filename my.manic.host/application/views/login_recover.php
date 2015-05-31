<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Manic Host | Recover</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="Search and buy domains, hosting and more from a huge inventory of premium services. Give your brand some class - buy a domain from Manic Host today!" name="description"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="/assets/admin/pages/css/lock.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="/assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="/favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
<div class="page-lock">
    <div class="page-logo">
        <a class="brand" href="index.html">
            <img src="/assets/img/logo-light.png" alt="logo"/>
        </a>
    </div>
    <div class="page-body">
        <div class="lock-head">
            Recover Account
        </div>
        <div class="lock-body">
            <div class="pull-left lock-avatar-block">
                <img src="/assets/img/lock.png" class="lock-avatar">
            </div>
            <form class="lock-form pull-left" action="/login/recover/" method="post">
                <input type="hidden" name="token" value="<?php echo $token; ?>" />
                <h4><?php echo $username; ?></h4>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="New Password" name="password"/>
                </div>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirm Password" name="cpassword"/>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success uppercase">Login</button>
                </div>
            </form>
        </div>
        <div class="lock-bottom">
            <a href="/login/">Back to Login</a>
        </div>
    </div>
    <!--<div class="page-footer-custom">
        2014 &copy; Metronic. Admin Dashboard Template.
    </div>-->
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="/assets/global/plugins/respond.min.js"></script>
<script src="/assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init();
    });
</script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-50859151-2', 'auto');
    ga('send', 'pageview');

</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>