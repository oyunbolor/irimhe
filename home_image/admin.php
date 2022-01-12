<?php
require("config/inc.cfg.php");
require("config/inc.session.php");
require("config/inc.functions.php");
require("config/inc.db.php");
require("notification/inc.alerts.php");

if (!isset($_SESSION['session_id']) && !isset($_SESSION['username']))
{
	header("Location: index.php?cat=6");

} else {
	$selQuery = "SELECT us.user_id, us.username, us.profile, us.lastname  FROM user us WHERE us.profile = '".$_SESSION['profile']."' AND us.username = '".$_SESSION['username']."' AND us.login_session = '".$_SESSION['session_id']."'";
	$rows = $db->query($selQuery);
	
	if (!empty($rows)) 
	{	
		$sess_user_id = $rows[0]["user_id"];
		$sess_profile = $rows[0]["profile"];
		$sess_user_name = $rows[0]["lastname"];

		$checkQuery = "SELECT us.user_id FROM user us WHERE us.user_id = ".$sess_user_id."" ; 
		$checkrows = $db->query($checkQuery);
		require("templates/inc.admin_head.php");
		
?>
<body class="nav-md">
<div class="container body">
  <div class="main_container">
    <?php
		require("templates/inc.admin_left.php");
		?>
    <!-- top navigation -->
    <?php
		require("templates/inc.admin_nav.php");
		?>
    <!-- /top navigation --> 
    
    <!-- page content -->
    <div class="right_col" role="main">
	<?php
	
		switch ($menuitem)
		{
			case 1:
				require("templates/inc.dashboard.php");
				break;
			case 2:  
				require("tamenu/inc.admin_menu.php");
				break;
			case 3: 
				require("tamenu/inc.admin_submenu.php");
				break;
			case 4: 
				require("tamenu/inc.admin_sub2menu.php");
				break;
			case 5: 
				require("metadata/inc.admin_metadata.php");
				break;
			case 6: 
				require("tanews/inc.admin_news.php");
				break;
			case 7:
				require("tausers/inc.admin_user.php");
				break;
			case 8: 
				require("tagroups/inc.admin_group.php");
				break;
			case 9: 
				require("tausergroups/inc.admin_usergroups.php");
				break;
			case 10: 
				require("tagrouproles/inc.admin_grouproles.php");
				break;
			case 11: 
				require("home_image/inc.admin_image.php");
				break;
		}
	?>
    </div>
    <!-- /page content -->
<?php
		require("templates/inc.admin_footer.php");
	?>
</body>
</html>
<?php
	}else
	{
		header("Location: index.php?cat=6");
	}
}
?>