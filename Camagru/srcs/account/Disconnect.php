<?PHP
session_start();
?>
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
<title>Disconnect - Camagru</title>
</head>

<body>
	<?php
  	$current_page = "Disconnect";
	include '../../header.php';
	?>
	<div class="center">
		<h2>See you soon <?PHP echo $_SESSION['login'];?> !</h2><br/>

		<p class="text" style="text-align:center;">You will be redirected to the home page in 5 seconds.</p><br/>
	</div>
</body>
</html>

<?PHP
session_destroy();

	echo "<meta http-equiv='refresh' content='5,url=../../index.php'>";
	include '../../footer.php';
?>
