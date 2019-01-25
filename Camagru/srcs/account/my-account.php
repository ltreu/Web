<?PHP session_start();
if ($_SESSION['login'] == NULL || !($_SESSION['login']))
{
	echo "<meta http-equiv='refresh' content='0,url=../../index.php'>";
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
<link rel="stylesheet" type="text/css" href="../../css/global.css">
<link rel="stylesheet" type="text/css" href="../../css/header.css">
<link rel="stylesheet" type="text/css" href="../../css/my-account.css">
<meta name="google" content="notranslate" />
<title>My Account - Camagru</title>
</head>

<body>
	<?php
	$current_page = "my-account";
	include '../../header.php';
	?>
	<div class="center">
		<h2>Welcome <?PHP echo $_SESSION['login'];?></h2>
		<br/><br/>
		<h3>Statistics</h3>

		<?php
		include '../../functions/registration.php';
		include '../../functions/gallery.php';
		include '../../functions/login.php';

		$gallery_user = get_gallery_user($_SESSION['login']);
		if ($gallery_user == NULL)
		{
			$_SESSION['nb_fixtures'] = 0;
			echo "<p class='text'>You have not done any editing yet :(</p>";
			echo "<p class='text'>IF you would like to click  <a href='../Fixtures/Fixtures.php'>HERE!</a></p>";
		}
		else
		{
			echo '<p class="text"> Number of like on my fixtures : ';
			$nb_likes = get_nb_likes_user($_SESSION['id']);
			echo $nb_likes;
			echo "</p>";
			echo '<p class="text"> Most liked fixtured : ';
			$most_liked_picture = get_most_liked_picture($_SESSION['id']);
			if ($most_liked_picture == NULL)
			{
				echo "No :(";
			}
			else {
				echo "<br/><br/>";
				$max = $most_liked_picture[0]['nb_likes'];
				foreach ($most_liked_picture as $elem)
				{
					if ($elem['nb_likes'] == $max)
					$array_like[] = $elem;
				}
				foreach ($array_like as $photo_like)
				{
					if ($max > 1)
					{
						echo "<a href='../photo/photo.php?id_photo=".$photo_like['id_photo']."'>Click here</a> (".$max." likes)<br/>";
					}
					else {
						echo "<a href='../photo/photo.php?id_photo=".$photo_like['id_photo']."'>Click here</a> (".$max." like)<br/>";
					}
				}
			}
			echo "</p><br/>";
			echo '<p class="text"> Number of comments on my Fixtures : ';
			$nb_comments = get_nb_comments_user($_SESSION['id']);
			echo $nb_comments;
			echo "</p>";
			echo '<p class="text"> My most commented on Fixture : ';
			$most_commented_picture = get_most_commented_picture($_SESSION['id']);
			if ($most_commented_picture == NULL)
			{
				echo "No :(";
			}
			else {
				echo "<br/><br/>";
				$max = $most_commented_picture[0]['nb_comments'];
				foreach ($most_commented_picture as $elem)
				{
					if ($elem['nb_comments'] == $max)
					{
						$array_comments[] = $elem;
					}
				}
				foreach ($array_comments as $photo_comment)
				{
					if ($max > 1)
					{
						echo "<a href='../photo/photo.php?id_photo=".$photo_comment['id_photo']."'>Click here</a> (".$max." comments)<br/>";
					}
					else {
						echo "<a href='../photo/photo.php?id_photo=".$photo_comment['id_photo']."'>Click here</a> (".$max." comment)<br/>";
					}
				}
			}
			echo "<br/><br/>";

			echo '<p class="text"><a href="../Fixtures/fixtures-users.php?login='.$_SESSION['login'].'"> View all my Fixtures</a></p>';

		}
		echo "<br/>"
		?>
		<br/>
		<h3>Manage my account</h3><br/>
		<p class="text"><a href="change-password.php">Change my password</a></p>
		<?php
		if ($_SESSION['groupe'] != 'admin')
		{
			echo '<p class="text"><a href="delete-account.php">Delete my account</a></p>';
		}
		if ($_SESSION['wish-to-delete-account'] == "OK")
		{
			echo "<p class='text'>Do you really want to delete your account?</p>";
			echo "<form method='post' action='delete-account.php'>";
			echo "<input type='submit' name='yes' value='Yes'/>\t";
			echo "<input type='submit' name='no' value='No'/><br/><br/>";
			echo "</form><br/><br/>";
		}
		if ($_SESSION['session-destroy'] == "OK")
		{
			echo "<div id='login-ko'><p>Your account has been deleted.</p>";
			echo "<p>You will be rediredcted to the home page in 5 seconds.</p></div>";
			session_destroy();
			echo "<meta http-equiv='refresh' content='5,url=../../index.php'>";
		}
		?>
	</div>
</body>
<?php
include '../../footer.php';
?>
</html>
