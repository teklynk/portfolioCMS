<?php
define('inc_access', TRUE);
include 'includes/header.php';
	$pageMsg="";
	//update table on submit
	if (!empty($_POST)) {
		$socialUpdate = "UPDATE socialmedia SET heading='".$_POST["social_heading"]."', facebook='".$_POST["social_facebook"]."', twitter='".$_POST["social_twitter"]."', google='".$_POST["social_google"]."', linkedin='".$_POST["social_linkedin"]."', github='".$_POST["social_github"]."'";
		mysqli_query($db_conn, $socialUpdate);
		$pageMsg="<div class='alert alert-success'>The social media section has been updated.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='socialmedia.php'\">×</button></div>";
	}

	$sqlSocial = mysqli_query($db_conn, "SELECT heading, facebook, twitter, linkedin, google, github FROM socialmedia");
	$row  = mysqli_fetch_array($sqlSocial);
?>
   <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				<?php echo $rowSocial["heading"]?>
			</h1>
		</div>
	</div>
	 <div class="row">
		<div class="col-lg-8">
		<?php
		if ($pageMsg !="") {
			echo $pageMsg;
		}
		?>
			<form role="socialmediaForm" method="post" action="">
				<div class="form-group">
					<label>Heading</label>
					<input class="form-control" name="social_heading" value="<?php echo $row['heading']; ?>"  placeholder="Follow Me">
				</div>
				<div class="form-group">
					<label>Facebook</label>
					<input class="form-control" name="social_facebook" value="<?php echo $row['facebook']; ?>"  placeholder="https://www.facebook.com/username">
				</div>
				<div class="form-group">
					<label>Twitter</label>
					<input class="form-control" name="social_twitter" value="<?php echo $row['twitter']; ?>"  placeholder="https://www.twitter.com/username">
				</div>
				<div class="form-group">
					<label>Google+</label>
					<input class="form-control" name="social_google" value="<?php echo $row['google']; ?>"  placeholder="https://plus.google.com/8675309/posts">
				</div>
				<div class="form-group">
					<label>GitHub</label>
					<input class="form-control" name="social_github" value="<?php echo $row['github']; ?>"  placeholder="https://www.github.com/username/">
				</div>
				<div class="form-group">
					<label>LinkedIn</label>
					<input class="form-control" name="social_linkedin" value="<?php echo $row['linkedin']; ?>"  placeholder="https://www.linkedin.com/username/">
				</div>

				<button type="submit" class="btn btn-default"><i class='fa fa-fw fa-save'></i> Submit</button>
				<button type="reset" class="btn btn-default"><i class='fa fa-fw fa-refresh'></i> Reset</button>

			</form>

		</div>
	</div>
<?php
include 'includes/footer.php';
?>
