<?php

	function	get_gallery_data($page)
	{
		$offset = ($page - 1) * 10;
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$request = $bdd->prepare("SELECT * FROM `photos` ORDER BY `date_upload` DESC LIMIT 10 OFFSET :offs");
			$request->bindParam(':offs', $offset, PDO::PARAM_INT);
			$request->execute();
			$data = $request->fetchAll();
			return ($data);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	get_gallery_user($login)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$request = $bdd->prepare("SELECT * FROM `photos` INNER JOIN `users` ON users.id = photos.id_user WHERE `login` LIKE :login ORDER BY `date_upload` DESC");
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

	function	get_nb_fixtures()
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$request = $bdd->prepare("SELECT * FROM `photos`");
			$request->execute();
			$result = $request->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	check_if_login_exists($login)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$request = $bdd->prepare("SELECT * FROM `users` WHERE `login` = :login");
			$request->bindParam(':login', $login);
			$request->execute();
			$result = $request->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	check_if_table_photos_exists()
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$request = $bdd->prepare("SHOW TABLES LIKE 'photos'");
			$request->execute();
			$code = $request->fetchAll(PDO::FETCH_ASSOC);
			return ($code);
		}
		catch (PDOException $e) {
			print "Error : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	check_if_database_exists()
	{
		include '../../config/database.php';
		try {
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
				$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		        $request = $bdd->prepare("SELECT * FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :db_name");
				$request->bindParam(':db_name', $DB_NAME);
				$request->execute();
				$code = $request->fetchAll(PDO::FETCH_ASSOC);
				return ($code);
		    }
			catch (PDOException $e) {
				print "Error : ".$e->getMessage()."<br/>";
				die();
			}
	}
 ?>
