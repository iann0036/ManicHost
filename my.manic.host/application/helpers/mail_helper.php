<?php
/**
 * Created by PhpStorm.
 * User: iann0036
 * Date: 15/2/2015
 * Time: 2:00 PM
 */

function internalVpsRemove($vps) {
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: Manic Host <admin@manic.host>";
    $headers[] = "Subject: ADMIN ACTION - VPS Cancel";

    $vpstext = var_export($vps,true);

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />

<p>Remove: </p>

<p>${vpstext}</p>

</div>
EOT;

    mail("admin@manic.host", "ADMIN ACTION - VPS Cancel", $body, implode("\r\n", $headers));
}

function internalSslRemove($ssl) {
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: Manic Host <admin@manic.host>";
    $headers[] = "Subject: ADMIN ACTION - SSL Cancel";

    $ssltext = var_export($ssl,true);

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />

<p>Remove: </p>

<p>${ssltext}</p>

</div>
EOT;

    mail("admin@manic.host", "ADMIN ACTION - SSL Cancel", $body, implode("\r\n", $headers));
}

function sendDomainReminderMail($to, $name, $domain) {
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: Manic Host <admin@manic.host>";
    $headers[] = "Bcc: Manic Host Admin <admin@manic.host>";
    $headers[] = "Subject: Domain Expiring";

    $name_parts = explode(' ',$name);
    $firstname = $name_parts[0];

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />

<p>Hi ${firstname},</p>

<p>Your domain name, <b>${domain}</b>, is expiring in 7 days. Please log into your Manic Host account to ensure your domain is renewed.</p>

<p>Sincerely,<br />
Manic Host.</p>
</div>
EOT;

    mail($to, "Domain Expiring", $body, implode("\r\n", $headers));
}

function sendCustomMail($from, $to, $subject, $message) {
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: ".$from;
    $headers[] = "Bcc: Manic Host Admin <admin@manic.host>";
    $headers[] = "Subject: ".$subject;

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />

${message}

<p>Sincerely,<br />
Manic Host.</p>
</div>
EOT;

    mail($to, $subject, $body, implode("\r\n", $headers));
}

function sendProvisionedMailboxMail($email, $firstname, $mailbox_email, $password) {
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: Manic Host Support <support@manic.host>";
    $headers[] = "Bcc: Manic Host Admin <admin@manic.host>";
    $headers[] = "Subject: Your Mailbox has been provisioned";

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />
<p>Hi ${firstname},</p>

<p>Thanks for your recent order at Manic Host. This e-mail is to notify you that your email mailbox for the address <b>${mailbox_email}</b> is now provisioned.</p>

<p>The password for this account is <b>${password}</b></p>

<p>You can access this mailbox by webmail at <a href="https://mail.manic.host/">https://mail.manic.host</a>.</p>

<p>If you require further information, please reply directly to this e-mail.</p>

<p>Sincerely,<br />
Manic Host.</p>
</div>
EOT;

    mail($email, "Your Mailbox has been provisioned", $body, implode("\r\n", $headers));
}

function sendProvisionedSSLMail($email, $firstname, $domain) {
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: Manic Host Support <support@manic.host>";
    $headers[] = "Bcc: Manic Host Admin <admin@manic.host>";
    $headers[] = "Subject: Your SSL Certificate has been provisioned";

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />
<p>Hi ${firstname},</p>

<p>Thanks for your recent order at Manic Host. This e-mail is to notify you that your SSL certificate for the domain <b>${domain}</b> is now provisioned.</p>

<p>You can access this certificate by logging into your Manic Host account.</p>

<p>If you require further information, please reply directly to this e-mail.</p>

<p>Sincerely,<br />
Manic Host.</p>
</div>
EOT;

    mail($email, "Your SSL Certificate has been provisioned", $body, implode("\r\n", $headers));
}

