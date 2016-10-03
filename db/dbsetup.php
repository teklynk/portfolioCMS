<?php
include 'dbconn.php';

//Global Vars - Edit values for your web site. leave as is in most cases.
$image_dir = "../uploads/"; //physical path to uploads folder
$image_url = "//".$_SERVER['HTTP_HOST']."/portfolioCMS/uploads/"; //web path to uploads folder
$target_dir = $image_dir;

//Custom CSS file paths
$customCss_dir = '../css/custom.css'; //physical path to custom css file
$customCss_url = "//".$_SERVER['HTTP_HOST']."/portfolioCMS/css/custom.css"; //web path to custom css file

//establish db connection
$db_conn = mysqli_connect($db_servername, $db_username, $db_password);
mysqli_select_db($db_conn, $db_name);

if (mysqli_connect_errno()) {
     die(mysqli_connect_error());
}

//db connection is closed in includes/footer.php

//Error handling . Add debug=true to the querystring
if (isset($_GET["debug"])) {
	error_reporting(E_ALL | E_WARNING | E_NOTICE | E_STRICT | E_DEPRECATED);
	ini_set('display_errors', TRUE);
  error_reporting(1);
} else {
  error_reporting(E_ALL | E_WARNING | E_NOTICE | E_STRICT | E_DEPRECATED);
  ini_set('display_errors', FALSE);
  error_reporting(0);
}
?>
