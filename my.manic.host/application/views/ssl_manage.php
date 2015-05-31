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
                    <span class="caption-subject theme-font-color bold uppercase">My SSL Certificates</span>
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
                            Certificate ID
                        </th>
                        <th>
                            Domain
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            Expiry Date
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
                    foreach ($certs as $cert) {
                    ?>
                        <tr class="odd gradeX">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1"/>
                            </td>
                            <td>
                                <?php echo $cert['id']; ?>
                            </td>
                            <td>
                                <?php echo $cert['domain']; ?>
                            </td>
                            <td>
                                <?php echo $cert['type']; ?>
                            </td>
                            <td>
                                <?php echo $cert['expiry']; ?>
                            </td>
                            <td>
                                <?php
                                    if ($cert['status']=='active')
                                        echo '<span class="label label-sm label-success"> Active </span>';
                                ?>
                            </td>
                            <td>
                                <a href="/ssl/manage/<?php echo $cert['id']; ?>" class="btn btn-xs blue"> Manage </a>
                                <a onclick="removeItem(<?php echo $cert['id']; ?>)" class="btn btn-xs red"> Remove </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajax" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content"><div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">View Certificate</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <p>&nbsp;</p>
                    <p style="text-align: center;">Loading...</p>
                    <p>&nbsp;</p>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<script>
    function removeItem(id) {
        bootbox.confirm("Are you sure you want to remove this SSL certificate?", function(result) {
            if (result==true)
                window.location = "/ssl/remove/" + id;
        });
    }
</script>