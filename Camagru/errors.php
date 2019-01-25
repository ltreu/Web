<?php
session_start();
ini_set('display_errors',0);

function error_registration()
{
	if ($_SESSION['Register-username'] == "KO")
	echo "<div id='registration-ko'>Error : Please enter a username</div>";
	else if ($_SESSION['flag-user-exists'] == "KO")
	echo "<div id='registration-ko'>Error : User name already exists</div>";
	if ($_SESSION['Register-email'] == "KO")
	echo "<div id='registration-ko'>Error : Please enter an email address</div>";
	else if ($_SESSION['flag-regex-mail'] == "KO")
	echo "<div id='registration-ko'>Error : Please enter a valid email address</div>";
	else if ($_SESSION['flag-email-exists'] == "KO")
	echo "<div id='registration-ko'>Error : This email address is already in use</div>";
	if ($_SESSION['Register-password1'] == "KO")
	echo "<div id='registration-ko'>Error : Please enter a password</div>";
	else if ($_SESSION['flag-regex-password'] == "KO")
	echo "<div id='registration-ko'>Error : Your password must contain 6 characters including a number</div>";
	if ($_SESSION['Register-password2'] == "KO")
	echo "<div id='registration-ko'>Error : Please re-enter your password</div>";
	if ($_SESSION['same-password'] == "KO")
	echo "<div id='registration-ko'>Error : Please re-enter your password identically</div>";
	if ($_SESSION['flag-registration'] == "OK"){
		echo "<div id='registration-ok'><p>Your registration has been noted</p>";
		echo "<p>You should receive a confirmation email shortly</p></div>";
	}
}

function delete_error_registration()
{
	$_SESSION['registration-username'] = NULL;
	$_SESSION['flag-user-exists'] = NULL;
	$_SESSION['registration-email'] = NULL;
	$_SESSION['flag-regex-mail'] = NULL;
	$_SESSION['flag-email-exists'] = NULL;
	$_SESSION['registration-password1'] = NULL;
	$_SESSION['flag-regex-password'] = NULL;
	$_SESSION['registration-password2'] = NULL;
	$_SESSION['same-password'] = NULL;
	$_SESSION['flag-registration'] = NULL;
}

function	error_connect()
{
	if ($_SESSION['connect-email'] == "KO")
	echo "<div id='registration-ko'>Error : Please enter an email address</div>";
	else if ($_SESSION['connect-mail-exists'] == "KO")
	echo "<div id='registration-ko'>Error : Unknown email address</div>";
	if ($_SESSION['connect-password'] == "KO")
	echo "<div id='registration-ko'>Error : Please enter a password</div>";
	if ($_SESSION['connect-good-password'] == "KO")
	echo "<div id='registration-ko'>Error : Password is incorrect</div>";
}

function delete_error_connect()
{
	$_SESSION['connect-mail'] = NULL;
	$_SESSION['connect-mail-exists'] = NULL;
	$_SESSION['connect-password'] = NULL;
	$_SESSION['connect-good-password'] = NULL;
}

function	error_reset_password()
{
	if ($_SESSION['flag-reset-password-mail-exists'] == "KO")
	echo "<div id='registration-ko'>Error : Unknown email address</div>";
	if ($_SESSION['mail-reinit-password'] == "OK"){
		echo "<div id='registration-ok'><p>Your request has been taken into account</p>";
		echo "<p>You should receive a reset email shortly</p></div>";
	}
	if ($_SESSION['flag-mail-exists-reset-my-password'] == "KO")
	echo "<div id='registration-ko'>Error : Unknown email address</div>";
	if ($_SESSION['reset-password1'] == "KO")
	echo "<div id='registration-ko'>Error : Please enter a password</div>";
	else if ($_SESSION['reset-flag-regex-password'] == "KO")
	echo "<div id='registration-ko'>Error : Your password must cntain atleast 6 characters including a number</div>";
	if ($_SESSION['reset-password2'] == "KO")
	echo "<div id='registration-ko'>Error : Please re-enter your password</div>";
	else if ($_SESSION['reset-same-password'] == "KO")
	echo "<div id='registration-ko'>Error : Please re-enter your password identically</div>";
	if ($_SESSION['reset-good-token'] == "KO")
	echo "<div id='registration-ko'>Error : The reset link is wrong</div>";
	if ($_SESSION['reinit-password-in-db'] == "OK"){
		echo "<div id='registration-ok'><p>Your password has been reset</p>";
		echo "<p>You will be redirected to the home page in 5 seconds</p></div>";
	}
}

