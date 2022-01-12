<?php
require("modules/mysql.class.php");
$db = new mysql();
$db->mysql_connect($_MY_CONF["DATABASE_HOST"], $_MY_CONF["DATABASE_USER"], $_MY_CONF["DATABASE_PASS"], $_MY_CONF["DATABASE_NAME"],"");
//var_dump($db);
?>
