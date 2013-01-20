<?php 
	session_start();
	if (isset($_SESSION['user'])) {
		header('Location:start.php');
	}
	else header('Location:login.php') 
?>