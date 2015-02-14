<?php include 'includes/header.php';?>
<?php
session_start();
unset($_SESSION["user_id"]);
unset($_SESSION["user_name"]);
$message="";

if (!empty($_POST)) {

	$result = mysql_query("SELECT username, password, id FROM users WHERE username='" . $_POST["username"] . "' AND password = '". $_POST["password"]."'");
	$row  = mysql_fetch_array($result);

	if (is_array($row)) {
		$_SESSION["user_id"] = $row['id'];
		$_SESSION["user_name"] = $row['username'];
	} else {
		$message = "<div class='alert alert-danger' role='alert'>Invalid Username or Password!<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='index.php'\">×</button></div>";
	}
}

if (isset($_SESSION["user_id"]) AND isset($_SESSION["user_name"])) {
	//header("Location: setup.php");
	echo "<script>window.location.href='setup.php';</script>";
}
?>
<style>
html, body {
	margin-top: 0px !important;
	background-color: #fff !important;
}
.navbar-inverse {
	display:none !important;
}
#wrapper {
	padding-left: 0px !important;
}
.form-signin {
	max-width: 330px;
	padding: 15px;
	margin: 0 auto;
}
</style>
<div class="container">
    <div class="row">
        <form name="frmUser" class="form-signin" method="post" action="">
		<h2 class="form-signin-heading">Please sign in</h2>
		<div class="message"><?php if ($message!="") {echo $message;} ?></div>
        	<label for="username" class="sr-only">Username</label>
            <input class="form-control" type="text" name="username" placeholder="Username" required>
            <label for="password" class="sr-only">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
        <p></p>
    </div>
</div>

<?php include 'includes/footer.php';?>
