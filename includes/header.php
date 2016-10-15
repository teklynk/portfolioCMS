<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include 'db/dbsetup.php'; //contains DB connection string and global variables

		//SQL Select Statements
		$sqlSetup = mysqli_query($db_conn, "SELECT title, author, keywords, description, headercode, googleanalytics, portfolioheading FROM setup");
		$rowSetup  = mysqli_fetch_array($sqlSetup);

		$sqlLanding = mysqli_query($db_conn, "SELECT heading, introtext, skills, image FROM landing");
		$rowLanding = mysqli_fetch_array($sqlLanding);

		$sqlAbout = mysqli_query($db_conn, "SELECT heading, content FROM aboutus");
		$rowAbout = mysqli_fetch_array($sqlAbout);

		$sqlFooter = mysqli_query($db_conn, "SELECT heading, content FROM footer");
		$rowFooter = mysqli_fetch_array($sqlFooter);

		$sqlContact = mysqli_query($db_conn, "SELECT heading, email, sendtoemail, address, city, state, zipcode, phone FROM contactus");
		$rowContact = mysqli_fetch_array($sqlContact);

		$sqlSocial = mysqli_query($db_conn, "SELECT heading, facebook, twitter, linkedin, google, github FROM socialmedia");
		$rowSocial = mysqli_fetch_array($sqlSocial);

		$sqlPages = mysqli_query($db_conn,"SELECT id, title, thumbnail, content, active, openmodal, datetime FROM pages WHERE active=1 ORDER BY datetime DESC"); //uses while loop

		$sqlPagesActive = mysqli_query($db_conn,"SELECT id, title, thumbnail, content, active FROM pages WHERE active=1"); //uses while loop
	?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $rowSetup["description"];?>">
    <meta name="keywords" content="<?php echo $rowSetup["keywords"];?>">
    <meta name="author" content="<?php echo $rowSetup["author"];?>">

    <title><?php echo $rowSetup["title"];?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<?php
		//Custom CSS
		if ($customCss_url !="") {
			echo "<link href='".$customCss_url."' rel='stylesheet' type='text/css'>";
		}
		//Custom header code
		echo $rowSetup["headercode"]."\n";

		//Google Analytics tracking code
		if ($rowSetup["googleanalytics"]) {
			$googleID = $rowSetup["googleanalytics"];
	?>
		<script type="text/javascript">

			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '<?php echo $googleID ?>']);
			_gaq.push(['_trackPageview']);

			(function() {
			  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();

		</script>
	<?php
	}
	?>
</head>

<body id="page-top" class="index">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top"><?php echo $rowLanding["heading"];?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio"><?php echo $rowSetup["portfolioheading"];?></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about"><?php echo $rowAbout["heading"];?></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact"><?php echo $rowContact["heading"];?></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
