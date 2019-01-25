<?PHP
session_start();
include '../../header.php';
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
<link rel="stylesheet" type="text/css" href="../../css/gallery.css">
<meta name="google" content="notranslate" />
<title>My Fixtures</title>
</head>

<body>
	<?php
	$current_page = "fixtures-users";
	include '../../functions/gallery.php';
	?>
	<div class="center">

			<?PHP
			$exists_or_not = check_if_login_exists(htmlentities($_GET['login']));
			if ($exists_or_not == 0)
			{
				echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php'>";
			}
			else {
					$login = htmlentities($_GET['login']);
					echo "<h2>fixtures or Fixtures: ".$login."</h2><br/>";
					echo '<div class="gallery">';
					$data = get_gallery_user($login);
					$nb_values = count($data);
					if ($nb_values == 0)
					{
						if ($_SESSION['login'] == $login)
						{
						echo "<p class='text'>You have yet to do editing :( </p>
						<br/><p class='text'>If you want to do editing, <a href='Fixtures.php'>Click HERE</a></p>";
						}
						else {
							echo "<p>".$login." Hasn't done any editing yet :(</p>";
						}
					}
					else {
						foreach ($data as $data1)
						{
							echo "<div class='photo'>";
							echo "<a href='../photo/photo.php?id_photo=".$data1['id_photo']."'><img src='../../".$data1['link']."'></a>";
							echo "</div>";
						}
						echo "</div>";
					}
			}
				echo "</div>";
			?>

</div>
</body>
<?php
include '../../footer.php';
 ?>
</html>