function sendProvisionedForwarderMail($email, $firstname, $forwarder_email) {
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: Manic Host Support <support@manic.host>";
    $headers[] = "Bcc: Manic Host Admin <admin@manic.host>";
    $headers[] = "Subject: Your Forwarder has been provisioned";

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />
<p>Hi ${firstname},</p>

<p>Thanks for your recent order at Manic Host. This e-mail is to notify you that your email forwarder for the address ${forwarder_email} is now provisioned.</p>

<p>By default, emails will initially be forwarded to your administrative email address (this address). You can change this in your account.</p>

<p>If you require further information, please reply directly to this e-mail.</p>

<p>Sincerely,<br />
Manic Host.</p>
</div>
EOT;

    mail($email, "YourForwarder has been provisioned", $body, implode("\r\n", $headers));
}

function sendProvisionedHostingMail($email, $firstname, $plan, $domain) {
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: Manic Host Support <support@manic.host>";
    $headers[] = "Bcc: Manic Host Admin <admin@manic.host>";
    $headers[] = "Subject: Your Hosting Account has been provisioned";

    $plan = ucfirst($plan);

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />
<p>Hi ${firstname},</p>

<p>Thanks for your recent order at Manic Host. This e-mail is to notify you that your ${plan} hosting plan is now available.</p>

<p>If you require further information, please reply directly to this e-mail.</p>

<p>Sincerely,<br />
Manic Host.</p>
</div>
EOT;

    mail($email, "Your Hosting Account has been provisioned", $body, implode("\r\n", $headers));
}

function sendManualProvisionMail($email, $firstname, $items) {
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: Manic Host Support <support@manic.host>";
    $headers[] = "Bcc: Manic Host Admin <admin@manic.host>";
    $headers[] = "Subject: Order Processing Information";

    $item_descs = array();
    foreach ($items as $item) {
        $item_desc = $item['name'];
        if (isset($item['options']['domain'])) {
            if (strlen($item['options']['domain']) > 1)
                $item_desc .= " (" . $item['options']['domain'] . ")";
        } else if (isset($item['options']['email_address'])) {
            if (strlen($item['options']['email_address']) > 1)
                $item_desc .= " (" . $item['options']['email_address'] . ")";
        } else if (isset($item['options']['hostname'])) {
            if (strlen($item['options']['hostname']) > 1)
                $item_desc .= " (" . $item['options']['hostname'] . ")";
        }

        $item_descs[] = $item_desc;
    }
    $long_item_descs = implode(", ", $item_descs);

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />
<p>Hi ${firstname},</p>

<p>Thanks for your recent order at Manic Host. This e-mail is to notify you that item(s) in your recent order requires some manual verification or setup.</p>

<p><b>Item(s): </b>${long_item_descs}</p>

<p>Please accept our apologies for the delay and note that we are working to have your service provisioned as soon as possible.</p>

<p>If you require further information, please reply directly to this e-mail.</p>

<p>Sincerely,<br />
Manic Host.</p>
</div>
EOT;

    mail($email, "Order Processing Information", $body, implode("\r\n", $headers));
}

function sendResetMail($username,$email,$name,$token) {
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: Manic Host <noreply@manic.host>";
    $headers[] = "Bcc: Manic Host Admin <admin@manic.host>";
    $headers[] = "Subject: Password reset for Manic Host";

    $name_parts = explode(' ',$name);
    $firstname = $name_parts[0];
    $orig_ip = $_SERVER['REMOTE_ADDR'];

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />
<p>Hi ${firstname},</p>

<p>A request has been made to reset your password on Manic Host.</p>

<p>Please click on the link to reset your password.</p>

<p style="margin-top: 20px; margin-bottom: 20px;"><a style="text-decoration: none;" href="http://my.manic.host/login/recover/${username}/${token}/">Reset Your Password</a></p>

<p>If you did not request to reset your password, please ignore this email. Your password will remain unchanged. The password reset request originated at IP address ${orig_ip}.</p>

<p>Sincerely,<br />
Manic Host.</p>
</div>
EOT;

    mail($email, "Password reset for Manic Host", $body, implode("\r\n", $headers));
}

