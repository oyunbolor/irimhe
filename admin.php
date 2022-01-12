<?php
require("config/inc.functions.php");
require("config/inc.session.php");
require("config/inc.cfg.php");
require("config/inc.db.php");
require("notification/inc.alerts.php");
require("config/inc.language.php");

require("templates/inc.admin_head.php");


$schemas = "iremhena_irimhe_new";

if (!isset($_SESSION['irimhe_session_id']) && !isset($_SESSION['irimhe_username']) && !isset($_SESSION['irimhe_profile']))
{
		header("Location: index.php");
} else {
		$selQuery = "SELECT tu.user_id, tu.lastname, tu.profile FROM ".$schemas.".tausers tu WHERE tu.profile = ".$_SESSION['irimhe_profile']." AND tu.login_name = '".$_SESSION['irimhe_username']."' AND tu.login_session = '".$_SESSION['irimhe_session_id']."'";
		$rows = $db->Query($selQuery);
		
		if (!empty($rows)) 
		{	
			$sess_user_name = $rows[0]["lastname"];
			$sess_user_id = $rows[0]["user_id"];
			$sess_profile = $rows[0]["profile"];
?>
<body id="page-top">
  	<div id="wrapper">
        <?php
			require("templates/inc.admin_nav_side.php");
			$language_name = "mn";
			if($session->get("irimhe_lang") == 1){
				$language_name = "mn";	
			} else if($session->get("irimhe_lang") == 2){
				$language_name = "en";
			}
	    ?>
    	<!-- Content Wrapper -->
	    <div id="content-wrapper" class="d-flex flex-column">

	    <!-- Main Content -->
	    <div id="content">
	    		<?php
				require("templates/inc.admin_nav_top.php");
				
				
				?>
			<div class="container-fluid">
	     	<?php
				switch ($menuitem)
				{
					case 1:
						require("templates/inc.admin_home.php");
						break;
					case 2:
						require("tagroups/inc.admin_groups.php");
						break;
					case 3: 
						require("tausers/inc.admin_users.php");
						break;
					case 4: 
						require("tausergroups/inc.admin_usergroups.php");
						break;
					case 5: 
						require("tagrouproles/inc.admin_grouproles.php");
						break;
					case 6:  
						require("tamenu/inc.admin_menu.php");
						break;
					case 7: 
						require("tasubmenu/inc.admin_submenu.php");
						break;
					case 8: 
						require("tasub2menu/inc.admin_sub2menu.php");
						break;
					case 9: 
						require("metadata/inc.admin_metadata.php"); 
						break;
					case 10: 
						require("tanews/inc.admin_news.php");
						break;
					case 11: 
						require("home_image/inc.admin_image.php");
						break;
					
					default:
						require("templates/inc.admin_home.php");
						break;
				}
			?>
			</div>
    	</div>
    	<?php
			require("templates/inc.admin_footer.php");
		?>
	</body>
</html><?php
		}else
		{
			header("Location: index.php");
		}
}
?>
