<?php
//fill these out for your mysql server setup
$db_servername = "";
$db_username = "";
$db_password = "";
$db_name = "";

//Global Vars - Edit values for your web site
$image_dir = "../uploads/"; //physical path to uploads folder
$image_url = "http://".$_SERVER['HTTP_HOST']."/uploads/"; //web path to uploads folder
$target_dir = $image_dir;

//establish db connection 
$db_conn = mysql_connect($db_servername, $db_username, $db_password);
mysql_select_db($db_name, $db_conn);

//connection is closed in includes/footer.php
?>