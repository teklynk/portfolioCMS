<?php
define('inc_access', TRUE);
include 'includes/header.php';

		//Upload function
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$fileExt = substr(basename( $_FILES["fileToUpload"]["name"]),-4);
			if ($fileExt==".png" || $fileExt==".jpg" || $fileExt==".gif") {
				$uploadMsg = "<div class='alert alert-success' style='margin-top:12px;'>The file ". basename( $_FILES["fileToUpload"]["name"]) . " has been uploaded.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='uploads.php'\">×</button></div>";
			} else {
				unlink($target_file);
				$uploadMsg = "<div class='alert alert-danger' style='margin-top:12px;'>The file ". basename( $_FILES["fileToUpload"]["name"]) . " is not allowed.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='uploads.php'\">×</button></div>";
			}
		} else {
			$uploadMsg = "";
		}

		$deleteMsg = "";
		//Delete file
		if ($_GET["delete"] && !$_GET["confirm"]) {
			$deleteMsg="<div class='alert alert-danger'>Are you sure you want to delete ".$_GET["delete"]."? <a href='?delete=".$_GET["delete"]."&confirm=yes' class='alert-link'>Yes</a><button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='uploads.php'\">×</button></div>";
		} elseif ($_GET["delete"] && $_GET["confirm"]=="yes") {
			unlink($target_dir.$_GET["delete"]);
			$deleteMsg="<div class='alert alert-success'>".$_GET["delete"]." has been deleted.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='uploads.php'\">×</button></div>";
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
		<div class="col-lg-8">
        <?php if ($uploadMsg !="") {echo $uploadMsg ;} ?>
        <?php if ($deleteMsg !="") {echo $deleteMsg ;} ?>
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
		<div class="col-lg-8">
			<h2>Files</h2>
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>File Name</th>
							<th>Date</th>
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
								if ($file==="index.html") continue;
								$count++;
								$modDate = date('m-d-Y, H:i:s',filemtime($target_dir.$file));
								echo "<tr>
								<td>".$file."</td>
								<td>".$modDate."</td>
								<td><button type='button' class='btn btn-xs btn-default' onclick=\"showMyModal('$file', '$target_dir$file')\"><i class='fa fa-fw fa-image'></i> Preview</button></td>
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
<!--modal preview window-->
<script type="text/javascript">
	function showMyModal(myTitle, myFile) {
	   $('#myModalTitle').html(myTitle);
	   $('#myModalFile').attr("src", myFile);
	   $('#myModal').modal('show');
	}
</script>
 <div class="modal fade"  id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalTitle"></h4>
      </div>
      <div class="modal-body">
			<img id="myModalFile" src="" class="img-responsive center-block" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
include 'includes/footer.php';
?>
