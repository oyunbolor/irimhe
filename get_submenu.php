<?php
require("config/inc.functions.php");
require("config/inc.session.php");
require("config/inc.language.php");
require("config/inc.cfg.php");
require("config/inc.db.php");

if (isset($_POST["menuid"]))
{
	$menuid = (int) $_POST["menuid"];
}else
{
	$menuid = 0;
}

$selQuery = "SELECT tams.sub_id, tams.sub_name FROM tamenu_sub tams WHERE tams.menu_id = ".$menuid." ORDER BY tams.menu_id ASC, tams.sub_name ASC";

$rows = $db->query($selQuery);
if(!empty($rows))
{
	for ($i=0; $i < sizeof($rows); $i++) 
	{
		echo "<option value='".$rows[$i]["sub_id"]."'>".$rows[$i]["sub_name"]."</option>"; 
	}
}		
?>
