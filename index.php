<?php
include 'includes/header.php';
?>

		<!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <?php
	                if ($rowLanding["image"] != "") {
	                	echo "<img class='img-responsive' src='uploads/".$rowLanding["image"]."' alt=''>";
	                } else {
	                	echo "<img class='img-responsive' src='img/profile.png' alt=''>";
	                }
                ?>
                    <div class="intro-text">
                        <span class="name"><?php echo $rowLanding["introtext"];?></span>
                        <hr class="star-light">
                        <span class="skills"><?php echo $rowLanding["skills"];?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><?php echo $rowSetup["portfolioheading"];?></h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
			<?php
				while ($rowPages  = mysqli_fetch_array($sqlPages)) {
			?>
            <div class="col-sm-4 portfolio-item">
							<?php
							if ($rowPages["openmodal"] == 1){
								echo "<a href='#portfolioModal".$rowPages["id"]."' class='portfolio-link' data-toggle='modal'>";
							}else{
								echo "<a href='portfolio.php?id=".$rowPages["id"]."' class='portfolio-link'>";
							}
							?>

                    <div class="caption">
                    	<div class="caption-content">
							<?php
                            if ($rowPages["title"] != "") {
                                echo "<div class='portfolio-title'>".$rowPages["title"]."</div>";
                            }
                            ?>
                        <i class="fa fa-search-plus fa-3x"></i>
                      </div>
                  </div>
					<?php
						if ($rowPages["thumbnail"] != "") {
							echo "<img src='uploads/".$rowPages["thumbnail"]."' class='img-responsive' title='".$rowPages["title"]."' alt='".$rowPages["title"]."'>";
						} else {
							echo "<img src='img/portfolio/cake.png' class='img-responsive' title='".$rowPages["title"]."' alt='".$rowPages["title"]."'>";
						}
					?>
                </a>
            </div>
      		<?php
				}
			?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><?php echo $rowAbout["heading"];?></h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-lg-offset-0 text-center">
                	<?php echo $rowAbout["content"];?>
                </div>
            </div>
        </div>
    </section>

  	<!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><?php echo $rowContact["heading"];?></h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form name="sentMessage" id="contactForm" method="post" action="mail/contact_me.php">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" id="name" name="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Email Address" id="email" name="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" placeholder="Phone Number" id="phone" name="phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" class="form-control" placeholder="Message" id="message" name="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
						<input type="hidden" name="sendToEmail" value="<?php echo $rowContact["sendtoemail"];?>"/>
                        <br>

						<?php
							if ($_GET["msgsent"]=="thankyou") {
								echo "<div id='success'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true' onclick=\"window.location.href='index.php#contact'\">×</button><strong>Your message has been sent. </strong></div></div>";
							} else if ($_GET["msgsent"]=="error") {
								echo "<div id='success'><div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true' onclick=\"window.location.href='index.php#contact'\">×</button><strong>An error occured while sending your message. </strong></div></div>";
							}
						?>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
		<?php
		include 'includes/footer.php';
		?>
