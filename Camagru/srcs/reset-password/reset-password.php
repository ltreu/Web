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
<title>Reset Password - Camagru</title>
</head>

<body>
	<?php
	include '../../header.php';
	?>
	<div class="center">
		<h2>Reset Password</h2><br/>

		<p class="text">The Quick brown Fox jumped over the Lazy Dog. The Quick brown Fox jumped over the Lazy Dog. The Quick brown Fox jumped over the Lazy Dog.</p><br/>

		<form method="post" action="check-reset-password.php">
			<p>Email : </p>
			<input type="text" name="mail"><br/><br/>
			<input
			type="submit"
			name="submit"
			value="submit"/><br/><br/>
		</form><br/><br/>
		<?PHP
		include "../../errors.php";
		error_reset_password();
		delete_error_reset_password();
		?>


	</div>
</body>
<?php
include '../../footer.php';
 ?>
</html>
