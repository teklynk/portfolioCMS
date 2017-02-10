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
<?php
while ($rowPagesActive  = mysqli_fetch_array($sqlPagesActive)) {
?>
<!-- Portfolio Modals -->
<div class="portfolio-modal modal fade" id="portfolioModal<?php echo $rowPagesActive["id"];?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">

                        <h2><?php echo $rowPagesActive["title"];?></h2>
                        <hr class="star-primary">
          <?php
                          if ($rowPagesActive["thumbnail"] != "") {
                              echo "<img src='uploads/".$rowPagesActive["thumbnail"]."' class='img-responsive img-centered' alt=''>";
                          } else {
                              echo "<img src='img/portfolio/cake.png' class='img-responsive' alt=''>";
                          }
                        ?>
                        <?php echo $rowPagesActive["content"];?>

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
?>
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
