<?php
if (isset($_GET["cat"]))
{
	$cat = (int)$_GET["cat"];
}else
{
	$cat = 1;
}
switch ($cat)
{
case 1:require("includes/home.php"); break;
case 2: require("includes/contact.php"); break;
case 3: require("includes/links.php"); break;
case 4: require("includes/news_full.php"); break;
case 5: require("includes/news_list.php"); break;
case 6: require("login.php"); break;
case 7: require("includes/search.php"); break;
case 8: require("includes/members.php"); break;
default : echo "Тийм хуудас байхгүй байна."; break;
}
?>

