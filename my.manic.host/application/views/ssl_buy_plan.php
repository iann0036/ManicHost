<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">SSL Information</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" action="/ssl/buy/<?php echo $product; ?>/complete/" method="post">
                    <input type="hidden" name="years" value="<?php echo $years; ?>" />
                    <input type="hidden" name="product" value="<?php echo $product; ?>" />
                    <input type="hidden" name="csrid" id="csrid" />
                    <div class="form-group">
                        <label class="col-md-3 control-label">Domain Name</label>
                        <div class="col-md-9">
                            <input id="domain" name="domain" type="text" class="form-control" placeholder="yourdomain.com" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Webserver</label>
                        <div class="col-md-9">
                            <select name="webserver" class="form-control">
                            <?php
                            foreach ($webservers as $webserver) {
                            ?>
                                <option value="<?php echo $webserver['id']; if ($webserver['software']=="OTHER") echo '" selected="selected'; ?>"><?php echo str_replace("â€“","-",$webserver['software']); ?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Validation E-mail Address</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="icheck-list" id="emails_list">
                                    <p class="form-control-static"><i>Enter a domain for the list of possible validation addresses</i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Certificate Signing Request</label>
                        <div class="col-md-9">
                            <textarea id="csr" name="csr" class="form-control" rows="5" placeholder="-----BEGIN CERTIFICATE REQUEST-----

...

-----END CERTIFICATE REQUEST-----"></textarea>
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="col-md-3"></label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <a data-toggle="modal" href="#csrgen"><button id="generateCsrButton" disabled="disabled" class="btn btn-warning">Generate CSR</button></a>
                                &nbsp;<button type="submit" class="btn blue">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="csrgen" tabindex="-1" role="csrgen" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Generate CSR</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Domain Name (Common Name)</label>
                        <div class="col-md-9">
                            <p style="font-weight: bold;" class="form-control-static" id="modal-domain"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Organization</label>
                        <div class="col-md-9">
                            <input id="org-gencsrmodal" type="text" class="form-control" placeholder="Your Corp, Inc" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Department</label>
                        <div class="col-md-9">
                            <input id="dept-gencsrmodal" type="text" class="form-control" placeholder="IT" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">City</label>
                        <div class="col-md-9">
                            <input id="city-gencsrmodal" type="text" class="form-control" placeholder="Smallville" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">State</label>
                        <div class="col-md-9">
                            <input id="state-gencsrmodal" type="text" class="form-control" placeholder="TX" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Country</label>
                        <div class="col-md-9">
                            <input id="country-gencsrmodal" type="text" class="form-control" placeholder="US" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">E-mail Address</label>
                        <div class="col-md-9">
                            <input id="email-gencsrmodal" type="text" class="form-control" placeholder="you@yourdomain.com" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                <button id="genCsrModalButton" type="button" class="btn blue" onclick="generateCsr()">Generate</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<img src="/assets/global/img/loading-spinner-grey.gif" alt="" class="loading" style="display: none;">
<script>
    $('#domain').change(function(){
        $('#modal-domain').html($('#domain').val());
        $('#generateCsrButton').removeAttr('disabled');

        $("#emails_list").empty();
        $("#emails_list").append('<img src="/assets/global/img/loading-spinner-grey.gif" alt="" class="loading">');
        $.get("/ssl/emails/" + $('#domain').val(), function(data) {
            $("#emails_list").empty();
            if (data.ComodoApprovalEmails.length<2)
                $("#emails_list").append('<p class="form-control-static"><i>Unknown</i></p>');
            else {
                for (var i = 0; i < data.ComodoApprovalEmails.length; i++) {
                    var option = '<label><input type="radio" name="validation_email" class="icheck" data-radio="iradio_square-orange" value="' + data.ComodoApprovalEmails[i] + '"> ' + data.ComodoApprovalEmails[i] + ' </label>';
                    $("#emails_list").append(option);
                }
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
        }, "json");
    });

    function generateCsr() {
        $('#genCsrModalButton').attr('disabled','disabled');
        $.post("/ssl/csr/" + $('#domain').val(), {
            org: $('#org-gencsrmodal').val(),
            dept: $('#dept-gencsrmodal').val(),
            city: $('#city-gencsrmodal').val(),
            state: $('#state-gencsrmodal').val(),
            country: $('#country-gencsrmodal').val(),
            email: $('#email-gencsrmodal').val()
        }).done(function(data) {
            var datajson = JSON.parse(data);
            $('#csrgen').modal('hide');
            $('#genCsrModalButton').removeAttr('disabled');
            $('#csr').html(datajson.csr_code);
            $('#csrid').val(datajson.csr_id);
            console.log(datajson);
        }, "json");
    }
</script>