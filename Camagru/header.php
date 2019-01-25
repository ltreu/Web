<?php
  session_start();
	ini_set('display_errors',0);
?>

<header>
</header>
<style>
</style>
<link rel="stylesheet" type="text/css" href="css/global.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<nav class="navigation">

  <a href="/Camagru/index.php"><div class="CamagruHome">Camagru</div></a>

	<a  <?PHP if ($current_page == "gallery"){echo "id='current'";}?>href='/Camagru/srcs/gallery/gallery.php?page=1'><div>Gallery</div></a>
	<?PHP
	echo "<a ";
	if ($current_page == "Fixtures"){
		echo "id='current'";
	}
	echo "href='/Camagru/srcs/Fixtures/Fixtures.php'><div>Fixtures</div></a>";
	if ($_SESSION['connected'] == "OK")
	{
		echo "<a ";
		if ($current_page == "my-account"){
			echo "id='current'";
		}
		echo "href='/Camagru/srcs/account/my-account.php'><div>My Account</div></a>";
		if ($_SESSION['groupe'] == 'admin')
		{
		echo "<a ";
		if ($current_page == "admin"){
			echo "id='current'";
		}
		echo "href='/Camagru/srcs/admin/admin.php'><div>Administration</div></a>";
	}
		echo "<a ";
		if ($current_page == "Disconnect"){
			echo "id='current'";
		}
		echo "href='/Camagru/srcs/account/Disconnect.php'><div>Disconnect</div></a>";
	}
	else
	{
		echo "<a ";
		if ($current_page == "Register"){
			echo "id='current'";
		}
		echo "href='/Camagru/srcs/Register/Register.php'><div>Register</div></a>";
		echo "<a ";
		if ($current_page == "Connect"){
			echo "id='current'";
		}
		echo "href='/Camagru/srcs/Connect/Connect.php'><div>Login</div></a>";
	}
	?>
</nav>
