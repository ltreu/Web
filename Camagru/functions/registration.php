<?php
function check_form($flag, $text, $data)
{
	if (isset($data) && $data != NULL)
	{
		$_SESSION[$flag."-".$text] = "OK";
	}
	else
	{
		$_SESSION[$flag."-".$text] = "KO";
	}
}

function check_regex_mail($data)
{
	if (filter_var($data, FILTER_VALIDATE_EMAIL) == FALSE)
	{
		$_SESSION['flag-regex-mail'] = "KO";
	}
	else {
		$_SESSION['flag-regex-mail'] = "OK";
	}
}

function check_regex_password($data, $flag)
{
	if (preg_match("/(?=.{6,})(?=.*\d)(?=.*[a-zA-Z])/", $data) != 1)
	{
		$_SESSION[$flag] = "KO";
	}
	else {
		$_SESSION[$flag] = "OK";
	}
}

function check_exists_username($username)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$request = $bdd->prepare("SELECT * FROM `users` WHERE `login`= :login");
		$request->bindParam(':login', $username);
		$request->execute();
		$result = $request->rowCount();
		if ($result  > 0){
			$_SESSION['flag-user-exists'] = "KO";
		}
		else {
			$_SESSION['flag-user-exists'] = "OK";
		}
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function check_exists_mail($email)
{
	try{
        echo "Attempting to test email";
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$request = $bdd->prepare("SELECT * FROM `users` WHERE `mail`= :email");
		$request->bindParam(':email', $email);
		$request->execute();
		$result = $request->rowCount();
		return ($result);
        echo "$result";
	}
	catch (PDOException $e) {
		print "Error : ".$e->getMessage()."<br/>";
		die();
	}
}

function check_same_password($pass1, $pass2, $flag)
{
	if ($pass1 != $pass2)
	{
		$_SESSION[$flag] = "KO";
	}
	else {
		$_SESSION[$flag] = "OK";
	}
}

function send_confirmation_mail($identity, $mail, $submit)
{
    echo $mail;
    echo "Sending email to:";
	$name = "Camagru";
	$message = "Dear " . $identity . ",\r\n\r\n" .
	"Thank you for registering to Camagru\r\n\r\n" .
	"You can now login at the following: \r\n\r\n" .
	"http://localhost:8080/Camagru/srcs/Connect/Connect.php \r\n\r\n" .
	"We hope to see you soon!";
	$from = 'From: Camagru';
	$to = $mail;
	$subject = mb_encode_mimeheader('Your registration to camagru', "UTF-8");
	$body = "From: $name\r\nTo: $to\r\nMessage:\r\n\r\n$message";

	if ($submit)
	{
		if (mail ($to, $subject, $body, $from) == FALSE)
		{
            echo "email dies";
			die();
		}
	}
}

 ?>
