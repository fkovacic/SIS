<?php 
	session_start();
	include('func.php');
	if (isset($_SESSION['user'])) {
		wlog($_SERVER['REQUEST_URI'].";user=".$_SESSION['user']['username'].";source=".$_SESSION['user']['source'].";"."Online user tried to access.");
		header('Location:index.php');
	}
	include 'header.php'; 
?>
<div id="menu">
	<a href="login.php">Log in ></a>
</div>
<div id="content">
	<div id="form">
		<form method="post" action="check.php" id="login">
			<div class="row">
				<label for="username">
					Username:
				</label>
				<input type="text" id="username" name="username" />
				<br />
			</div>
			<div class="row">
				<label for="password">
					Password:
				</label>
				<input type="password" id="password" name="password" />
				<br />
			</div>
			<div class="row">
				<input type="submit" name="ok" value="Login" id="button" />
			</div>
		</form>
	</div>
	<?php 
		if (isset($_SESSION['e'])) {
			echo "<div class=\"warning\">".$_SESSION['e']."</div>";
			wlog($_SERVER['REQUEST_URI'].";".$_SESSION['e']);
			unset($_SESSION['e']);
		}
	?>
</div>
<?php include 'footer.php'; ?>