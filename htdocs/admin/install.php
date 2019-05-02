<?php
define('inc_access', TRUE);
require_once('includes/header.php');

unset($_SESSION["user_id"]);
unset($_SESSION["user_name"]);

// Name of the dbconn file
$dbFileLoc = __DIR__ . "/../db/dbconn.php";
// Name of the sql dump file
$sqlfilename = __DIR__ . "/../db/bootstrapcms.sql";

if (!file_exists($dbFileLoc)) {
    echo "$dbFileLoc does not exist <br/>";
    if (!is_writable($dbFileLoc)) {
        echo "$dbFileLoc is not writable<br/>";
    }
}
if (!file_exists($sqlfilename)) {
    echo "$sqlfilename does not exist<br/>";
    if (!is_readable($sqlfilename)) {
        echo "$sqlfilename unable to read file<br/>";
    }
}

if (!empty($_POST)) {
    // MySQL host
    $mysql_host = mysqli_escape_string($db_conn, $_POST["dbserver"]);
    // MySQL username
    $mysql_username = mysqli_escape_string($db_conn, $_POST["dbusername"]);
    // MySQL password
    $mysql_password = mysqli_escape_string($db_conn, $_POST["dbpassword"]);
    // Database name
    $mysql_database = mysqli_escape_string($db_conn, $_POST["dbname"]);
    // CMS username
    $cms_username = mysqli_escape_string($db_conn, $_POST["username"]);
    // CMS password
    $cms_password = mysqli_escape_string($db_conn, $_POST["password"]);

    //establish db connection
    $db_conn = mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysqli_error($db_conn));
    mysqli_select_db($db_conn, $mysql_database) or die('Error selecting MySQL database: ' . mysqli_error($db_conn));

    // Temporary variable, used to store current query
    $templine = '';
    // Read in entire file
    $lines = file($sqlfilename);

    // Loop through each line
    foreach ($lines as $line) {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Add this line to the current segment
        $templine .= $line;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';') {
            // Perform the query
            mysqli_query($db_conn, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($db_conn) . '<br /><br />');
            // Reset temp variable to empty
            $templine = '';
        }
    }

    $userInsert = "INSERT INTO users (username, password) VALUES ('" . $cms_username . "', password('" . $cms_password . "');)";
    mysqli_query($db_conn, $userInsert);

    //TODO: write connection info to dbconn.php. include dbconn.php in dbsetup.php which contains global variables. use dbsetup.php in the header instead of dbconn.php.
    $dbfile = fopen($dbFileLoc, "w") or die("Unable to open file!");

    $writeline = "<?php\n";
    fwrite($dbfile, $writeline);
    $writeline = "\$db_servername = '" . $_POST['dbserver'] . "';\n";
    fwrite($dbfile, $writeline);
    $writeline = "\$db_username = '" . $_POST['dbusername'] . "';\n";
    fwrite($dbfile, $writeline);
    $writeline = "\$db_password = '" . $_POST['dbpassword'] . "';\n";
    fwrite($dbfile, $writeline);
    $writeline = "\$db_name = '" . $_POST['dbname'] . "';\n";
    fwrite($dbfile, $writeline);
    $writeline = "?>";
    fwrite($dbfile, $writeline);

    fclose($dbfile);

    rename("install.php", "~install.old"); //rename install page so that it can not be accessed after the initial install
    echo "<script>window.location.href='index.php';</script>"; //redirect to login page

}//the big IF
?>
<style>
    html, body {
        margin-top: 0px !important;
        background-color: #fff !important;
    }

    .navbar-inverse {
        display: none !important;
    }

    #wrapper {
        padding-left: 0px !important;
    }

    .form-signin {
        max-width: 350px;
        padding: 15px;
        margin: 0 auto;
    }
</style>

<div class="container">
    <div class="row">
        <form name="frmUser" class="form-signin" method="post" action="">
            <h2 class="form-signin-heading">Database info</h2>
            <label for="dbserver" class="sr-only">DB Server</label>
            <input class="form-control" type="text" name="dbserver" placeholder="DB Server" required>
            <label for="dbusername" class="sr-only">DB Username</label>
            <input class="form-control" type="text" name="dbusername" placeholder="DB Username" required>
            <label for="dbpassword" class="sr-only">DBPassword</label>
            <input class="form-control" type="text" name="dbpassword" placeholder="DB Password" required>
            <label for="dbname" class="sr-only">DB Name</label>
            <input class="form-control" type="text" name="dbname" placeholder="DB Name" required>
            <h2 class="form-signin-heading">Create an Admin user</h2>
            <label for="username" class="sr-only">Username</label>
            <input class="form-control" type="text" name="username" placeholder="Username" required>
            <label for="password" class="sr-only">Password</label>
            <input class="form-control" type="text" name="password" placeholder="Password" required>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
        </form>
    </div>
</div>
<?php
require_once('includes/footer.php');
?>
