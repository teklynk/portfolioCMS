<?php
include 'includes/header.php';
?>
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
<?php
include 'includes/footer.php';
?>
