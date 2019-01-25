<?PHP session_start();
	if ($_SESSION['groupe'] != 'admin')
	{
		echo "<meta http-equiv='refresh' content='0,url=../account/my-account.php'>";
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css?family=Merienda+One');
@import url('https://fonts.googleapis.com/css?family=Open+Sans');
</style>
<link rel="stylesheet" type="text/css" href="../../css/admin.css">
<link rel="stylesheet" type="text/css" href="../../css/header.css">
<link rel="stylesheet" type="text/css" href="../../css/global.css">
<meta name="google" content="notranslate" />
<title>Admin - Camagru</title>
</head>

<body>
	<?php
  	$current_page = "admin";
	include '../../header.php';
	?>
	<div class="center">
		<h2>Administration</h2><br/>

		<div class='manage-admin'>
			<a href="user-management.php" class='link-admin'><div class='manage'>Manage Users</div></a>
			<a href="filters-management.php" class='link-admin'><div class='manage'>Manage Filters</div></a>
			<a href="statistics.php" class='link-admin'><div class='manage'>Statistics</div></a>
		</div>

<br/>
	</div>
</body>
<?php
include '../../footer.php';
 ?>
</html>
