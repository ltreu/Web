<?PHP session_start();
ini_set('display_errors',0);

include "../../functions/login.php";
include "../../functions/registration.php";

//check_form('login', 'mail', $_POST['mail']);
//check_form('login', 'password', $_POST['password']);

var_dump( $_POST[ 'mail' ] );
if ($_POST['mail'] && $_POST['password'])
{
	$ml = htmlentities($_POST['mail']);
	$psw = htmlentities($_POST['password']);
	$return = check_exists_mail($ml);
	echo $return;
	if ($return > 0)
	{
		$_SESSION['login-mail-exists'] = "OK";
        //Check the sha512 hash below
		$infos = connect_check_password($ml, hash('sha512', $psw));
//        echo "    info is: ";
//        echo $info;
//        echo "     ";
		if ($infos != NULL)
		{
//            echo $info;
//            echo "info is not null";
			$_SESSION['id'] = $infos['id'];
			$_SESSION['login'] = $infos['login'];
			$_SESSION['mail'] = $infos['mail'];
			$_SESSION['groupe'] = $infos['groupe'];
			$_SESSION['connected'] = "OK";
			echo "<meta http-equiv='refresh' content='0,url=../account/my-account.php'>";
		}
		else
		{
//            echo $info;
//            echo "info is null";
			echo "<meta http-equiv='refresh' content='0,url=Connect.php'>";
			exit();
		}
	}
	else
	{
//        echo $return;
//        echo "Return is < 0";
		$_SESSION['login-mail-exists'] = "KO";
		echo "<meta http-equiv='refresh' content='0,url=Connect.php'>";
		exit();
	}
}
else
{
	echo "<meta http-equiv='refresh' content='0,url=Connect.php'>";
	exit();
}
?>
