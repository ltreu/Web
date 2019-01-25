<?php
session_start();
if ($_SESSION['groupe'] != 'admin')
{

	echo "<meta http-equiv='refresh' content='0,url=../account/my-account.php'>";
	exit();
}
else {

	include '../../functions/admin-users.php';

	if (isset($_GET['id']) && $_GET['id'] != NULL && is_numeric($_GET['id']))
	{
		$id = htmlentities($_GET['id']);
		$delete_id_exists = check_if_id_exists($id);
		$delete_admin = check_if_not_admin($id);
		if ($delete_id_exists > 0 && $delete_admin == 0)
		{
			delete_user($id);
		}
	}
	echo "<meta http-equiv='refresh' content='0,url=user-management.php'>";
}


 ?>
