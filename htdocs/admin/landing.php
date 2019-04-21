<?php
define('inc_access', TRUE);
include 'includes/header.php';

	//Upload function
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$pageMsg="";

	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		$uploadMsg = "<div class='alert alert-success'>The file ". basename( $_FILES["fileToUpload"]["name"]) ." has been uploaded.<button type='button' class='close' data-dismiss='alert'>×</button></div>";
	} else {
		$uploadMsg = "";
	}
	//update table on submit
	if (!empty($_POST)) {
		$landingUpdate = "UPDATE landing SET heading='".$_POST["landing_heading"]."', introtext='".$_POST["landing_introtext"]."', skills='".$_POST["landing_skills"]."', image='".$_POST["landing_image"]."' ";
		mysqli_query($db_conn, $landingUpdate);
		$pageMsg="<div class='alert alert-success'>The landing section has been updated.<button type='button' class='close' data-dismiss='alert' onclick=\"window.location.href='landing.php'\">×</button></div>";
	}

	$sqlLanding = mysqli_query($db_conn, "SELECT heading, introtext, skills, image FROM landing");
	$row  = mysqli_fetch_array($sqlLanding);
?>

   <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				<?php echo $rowLanding["heading"]?>
			</h1>
		</div>
	</div>
	 <div class="row">
		<div class="col-lg-8">
		<?php
		if ($uploadMsg !="") {
			echo $uploadMsg;
		}
		if ($pageMsg !="") {
			echo $pageMsg;
		}
		?>
			<form role="landingForm" method="post" action="" enctype="multipart/form-data">
				<div class="form-group">
					<label>Heading</label>
					<input class="form-control" name="landing_heading" value="<?php echo $row['heading']; ?>"  placeholder="Welcome">
				</div>
				<div class="form-group">
					<label>Intro</label>
					<input class="form-control" name="landing_introtext" value="<?php echo $row['introtext']; ?>" placeholder="John Doe">
				</div>
				<div class="form-group">
            <label>Upload File</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <div class="form-group">
            <label>Use an Existing Image</label>
            <select class="form-control" name="landing_image">
                <option value="">None</option>
                <?php
                    if ($handle = opendir($target_dir)) {
                        while (false !== ($file = readdir($handle))) {
                            if ('.' === $file) continue;
                            if ('..' === $file) continue;
                            if ($file==="Thumbs.db") continue;
                            if ($file===".DS_Store") continue;
                            if ($file==="index.html") continue;
                            if ($file===$row['image']){
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
					<label>Skills</label>
					<textarea class="form-control tinymce" name="landing_skills" rows="20"><?php echo $row['skills']; ?></textarea>
				</div>

				<button type="submit" class="btn btn-default"><i class='fa fa-fw fa-save'></i> Submit</button>
				<button type="reset" class="btn btn-default"><i class='fa fa-fw fa-refresh'></i> Reset</button>

			</form>

		</div>
	</div>

<?php
include 'includes/footer.php';
?>
