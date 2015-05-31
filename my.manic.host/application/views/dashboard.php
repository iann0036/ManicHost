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
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row margin-top-10">
				<div class="col-md-6 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet light tasks-widget">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font-color hide"></i>
								<span class="caption-subject theme-font-color bold uppercase">Announcements</span>
							</div>
						</div>
						<div class="portlet-body">
                            <?php
                            function convert_datetime($datetime, $dateonly = false) {
                                $newdate2 = $_SERVER['REQUEST_TIME']-$datetime;
                                if ($newdate2>172799 || $dateonly)
                                    return date("F j, Y",$datetime);
                                else if ($newdate2>86399)
                                    return "Yesterday";
                                else if ($newdate2>7199)
                                    return intval($newdate2/3600)." hours ago";
                                else if ($newdate2>3599)
                                    return "1 hour ago";
                                else if ($newdate2>119)
                                    return intval($newdate2/60)." minutes ago";
                                else if ($newdate2>59)
                                    return "1 minute ago";
                                else if ($newdate2>=0)
                                    return "Just a moment ago";
                                else
                                    return "In the future";
                            }
                            ?>
                            <div class="blog-twitter">
                                <?php
                                foreach ($announcements as $announcement) {
                                    ?>
                                    <div class="blog-twitter-block">
                                        <a href="https://twitter.com/ManicDotHost">
                                            @ManicDotHost </a>

                                        <p style="margin-right: 40px;">
                                            <?php echo $announcement->text; ?>
                                        </p>
											<span>
											<?php echo convert_datetime(strtotime($announcement->created_at)); ?> </span>
                                        <i class="fa fa-twitter blog-twiiter-icon"></i>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
						</div>
					</div>
					<!-- END PORTLET-->
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="icon-bar-chart theme-font-color hide"></i>
                                <span class="caption-subject theme-font-color bold uppercase">Contact Us</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="portlet-body">
                                <form action="/support/contact/" method="post">
                                    <div class="form-group">
                                        <input name="subject" type="text" class="form-control" placeholder="Subject">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" rows="5" placeholder="Message"></textarea>
                                    </div>
                                    <button type="submit" class="btn green">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-md-6 col-sm-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font-color hide"></i>
                                <span class="caption-subject theme-font-color bold uppercase">Logs</span>
                            </div>
                            <div class="actions">
                                <a target="_blank" href="/settings/exportlogs/" class="btn info btn-sm">
                                    <i class="fa fa-download"></i> Export to CSV </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="scroller" style="height: 337px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                <ul class="feeds">
                                    <?php
                                    foreach ($logs as $log) {
                                    ?>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <?php
                                                    if ($log->icon==null) {
                                                        ?>
                                                        <div class="label label-sm label-default">
                                                            <i class="fa fa-info"></i>
                                                        </div>
                                                    <?php
                                                    } else {
                                                        $parts = explode(':',$log->icon);
                                                        $icon = $parts[0];
                                                        $color = $parts[1];
                                                    ?>
                                                        <div class="label label-sm label-<?php echo $color; ?>">
                                                            <i class="fa fa-<?php echo $icon; ?>"></i>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        <?php echo $log->message; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date">
                                                <?php echo convert_datetime($log->timestamp); ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                    </ul>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
			<!-- END PAGE CONTENT INNER -->
