<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">Add Email Addresses</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" action="/email/add/" method="post">
                    <input type="hidden" id="type" name="type" />
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input name="email_address" type="text" class="form-control" placeholder="you@yourdomain.com">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="text-align: center;">
                        <div class="col-md-5">
                            <button onclick="setTypeForwarder()" style="min-width: 126px;" type="submit" class="btn btn-primary">Add Forwarder</button>
                        </div>
                        <div class="col-md-2">
                            <p style="margin-top: 10px;"><b>- OR -</b></p>
                        </div>
                        <div class="col-md-5">
                            <button onclick="setTypeMailbox()" style="min-width: 126px;" type="submit" class="btn btn-primary">Add Mailbox</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function setTypeMailbox() {
        $('#type').val('mailbox');
    }

    function setTypeForwarder() {
        $('#type').val('forwarder');
    }
</script>