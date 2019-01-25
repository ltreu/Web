<?PHP session_start();
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
<link rel="stylesheet" type="text/css" href="../../css/Fixtures.css">
<link rel="stylesheet" type="text/css" href="../../css/gallery.css">
<meta name="google" content="notranslate" />
<title>Fixtures - Camagru</title>
</head>

<body>
	<?php
	$current_page = "fixtures";
	include '../../header.php';
	echo '<div class="center">';
	if (!$_SESSION['login'])
	{
		echo "<p class='text' style='text-align:center;'>This page is for registered users only.</p>";
		echo "<p class='text' style='text-align:center;'>Register  <a href='../Register/Register.php'>HERE</a></p>";
		echo "<p class='text' style='text-align:center;'>Login  <a href='../Connect/Connect.php'>HERE</a></p>";
	}
	else {

		include 'go-to-Fixtures.php';
	}
	?>
</body>

<?php
include '../../footer.php';
 ?>

</html>
