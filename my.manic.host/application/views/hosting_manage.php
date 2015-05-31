<!-- BEGIN PAGE HEAD -->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Manage Hosting <small>manage hosting under your account</small></h1>
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
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">My Hosting Packages</span>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    <thead>
                    <tr>
                        <th class="table-checkbox">
                            <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes"/>
                        </th>
                        <th>
                            Domain
                        </th>
                        <th>
                            Package
                        </th>
                        <th>
                            Paid Until
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($hosting_packages as $package) {
                    ?>
                        <tr class="odd gradeX">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1"/>
                            </td>
                            <td>
                               <?php echo $package->domain; ?>
                            </td>
                            <td>
                                <?php echo ucfirst($package->plan); ?>
                            </td>
                            <td>
                                <?php echo date('j F Y',strtotime($package->expiry)); echo " (".$package->daydiff." days)"; ?>
                            </td>
                            <td>
                            <span class="label label-sm label-success">
									Active </span>
                            </td>
                            <td>
                                <a target="_blank" href="/hosting/cpanel/<?php echo $package->id; ?>" class="btn btn-xs blue"> Manage </a>
                                <a onclick="removeItem(<?php echo $package->id; ?>)" class="btn btn-xs red"> Remove </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>
    function removeItem(id) {
        bootbox.confirm("Are you sure you want to remove this hosting package?", function(result) {
            if (result==true)
                window.location = "/hosting/remove/" + id;
        });
    }
</script>