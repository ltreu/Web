<?PHP session_start();
	ini_set('display_errors',0);
	if ($_SESSION['id'])
	{
		header('Location: ../account/my-account.php');
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
<!-- <link rel="stylesheet" type="text/css" href="../../css/login.css"> -->
<link rel="stylesheet" type="text/css" href="../../css/registration.css">
<meta name="google" content="notranslate" />
<title>Register - Camagru</title>
</head>

<body >
	<?php
  	$current_page = "Register";
	include '../../header.php';
	?>
	<div class="heading">
		<h4 class="Reg">Register</h4>
	</div>
	<div class="center">
        <div class="registration-box">
				<img src="../../img/fluflu.png" class="avatar">
				<form action="checking-register.php" method="post" class="regform">
					<!-- <fieldset class="fieldset"> -->
						<legend class="RegLeg">Register Below</legend><br/>
					<!-- <label for="username">Username :</label> -->
					<input
					type="text"
					name="username" id="username" placeholder="Username"
					<?PHP if ($_SESSION['Register-username'] == "KO" ||
					$_SESSION['flag-user-exists'] == "KO")
					{echo "class='invalid'";}?>><br/><br/>
					<!-- <label for="email">Email :</label> -->
					<input
					type="email"
					name="email"
					id="email"
					placeholder="Email"
					<?PHP if ($_SESSION['Register-email'] == "KO" ||
					$_SESSION['flag-regex-mail'] == "KO" || $_SESSION['flag-email-exists'] == "KO")
					{echo "class='invalid'";}?>><br/><br/>
					<!-- <label for="password1">Password :</label> -->
					<input
					type="password"
					name="password1"
					id="password1"
					placeholder="Password"
					<?PHP if ($_SESSION['Register-password1'] == "KO" ||
					$_SESSION['flag-regex-password'] == "KO")
					{echo "class='invalid'";}?>><br/><br/>
					<!-- <label for="password2">Repeat Password :</label> -->
					<input
					type="password"
					name="password2"
					id="password2"
					placeholder="Re-enter password"
					<?PHP if ($_SESSION['Register-password2'] == "KO")
					{echo "class='invalid'";}?>><br/><br/>
					<input
					type="submit"
					name="submit"
					value="Submit"/>
					<!-- </fieldset> -->
				</form>
				<br/><br/>
			</div>
        <div id="ErrorList">
            <?PHP
            include "../../errors.php";
            error_registration();
            delete_error_registration();
            ?>
        </div>
	</div>
    <?php
include '../../footer.php';
 ?>
</body>

</html>
