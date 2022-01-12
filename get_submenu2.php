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
	$menuid= 0;
}

$subname = "";
$subname2 = "";
	
$selQuery2="SELECT tams.sub_id, tams.sub_name FROM tamenu_sub tams WHERE tams.menu_id = ".$menuid." ORDER BY tams.menu_id ASC, tams.sub_name ASC ";

$rows2 = $db->query($selQuery2);

if(!empty($rows2))
{	
	for ($i=0; $i < sizeof($rows2); $i++)
	{
		$subname .= "<option value='".$rows2[$i]["sub_id"]."'>".$rows2[$i]["sub_name"]."</option>"; 
	}
	$subid = $rows2[0]["sub_id"];
	 

	$selQuery3="SELECT tam2.sub_id, tam2.sub_name2 FROM tamenu_sub2 tam2 WHERE tam2.sub_id = ".$subid." ORDER BY tam2.sub_id ASC, tam2.sub_name2 ASC";

	$rows3 = $db->query($selQuery3);
	
	if(!empty($rows3))
	{	
		for ($i=0; $i < sizeof($rows3); $i++)
		{
			$subname2 .= "<option value='".$rows3[$i]["sub_id"]."'>".$rows3[$i]["sub_name2"]."</option>"; 
		}
	}
	echo json_encode(array("sub_name"=>$subname,"sub_name2"=>$subname2));				
}
?>