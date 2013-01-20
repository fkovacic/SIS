<?php 
	session_start();
	unset($_SESSION['user']);
	unset($_SESSION['e']);
	session_destroy();
	header('Location:index.php');
?>