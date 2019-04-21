<?php
define('inc_access', TRUE);

include 'includes/header.php';

	//Read/Write from text file
	$handle = fopen($customCss_dir, 'r');
	$data = fread($handle,filesize($customCss_dir));
	$pageMsg="";

	if (!empty($_POST)) {
		if (file_exists($customCss_dir)) {
			$handle = fopen($customCss_dir, 'w') or die('Cannot open file:  '.$customCss_dir);
			$data = filter_var($_POST["edit_css"], FILTER_SANITIZE_STRING);
			fwrite($handle, $data);
			//header("Location: editor.php");
			$pageMsg="<div class='alert alert-success'>".$customCss_dir." has been updated.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='editor.php'\">×</button></div>";

			closedir($handle);
		}
	}
?>

   <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Styles
			</h1>
	</div>

	<div class="col-lg-12">
		<?php
		if ($pageMsg !="") {
			echo $pageMsg;
		}
		?>
		<form role="editForm" method="post" action="editor.php">

			<div class="form-group">
				<label><?php echo $customCss_dir; ?></label>
				<textarea class="form-control input-sm" name="edit_css" rows="20"><?php echo $data;?></textarea>
			</div>
			<div class="form-group">
				<span>
					<?php
					if (file_exists($customCss_dir)) {
						echo "Updated: ".date('m-d-Y, H:i:s',filemtime($customCss_dir));
					}
					?>
				</span>
			</div>
			<button type="submit" class="btn btn-default"><i class='fa fa-fw fa-save'></i> Submit</button>
			<button type="reset" class="btn btn-default"><i class='fa fa-fw fa-refresh'></i> Reset</button>

		</form>

	</div>
</div><!--close main container-->
<?php
include 'includes/footer.php';
?>
