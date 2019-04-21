<?php
if(!defined('inc_access')) {
   die('Direct access not permitted');
}
?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
		<div class="version text-right"><small><a target="_blank" href="https://github.com/teklynk/portfolioCMS">Github</a></small></div>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
<?php
//close all db connections
	mysqli_close($db_conn);
	die();
?>
