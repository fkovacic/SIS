<?php
	session_start();
	include('func.php');
	if (!isset($_SESSION['user'])) {
		wlog($_SERVER['REQUEST_URI'].";"."Unauthorized access.");
		header('Location:index.php');
	}
	else {
		$oldname = $_SESSION['user']['username'];
		$user = $_POST['username'];
		$ccinfo = $_POST['ccinfo'];

		$muser = mysql_real_escape_string($user);
		$mcc = mysql_real_escape_string($ccinfo);

		$inject = false;
		if ($user != $muser || $ccinfo != $mcc || $_SESSION['user']['source'] == "dummy") $inject = true;


		if ($inject) {
			if ($_SESSION['user']['source'] == "dummy") {
				wlog($_SERVER['REQUEST_URI'].";user=".$_SESSION['user']['username'].";source=".$_SESSION['user']['source'].";username=".$user.";ccinfo=".$ccinfo);
				require('connectd.php');
				$query = mysql_query("UPDATE users SET username = '$user', ccinfo = '$ccinfo' WHERE username = '$oldname'") or $_SESSION['e'] = "An error has occured!";
				mysql_close();
				if (!isset($_SESSION['e'])) {
					$_SESSION['user']['username'] = $user;
					$_SESSION['user']['ccinfo'] = $ccinfo;
				}
			}
			else {
				$_SESSION['e'] = "Go away, hacker!";
				wlog($_SERVER['REQUEST_URI'].";user=".$_SESSION['user']['username'].";source=".$_SESSION['user']['source'].";".$_SESSION['e'].";username=".$user.";ccinfo=".$ccinfo);
			}
		}
		else {
			require('connect.php');
			$query = mysql_query("UPDATE users SET username = '$muser', ccinfo = '$mcc' WHERE username = '$oldname'") or die(mysql_error());
			mysql_close();
			$_SESSION['user']['username'] = $muser;
			$_SESSION['user']['ccinfo'] = $mcc;
		}
		if (isset($_SESSION['e'])) header('Location:edit.php');
		else header('Location:index.php');
	}
?>