<?php
define('inc_access', TRUE);
include 'includes/header.php';

	$pageMsg="";
	//update table on submit
	if (!empty($_POST)) {
		$aboutUpdate = "UPDATE aboutus SET heading='".$_POST["about_heading"]."', content='".$_POST["about_content"]."'";
		mysqli_query($db_conn, $aboutUpdate);
		$pageMsg="<div class='alert alert-success'>The about section has been updated.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='aboutus.php'\">×</button></div>";
	}

	$sqlAbout= mysqli_query($db_conn, "SELECT heading, content FROM aboutus");
	$row  = mysqli_fetch_array($sqlAbout);
?>
   <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				<?php echo $rowAbout["heading"]?>
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
			<form role="aboutForm" method="post" action="">

				<div class="form-group">
					<label>Heading</label>
					<input class="form-control" name="about_heading" value="<?php echo $row['heading']; ?>" placeholder="About Me">
				</div>

				<div class="form-group">
					<label>HTML / Text</label>
					<textarea class="form-control tinymce" name="about_content" rows="20"><?php echo $row['content']; ?></textarea>

				</div>

				<button type="submit" class="btn btn-default"><i class='fa fa-fw fa-save'></i>Submit</button>
				<button type="reset" class="btn btn-default"><i class='fa fa-fw fa-refresh'></i>Reset</button>

			</form>

		</div>
	</div>

<?php
include 'includes/footer.php';
?>
