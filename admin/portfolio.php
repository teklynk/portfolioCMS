<?php
define('inc_access', TRUE);
include 'includes/header.php';
//Page preview
if ($_GET["preview"]>""){
	$pagePreviewId=$_GET["preview"];
	$sqlPagePreview = mysqli_query($db_conn, "SELECT id, content FROM pages WHERE id='$pagePreviewId'");
	$row  = mysqli_fetch_array($sqlPagePreview);
		echo "<style type='text/css'>html, body {margin-top:0px !important;} nav {display:none !important;} .row {display:none !important;} #wrapper {padding-left: 0px !important;}</style>";
		echo $row['content'];
}
?>
   <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $rowSetup["portfolioheading"]?>
            </h1>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-8">
<?php

	if ($_GET["newpage"] || $_GET["editpage"]) {
		//Upload function
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$pageMsg="";

		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$uploadMsg = "<div class='alert alert-success'>The file ". basename( $_FILES["fileToUpload"]["name"]) ." has been uploaded.<button type='button' class='close' data-dismiss='alert'>×</button></div>";
		} else {
			$uploadMsg = "";
		}

		//Update existing page
		if ($_GET["editpage"]) {
			$thePageId = $_GET["editpage"];
			$pageLabel = "Edit Page Title";

			//update data on submit
			if (!empty($_POST["page_title"])) {
				$pageUpdate = "UPDATE pages SET title='".$_POST["page_title"]."',content='".$_POST["page_content"]."',thumbnail='".$_POST["page_image"]."',active=".$_POST["page_status"].",datetime='".date("Y-m-d H:i:s")."' WHERE id='$thePageId'";
				mysqli_query($db_conn, $pageUpdate);
				$pageMsg="<div class='alert alert-success'>The page ".$_POST["page_title"]." has been updated.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='portfolio.php'\">×</button></div>";
			}

			$sqlPages = mysqli_query($db_conn, "SELECT id, title, thumbnail, content, active, datetime FROM pages WHERE id='$thePageId'");
			$row  = mysqli_fetch_array($sqlPages);

		//Create new page
		} else if ($_GET["newpage"]) {
			$pageLabel = "New Page Title";
			//insert data on submit
			if (!empty($_POST["page_title"])) {
				$pageInsert = "INSERT INTO pages (title, content, thumbnail, active) VALUES ('".$_POST["page_title"]."', '".$_POST["page_content"]."', '".$_POST["page_image"]."', ".$_POST["page_status"].")";
				mysqli_query($db_conn, $pageInsert);
				$pageMsg="<div class='alert alert-success'>The page ".$_POST["page_title"]." has been added.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='portfolio.php'\">×</button></div>";
			}
		}


		//alert messages
		if ($uploadMsg !="") {
			echo $uploadMsg;
		}

		if ($pageMsg !="") {
			echo $pageMsg;
		}

		if ($_GET["editpage"]){
			//active status
			if ($row['active']==1) {
				$selActive1="SELECTED";
				$selActive0="";
			} else {
				$selActive0="SELECTED";
				$selActive1="";
			}
		}
?>
	<form role="pageForm" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="page_status">
                <option value="1" <?php if($_GET["editpage"]){echo $selActive1;}?>>Active</option>
                <option value="0" <?php if($_GET["editpage"]){echo $selActive0;} ?>>Draft</option>
            </select>
        </div>
		<div class="form-group">
			<label><?php echo $pageLabel; ?></label>
			<input class="form-control" name="page_title" value="<?php if($_GET["editpage"]){echo $row['title'];} ?>" placeholder="Page Title">
		</div>
        <div class="form-group">
            <label>Upload File</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
		<div class="form-group">
			<label>Use an Existing Image</label>
			<select class="form-control" name="page_image">
				<option value="">None</option>
				<?php
					if ($handle = opendir($target_dir)) {
						while (false !== ($file = readdir($handle))) {
							if ('.' === $file) continue;
							if ('..' === $file) continue;
							if ($file==="Thumbs.db") continue;
							if ($file===".DS_Store") continue;
							if ($file==="index.html") continue;
							if ($file===$row['thumbnail']){
								$imageCheck="SELECTED";
							} else {
								$imageCheck="";
							}
							echo "<option value=".$file." $imageCheck>".$file."</option>";
						}
						closedir($handle);
					}
				?>
			</select>
		</div>

		<div class="form-group">
			<label>HTML / Text</label>
			<textarea class="form-control tinymce" rows="20" name="page_content"><?php if($_GET["editpage"]){echo $row['content'];} ?></textarea>
		</div>
        <div class="form-group">
			<span><?php if($_GET["editpage"]){echo "Updated: ".date('m-d-Y, H:i:s',strtotime($row['datetime']));} ?></span>
		</div>
		<button type="submit" class="btn btn-default"><i class='fa fa-fw fa-save'></i> Submit</button>
		<button type="reset" class="btn btn-default"><i class='fa fa-fw fa-refresh'></i> Reset</button>

	</form>

