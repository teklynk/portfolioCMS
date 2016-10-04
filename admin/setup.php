<?php
define('inc_access', TRUE);
include 'includes/header.php';

	$pageMsg="";
	//update table on submit
	if (!empty($_POST)) {
		$site_keywords = filter_var($_POST["site_keywords"], FILTER_SANITIZE_STRING);
		$site_author = filter_var($_POST["site_author"], FILTER_SANITIZE_STRING);
		$site_description = filter_var($_POST["site_description"], FILTER_SANITIZE_STRING);
		$setupUpdate = "UPDATE setup SET title='".$_POST["site_title"]."', author='".$site_author."', keywords='".mysqli_real_escape_string($db_conn, $site_keywords)."', description='".mysqli_real_escape_string($db_conn, $site_description)."', headercode='".mysqli_real_escape_string($db_conn, $_POST["site_header"])."', googleanalytics='".$_POST["site_google"]."', tinymce=".$_POST["site_tinymce"]." ";
		mysqli_query($db_conn, $setupUpdate);
		$pageMsg="<div class='alert alert-success'>The setup section has been updated.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='setup.php'\">×</button></div>";
	}

	$sqlSetup = mysqli_query($db_conn, "SELECT title, author, description, keywords, headercode, googleanalytics, tinymce FROM setup");
	$row  = mysqli_fetch_array($sqlSetup);

?>
   <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Setup
				<small></small>
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
			<form role="setupForm" method="post" action="setup.php">

				<div class="form-group">
					<label>Site Title</label>
					<input class="form-control" name="site_title" value="<?php echo $row['title']; ?>" placeholder="My Portfolio Site">
				</div>
				  <div class="form-group">
					<label>Author</label>
					<input class="form-control" name="site_author" value="<?php echo $row['author']; ?>" placeholder="John Doe">
				</div>
				<div class="form-group">
					<label>Keywords</label>
					<textarea class="form-control" name="site_keywords" rows="3"><?php echo $row['keywords']; ?></textarea>
				</div>
				<div class="form-group">
					<label>Description</label>
					<textarea class="form-control" name="site_description" rows="3"><?php echo $row['description']; ?></textarea>
				</div>
				<div class="form-group">
					<label>Header Code</label>
					<textarea class="form-control" name="site_header" rows="3"><?php echo $row['headercode']; ?></textarea>
				</div>
				<div class="form-group">
					<label>Google Analytics</label>
					<input class="form-control" name="site_google" value="<?php echo $row['googleanalytics']; ?>" placeholder="UA-XXXX-Y">
				</div>
				<?php
					if ($row['tinymce']==1) {
						$selEditor1="SELECTED";
						$selEditor0="";
					} else {
						$selEditor0="SELECTED";
						$selEditor1="";
					}
				?>
				<div class="form-group">
					<label>TinyMCE</label>
					<select class="form-control" name="site_tinymce">
						<option value="1" <?php echo $selEditor1; ?>>On</option>
						<option value="0" <?php echo $selEditor0; ?>>Off</option>
					</select>
				</div>

					<button type="submit" class="btn btn-default"><i class='fa fa-fw fa-save'></i> Submit</button>
					<button type="reset" class="btn btn-default"><i class='fa fa-fw fa-refresh'></i> Reset</button>

			</form>

		</div>
	</div>
<?php
include 'includes/footer.php';
?>
