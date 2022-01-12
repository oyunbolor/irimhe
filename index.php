<?php
require("config/inc.functions.php");
require("config/inc.session.php");
require("config/inc.language.php");
require("config/inc.cfg.php");
require("config/inc.db.php");
require("notification/inc.alerts.php");
require("templates/inc.main_head.php");

$language_name = "mn";
if ($session->get("irimhe_lang") == 1) {
	$language_name = "mn";
} else if ($session->get("irimhe_lang") == 2) {
	$language_name = "en";
}

$my_url = "index.php";

require("templates/inc.main_nav.php");
require("templates/inc.main_side.php");
?>

<!--=================================
=            Page Slider            =
==================================-->

<!-- scroll-to-top -->
<div id="back-to-top" class="back-to-top">
  <i class="fa fa-angle-up"></i>
</div>
<?php require("templates/inc.main_footer.php"); ?> 
</body>
</html>
