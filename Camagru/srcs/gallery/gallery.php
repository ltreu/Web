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
<link rel="stylesheet" type="text/css" href="../../css/gallery.css">
<meta name="google" content="notranslate" />
<title>Gallery - Camagru</title>
</head>

<body>
	<?php
	$current_page = "gallery";
	include '../../header.php';
	include '../../functions/gallery.php';
	echo '<div id="center">';
	echo '<h2>Gallery</h2><br/>';

	$db_exists = check_if_database_exists('camagru');
	if ($db_exists != NULL)
	{
		$code = check_if_table_photos_exists();
	}
	if ($code != NULL)
	{

		$nb_fixtures = get_nb_fixtures();
		$_SESSION['max_page'] = ceil($nb_fixtures / 10);

		if (isset($_GET['page']) && $_GET['page'] != NULL && is_numeric($_GET['page'])
		&& $_GET['page'] > 0 && $_GET['page'] <= $_SESSION['max_page'])
		{
			$_SESSION['page'] = $_GET['page'];
			$data = get_gallery_data($_SESSION['page']);
			echo "<div class='gallery' id='common-gallery'>";
			foreach ($data as $key=>$elem)
			{
				echo "<div class='photo'>";
				echo "<a href='../photo/photo.php?id_photo=".$elem['id_photo']."'><img src='../../".$elem['link']."'></a>";
				echo "</div>";

			}
			echo "</div>";
			echo "<div id='pagination'>";

			if ($nb_fixtures > 10)
			{
				if ($_SESSION['page'] == 1)
				{
					echo "<img src='../../img/arrow-down-nope.png'/>";
				}
				else {
					echo "<a class='link' href='gallery.php?page=1'>1</a>";

					echo "<img src='../../img/arrow-down.png' onclick='previous_page()'/>";
				}
				echo "<p class='text' id='current_page'>page ".$_SESSION['page']."</p>";
				if ($_SESSION['page'] < $_SESSION['max_page'])
				{
					echo "<img src='../../img/arrow-up.png' onclick='next_page()'/>";
					echo "<a  class='link' href='gallery.php?page=".$_SESSION['max_page']."'>".$_SESSION['max_page']."</a>";
				}
				else {
					echo "<img src='../../img/arrow-up-nope.png'/>";
				}
			}
			echo "</div>";
		}
		else {
			echo "<meta http-equiv='refresh' content='0,url=gallery.php?page=1'>";
			exit();
		}
	}
	echo '<script src="pages.js"></script>';
	echo '</div>';
	?>
</body>
<?php
include '../../footer.php';
?>
</html>
