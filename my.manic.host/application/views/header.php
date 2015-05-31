<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<title>Manic Host | <?php echo $title; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="Search and buy domains, hosting and more from a huge inventory of premium services. Give your brand some class - join Manic Host today!" name="description"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
	<link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
	<link href="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE STYLES -->
	<link href="/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/icheck/skins/all.css"/>
    <link href="/assets/admin/pages/css/pricing-table.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/admin/pages/css/invoice.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/admin/pages/css/search.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/admin/pages/css/blog.css" rel="stylesheet" type="text/css"/>

    <!-- END PAGE STYLES -->
	<!-- BEGIN THEME STYLES -->
	<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
	<link href="/assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/admin/layout4/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="/assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->

    <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <?php if (substr($uri,0,9)=="/billing/") { ?>
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script type="text/javascript">
            Stripe.setPublishableKey('pk_test_C1m24mjYflI0qG6Z7TlG5x8h');

            var stripeResponseHandler = function(status, response) {
                var $form = $('#addcc-form');

                if (response.error) {
                    // Show the errors on the form
                    $form.find('.addcc-errors').text(response.error.message);
                    $form.find('button').prop('disabled', false);
                } else {
                    // token contains id, last4, and card type
                    var token = response.id;
                    // Insert the token into the form so it gets submitted to the server
                    $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                    // and re-submit
                    $form.get(0).submit();
                }
            };

            jQuery(function($) {
                $('#addcc-form').submit(function(e) {
                    var $form = $(this);

                    // Disable the submit button to prevent repeated clicks
                    $form.find('button').prop('disabled', true);

                    Stripe.card.createToken($form, stripeResponseHandler);

                    // Prevent the form from submitting with the default action
                    return false;
                });
            });
        </script>
    <?php } ?>
    <?php if (substr($uri,0,21)=="/checkout/creditcard/") { ?>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        Stripe.setPublishableKey('pk_test_C1m24mjYflI0qG6Z7TlG5x8h');

        var stripeResponseHandler = function(status, response) {
            var $form = $('#payment-form');

            if (response.error) {
                // Show the errors on the form
                $form.find('.payment-errors').text(response.error.message);
                $form.find('button').prop('disabled', false);
            } else {
                // token contains id, last4, and card type
                var token = response.id;
                // Insert the token into the form so it gets submitted to the server
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                // and re-submit
                $form.get(0).submit();
            }
        };

        jQuery(function($) {
            $('#payment-form').submit(function(e) {
                var $form = $(this);

                // Disable the submit button to prevent repeated clicks
                $form.find('button').prop('disabled', true);

                Stripe.card.createToken($form, stripeResponseHandler);

                // Prevent the form from submitting with the default action
                return false;
            });
        });
    </script>
    <?php } ?>

	<link rel="shortcut icon" href="/favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo page-sidebar-fixed">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="/">
				<img src="/assets/img/logo-light.png" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN PAGE ACTIONS -->
		<!-- DOC: Remove "hide" class to enable the page header actions
		<div class="page-actions">
			<div class="btn-group">
				<button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<span class="hidden-sm hidden-xs">Actions&nbsp;</span><i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="#">
							<i class="icon-docs"></i> New Post </a>
					</li>
					<li>
						<a href="#">
							<i class="icon-tag"></i> New Comment </a>
					</li>
					<li>
						<a href="#">
							<i class="icon-share"></i> Share </a>
					</li>
					<li class="divider">
					</li>
					<li>
						<a href="#">
							<i class="icon-flag"></i> Comments <span class="badge badge-success">4</span>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="icon-users"></i> Feedbacks <span class="badge badge-danger">2</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- END PAGE ACTIONS -->
		<!-- BEGIN PAGE TOP -->
		<div class="page-top">
			<!-- BEGIN HEADER SEARCH BOX -->
			<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box
			<form class="search-form" action="extra_search.html" method="GET">
				<div class="input-group">
					<input type="text" class="form-control input-sm" placeholder="Search..." name="query">
					<span class="input-group-btn">
					<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
				</div>
			</form>
			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a id="cart-dropdown" href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="fa fa-shopping-cart"></i>
                        <?php
                        $item_num = $this->cart->total_items();
                        if ($item_num>0) {
                        ?>
                        <span class="badge badge-success">
						<?php echo $item_num; ?> </span>
                        <?php
                        }
                        ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external" style="padding-top: 9px;">
                                <h3 style="padding-top: 6px;"><span class="bold"><?php
                                        if ($item_num<1)
                                            echo "No";
                                        else
                                            echo $item_num;
                                        ?> items</span></h3>
                                <?php if ($item_num<1) { ?>
                                <a href="#"><button disabled="disabled" class="btn green btn-sm">Checkout</button></a>
                                <?php } else { ?>
                                <a href="/checkout/"><button class="btn green btn-sm">Checkout</button></a>
                                <?php } ?>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                    <?php foreach ($this->cart->contents() as $item): ?>
                                    <?php foreach ($this->cart->product_options($item['rowid']) as $option_name => $option_value) { $item[$option_name] = $option_value; } ?>
                                    <?php if ($item['type']=="domain_registration" || $item['type']=="domain_transfer") { ?>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">$<?php echo number_format($item['price'],2); ?></span>
										<span class="details">
										<span class="label label-sm label-icon label-success">
										<i class="fa fa-globe"></i>
										</span><?php echo $item['name']; if ($item['qty']>1) echo " <small>(x".$item['qty'].")</small>"; ?><br /><i style="margin-left: 38px;"><?php echo $item['domain']; ?></i></span>
                                        </a>
                                    </li>
                                    <?php } else if ($item['type']=="hosting") { ?>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">$<?php echo number_format($item['price'],2); ?></span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-info">
                                    <i class="fa fa-cloud"></i>
                                    </span><?php echo $item['name']; if ($item['qty']>1) echo " <small>(x".$item['qty'].")</small>"; ?><br /><i style="margin-left: 38px;"><?php echo $item['domain']; ?></i></span>
                                            </a>
                                        </li>
                                    <?php } else if ($item['type']=="ssl_certificate") { ?>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">$<?php echo number_format($item['price'],2); ?></span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-warning">
                                    <i class="fa fa-lock"></i>
                                    </span>SSL Certificate<?php if ($item['qty']>1) echo " <small>(x".$item['qty'].")</small>"; ?><br /><i style="margin-left: 38px;"><?php echo $item['cert_type']; ?></i></span>
                                                </a>
                                            </li>
                                    <?php } else if ($item['type']=="email_mailbox" || $item['type']=="email_forwarder") { ?>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">$<?php echo number_format($item['price'],2); ?></span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-danger">
                                    <i class="fa fa-envelope"></i>
                                    </span><?php echo $item['name']; if ($item['qty']>1) echo " <small>(x".$item['qty'].")</small>"; ?><br /><i style="margin-left: 38px;"><?php echo $item['email_address']; ?></i></span>
                                                </a>
                                            </li>
                                    <?php } else if ($item['type']=="vps_1" || $item['type']=="vps_2" || $item['type']=="vps_3" || $item['type']=="vps_4") { ?>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">$<?php echo number_format($item['price'],2); ?></span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-default">
                                    <i class="fa fa-server"></i>
                                    </span><?php echo $item['name']; if ($item['qty']>1) echo " <small>(x".$item['qty'].")</small>"; ?><br /><i style="margin-left: 38px;"><?php echo $item['hostname']; ?></i></span>
                                                </a>
                                            </li>
                                    <?php } ?>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- END NOTIFICATION DROPDOWN -->
                    <li class="separator hide">
					</li>
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-exten
					ded" to change the dropdown styte -->
					<li class="dropdown dropdown-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username username-hide-on-mobile"><?php echo @trim($name); ?></span>
							<!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
							<img alt="" class="img-circle" src="<?php echo $profileimage; ?>" />
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="/settings/">
									<i class="icon-user"></i> My Profile </a>
							</li>
							<li>
								<a href="/logout/">
									<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END PAGE TOP -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="start<?php if ($uri=="/" || $uri=="") echo ' active'; ?>">
					<a href="/">
						<i class="fa fa-home"></i>
						<span class="title">Dashboard</span>
					</a>
				</li>
				<li<?php if (substr($uri,0,8)=="/domains") echo ' class="active open"'; ?>>
					<a href="javascript:;">
						<i class="fa fa-globe"></i>
						<span class="title">Domains</span>
						<span class="arrow<?php if (substr($uri,0,8)=="/domains") echo ' open'; ?>"></span>
					</a>
					<ul class="sub-menu">
						<li<?php if (substr($uri,0,15)=="/domains/manage") echo ' class="active"'; ?>>
							<a href="/domains/manage/">
								<i class="fa fa-suitcase"></i>
								Manage</a>
						</li>
						<li<?php if (substr($uri,0,15)=="/domains/search") echo ' class="active"'; ?>>
							<a href="/domains/search/">
								<i class="fa fa-search"></i>
								Search</a>
						</li>
                        <li<?php if (substr($uri,0,17)=="/domains/transfer") echo ' class="active"'; ?>>
                            <a href="/domains/transfer/">
                                <i class="fa fa-exchange"></i>
                                Transfer</a>
                        </li>
					</ul>
				</li>
                <li<?php if (substr($uri,0,8)=="/hosting") echo ' class="active open"'; ?>>
                    <a href="javascript:;">
                        <i class="fa fa-cloud"></i>
                        <span class="title">Hosting</span>
                        <span class="arrow<?php if (substr($uri,0,8)=="/hosting") echo ' open'; ?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li<?php if (substr($uri,0,15)=="/hosting/manage") echo ' class="active"'; ?>>
                            <a href="/hosting/manage/">
                                <i class="fa fa-suitcase"></i>
                                Manage</a>
                        </li>
                        <li<?php if (substr($uri,0,12)=="/hosting/buy") echo ' class="active"'; ?>>
                            <a href="/hosting/buy/">
                                <i class="fa fa-shopping-cart"></i>
                                Buy</a>
                        </li>
                    </ul>
                </li>
                <li<?php if (substr($uri,0,4)=="/vps") echo ' class="active open"'; ?>>
                    <a href="javascript:;">
                        <i class="fa fa-server"></i>
                        <span class="title">VPS</span>
                        <span class="arrow<?php if (substr($uri,0,4)=="/vps") echo ' open'; ?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li<?php if (substr($uri,0,11)=="/vps/manage") echo ' class="active"'; ?>>
                            <a href="/vps/manage/">
                                <i class="fa fa-suitcase"></i>
                                Manage</a>
                        </li>
                        <li<?php if (substr($uri,0,8)=="/vps/buy") echo ' class="active"'; ?>>
                            <a href="/vps/buy/">
                                <i class="fa fa-shopping-cart"></i>
                                Buy</a>
                        </li>
                    </ul>
                </li>
                <li<?php if (substr($uri,0,4)=="/ssl") echo ' class="active open"'; ?>>
                    <a href="javascript:;">
                        <i class="fa fa-lock"></i>
                        <span class="title">SSL</span>
                        <span class="arrow<?php if (substr($uri,0,4)=="/ssl") echo ' open'; ?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li<?php if (substr($uri,0,11)=="/ssl/manage") echo ' class="active"'; ?>>
                            <a href="/ssl/manage/">
                                <i class="fa fa-suitcase"></i>
                                Manage</a>
                        </li>
                        <li<?php if (substr($uri,0,8)=="/ssl/buy") echo ' class="active"'; ?>>
                            <a href="/ssl/buy/">
                                <i class="fa fa-shopping-cart"></i>
                                Buy</a>
                        </li>
                    </ul>
                </li>
                <li<?php if (substr($uri,0,6)=="/email") echo ' class="active open"'; ?>>
                    <a href="javascript:;">
                        <i class="fa fa-envelope"></i>
                        <span class="title">Email</span>
                        <span class="arrow<?php if (substr($uri,0,6)=="/email") echo ' open'; ?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li<?php if (substr($uri,0,13)=="/email/manage") echo ' class="active"'; ?>>
                            <a href="/email/manage/">
                                <i class="fa fa-suitcase"></i>
                                Manage</a>
                        </li>
                        <li<?php if (substr($uri,0,10)=="/email/buy") echo ' class="active"'; ?>>
                            <a href="/email/buy/">
                                <i class="fa fa-shopping-cart"></i>
                                Buy</a>
                        </li>
                    </ul>
                </li>
                <li<?php if (substr($uri,0,8)=="/billing") echo ' class="active"'; ?>>
                    <a href="/billing/">
                        <i class="fa fa-file"></i>
                        <span class="title">Billing</span>
                    </a>
                </li>
                <li<?php if (substr($uri,0,8)=="/support") echo ' class="active"'; ?>>
                    <a href="/support/">
                        <i class="fa fa-life-ring"></i>
                        <span class="title">Support</span>
                    </a>
                </li>
                <li<?php if (substr($uri,0,9)=="/settings") echo ' class="active"'; ?>>
                    <a href="/settings/">
                        <i class="fa fa-cogs"></i>
                        <span class="title">Settings</span>
                    </a>
                </li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
