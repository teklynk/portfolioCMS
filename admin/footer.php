<?php
define('inc_access', TRUE);
include 'includes/header.php';

	$pageMsg="";
	//update table on submit
	if (!empty($_POST)) {
		$footerUpdate = "UPDATE footer SET heading='".$_POST["footer_heading"]."', content='".$_POST["footer_content"]."'";
		mysqli_query($db_conn, $footerUpdate);
		$pageMsg="<div class='alert alert-success'>The footer section has been updated.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='footer.php'\">×</button></div>";
	}

	$sqlFooter= mysqli_query($db_conn, "SELECT heading, content FROM footer");
	$row  = mysqli_fetch_array($sqlFooter);
?>
   <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				<?php echo $rowFooter["heading"]?>
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
			<form role="footerForm" method="post" action="">

				<div class="form-group">
					<label>Heading</label>
					<input class="form-control" name="footer_heading" value="<?php echo $row['heading']; ?>" placeholder="About Me">
				</div>

				<div class="form-group">
					<label>HTML / Text</label>
					<textarea class="form-control tinymce" name="footer_content" rows="20"><?php echo $row['content']; ?></textarea>

				</div>

				<button type="submit" class="btn btn-default"><i class='fa fa-fw fa-save'></i>Submit</button>
				<button type="reset" class="btn btn-default"><i class='fa fa-fw fa-refresh'></i>Reset</button>

			</form>

		</div>
	</div>

<?php
include 'includes/footer.php';
?>
