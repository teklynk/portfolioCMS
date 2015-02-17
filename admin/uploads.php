<?php
include 'includes/header.php';
		
		//Upload function
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$uploadMsg = "<div class='alert alert-success' style='margin-top:12px;'>The file ". basename( $_FILES["fileToUpload"]["name"]) . " has been uploaded.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='uploads.php'\">×</button></div>";
		} else {
			$uploadMsg = "";
		}
		
		$deleteMsg = "";
		//Delete file
		if ($_GET["delete"] AND !$_GET["confirm"]) {
			$deleteMsg="<div class='alert alert-danger'>Are you sure you want to delete ".$_GET["delete"]."? <a href='?delete=".$_GET["delete"]."&confirm=yes' class='alert-link'>Yes</a><button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='uploads.php'\">×</button></div>";
			echo $deleteMsg;
		} elseif ($_GET["delete"] AND $_GET["confirm"]=="yes") {
			unlink($target_dir.$_GET["delete"]);
			$deleteMsg="<div class='alert alert-success'>".$_GET["delete"]." has been deleted.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='uploads.php'\">×</button></div>";
			echo $deleteMsg;
		}
?>

   <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				Uploads
			</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
        <?php if ($uploadMsg !="") {echo $uploadMsg ;} ?>
		<form role="uploadForm" method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
				<label>Upload Image</label>
				<input type="file" name="fileToUpload" id="fileToUpload">
			</div>
			<button type="submit" class="btn btn-default"><i class='fa fa-fw fa-upload'></i> Upload File</button>
		</form>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<h2>Files</h2>
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>File Name</th>
							<th>Preview</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php
						if ($handle = opendir($target_dir)) {
						$count = 0;
							while (false !== ($file = readdir($handle))) {
								if ('.' === $file) continue;
								if ('..' === $file) continue;
								//exclude these files
								if ($file==="Thumbs.db") continue;
								if ($file===".DS_Store") continue;
								$count++;
								echo "<tr>
								<td>".$file."</td>
								<td><button type='button' class='btn btn-xs btn-default' onclick=\"window.location.href='$target_dir$file'\"><i class='fa fa-fw fa-image'></i> Preview</button></td>
								<td><button type='button' class='btn btn-xs btn-default' onclick=\"window.location.href='?delete=$target_dir$file'\"><i class='fa fa-fw fa-trash'></i> Delete</button></td>
								</tr>";
							}
							closedir($handle);
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
    <!-- /.row -->
    

<?php
include 'includes/footer.php';
?>
