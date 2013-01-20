<?php 
	session_start();
	include('func.php');
	if (!isset($_SESSION['user'])) {
		wlog($_SERVER['REQUEST_URI'].";"."Unauthorized access.");
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
	<table id="utable">
		<tr>
			<th id="usfield">Username</th><th>Has cc data</th><th>Is admin</th>
		</tr>
		<?php 
			if ($_SESSION['user']['source'] == "dummy") require('connectd.php');
			else require('connect.php');
			$query = mysql_query("SELECT username, ccinfo, admin FROM users") or die(mysql_error());
			while ($row = mysql_fetch_assoc($query)) {
				echo "<tr><td id=\"usfield\">".$row['username']."</td><td>";
				if (strlen($row['ccinfo']) > 0) echo "Yes";
				else echo "No";
				echo "</td><td>";
				if ($row['admin'] != "0") echo "Yes";
				else echo "No";
				echo "</td></tr>";
			}
			mysql_close();
		?>
	</table>
</div>
<?php include('footer.php'); ?>