<?php
	session_start();
	include('func.php');
	if (isset($_SESSION['user'])) {
		wlog($_SERVER['REQUEST_URI'].";user=".$_SESSION['user']['username'].";source=".$_SESSION['user']['source'].";"."Online user tried to access.");
		header('Location:index.php');
	}
	else {
		$user = $_POST['username'];
		$pass = $_POST['password'];

		$muser = mysql_real_escape_string($user);
		$mpass = sha1("s1s_!".$pass);

		$inject = false;
		if ($user != $muser) $inject = true;

		if ($inject) {
			wlog($_SERVER['REQUEST_URI'].";username=".$user.";password=".$pass);
			require('connectd.php');
			$query = mysql_query("SELECT * FROM users WHERE username = '$user' AND password = '$mpass'");
			$res = mysql_fetch_assoc($query);
			if (mysql_num_rows($query)) {
				unset($_SESSION['e']);
				$_SESSION['user']['username'] = $res['username'];
				$_SESSION['user']['ccinfo'] = $res['ccinfo'];
				$_SESSION['user']['admin'] = $res['admin'];
				$_SESSION['user']['source'] = "dummy";
			}
			else $_SESSION['e'] = "Wrong username and/or password!";
			mysql_close();
		}
		else {
			require('connect.php');
			$query = mysql_query("SELECT * FROM users WHERE username = '$muser'") or die(mysql_error());
			$res = mysql_fetch_assoc($query);
			if (mysql_num_rows($query) && $res['password'] == $mpass) {
				unset($_SESSION['e']);
				$_SESSION['user']['username'] = $res['username'];
				$_SESSION['user']['ccinfo'] = $res['ccinfo'];
				$_SESSION['user']['admin'] = $res['admin'];
				$_SESSION['user']['source'] = "normal";
			}
			else $_SESSION['e'] = "Wrong username and/or password!";
			mysql_close();
		}
		header('Location:index.php');
	}
?>