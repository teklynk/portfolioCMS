<?php
if(!defined('inc_access')) {
   die('Direct access not permitted');
}
session_start();
//DB connection string and Global variable
include '../db/dbsetup.php';

//IP Range is set in config
if ($IPrange <> '') {
	if (!strstr($_SERVER['REMOTE_ADDR'], $IPrange) ){
		die('Permission denied'); //Do not execute any more code on the page
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="900; url=index.php" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bootstrap admin panel 2/2/2015">
    <meta name="author" content="Ryan Jones">

    <title>Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  <?php
	$sqlSetup = mysqli_query($db_conn, "SELECT tinymce, portfolioheading FROM setup");
	$rowSetup  = mysqli_fetch_array($sqlSetup);

	$sqlLanding = mysqli_query($db_conn, "SELECT heading FROM landing");
	$rowLanding  = mysqli_fetch_array($sqlLanding);

	$sqlAbout = mysqli_query($db_conn, "SELECT heading FROM aboutus");
	$rowAbout  = mysqli_fetch_array($sqlAbout);

	$sqlContact = mysqli_query($db_conn, "SELECT heading FROM contactus");
	$rowContact  = mysqli_fetch_array($sqlContact);

	$sqlFooter = mysqli_query($db_conn, "SELECT heading FROM footer");
	$rowFooter  = mysqli_fetch_array($sqlFooter);

	$sqlSocial = mysqli_query($db_conn, "SELECT heading FROM socialmedia");
	$rowSocial  = mysqli_fetch_array($sqlSocial);

	if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"]) && $rowSetup["tinymce"]==1) {
	?>
	  <script type="text/javascript" language="javascript"  src="js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector: "textarea.tinymce",
        theme: 'modern',
		    plugins: "link image table code",
		    image_dimensions: false,
        object_resizing: false,
		    document_base_url: '$image_url',
		    resize: "both",
		    image_list: [
		   	<?php
				if ($handle = opendir($image_dir)) {
					while (false !== ($imgfile = readdir($handle))) {
						if ('.' === $imgfile) continue;
						if ('..' === $imgfile) continue;
						if ($imgfile==="Thumbs.db") continue;
						if ($imgfile===".DS_Store") continue;
						if ($imgfile==="index.html") continue;

						echo "{title: '".$imgfile."', value: '".$image_url.$imgfile."'},";
					}
					closedir($handle);
				}
		    ?>
    		],
    		menu: {//insert menu options here
  			},
 				toolbar: 'insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image table | code'
			});
		</script>
	<?php
	}
	?>
</head>
<body>

    <div id="wrapper">
<?php
if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"])) {
?>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="setup.php">Admin Panel</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  <?php echo $_SESSION["user_name"]?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../index.php" target="_blank"><i class="fa fa-fw fa-home"></i> View My Site</a>
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
             </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="setup.php"><i class="fa fa-fw fa-gear"></i> Setup</a>
                    </li>
                    <li>
                        <a href="landing.php"><i class="fa fa-fw fa-rocket"></i> <?php echo $rowLanding["heading"]?></a>
                    </li>
                    <li>
                        <a href="portfolio.php"><i class="fa fa-fw fa-table"></i> <?php echo $rowSetup["portfolioheading"]?></a>
                    </li>
                    <li>
                        <a href="aboutus.php"><i class="fa fa-fw fa-edit"></i> <?php echo $rowAbout["heading"]?></a>
                    </li>
                    <li>
                        <a href="contactus.php"><i class="fa fa-fw fa-edit"></i> <?php echo $rowContact["heading"]?></a>
                    </li>
                    <li>
                        <a href="footer.php"><i class="fa fa-fw fa-edit"></i> <?php echo $rowFooter["heading"]?></a>
                    </li>
                    <li>
                        <a href="socialmedia.php"><i class="fa fa-fw fa-facebook-square"></i> <?php echo $rowSocial["heading"]?></a>
                    </li>
                    <li>
                        <a href="uploads.php"><i class="fa fa-fw fa-folder"></i> Uploads</a>
                    </li>
                    <li>
                        <a href="editor.php"><i class="fa fa-fw fa-css3"></i> Styles</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
<?php
}
?>
        <div id="page-wrapper">
            <div class="container-fluid">
