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
<title>Manage Filters - Camagru</title>
</head>

<body>
	<?php
	$current_page = "admin";
	include '../../header.php';
	include '../../functions/admin-filters.php'
	?>
	<div class="center">
		<h2>List of filters</h2><br/>
		<?php
		$data = get_list_filters();
		echo "<table cellspacing='0'>";
		foreach ($data as $filter)
		{
			echo "<tr>";
			echo "<td>";
			echo str_replace("img/filters/", "", str_replace(".png", "", $filter['path_filter']));
			echo "</td>";
			echo "<td>";

			if ($filter['login'] != 'admin')
			{
				echo "<a href='delete-filter.php?id=".$filter['id_filter']."'>Delete</a>";
			}
			echo "</td>";

			echo "</tr>";
		}
		echo "</table>";

		if ($_SESSION['error-delete-filter'] == "KO")
		{
			echo "<br/><div id='login-ko'>Error : You must leave atleast five filters !</div>";
			$_SESSION['error-delete-filter'] = NULL;
		}


		?>


		<br/>

		<h2>Add Filter</h2><br/>
		<p class='text' style='text'>Your filter must be in PNG format and be in the same folder as the others (img/filters).</p>
		<form method="POST" action="add-filter.php">
			<p class='text'>The name of your filter without its extension: </p>
			<input type="text" name="filter" id="filter">
			<input type="submit" name="submit" value="submit"/>

		</form>
		<?PHP
		if ($_SESSION['filter-already-exists'] == "OK")
		{
			echo "<br/><div id='login-ko'>Error : Unfortunately, this filter seems to exit already !</div>";
			$_SESSION['filter-already-exists'] = NULL;
		}
		?>
	</div>
</body>
<?php
include '../../footer.php';
?>
</html>
