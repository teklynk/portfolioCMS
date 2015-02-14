<?php 
include 'includes/header.php';

	//Read/Write from text file
	$my_file = '../css/custom.css';
	$handle = fopen($my_file, 'r');
	$data = fread($handle,filesize($my_file));

	if (!empty($_POST)) {
		$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
		$data = $_POST["edit_css"];
		fwrite($handle, $data);
		header("Location: editor.php");
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

			<form role="editForm" method="post" action="editor.php">

				<div class="form-group">
					<label>CSS Editor</label>
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
