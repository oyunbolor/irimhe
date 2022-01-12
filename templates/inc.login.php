<?php
if ($error!="")
{
	show_notification("error", "Алдаа: ", $error);
}
?>
<section class="section contact">
  <!-- container start -->
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-5 ">
        <!-- address start -->
        <div class="address-block">
          <!-- Email -->
          <div class="media">
            <i class="fa fa-exclamation-circle"></i>
            <div class="media-body">
              <h3><?php echo _p("LoginTitle"); ?></h3>
              <p>
				<?php echo _p("LoginText"); ?>
              </p>
            </div>
          </div>
        </div>
        <!-- address end -->
      </div>
      <div class="col-lg-8 col-md-7">
        <div class="contact-form">
          <!-- contact form start -->
          <form action="<?php echo $my_url; ?>" class="row" method="post">
            <!-- name -->
            <div class="col-lg-6">
              <input type="text" name="username" class="form-control main" placeholder="<?php echo _p("LoginName"); ?>" required>
            </div>
            <!-- email -->
            <div class="col-lg-6">
              <input type="password" name="password" class="form-control main" placeholder="<?php echo _p("LoginPassword"); ?>" required>
            </div>
            <!-- submit button -->
			<div class="col-lg-6 text-right">
              <button class="btn btn-style-one" type="submit" name="loginbttn"><?php echo _p("LoginButton"); ?></button>
			  <button class="btn btn-style-one" type="submit" required="required"><?php echo _p("CancelButton"); ?></button>
            </div>
          </form>
          <!-- contact form end -->
        </div>
      </div>
    </div>
  </div>
  <!-- container end -->
</section>