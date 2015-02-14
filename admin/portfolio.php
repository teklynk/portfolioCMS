<?php 
include 'includes/header.php';
?>
   <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Portfolio
            </h1>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-6">
<?php
	if ($_GET["newpage"] OR $_GET["editpage"]) {
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
				$pageUpdate = "UPDATE pages SET title='".$_POST["page_title"]."',content='".$_POST["page_content"]."',thumbnail='".$_POST["page_image"]."', active=".$_POST["page_status"]." WHERE id='$thePageId'";
				mysql_query($pageUpdate);
				$pageMsg="<div class='alert alert-success'>The page ".$_POST["page_title"]." has been updated.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='portfolio.php'\">×</button></div>";
			}
			
			$sqlPages = mysql_query("SELECT id, title, thumbnail, content, active, datetime FROM pages WHERE id='$thePageId'");
			$row  = mysql_fetch_array($sqlPages);
			
		//Create new page
		} else if ($_GET["newpage"]) {
			$pageLabel = "New Page Title";
			//insert data on submit
			if (!empty($_POST["page_title"])) {
				$pageInsert = "INSERT INTO pages (title, content, thumbnail, active) VALUES ('".$_POST["page_title"]."', '".$_POST["page_content"]."', '".$_POST["page_image"]."', ".$_POST["page_status"].")";
				mysql_query($pageInsert);
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
			<span><?php if($_GET["editpage"]){echo "Created: ".$row['datetime'];} ?></span>
		</div>
		<button type="submit" class="btn btn-default"><i class='fa fa-fw fa-save'></i> Submit</button>
		<button type="reset" class="btn btn-default"><i class='fa fa-fw fa-refresh'></i> Reset</button>

	</form>

<?php
	} else {
		$deleteMsg="";
		$pageMsg="";
		if ($_GET["deletepage"]) {
			$delPageId = $_GET["deletepage"];
			//delete data on submit
			$pageDelete = "DELETE FROM pages WHERE id='$delPageId'";
			mysql_query($pageDelete);
			$deleteMsg="<div class='alert alert-success'>The page has been deleted.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='portfolio.php'\">×</button></div>";
			echo $deleteMsg;
		} 
        //update data on submit
        if (!empty($_POST["main_heading"])) {
            $setupUpdate = "UPDATE setup SET portfolioheading='".$_POST["main_heading"]."'";
            mysql_query($setupUpdate);
            $pageMsg="<div class='alert alert-success'>The heading has been updated.<button type='button' class='close' data-dismiss='alert'>×</button></div>";
        }
		
    	$sqlSetup = mysql_query("SELECT portfolioheading FROM setup");
		$rowSetup  = mysql_fetch_array($sqlSetup);
?>
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
						<th>Edit</th>
						<th>Delete</th>
            <th>Status</th>
					</tr>
				</thead>
				<tbody>
                <?php 
					$sqlPages = mysql_query("SELECT id, title, thumbnail, active FROM pages ORDER BY title");
					while ($row  = mysql_fetch_array($sqlPages)) {
						$pageId=$row['id'];
						$pageTitle=$row['title'];
						$pageTumbnail=$row['thumbnail'];
						$pageActive=$row['active'];
						if ($row['active']==0){
							$isActive="(Draft)";
						} else {
							$isActive="";
						}
						echo "<tr>
						<td>".$pageTitle."</td>
						<td><button type='button' class='btn btn-xs btn-default' onclick=\"window.location.href='?editpage=$pageId'\"><i class='fa fa-fw fa-edit'></i> Edit</button></td>
						<td><button type='button' class='btn btn-xs btn-default' onclick=\"window.location.href='?deletepage=$pageId'\"><i class='fa fa-fw fa-trash'></i> Delete</button></td>
						<td>
						<span><i>".$isActive."</i></span>
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
