<?php
require("config/inc.cfg.php");
require("config/inc.db.php");

$schemas = "scflora";

if (isset($_POST["phylumcode"]))
{
	$phylumcode = (int) $_POST["phylumcode"];
}else
{
	$phylumcode= 0;
}

$class_code = "";

$selQuery="SELECT tacn.class_code, tacn.class_name_mn||' - '||tacn.class_name as class_name FROM ".$schemas.".taclassname tacn, ".$schemas.".taphylumname tapn WHERE tacn.phylum_code = tapn.phylum_code AND tapn.phylum_code = ".$phylumcode." ORDER BY tacn.class_code";
//echo $selQuery;
$rows = $db->query($selQuery);

if(!empty($rows))
{

	for ($i=0; $i < sizeof($rows); $i++)
	{
		$class_code .= "<option value='".$rows[$i]["class_code"]."'>".$rows[$i]["class_name"]."</option>"; 
	}
	echo json_encode(array("class_code"=>$class_code));	
}
?>