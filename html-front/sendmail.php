<script>
function clearForms()
{
  var i;
  for (i = 0; (i < document.forms.length); i++) {
    document.forms[i].reset();
  }
  $('.alert.alert-success').fadeOut(200);
}
</script>
<?php

	$name = trim($_POST['name']);
	$email = $_POST['email'];
	$comments = $_POST['comments'];

	$site_owners_email = 'admin@manic.host'; // Replace this with your own email address
	$site_owners_name = 'Manic Host Admin'; // replace with your name

	if (strlen($name) < 2) {
		$error['name'] = "Please enter your name";
	}

	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Please enter a valid email address";
	}

	if (strlen($comments) < 3) {
		$error['comments'] = "Please leave a comment.";
	}

	if (!$error) {

		require_once('phpMailer/class.phpmailer.php');
		$mail = new PHPMailer();

		$mail->From = $email;
		$mail->FromName = $name;
		$mail->Subject = "Contact Form";
		$mail->AddAddress($site_owners_email, $site_owners_name);
		$mail->IsHTML(true);
		$mail->Body = '<b>Name:</b> '. $name .'<br/><b>E-mail:</b> '. $email .'<br/><br/>' . $comments;

		$mail->Send();

		echo "<div class='alert alert-success'  role='alert'>Thanks " . $name . ". Your message has been sent.</div>";

	} # end if no error
	else {

		$response = (isset($error['name'])) ? "<div class='alert alert-danger'  role='alert'>" . $error['name'] . "</div> \n" : null;
		$response .= (isset($error['email'])) ? "<div class='alert alert-danger'  role='alert'>" . $error['email'] . "</div> \n" : null;
		$response .= (isset($error['comments'])) ? "<div class='alert alert-danger'  role='alert'>" . $error['comments'] . "</div>" : null;

		echo $response;
	} # end if there was an error sending

?>