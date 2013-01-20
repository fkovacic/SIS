<?php
	require("db.php");
	mysql_connect($server, $dbusername, $dbpassword) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
	mysql_query("set names utf8");	
?>