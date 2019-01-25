<?PHP session_start();
//ini_set('display_errors',0);

	include "../../functions/registration.php";
	check_form("Register", "username", $_POST['username']);
	check_form("Register", "email", $_POST['email']);
	check_form("Register", "password1", $_POST['password1']);
	check_form("Register", "password2", $_POST['password2']);
//    echo "Done checking form values";

	if ($_SESSION['Register-username'] == "OK")
	{
        echo "Checking the username";
        echo $username;
		$username = htmlentities($_POST['username']);
		check_exists_username($username);
        echo "Reg username OK";
        echo $username;

	}

	if ($_SESSION['Register-email'] == "OK")
	{
		$email = htmlentities($_POST['email']);
		check_regex_mail($email);
		$return = check_exists_mail($email);
		$_SESSION['flag-email-exists'] = ($return > 0) ? "KO" : "OK";
        echo $email;
	}

	if ($_SESSION['Register-password1'] == "OK")
	{
		$password1 = $_POST['password1'];
		check_regex_password($password1, "flag-regex-password");
	}

	if ($_SESSION['Register-password2'] == "OK")
	{
		$password2 = $_POST['password2'];
	}


	if ($_SESSION['Register-password1'] == "OK" && $_SESSION['Register-password2'] == "OK")
	{
		check_same_password($password1, $password2, "same-password");
	}



if ($_SESSION['Register-username'] == "OK" && $_SESSION['Register-email'] == "OK"
&& $_SESSION['Register-password1'] == "OK" && $_SESSION['Register-password2'] == "OK"
&& $_SESSION['flag-regex-password'] == "OK" && $_SESSION['flag-regex-mail'] == "OK"
&& $_SESSION['flag-user-exists'] == "OK" && $_SESSION['flag-email-exists'] == "OK"
&& $_SESSION['same-password'] == "OK")
{

	$_SESSION['flag-registration'] = "OK";
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$password = hash('sha512', $password1);
		$request = $bdd->prepare("INSERT INTO `users` (`login`, `mail`, `groupe`, `mdp`)
		VALUES(:username, :mail, :user, :password)");
		$request->bindParam(':username', $username);
		$request->bindParam(':mail', $email);
		$request->bindValue(':user', 'user');
		$request->bindParam(':password', $password);
		$request->execute();

        //Check this link to set up an SMTP Server on macOS
        //https://serversmtp.com/smtp-server-for-mac/
		send_confirmation_mail($username, $email, $_POST['submit']);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
	echo "<meta http-equiv='refresh' content='0,url=Register.php'>";

}
else {
	echo "<meta http-equiv='refresh' content='0,url=Register.php'>";
	exit();
}
?>
