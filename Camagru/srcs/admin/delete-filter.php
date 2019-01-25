<?php
session_start();


if ($_SESSION['groupe'] != 'admin')
{
	echo "<meta http-equiv='refresh' content='0,url=../account/my-account.php'>";
	exit();
}
else {
	include '../../functions/admin-filters.php';
	if (isset($_GET['id']) && $_GET['id'] != NULL && is_numeric($_GET['id']))
	{

		$id_filter = htmlentities($_GET['id']);
		$delete_id_filter_exists = check_if_id_filter_exists($id_filter);
		if ($delete_id_filter_exists > 0)
		{
			delete_filter($id_filter);
		}
	}
	echo "<meta http-equiv='refresh' content='0,url=filters-management.php'>";
}


 ?>
