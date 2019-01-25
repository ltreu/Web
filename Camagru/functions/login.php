<?php

function connect_check_password($mail, $password)
{
//    echo "This function is being called by the login";
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$request = $bdd->prepare("SELECT * FROM `users` WHERE `mail` LIKE :mail");
		$request->bindParam(':mail', $mail);
		$request->execute();
		$code = $request->fetch(PDO::FETCH_ASSOC);
//        echo "code is: ";
//        echo $code;
//        echo $mail;
//        echo $password;
//        echo $request;
		if (in_array($password, $code) == TRUE)
		{
//            echo "password is correct";
			$_SESSION['connect-good-password'] = "OK";
			return ($code);
		}
		else {
//            echo "password is incorrect";
			$_SESSION['connect-good-password'] = "KO";
		}
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function send_reinit_password_mail($token, $mail, $submit)
{
	$name = "Camagru";
	$message = "Dear member" . ",\r\n\r\n" .
	"You seem to have forgotten your password.\r\n\r\n" .
	"Follow this link to reset your password : \r\n\r\n" .
	"http://localhost:8080/camagru/srcs/reset-password/reset-my-password.php?token=".$token." \r\n\r\n" .
	"Cheers for now !";
	$from = 'From: Camagru';
	$to = $mail;
	$subject = mb_encode_mimeheader('Resetting a pasword.en', "UTF-8");
	$body = "From: $name\r\nTo: $to\r\nMessage:\r\n\r\n$message";
	if ($submit)
	{
		if (mail ($to, $subject, $body, $from) == FALSE)
		{
			die();
		}
	}
}

function	get_nb_likes_user($id)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$request = $bdd->prepare("SELECT `photos`.`link`, `photos`.`id_user` AS `Uploader`, `likes`.`id_photo` AS `id_photo`
			FROM `likes`
			INNER JOIN `photos` ON `photos`.`id_photo` = `likes`.`id_photo`
			WHERE `photos`.`id_user` = :id
			ORDER BY `likes`.`id_photo` ASC");
			$request->bindParam(':id', $id);
			$request->execute();
			$result = $request->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	get_most_liked_picture($id)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$request = $bdd->prepare("SELECT `photos`.`id_photo`, `photos`.`link`, COUNT(*) as `nb_likes`
			FROM `likes`
			INNER JOIN `photos` ON `photos`.`id_photo` = `likes`.`id_photo`
			WHERE `photos`.`id_user` = :id
			GROUP BY `photos`.`id_photo`
			ORDER BY `nb_likes` DESC");
			$request->bindParam(':id', $id);
			$request->execute();
			$result = $request->fetchAll(PDO::FETCH_ASSOC);
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}


	}

	function	get_nb_comments_user($id)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$request = $bdd->prepare("SELECT `photos`.`link`, `photos`.`id_user` AS `Uploader`, `comments`.`id_photo` AS `id_photo`
				FROM `comments`
				INNER JOIN `photos` ON `photos`.`id_photo` = `comments`.`id_photo`
				WHERE `photos`.`id_user` = :id
				ORDER BY `comments`.`id_photo` ASC");
				$request->bindParam(':id', $id);
				$request->execute();
				$result = $request->rowCount();
				return ($result);
			}
			catch (PDOException $e) {
				print "Error : ".$e->getMessage()."<br/>";
				die();
			}
		}

		function	get_most_commented_picture($id)
		{
			try{
				include '../../config/database.php';
				$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
				$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$bdd->query("USE camagru");
				$request = $bdd->prepare("SELECT `photos`.`id_photo`, `photos`.`link`, COUNT(*) as `nb_comments`
				FROM `comments`
				INNER JOIN `photos` ON `photos`.`id_photo` = `comments`.`id_photo`
				WHERE `photos`.`id_user` = :id
				GROUP BY `photos`.`id_photo`
				ORDER BY `nb_comments` DESC");
				$request->bindParam(':id', $id);
				$request->execute();
				$result = $request->fetchAll(PDO::FETCH_ASSOC);
				return ($result);
			}
			catch (PDOException $e) {
				print "Error : ".$e->getMessage()."<br/>";
				die();
			}


		}
function	check_old_pass($old_pass, $flag)
{

	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$request = $bdd->prepare("SELECT `mdp` FROM `users` WHERE `id` LIKE :id");
		$request->bindParam(':id', $_SESSION['id']);
		$request->execute();
		$code = $request->fetch(PDO::FETCH_ASSOC);
		if ($old_pass == $code['mdp'])
		{
			$_SESSION[$flag] = "OK";
			return ($code);
		}
		else {
			$_SESSION[$flag] = "KO";
		}
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}


 ?>
