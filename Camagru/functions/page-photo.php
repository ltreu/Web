<?php

	function	get_infos_user_photo($id_photo)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$request = $bdd->prepare("SELECT `link`, `login`, `mail` FROM `photos` INNER JOIN `users` ON users.id = photos.id_user WHERE `id_photo` LIKE :id_photo");
			$request->bindParam(':id_photo', $id_photo);
			$request->execute();
			$data = $request->fetchAll(PDO::FETCH_ASSOC);
			return ($data);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	get_nb_likes($id_photo)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$request = $bdd->prepare("SELECT * FROM `likes` WHERE `id_photo`= :id_photo");
			$request->bindParam(':id_photo', $id_photo);
			$request->execute();
			$result = $request->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	check_if_already_liked($id_photo, $id)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$request = $bdd->prepare("SELECT * FROM `likes` INNER JOIN `users` ON users.id = likes.id_user WHERE `id_photo`= :id_photo AND `id_user` = :id_user");
			$request->bindParam(':id_photo', $id_photo);
			$request->bindParam(':id_user', $id);
			$request->execute();
			$result = $request->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	check_if_my_photo($id_photo, $id)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$request = $bdd->prepare("SELECT * FROM `photos` WHERE `id_photo`= :id_photo AND `id_user` = :id_user");
			$request->bindParam(':id_photo', $id_photo);
			$request->bindParam(':id_user', $id);
			$request->execute();
			$result = $request->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	can_i_like_it($id_photo)
	{
		if (isset($_SESSION['login']))
		{
			$_SESSION['already_liked'] = check_if_already_liked($id_photo, $_SESSION['id']);
			$_SESSION['my_photo'] = check_if_my_photo($_GET['id_photo'], $_SESSION['id']);
			if ($_SESSION['already_liked'] != 0 || $_SESSION['my_photo'] != 0)
			{
				echo 'src="../../img/paw-grey.png"';
				if ($_SESSION['already_liked'] != 0)
				echo 'title="You already like this picture !"';
				else if ($_SESSION['my_photo'] != 0)
				echo 'title="Unable to like your own photo !"';
			}
			else {
				echo 'src="../../img/paw-black.png"';
				echo 'onmouseover="this.src=\'../../img/paw-pink.png\'"';
				echo 'onmouseout="this.src=\'../../img/paw-black.png\'"';
				echo 'onclick="increment_like(this)"';
				$_SESSION['click-like'] = "OK";
				$_SESSION['id_photo'] = $id_photo;
			}
		}
		else {
			echo 'src="../../img/paw-grey.png"';
			echo 'title="You must be logged in to like this image !"';
		}
	}


function	get_comments($id_photo)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$bdd->query("SET NAMES UTF8");
		$request = $bdd->prepare("SELECT `login`, `comments`, `id_comment` FROM `comments` INNER JOIN `users` ON users.id = comments.id_user WHERE `id_photo` LIKE :id_photo");
		$request->bindParam(':id_photo', $id_photo);
		$request->execute();
		$data = $request->fetchAll(PDO::FETCH_ASSOC);
		return ($data);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_mail_user($login)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$bdd->query("SET NAMES UTF8");
		$request = $bdd->prepare("SELECT `mail` FROM `users` WHERE `login` LIKE :login");
		$request->bindParam(':login', $login);
		$request->execute();
		$data = $request->fetchAll(PDO::FETCH_ASSOC);
		return ($data);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function	send_comment_mail($identity, $id_photo, $submit, $mail)
{
		$name = "Camagru";
		$message = "<br/>Dear " . $identity . ",<br/><br/>" .
		"One of your fixtures has been commented on". "<br/>".
		"Why not take a look at it please follow: <a href='http://localhost:8080/Camagru/srcs/photo/photo.php?id_photo=".$id_photo."'></a>" . "<br/><br/>" .
		"Camagru !";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
     	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: Camagru';
		$to = $mail;
		$subject = 'New comment on your fixture';
		$body = "From: $name<br/>To: $to<br/>Message:<br/>$message";

		echo "about to post a comment and send out a mail to:";
		echo $identity;
		echo $id_photo;
		echo $submit;
		echo $mail;
			if ($submit)
			{
				if (mail ($to, $subject, $body, $headers) == FALSE)
				{
					die("error");
				}
			}
}


function	put_comments($comments)
{
if ($comments == NULL)
{
	echo "<br/><p class='text' style='text-align:center;'>There are no comments on this photo yet. Be the first to comment !</p>";
}
else {
	echo "<br/>";
	foreach ($comments as $data)
	{

		if ($data['login'] == $_SESSION['login'] || $_SESSION['groupe'] == 'admin')
		{
			echo "<div id='comment' onmouseover=\"getElementById('".$data['id_comment'];
			echo "').style.display='block'\" onmouseout=\"getElementById('".$data['id_comment'];
			echo "').style.display='none'\" >";
			echo "<p class='text'>Posted by <a href='../Fixtures/Fixturess-users.php?login=".$data['login']."'>".$data['login']."</a></p>";
			echo "<p class='text'>".$data['comments']."</p>";
			echo "<a href='delete-comment.php?id-comment=".$data['id_comment']."' class='delete-comment' id='".$data['id_comment']."'>Remove</a>";
		}
		else {
			echo "<div id='comment'>";
			echo "<p class='text'>Posted by <a href='../Fixtures/Fixturess-users.php?login=".$data['login']."'>".$data['login']."</a></p>";
			echo "<p class='text'>".$data['comments']."</p>";
		}
		echo "</div>";
		echo "<br/>";
	}
}
}

function	check_if_picture_exists($id)
{
	if (isset($id) && $id != NULL && is_numeric($id))
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$request = $bdd->prepare("SELECT * FROM `photos` WHERE `id_photo` = :id_photo");
			$request->bindParam(':id_photo', $id);
			$request->execute();
			$code = $request->rowCount();
			if ($code == 0)
			{
				echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php'>";
				exit();
			}
			else {
				$_SESSION['id_photo'] = $id;
			}
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}
	else {
		echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php'>";
		exit();
	}
}

function	picture_belong_to_user($id)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$request = $bdd->prepare("SELECT * FROM `photos` WHERE `id_photo` = :id_photo AND `id_user` = :id_user");
		$request->bindParam(':id_photo', $id);
		$request->bindParam(':id_user', $_SESSION['id']);
		$request->execute();
		$code = $request->rowCount();
		return ($code);

}
catch (PDOException $e) {
	print "Error : ".$e->getMessage()."<br/>";
	die();
}
}


?>