function	delete_error_reset_password()
{
	$_SESSION['flag-reset-password-mail-exists'] = NULL;
	$_SESSION['mail-reinit-password'] = NULL;
	$_SESSION['flag-mail-exists-reset-my-password'] = NULL;
	$_SESSION['reset-password1'] = NULL;
	$_SESSION['reset-flag-regex-password'] = NULL;
	$_SESSION['reset-password2'] = NULL;
	$_SESSION['reset-same-password'] = NULL;
	$_SESSION['reset-good-token'] = NULL;
	$_SESSION['reinit-password-in-db'] = NULL;
}

function	error_post_comment()
{
	if ($_SESSION['comment-send'] == "KO")
		echo "<br/><br/><div id='registration-ko'>Error when sending the comment</div>";
	else if ($_SESSION['comment-send'] == "OK"){
		echo "<br/><br/><div id='registration-ok'><p>Your comment has been sent!</p>";
		if ($_SESSION['login'] != $_SESSION['login-target'])
		{
			echo "<p>".$_SESSION['login-target']." will be notified via email</p></div>";
		}
		else {
			echo "</div>";
		}
	}
	$_SESSION['comment-send'] = NULL;
}



function	error_change_password()
{
	if ($_SESSION['change-pass-old_pass'] == "KO")
		echo "<div id='registration-ko'>Error : Please enter your old password</div>";
	else if ($_SESSION['flag-old-pass'] == "KO")
		echo "<div id='registration-ko'>Error : Password does not match</div>";
	if ($_SESSION['change-pass-pass1'] == "KO")
		echo "<div id='registration-ko'>Error : Please enter a new password</div>";
	else if ($_SESSION['flag-regex-password'] == "KO")
		echo "<div id='registration-ko'>Error : Your password must contain atleast 6 characters including a number</div>";
	if ($_SESSION['change-pass-pass2'] == "KO")
		echo "<div id='registration-ko'>Error : Please re-enter your new password</div>";
	else if ($_SESSION['same-password'] == "KO")
		echo "<div id='registration-ko'>Error : Please re-enter your new password identically</div>";
	if ($_SESSION['flag-password-changed'] == "OK"){
		echo "<div id='registration-ok'><p>Your password has been changed !</p><br/>";
		echo "<p>You will be redirected to your personal account in 5 seconds</p></div>";
	}
}

function delete_error_change_password()
{
	$_SESSION['change-pass-old_pass'] = NULL;
	$_SESSION['change-pass-pass1'] = NULL;
	$_SESSION['change-pass-pass2'] = NULL;
	$_SESSION['flag-regex-password'] = NULL;
	$_SESSION['same-password'] = NULL;
	$_SESSION['flag-old-pass'] = NULL;
	$_SESSION['flag-password-changed'] = NULL;
}

function	send_image_error()
{
	if ($_SESSION['send-image-error'] == "KO")
	{
		echo "<div id='registration-ko'>Error while transferring the file</div>";
		$_SESSION['send-image-error'] = NULL;
	}
	if ($_SESSION['send-image-size'] == "KO")
	{
		echo "<div id='registration-ko'>Error : Your file is too large to upload</div>";
		$_SESSION['send-image-size'] = NULL;
	}
	if ($_SESSION['send-image-extension'] == "KO")
	{
		echo "<div id='registration-ko'>Error : incorrecet file extenstion</div>";
		$_SESSION['send-image-extension'] = NULL;
	}
	if ($_SESSION['send-image-dimensions'] == "KO")
	{
		echo "<div id='registration-ko'>Error : Incorrect file dimensions</div>";
		$_SESSION['send-image-dimensions'] = NULL;
	}
}




?>
