<?PHP session_start();
//ini_set('display_errors',0);
	if ($_SESSION['login'])
	{
//		header('Location: ../account/my-account.php');
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
<link rel="stylesheet" type="text/css" href="../../css/login.css">
<meta name="google" content="notranslate" />
<title>Login - Camagru</title>
</head>

<body>
	<?php
  	$current_page = "Login";
	include '../../header.php';
	?>
	<div class="heading">
		<h4 class="Log">Login</h4>
	</div>
	<div class="center">
    <div class="login-box">
      <img src="../../img/fluflu.png" class="avatar">
      <form method="post" action="check-login.php" class="logform">
<!--                <fieldset>-->
          <legend class="LogLeg">Login below</legend><br/>
<!--          <label for="mail">Email :</label>-->
          <input type="text" name="mail" id="mail" placeholder="Username"
              <?PHP if ($_SESSION['login-mail'] == "KO" ||
              $_SESSION['login-mail-exists'] == "KO")
              {echo "class='invalid'";}?>
              >
          <br/><br/>
<!--          <label for="password">Password :</label>-->
          <input type="password" name="password" id="password" placeholder="Password"
              <?PHP if ($_SESSION['login-password'] == "KO" ||
              $_SESSION['login-good-password'] == "KO")
              {echo "class='invalid'";}?>
              >
          <br/><br/>
          <input type="submit" name="submit" value="Submit"/>
          <br/><br/>
<!--            </fieldset>-->
          <p class="ForgotPassword">Forgot password? <a class="PassReset" href="../reset-password/reset-password.php">Click here!</a></p>
      </form>
    </div><br/><br/>
		<?PHP
		include "../../errors.php";
		error_connect();
		delete_error_connect();
		?>
	</div>
    
</body>
<?php
include '../../footer.php';
 ?>
</html>
