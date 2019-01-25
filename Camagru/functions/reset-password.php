<?php

	function	check_token_reset_password($password1, $token, $mail)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$request = $bdd->prepare("SELECT * FROM `users` WHERE `mail`= :mail");
			$request->bindParam(':mail', $mail);
			$request->execute();
			$code = $request->fetch(PDO::FETCH_ASSOC);
			if (in_array($token, $code) == TRUE)
			$_SESSION['reset-good-token'] = "OK";
			else {
				$_SESSION['reset-good-token'] = "KO";
			}
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

 ?>
