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
<title>Manage users - Camagru</title>
</head>

<body>
	<?php
	$current_page = "admin";
	include '../../header.php';
	include '../../functions/admin-users.php'
	?>
	<div class="center">
		<h2>List of users</h2><br/>
		<?php
		$data = get_list_users();
		if (count($data) == 1)
		{
			echo "<p class='text' style='text-align:center;'>Sorry, but no one uses your site !</p>";
		}
		else {
			echo "<table cellspacing='0'>";
			foreach ($data as $user)
			{
				echo "<tr>";
				echo "<td>";
				echo $user['login'];
				echo "</td>";
				echo "<td>";
				echo $user['mail'];
				echo "</td>";
				echo "<td>";

				if ($user['login'] != 'admin')
				{
					echo "<a href='delete-user.php?id=".$user['id']."'>Delete</a>";
				}
				echo "</td>";

				echo "</tr>";
			}
			echo "</table>";
		}
		?>
		<br/>
	</div>
</body>
<?php
include '../../footer.php';
?>
</html>
