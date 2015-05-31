<!-- BEGIN PAGE HEAD -->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Admin <small>manic host management</small></h1>
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
        Admin
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->

<div class="row margin-top-10">
    <div class="col-md-4">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">Manual Email</span>
                </div>
            </div>
            <div class="portlet-body">
                <form action="/admin/email/" method="post">
                    <div class="form-group">
                        <select name="from" id="from" class="form-control">
                            <option value="Manic Host <admin@manic.host>">Manic Host &lt;admin@manic.host&gt;</option>
                            <option value="Manic Host Support <support@manic.host>">Manic Host Support &lt;support@manic.host&gt;</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="to" type="text" class="form-control" placeholder="To">
                    </div>
                    <div class="form-group">
                        <input name="subject" type="text" class="form-control" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="5" placeholder="<p>Hi Name,<p>

<p>Message</p>"></textarea>
                    </div>
                    <button type="submit" class="btn green">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
    </div>
</div>