function sendWelcomeMail($username,$email,$name) {
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: Manic Host <admin@manic.host>";
    $headers[] = "Bcc: Manic Host Admin <admin@manic.host>";
    $headers[] = "Subject: Welcome to Manic Host";

    $name_parts = explode(' ',$name);
    $firstname = $name_parts[0];

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />
<p>Hi ${firstname},</p>

<p>Thanks for joining Manic Host.</p>

<p>To get started, you should login to your account, then you will be directed to the Dashboard. This is an overview of your account, including account balance, if you choose to keep one, and a list of all your current services. By clicking in the sidebar, you can access, manage and update your services as needed.</p>

<p>If you have any queries on the usage of Manic Host, check out the FAQ, or simply reply to this e-mail. We appreciate your business.</p>

<p>Sincerely,<br />
Manic Host.</p>
</div>
EOT;

    mail($email, "Welcome to Manic Host", $body, implode("\r\n", $headers));
}

function sendContactMail($name, $user_email, $username, $subject, $message) {
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    if (strlen($user_email)>2)
        $headers[] = "From: ".$name." <".$user_email.">";
    else
        $headers[] = "From: ".$name." <unknownemail@manic.host>";
    $headers[] = "Subject: ".$subject;

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />
<p><b>Message from {$name}:</b></p>
<p>${message}</p>
<hr />
<p>This message was sent by ${name} (${username}) via the contact form on <a href="https://my.manic.host/">my.manic.host</a>.</p>
</div>
EOT;

    mail('Manic Host Admin <admin@manic.host>', $subject, $body, implode("\r\n", $headers));
}

function sendLoginMail($username,$email,$name) {
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: Manic Host <admin@manic.host>";
    $headers[] = "Bcc: Manic Host Admin <admin@manic.host>";
    $headers[] = "Subject: Login Notification";

    $name_parts = explode(' ',$name);
    $firstname = $name_parts[0];
    $ip = $_SERVER['REMOTE_ADDR'];
    $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />
<p>Hi ${firstname},</p>

<p>Someone has recently logged into your Manic Host account.</p>

<p><b>Username:</b> ${username}<br />
<b>IP Address:</b> ${ip}<br />
<b>Hostname:</b> ${hostname}</p>

<p>If this is not you we highly recommend you change your details and contact support immediately.</p>

<p>You can modify the settings of this alert under your profile.</p>

<p>Sincerely,<br />
Manic Host.</p>
</div>
EOT;

    mail($email, "Login Notification", $body, implode("\r\n", $headers));
}

function sendInvoiceMail($email, $name, $invoice_no) {
    $files = array("/var/www/my.manic.host/invoices/Invoice_".$invoice_no.".pdf");
    $mime_boundary = "==Manic_Invoice_x".md5(time())."x";

    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: multipart/mixed;\n boundary=\"".$mime_boundary."\"";
    $headers[] = "From: Manic Host <admin@manic.host>";
    $headers[] = "Bcc: Manic Host Admin <admin@manic.host>";
    $headers[] = "Subject: Invoice #".$invoice_no;

    $name_parts = explode(' ',$name);
    $firstname = $name_parts[0];

    $body = <<<EOT
<div style="font-size: 14px; font-family: Helvetica, Arial, sans-serif">
<img src="https://my.manic.host/assets/img/manichost.png" alt="Manic Host" />
<p>Hi ${firstname},</p>

<p>We have received your payment, please find attached your invoice.</p>

<p><b>Invoice Number:</b> ${invoice_no}</p>

<p>Sincerely,<br />
Manic Host.</p>
</div>
EOT;

    $body = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n\n" . $body . "\n\n";

    for ($i=0; $i<count($files); $i++) {
        if (is_file($files[$i])) {
            $body .= "--{$mime_boundary}\n";
            $fp = @fopen($files[$i],"rb");
            $data = @fread($fp,filesize($files[$i]));
            @fclose($fp);
            $data = chunk_split(base64_encode($data));
            $body .= "Content-Type: application/octet-stream; name=\"".basename($files[$i])."\"\n" .
                "Content-Description: ".basename($files[$i])."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($files[$i])."\"; size=".filesize($files[$i]).";\n" .
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
        }
    }
    $body .= "--{$mime_boundary}--";

    mail($email, "Invoice #".$invoice_no, $body, implode("\r\n", $headers));
}
