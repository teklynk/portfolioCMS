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

		$sqlPagesActive = mysqli_query($db_conn,"SELECT id, title, thumbnail, content, active, openmodal FROM pages WHERE active=1 AND id=".$_GET["id"]);
    $rowPagesActive  = mysqli_fetch_array($sqlPagesActive)
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
                <a class="navbar-brand" href="index.php#page-top"><?php echo $rowLanding["heading"];?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="index.php#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.php#portfolio"><?php echo $rowSetup["portfolioheading"];?></a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.php#about"><?php echo $rowAbout["heading"];?></a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.php#contact"><?php echo $rowContact["heading"];?></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

<!-- Portfolio Page -->
<div class="portfolio" id="portfolio<?php echo $rowPagesActive["id"];?>" >
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2" style="margin-top:100px;">
                <div class="modal-body">
                    <h2 style="text-align:center;"><?php echo $rowPagesActive["title"];?></h2>
                    <hr class="star-primary">

                    <?php
                      if ($rowPagesActive["thumbnail"] != "") {
                          echo "<img src='uploads/".$rowPagesActive["thumbnail"]."' class='img-responsive img-centered' alt=''>";
                      } else {
                          echo "<img src='img/portfolio/cake.png' class='img-responsive' alt=''>";
                      }
                    ?>
                    <?php echo $rowPagesActive["content"];?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-4">
                    <h3>Location</h3>
                    <p>
                    <?php
                      if (!empty($rowContact["address"])) {
                        echo $rowContact["address"]."<br>";
                      }
                      if (!empty($rowContact["city"])) {
                        echo $rowContact["city"].", ";
                      }
                      if (!empty($rowContact["state"])) {
                        echo $rowContact["state"]."<br>";
                      }
                      if (!empty($rowContact["phone"])) {
                        echo $rowContact["phone"]."<br>";
                      }
                      if (!empty($rowContact["email"])) {
                        echo $rowContact["email"];
                      }
                    ?>
                    </p>
                </div>
                <div class="footer-col col-md-4">
                    <h3><?php echo $rowSocial["heading"];?></h3>
                    <ul class="list-inline">

            <?php
              if (!empty($rowSocial["facebook"])){
                echo "<li><a href=".$rowSocial["facebook"]." class='btn-social btn-outline'><i class='fa fa-fw fa-facebook'></i></a></li>";
              }

              if (!empty($rowSocial["google"])){
                echo "<li><a href=".$rowSocial["google"]." class='btn-social btn-outline'><i class='fa fa-fw fa-google-plus'></i></a></li>";
              }

              if (!empty($rowSocial["github"])){
                echo "<li><a href=".$rowSocial["github"]." class='btn-social btn-outline'><i class='fa fa-fw fa-github'></i></a></li>";
              }

              if (!empty($rowSocial["twitter"])){
                echo "<li><a href=".$rowSocial["twitter"]." class='btn-social btn-outline'><i class='fa fa-fw fa-twitter'></i></a></li>";
              }

              if (!empty($rowSocial["linkedin"])){
                echo "<li><a href=".$rowSocial["linkedin"]." class='btn-social btn-outline'><i class='fa fa-fw fa-linkedin'></i></a></li>";
              }
            ?>

                    </ul>
                </div>
                <div class="footer-col col-md-4">
                    <h3><?php echo $rowFooter["heading"];?></h3>
                    <?php echo $rowFooter["content"];?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    Copyright &copy; <?php echo $_SERVER['HTTP_HOST']."&nbsp;".date("Y");?>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll visible-xs visble-sm">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/cbpanimatedheader.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/freelancer.js"></script>

</body>

</html>
<?php
//close all db connections
mysqli_close($db_conn);
die();
?>
