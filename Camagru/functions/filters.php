<?php
function	get_filters()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$request = $bdd->prepare("SELECT * FROM `filters`");
		$request->execute();
		$data = $request->fetchAll(PDO::FETCH_ASSOC);
		return ($data);
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}
 ?>
