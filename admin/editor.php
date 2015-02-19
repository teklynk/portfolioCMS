<?php 
include 'includes/header.php';

	//Read/Write from text file
	$handle = fopen($customCss_dir, 'r');
	$data = fread($handle,filesize($customCss_dir));

	if (!empty($_POST)) {
		$handle = fopen($customCss_dir, 'w') or die('Cannot open file:  '.$customCss_dir);
		$data = $_POST["edit_css"];
		fwrite($handle, $data);
		//header("Location: editor.php");
		$pageMsg="<div class='alert alert-success'>".$customCss_dir." has been updated.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='editor.php'\">×</button></div>";
	}
?>

   <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Styles
			</h1>
	</div>
	<div class="row">
		<div class="col-lg-6">
		<?php 
		if ($pageMsg !="") {
			echo $pageMsg;
		}
		?>
			<form role="editForm" method="post" action="editor.php">

				<div class="form-group">
					<label><?php echo $customCss_dir; ?></label>
					<textarea class="form-control" name="edit_css" rows="20"><?php echo $data;?></textarea>
				</div>

				<button type="submit" class="btn btn-default"><i class='fa fa-fw fa-save'></i> Submit</button>
				<button type="reset" class="btn btn-default"><i class='fa fa-fw fa-refresh'></i> Reset</button>

			</form>

		</div>
	</div>

<?php
include 'includes/footer.php';
?>
