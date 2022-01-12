<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo _p("SITE_NAME"); ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="files/plugins/bootstrap/bootstrap.min.css">
  <!-- Slick Carousel -->
<link rel="stylesheet" href="files/plugins/slick/slick.css">
<link rel="stylesheet" href="files/plugins/slick/slick-theme.css">
<!-- FancyBox -->
<link rel="stylesheet" href="files/plugins/fancybox/jquery.fancybox.min.css">
<!-- fontawesome -->
<link rel="stylesheet" href="files/plugins/fontawesome/css/all.min.css">
<!-- animate.css -->
<link rel="stylesheet" href="files/plugins/animation/animate.min.css">
<!-- jquery-ui -->
<link rel="stylesheet" href="files/plugins/jquery-ui/jquery-ui.css">
<!-- timePicker -->
<link rel="stylesheet" href="files/plugins/timePicker/timePicker.css">

<!-- Stylesheets -->
<link href="files/css/style.css" rel="stylesheet">

<div class="header-top">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="top-left text-center text-md-left">
         
        </div>
      </div>
      <div class="col-md-6">
        <div class="top-right text-center text-md-right">
          <ul class="social-links">
            <li>
              <a href="../../../themefisher.com/index.html" aria-label="facebook">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li>
              <a href="../../../themefisher.com/index.html" aria-label="google-plus">
                <i class="fab fa-google-plus-g"></i>
              </a>
            </li> 
			<li>
              <a href="phone_login.php" aria-label="twitter">
                <i class="fa fa-phone"></i>
              </a>
            </li>
            <li>
              <a href="index.php?cat=6" aria-label="pinterest">
                <i class="fa fa-user"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<div class=" ">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-xl-2 col-lg-2">
        <div class="logo">
          <a href="index.php">
            <img loading="lazy" class="img-fluid" src="images/irimhe_logo.png" alt="logo" style="width: 70%">
			
          </a>
        </div>
      </div>
      <div class="col-xl-10 col-lg-9">
        <div class="right-side" style="display: flex; align-items: center; justify-content: space-between;">
		
			<?php
			if($_SESSION['irimhe_lang']==1){
				$language=1;
			 ?>
          <div class="contact-info" style="margin-bottom: 0">
           
			<h3>Ус цаг уур, орчны судалгаа, мэдээллийн хүрээлэн</h3>
          </div>
		  <?php
			}else {
				$language=2;
		  
			?>
			<div class="contact-info" style="margin-bottom: 0">
            <img loading="lazy" class="img-fluid" src="images/irimhe_logo_us.png" alt="logo" style="width: 100%">
          </div>
		  <?php
			}
		  ?>
          <div class="link-btn text-center text-lg-right">
				<div class="top-right text-center text-md-right">
				  <ul class="social-links" style="display: flex; align-items: center;width: 100px;">
					<li>
					  <a href="get_language.php?irimhe_lang=2">
						<img loading="lazy" class="img-fluid" src="images/en.png" alt="en">
					  </a>
					</li>
					<li>
					  <a href="get_language.php?irimhe_lang=1">
						<img loading="lazy" class="img-fluid" src="images/mn.png" alt="mn">
					  </a>
					</li>
				  </ul>
				</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--header top-->

</head>