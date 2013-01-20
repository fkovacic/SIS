<?php 
	session_start();
	include('func.php');
	if (!isset($_SESSION['user'])) {
		wlog($_SERVER['REQUEST_URI'].";"."Unauthorized access.");
		header('Location:index.php');
	}
	else if ($_SESSION['user']['admin'] != "1") {
		wlog($_SERVER['REQUEST_URI'].";user=".$_SESSION['user']['username'].";"."Forbidden access to admin page.");
		header('Location:index.php');
	}
	include('header.php');
?>
<div id="menu">
	<a href="start.php"> Users </a>
	<a href="edit.php"> Edit my data </a>
	<?php 
		if ($_SESSION['user']['admin'] == 1) {
			echo "<a href=\"get.php?p=cc\"> Get important data </a>";
			echo "<a href=\"get.php?p=pass\"> Get passwords </a>";
		}
	?>
</div>
<div id="content">
	<?php 
		wlog($_SERVER['REQUEST_URI'].";user=".$_SESSION['user']['username'].";source=".$_SESSION['user']['source']);
		if ($_SESSION['user']['source'] == "dummy") {
			if ($_GET['p'] == "cc") {
				echo "<table id=\"utable\"><tr><th id=\"usfield\">Username</th><th id=\"usfield\">CC data</th></tr>";
				require('connectd.php');
				$query = mysql_query("SELECT username, ccinfo FROM users") or die(mysql_error());
				while ($row = mysql_fetch_assoc($query)) {
					echo "<tr><td id=\"usfield\">".$row['username']."</td><td id=\"usfield\">".$row['ccinfo']."</td></tr>";
				}
				mysql_close();
				echo "</table>";
			}
			else if($_GET['p'] == "pass") {
				echo "<table id=\"utable\"><tr><th id=\"usfield\">Username</th><th id=\"usfield\">Password hash</th></tr>";
				require('connectd.php');
				$query = mysql_query("SELECT username, password FROM users") or die(mysql_error());
				while ($row = mysql_fetch_assoc($query)) {
					echo "<tr><td id=\"usfield\">".$row['username']."</td><td id=\"usfield\">".$row['password']."</td></tr>";
				}
				mysql_close();
				echo "</table>";
			}
		}
		else $_SESSION['e'] = "You do not deserve to get this data!";
		if (isset($_SESSION['e'])) {
			echo "<div class=\"warning\">".$_SESSION['e']."</div>";
			unset($_SESSION['e']);
		}
	?>
</div>
<?php include('footer.php'); ?>