<?php
	} else {
		$deleteMsg="";
		$deleteConfirm="";
		$pageMsg="";
		$delPageId = $_GET["deletepage"];
		$delPageTitle = $_GET["deletetitle"];
		$movePageId = $_GET["movepage"];
		$movePageTitle = $_GET["movetitle"];

		//delete page
		if ($_GET["deletepage"] && $_GET["deletetitle"] && !$_GET["confirm"]) {
			$deleteMsg="<div class='alert alert-danger'>Are you sure you want to delete ".$delPageTitle."? <a href='?deletepage=".$delPageId."&deletetitle=".$delPageTitle."&confirm=yes' class='alert-link'>Yes</a><button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='portfolio.php'\">×</button></div>";
			echo $deleteMsg;
		} elseif ($_GET["deletepage"] && $_GET["deletetitle"] && $_GET["confirm"]=="yes") {
			//delete page after clicking Yes
			$pageDelete = "DELETE FROM pages WHERE id='$delPageId'";
			mysqli_query($db_conn, $pageDelete);
			$deleteMsg="<div class='alert alert-success'>".$delPageTitle." has been deleted.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='portfolio.php'\">×</button></div>";
			echo $deleteMsg;
		}

		//move pages to top of list
    if (($_GET["movepage"] && $_GET["movetitle"])) {
        $pagesDateUpdate = "UPDATE pages SET datetime='".date("Y-m-d H:i:s")."' WHERE id='$movePageId'";
        mysqli_query($db_conn, $pagesDateUpdate);
        $pageMsg="<div class='alert alert-success'>".$movePageTitle." has been moved to the top.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='portfolio.php'\">×</button></div>";
    }

    //update heading on submit
    if (!empty($_POST["main_heading"])) {
        $setupUpdate = "UPDATE setup SET portfolioheading='".$_POST["main_heading"]."'";
        mysqli_query($db_conn, $setupUpdate);
        $pageMsg="<div class='alert alert-success'>The heading has been updated.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='portfolio.php'\">×</button></div>";
    }

    $sqlSetup = mysqli_query($db_conn, "SELECT portfolioheading FROM setup");
		$rowSetup  = mysqli_fetch_array($sqlSetup);
?>
<!--modal preview window-->
<script type="text/javascript">
	function showMyModal(myTitle, myFile) {
	   $('#myModalTitle').html(myTitle);
	   $('#myModalFile').attr("src", myFile);
	   $('#webpageDialog').modal('show');
	}
</script>
<style>
#webpageDialog iframe {
	width: 100%;
	height: 600px;
	frameborder: 0;
	border: none;
}
.modal-dialog {
	width:95%;
}
</style>


 <div class="modal fade" id="webpageDialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalTitle"></h4>
      </div>
      <div class="modal-body">
			<iframe id="myModalFile" src="" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

	<button type="button" class="btn btn-default" onclick="window.location='?newpage=true';"><i class='fa fa-fw fa-paper-plane'></i> Create a New Page</button>
		<h2>Pages</h2>
		<div class="table-responsive">
    <?php
		if ($pageMsg !="") {
			echo $pageMsg;
		}
		?>
			<form role="portfolioForm" method="post" action="">
            <div class="form-group">
                <label>Heading</label>
                <input class="form-control" name="main_heading" value="<?php echo $rowSetup['portfolioheading']; ?>" placeholder="My Portfolio">
            </div>
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>Page Title</th>
						<th>Preview</th>
						<th>Edit</th>
						<th>Delete</th>
						<th>Move</th>
            <th>Status</th>
					</tr>
				</thead>
				<tbody>
        <?php
					$sqlPages = mysqli_query($db_conn, "SELECT id, title, thumbnail, content, active FROM pages ORDER BY datetime DESC");
					while ($row  = mysqli_fetch_array($sqlPages)) {
						$pageId=$row['id'];
						$pageTitle=$row['title'];
						$pageTumbnail=$row['thumbnail'];
						$pageContent=$row['content'];
						$pageActive=$row['active'];
						if ($row['active']==0){
							$isActive="<i style='color:red;'>(Draft)</i>";
						} else {
							$isActive="";
						}
						echo "<tr>
						<td>".$pageTitle."</td>
						<td><button type='button' class='btn btn-xs btn-default' onclick=\"showMyModal('$pageTitle', '?preview=$pageId')\"><i class='fa fa-fw fa-edit'></i> Preview</button></td>
						<td><button type='button' class='btn btn-xs btn-default' onclick=\"window.location.href='?editpage=$pageId'\"><i class='fa fa-fw fa-edit'></i> Edit</button></td>
						<td><button type='button' class='btn btn-xs btn-default' onclick=\"window.location.href='?deletepage=$pageId&deletetitle=$pageTitle'\"><i class='fa fa-fw fa-trash'></i> Delete</button></td>
						<td><button type='button' class='btn btn-xs btn-default' onclick=\"window.location.href='?movepage=$pageId&movetitle=$pageTitle'\"><i class='fa fa-fw fa-arrow-up'></i> Move</button></td>
						<td>
						<span>".$isActive."</span>
						</td>
						</tr>";
					}
				?>
				</tbody>
			</table>
            <button type="submit" class="btn btn-default"><i class='fa fa-fw fa-save'></i> Submit</button>
			<button type="reset" class="btn btn-default"><i class='fa fa-fw fa-refresh'></i> Reset</button>
			</form>
		</div>
<?php
	}
?>
		</div>
	</div>
	<p></p>

<?php
include 'includes/footer.php';
?>
