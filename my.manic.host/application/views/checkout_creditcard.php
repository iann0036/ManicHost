<?php $total = $this->cart->total(); ?>
<!-- BEGIN PAGE HEAD -->
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>Checkout <small>finalize your purchase</small></h1>
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
        Checkout
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row margin-top-10">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">Checkout</span>
                </div>
            </div>
            <div class="portlet-body form">
                <br />
                <h4><i class="fa fa-user"></i>&nbsp;Your Contact Info</h4>
                <hr />
                <form id="payment-form" class="form-horizontal" role="form" action="/checkout/complete/" method="post">
                    <div class="form-body">
                        <div class="billing-details">
                            <div class="form-group">
                                <label class="col-md-2 control-label">E-mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="admin_email" name="admin_email" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">First Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="admin_firstname" name="admin_firstname" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Last Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="admin_lastname" name="admin_lastname" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Phone Number</label>
                                <div class="col-md-6">
                                    <input type="text" id="admin_phone" name="admin_phone" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Country</label>
                                <div class="col-md-6">
                                    <select name="admin_country" id="admin_country_list" class="form-control">
                                        <option value=""></option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA">Bosnia and Herzegowina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="BN">Brunei Darussalam</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo</option>
                                        <option value="CD">Congo, the Democratic Republic of the</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CI">Cote d'Ivoire</option>
                                        <option value="HR">Croatia (Hrvatska)</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands (Malvinas)</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard and Mc Donald Islands</option>
                                        <option value="VA">Holy See (Vatican City State)</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran (Islamic Republic of)</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KP">Korea, Democratic People's Republic of</option>
                                        <option value="KR">Korea, Republic of</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Lao People's Democratic Republic</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libyan Arab Jamahiriya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macau</option>
                                        <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia, Federated States of</option>
                                        <option value="MD">Moldova, Republic of</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN">Netherlands Antilles</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Reunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russian Federation</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="KN">Saint Kitts and Nevis</option>
                                        <option value="LC">Saint LUCIA</option>
                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">Sao Tome and Principe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SK">Slovakia (Slovak Republic)</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SH">St. Helena</option>
                                        <option value="PM">St. Pierre and Miquelon</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syrian Arab Republic</option>
                                        <option value="TW">Taiwan, Province of China</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania, United Republic of</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="UM">United States Minor Outlying Islands</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Viet Nam</option>
                                        <option value="VG">Virgin Islands (British)</option>
                                        <option value="VI">Virgin Islands (U.S.)</option>
                                        <option value="WF">Wallis and Futuna Islands</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Address Line 1</label>
                                <div class="col-md-6">
                                    <input type="text" id="admin_address1" name="admin_address1" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Address Line 2</label>
                                <div class="col-md-6">
                                    <input type="text" id="admin_address2" name="admin_address2" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">City</label>
                                <div class="col-md-6">
                                    <input type="text" id="admin_city" name="admin_city" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">State / Province</label>
                                <div class="col-md-6">
                                    <input type="text" id="admin_state" name="admin_state" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Zip / Postcode</label>
                                <div class="col-md-6">
                                    <input type="text" id="admin_postcode" name="admin_postcode" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group abn-form-group" style="display: none;">
                                <label class="col-md-2 control-label">Australian Business Number (ABN)</label>
                                <div class="col-md-6">
                                    <input type="text" id="admin_abn" name="admin_abn" class="form-control">
                                    <!--<label><i>For Australian customers, GST will be added to the total price.</i></label>-->
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                        <br />
                        <h4><i class="fa fa-user"></i>&nbsp;Billing Contact Info</h4>
                        <hr />
                        <div class="billing-details">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Copy my info</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                            <label>
                                                <input type="checkbox" id="billing_same" name="billing_same" class="icheck" data-checkbox="icheckbox_square-orange"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">E-mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="billing_email" name="billing_email" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">First Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="billing_firstname" name="billing_firstname" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Last Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="billing_lastname" name="billing_lastname" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Phone Number</label>
                                <div class="col-md-6">
                                    <input type="text" id="billing_phone" name="billing_phone" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Country</label>
                                <div class="col-md-6">
                                    <select name="billing_country" id="billing_country_list" class="form-control">
                                        <option value=""></option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA">Bosnia and Herzegowina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="BN">Brunei Darussalam</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo</option>
                                        <option value="CD">Congo, the Democratic Republic of the</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CI">Cote d'Ivoire</option>
                                        <option value="HR">Croatia (Hrvatska)</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands (Malvinas)</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard and Mc Donald Islands</option>
                                        <option value="VA">Holy See (Vatican City State)</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran (Islamic Republic of)</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KP">Korea, Democratic People's Republic of</option>
                                        <option value="KR">Korea, Republic of</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Lao People's Democratic Republic</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libyan Arab Jamahiriya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macau</option>
                                        <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia, Federated States of</option>
                                        <option value="MD">Moldova, Republic of</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN">Netherlands Antilles</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Reunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russian Federation</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="KN">Saint Kitts and Nevis</option>
                                        <option value="LC">Saint LUCIA</option>
                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">Sao Tome and Principe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SK">Slovakia (Slovak Republic)</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SH">St. Helena</option>
                                        <option value="PM">St. Pierre and Miquelon</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syrian Arab Republic</option>
                                        <option value="TW">Taiwan, Province of China</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania, United Republic of</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="UM">United States Minor Outlying Islands</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Viet Nam</option>
                                        <option value="VG">Virgin Islands (British)</option>
                                        <option value="VI">Virgin Islands (U.S.)</option>
                                        <option value="WF">Wallis and Futuna Islands</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Address Line 1</label>
                                <div class="col-md-6">
                                    <input type="text" id="billing_address1" name="billing_address1" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Address Line 2</label>
                                <div class="col-md-6">
                                    <input type="text" id="billing_address2" name="billing_address2" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">City</label>
                                <div class="col-md-6">
                                    <input type="text" id="billing_city" name="billing_city" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">State / Province</label>
                                <div class="col-md-6">
                                    <input type="text" id="billing_state" name="billing_state" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Zip / Postcode</label>
                                <div class="col-md-6">
                                    <input type="text" id="billing_postcode" name="billing_postcode" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group abn-form-group" style="display: none;">
                                <label class="col-md-2 control-label">Australian Business Number (ABN)</label>
                                <div class="col-md-6">
                                    <input type="text" id="billing_abn" name="billing_abn" class="form-control">
                                    <!--<label><i>For Australian customers, GST will be added to the total price.</i></label>-->
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                        <br />
                        <h4><i class="fa fa-user"></i>&nbsp;Technical Contact Info</h4>
                        <hr />
                        <div class="billing-details">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Copy my info</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                            <label>
                                                <input type="checkbox" id="tech_same" name="tech_same" class="icheck" data-checkbox="icheckbox_square-orange"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">E-mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="tech_email" name="tech_email" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">First Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="tech_firstname" name="tech_firstname" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Last Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="tech_lastname" name="tech_lastname" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Phone Number</label>
                                <div class="col-md-6">
                                    <input type="text" id="tech_phone" name="tech_phone" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Country</label>
                                <div class="col-md-6">
                                    <select name="tech_country" id="tech_country_list" class="form-control">
                                        <option value=""></option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA">Bosnia and Herzegowina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="BN">Brunei Darussalam</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo</option>
                                        <option value="CD">Congo, the Democratic Republic of the</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CI">Cote d'Ivoire</option>
                                        <option value="HR">Croatia (Hrvatska)</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands (Malvinas)</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard and Mc Donald Islands</option>
                                        <option value="VA">Holy See (Vatican City State)</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran (Islamic Republic of)</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KP">Korea, Democratic People's Republic of</option>
                                        <option value="KR">Korea, Republic of</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Lao People's Democratic Republic</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libyan Arab Jamahiriya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macau</option>
                                        <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia, Federated States of</option>
                                        <option value="MD">Moldova, Republic of</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN">Netherlands Antilles</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Reunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russian Federation</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="KN">Saint Kitts and Nevis</option>
                                        <option value="LC">Saint LUCIA</option>
                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">Sao Tome and Principe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SK">Slovakia (Slovak Republic)</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SH">St. Helena</option>
                                        <option value="PM">St. Pierre and Miquelon</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syrian Arab Republic</option>
                                        <option value="TW">Taiwan, Province of China</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania, United Republic of</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="UM">United States Minor Outlying Islands</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Viet Nam</option>
                                        <option value="VG">Virgin Islands (British)</option>
                                        <option value="VI">Virgin Islands (U.S.)</option>
                                        <option value="WF">Wallis and Futuna Islands</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Address Line 1</label>
                                <div class="col-md-6">
                                    <input type="text" id="tech_address1" name="tech_address1" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Address Line 2</label>
                                <div class="col-md-6">
                                    <input type="text" id="tech_address2" name="tech_address2" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">City</label>
                                <div class="col-md-6">
                                    <input type="text" id="tech_city" name="tech_city" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">State / Province</label>
                                <div class="col-md-6">
                                    <input type="text" id="tech_state" name="tech_state" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Zip / Postcode</label>
                                <div class="col-md-6">
                                    <input type="text" id="tech_postcode" name="tech_postcode" class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="form-group abn-form-group" style="display: none;">
                                <label class="col-md-2 control-label">Australian Business Number (ABN)</label>
                                <div class="col-md-6">
                                    <input type="text" id="tech_abn" name="tech_abn" class="form-control">
                                    <!--<label><i>For Australian customers, GST will be added to the total price.</i></label>-->
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                        <br />
                        <h4><i class="fa fa-credit-card"></i>&nbsp;Credit Card Details</h4>
                        <hr />
                        <span style="color: #ff0000" class="payment-errors"></span>
                        <input type="hidden" name="payment_id" value="<?php echo uniqid(); ?>" />
                        <div class="creditcard-payment">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Total</label>
                                <div class="col-md-10">
                                    <p class="form-control-static">
                                        <b>$<?php echo number_format($total,2); ?> USD</b>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Accepted Card Types</label>
                                <div class="col-md-10" style="vertical-align: middle;">
                                    <img src="/assets/img/visa_32.png" />
                                    <img src="/assets/img/mastercard_32.png" />
                                    <img src="/assets/img/american_express_32.png" />
                                    <img src="/assets/img/diners_club_32.png" />
                                    <img src="/assets/img/jcb_32.png" />
                                    <img src="/assets/img/discover_32.png" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Card Number</label>
                                <div class="col-md-10">
                                    <input style="max-width: 250px;" data-stripe="number" type="text" maxlength="20" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">CVC</label>
                                <div class="col-md-10">
                                    <input style="max-width: 60px;" data-stripe="cvc" type="text" maxlength="4" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Expiry</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input style="max-width: 50px;" data-stripe="exp-month" type="text" maxlength="2" class="form-control" placeholder="MM">
                                        <input style="max-width: 60px;" data-stripe="exp-year" type="text" maxlength="4" class="form-control" placeholder="YYYY">
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="form-group">
                                <label class="col-md-2"></label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="creditcard-payment"><button type="submit" class="btn green-haze"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Pay Now</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#admin_email').change(function(){
        if ($('#billing_email').attr('disabled')=="disabled")
            $('#billing_email').val($('#admin_email').val());
        if ($('#tech_email').attr('disabled')=="disabled")
            $('#tech_email').val($('#admin_email').val());
    });
    $('#admin_firstname').change(function(){
        if ($('#billing_firstname').attr('disabled')=="disabled")
            $('#billing_firstname').val($('#admin_firstname').val());
        if ($('#tech_firstname').attr('disabled')=="disabled")
            $('#tech_firstname').val($('#admin_firstname').val());
    });
    $('#admin_lastname').change(function(){
        if ($('#billing_lastname').attr('disabled')=="disabled")
            $('#billing_lastname').val($('#admin_lastname').val());
        if ($('#tech_lastname').attr('disabled')=="disabled")
            $('#tech_lastname').val($('#admin_lastname').val());
    });
    $('#admin_phone').change(function(){
        if ($('#billing_phone').attr('disabled')=="disabled")
            $('#billing_phone').val($('#admin_phone').val());
        if ($('#tech_phone').attr('disabled')=="disabled")
            $('#tech_phone').val($('#admin_phone').val());
    });
    $('#admin_address1').change(function(){
        if ($('#billing_address1').attr('disabled')=="disabled")
            $('#billing_address1').val($('#admin_address1').val());
        if ($('#tech_address1').attr('disabled')=="disabled")
            $('#tech_address1').val($('#admin_address1').val());
    });
    $('#admin_address2').change(function(){
        if ($('#billing_address2').attr('disabled')=="disabled")
            $('#billing_address2').val($('#admin_address2').val());
        if ($('#tech_address2').attr('disabled')=="disabled")
            $('#tech_address2').val($('#admin_address2').val());
    });
    $('#admin_city').change(function(){
        if ($('#billing_city').attr('disabled')=="disabled")
            $('#billing_city').val($('#admin_city').val());
        if ($('#tech_city').attr('disabled')=="disabled")
            $('#tech_city').val($('#admin_city').val());
    });
    $('#admin_state').change(function(){
        if ($('#billing_state').attr('disabled')=="disabled")
            $('#billing_state').val($('#admin_state').val());
        if ($('#tech_state').attr('disabled')=="disabled")
            $('#tech_state').val($('#admin_state').val());
    });
    $('#admin_postcode').change(function(){
        if ($('#billing_postcode').attr('disabled')=="disabled")
            $('#billing_postcode').val($('#admin_postcode').val());
        if ($('#tech_postcode').attr('disabled')=="disabled")
            $('#tech_postcode').val($('#admin_postcode').val());
    });
    $('#admin_abn').change(function(){
        if ($('#billing_abn').attr('disabled')=="disabled")
            $('#billing_abn').val($('#admin_abn').val());
        if ($('#tech_abn').attr('disabled')=="disabled")
            $('#tech_abn').val($('#admin_abn').val());
    });

    $('#admin_country_list').change(function(){
        if ($('#admin_country_list').val() == "AU")
            $('.abn-form-group').attr('style','display: block;');
        else
            $('.abn-form-group').attr('style','display: none;');

        if ($('#billing_country_list').attr('disabled')=="disabled")
            $('#billing_country_list').val($('#admin_country_list').val());
        if ($('#tech_country_list').attr('disabled')=="disabled")
            $('#tech_country_list').val($('#admin_country_list').val());
    });

    $('#billing_same').on('ifChecked', function(event){
        $('#billing_email').val($('#admin_email').val());
        $('#billing_email').attr('disabled','disabled');
        $('#billing_firstname').val($('#admin_firstname').val());
        $('#billing_firstname').attr('disabled','disabled');
        $('#billing_lastname').val($('#admin_lastname').val());
        $('#billing_lastname').attr('disabled','disabled');
        $('#billing_phone').val($('#admin_phone').val());
        $('#billing_phone').attr('disabled','disabled');
        $('#billing_country_list').val($('#admin_country_list').val());
        $('#billing_country_list').attr('disabled','disabled');
        $('#billing_address1').val($('#admin_address1').val());
        $('#billing_address1').attr('disabled','disabled');
        $('#billing_address2').val($('#admin_address2').val());
        $('#billing_address2').attr('disabled','disabled');
        $('#billing_city').val($('#admin_city').val());
        $('#billing_city').attr('disabled','disabled');
        $('#billing_state').val($('#admin_state').val());
        $('#billing_state').attr('disabled','disabled');
        $('#billing_postcode').val($('#admin_postcode').val());
        $('#billing_postcode').attr('disabled','disabled');
        $('#billing_abn').val($('#admin_abn').val());
        $('#billing_abn').attr('disabled','disabled');
    });
    $('#billing_same').on('ifUnchecked', function(event){
        $('#billing_email').val('');
        $('#billing_email').removeAttr('disabled');
        $('#billing_firstname').val('');
        $('#billing_firstname').removeAttr('disabled');
        $('#billing_lastname').val('');
        $('#billing_lastname').removeAttr('disabled');
        $('#billing_phone').val('');
        $('#billing_phone').removeAttr('disabled');
        $('#billing_country_list').val('');
        $('#billing_country_list').removeAttr('disabled');
        $('#billing_address1').val('');
        $('#billing_address1').removeAttr('disabled');
        $('#billing_address2').val('');
        $('#billing_address2').removeAttr('disabled');
        $('#billing_city').val('');
        $('#billing_city').removeAttr('disabled');
        $('#billing_state').val('');
        $('#billing_state').removeAttr('disabled');
        $('#billing_postcode').val('');
        $('#billing_postcode').removeAttr('disabled');
        $('#billing_abn').val('');
        $('#billing_abn').removeAttr('disabled');
    });
    $('#tech_same').on('ifChecked', function(event){
        $('#tech_email').val($('#admin_email').val());
        $('#tech_email').attr('disabled','disabled');
        $('#tech_firstname').val($('#admin_firstname').val());
        $('#tech_firstname').attr('disabled','disabled');
        $('#tech_lastname').val($('#admin_lastname').val());
        $('#tech_lastname').attr('disabled','disabled');
        $('#tech_phone').val($('#admin_phone').val());
        $('#tech_phone').attr('disabled','disabled');
        $('#tech_country_list').val($('#admin_country_list').val());
        $('#tech_country_list').attr('disabled','disabled');
        $('#tech_address1').val($('#admin_address1').val());
        $('#tech_address1').attr('disabled','disabled');
        $('#tech_address2').val($('#admin_address2').val());
        $('#tech_address2').attr('disabled','disabled');
        $('#tech_city').val($('#admin_city').val());
        $('#tech_city').attr('disabled','disabled');
        $('#tech_state').val($('#admin_state').val());
        $('#tech_state').attr('disabled','disabled');
        $('#tech_postcode').val($('#admin_postcode').val());
        $('#tech_postcode').attr('disabled','disabled');
        $('#tech_abn').val($('#admin_abn').val());
        $('#tech_abn').attr('disabled','disabled');
    });
    $('#tech_same').on('ifUnchecked', function(event){
        $('#tech_email').val('');
        $('#tech_email').removeAttr('disabled');
        $('#tech_firstname').val('');
        $('#tech_firstname').removeAttr('disabled');
        $('#tech_lastname').val('');
        $('#tech_lastname').removeAttr('disabled');
        $('#tech_phone').val('');
        $('#tech_phone').removeAttr('disabled');
        $('#tech_country_list').val('');
        $('#tech_country_list').removeAttr('disabled');
        $('#tech_address1').val('');
        $('#tech_address1').removeAttr('disabled');
        $('#tech_address2').val('');
        $('#tech_address2').removeAttr('disabled');
        $('#tech_city').val('');
        $('#tech_city').removeAttr('disabled');
        $('#tech_state').val('');
        $('#tech_state').removeAttr('disabled');
        $('#tech_postcode').val('');
        $('#tech_postcode').removeAttr('disabled');
        $('#tech_abn').val('');
        $('#tech_abn').removeAttr('disabled');
    });


</script>