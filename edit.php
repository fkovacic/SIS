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
	<div id="form">
		<form method="post" action="editdata.php" id="edit">
			<div class="row">
				<label for="username">
					Username:
				</label>
				<input type="text" id="username" name="username" value=<?php echo "\"".$_SESSION['user']['username']."\""; ?> />
				<br />
			</div>
			<div class="row">
				<label for="ccinfo">
					CC info:
				</label>
				<input type="ccinfo" id="ccinfo" name="ccinfo" value=<?php echo "\"".$_SESSION['user']['ccinfo']."\""; ?> />
				<br />
			</div>
			<div class="row">
				<input type="submit" name="ok" value="Edit" id="button" />
			</div>
		</form>
	</div>
	<?php 
		if (isset($_SESSION['e'])) {
			echo "<div class=\"warning\">".$_SESSION['e']."</div>";
			wlog($_SERVER['REQUEST_URI'].";user=".$_SESSION['user']['username'].";".$_SESSION['e']);
			unset($_SESSION['e']);
		}
	?>
</div>
<?php include('footer.php'); ?>