<?PHP session_start();?>
<!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css?family=Merienda+One');
@import url('https://fonts.googleapis.com/css?family=Open+Sans');
</style>
<link rel="stylesheet" type="text/css" href="../../css/global.css">
<link rel="stylesheet" type="text/css" href="../../css/header.css">
<link rel="stylesheet" type="text/css" href="../../css/login.css">
<meta name="google" content="notranslate" />
<title>Reset my password - Camagru</title>
</head>

<body>
	<?php
	include '../../header.php';
	$token = $_GET['token'];
	?>
	<div class="center">
		<h2>Reset my password</h2><br/>

		<form method="post" action="check-reset-my-password.php">
			<p>Email : </p>
			<input type="text" name="mail"
			<?PHP if ($_SESSION['flag-mail-exists-reset-my-password'] == "KO")
			{echo "class='invalid'";}?>><br/><br/>
			<p>New Password : </p>
			<input type="password" name="password1"
			<?PHP if ($_SESSION['reset-password1'] == "KO" ||
			$_SESSION['reset-flag-regex-password'] == "KO")
			{echo "class='invalid'";}?>><br/><br/>
			<p>Repeat your new password : </p>
			<input type="password" name="password2"
			<?PHP if ($_SESSION['reset-password2'] == "KO" ||
			$_SESSION['reset-same-password'] == "KO")
			{echo "class='invalid'";}?>><br/><br/>
			<input type="hidden" name="token" value="<?PHP echo $token;?>">
			<input type="submit" name="submit" value="submit"/><br/><br/>
		</form><br/><br/>

		<?PHP
		include "../../errors.php";
		error_reset_password();
		if ($_SESSION['reinit-password-in-db'] == "OK")
		{
			echo "<meta http-equiv='refresh' content='5,url=../../index.php'>";
		}
		delete_error_reset_password();
		?>

	</div>
</body>
<?php
include '../../footer.php';
 ?>
</html>
