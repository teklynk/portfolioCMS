Open phpmyadmin and create a database.
Go to your database and click the Import tab at the top.
Go to File to Import and browse to the bootstrapcms_empty.sql file and click GO.
Once the tables have been created, select the users table.
Click the Insert tab and enter a username and password in the Value fields and click GO. 
You can now visit http://www.yourwebsite.com/admin and login. 

You WILL need to edit some of the global variables in dbconn.php
$db_servername = "";
$db_username = "";
$db_password = "";
$db_name = "";

$image_dir = "../uploads/"; //physical path to uploads folder
$image_url = "http://".$_SERVER['HTTP_HOST']."/uploads/"; //web path to uploads folder

Enjoy!