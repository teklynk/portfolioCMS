<?php
include 'dbconn.php';

//Global Vars - Edit values for your web site. leave as is in most cases.
$image_dir = "../uploads/"; //physical path to uploads folder
$image_url = "//".$_SERVER['HTTP_HOST']."/uploads/"; //web path to uploads folder
$target_dir = $image_dir;

//Custom CSS file paths
$customCss_dir = '../css/custom.css'; //physical path to custom css file
$customCss_url = "//".$_SERVER['HTTP_HOST']."/css/custom.css"; //web path to custom css file

//establish db connection
$db_conn = mysql_connect($db_servername, $db_username, $db_password);
mysql_select_db($db_name, $db_conn);

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
