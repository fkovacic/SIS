<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>	
		<title>SIS Honeypot</title>
		<meta http-equiv="Content-Type"
			  content="text/html; charset=UTF-8"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1>
					<a href="index.php">SIS Honeypot app</a>
				</h1>
			</div>
			<?php 
				if (isset($_SESSION['user'])) {
					echo "<div id=\"u_log\"><p id=\"u_name\"><a href=\"edit.php\" id=\"u_link\">".$_SESSION['user']['username']."</a></p><p id=\"logout\"><a href=\"logout.php\">Log out</a></p>";
					if ($_SESSION['user']['admin'] == 1) {
						echo "<p id=\"admin\">Administrator</p>";
					}
					echo "</div>";
				}
			?>