<?php
session_start();
if ($_SESSION['wish-to-delete-account'] != "OK")
{
	$_SESSION['wish-to-delete-account'] = "OK";
	echo "<meta http-equiv='refresh' content='0,url=my-account.php'>";
	exit();
}
else {
	if ($_POST['yes'] == "Yes")
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");

			$request = $bdd->prepare("DELETE FROM `comments` WHERE `id_user`= :id_user");
			$request->bindParam(':id_user', $_SESSION['id']);
			$request->execute();

			$request = $bdd->prepare("DELETE FROM `likes` WHERE `id_user`= :id_user");
			$request->bindParam(':id_user', $_SESSION['id']);
			$request->execute();

			$request = $bdd->prepare("DELETE FROM `photos` WHERE `id_user`= :id_user");
			$request->bindParam(':id_user', $_SESSION['id']);
			$request->execute();

			$request = $bdd->prepare("DELETE FROM `users` WHERE `mail`= :mail");
			$request->bindParam(':mail', $_SESSION['mail']);
			$request->execute();
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
		$_SESSION['session-destroy'] = "OK";
		header('Location: my-account.php');
		exit();
	}
	else if ($_POST['non'] == "Non")
	{
		$_SESSION['wish-to-delete-account'] = NULL;
		header('Location: my-account.php');
		exit();
	}
	else {
		header('Location: my-account.php');
		exit();
	}
}
?>
