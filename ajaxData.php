<?php
//Include database configuration file
require("config/inc.cfg.php");
require("config/inc.session.php");
require("config/inc.functions.php");
require("config/inc.db.php");

if(isset($_POST["menu_id"]) && !empty($_POST["menu_id"]))
{
	$selQuery = "SELECT * FROM tamenu_sub WHERE menu_id = ".$_POST['menu_id']."  ORDER BY sub_name ASC";
	$rows = $db->query($selQuery);
	if (!empty($rows))
	{
		echo seldatadb("sub_name", "form-control", $rows, "sub_id", "sub_name", "", "", "Дэд цэсээ сонгоно уу");
	}
	else 
	{
		echo seldatadb("sub_name", "form-control", "", "", "", "", "", "Дэд цэс байхгүй байна" );
	}
}
if(isset($_POST["sub_id"]) && !empty($_POST["sub_id"]))
{
	$selQuery = "SELECT * FROM tamenu_sub2 WHERE sub_id = ".$_POST['sub_id']."  ORDER BY sub_name2 ASC";
	$rows = $db->query($selQuery);
	if (!empty($rows))
	{
		echo seldatadb("sub_name2", "form-control", $rows, "sub2_id", "sub_name2", "", "", "Дэдийн дэд цэсээ сонгоно уу");
	}
	else 
	{
		echo seldatadb("sub_name2", "form-control", "", "", "", "", "", "Дэдийн дэд цэс байхгүй байна" );
	}
}
var_dump ($selQuery);
?>