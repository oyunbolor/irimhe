<?php
require("config/inc.functions.php");
require("config/inc.session.php");
require("config/inc.language.php");
require("config/inc.cfg.php");
require("config/inc.db.php");


if (isset($_POST["subid"]))
{
	$subid = (int) $_POST["subid"];
}else
{
	$subid= 0;
}

$subname2 = "";
	
$selQuery2="SELECT tam2.sub_id, tam2.sub_name2 FROM tamenu_sub2 tam2 WHERE tam2.sub_id = ".$subid." ORDER BY tam2.sub_id ASC, tam2.sub_name2 ASC";

$rows2 = $db->query($selQuery2);

if(!empty($rows2))
{	
	for ($i=0; $i < sizeof($rows2); $i++)
	{
		$subname2 .= "<option value='".$rows2[$i]["sub_id"]."'>".$rows2[$i]["sub_name2"]."</option>"; 
	}
	 
	echo json_encode(array("sub_name2"=>$subname2));				
}
?>