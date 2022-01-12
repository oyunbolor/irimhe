<?php
$actual_url = "?"."$_SERVER[QUERY_STRING]";
$pieces_url = explode("&", $actual_url);
$actual_url=$pieces_url[0]."&".$pieces_url[1];

$my_url .= $actual_url;

$count = (isset($_POST["count"]) && (int) $_POST["count"] > 0) ? (int) $_POST["count"] : ((isset($_GET["count"]) && (int) $_GET["count"] > 0) ? (int) $_GET["count"] : 1);
$my_count = $my_url;
$my_url .= "&count=".$count;

$page = (isset($_GET["page"]) && (int) $_GET["page"] > 0) ? (int) $_GET["page"] : 1;
$my_page = "&page=".$page;

$pieces = explode("&", $my_url);
$actual_link_temp=$pieces[0]."&".$pieces[1];
$actual_link_pieces = explode("index.php", $actual_link_temp);
$actual_link=$actual_link_pieces[1];

// $startQuery = "SELECT";
// $valueQuery = "COUNT(*) AS num_count FROM menu_info";
// $whereQuery = "WHERE  menu_link="."'$actual_link'";

// $selQuery = $startQuery . " " . $valueQuery . " " . $whereQuery;

// $rows = $db->query($selQuery);
// $sum = 0;
// if (sizeof($rows) > 0)
	// $sum = $rows[0]["num_count"];

// $maxpage = ceil($sum / $count);
if($_SESSION['irimhe_lang']==1){
	$language=1;
} else {
	$language=2;
}

$limit = $count . " OFFSET " . ($page - 1) * $count;
$startQuery = "SELECT";
$valueQuery = "title, content, DATE_FORMAT(info_date, '%Y-%m-%d') as info_date FROM tamenu_info";
$whereQuery = "WHERE language=$language AND menu_link LIKE '".$actual_link."%'";
$sortQuery = " ORDER BY info_date DESC";

$selQuery = $startQuery . " " . $valueQuery . " " . $whereQuery .  " " . $sortQuery . " LIMIT " . $limit;
$rows = $db->query($selQuery);

for ($i = 0; $i < sizeof($rows); $i++) 
{
?>
<section class="blog-section section style-four style-five">
  <div class="container">
        <div class="left-side">
          <div class="item-holder">
            <div class="content-text">
              <h3><?php echo $rows[$i]["title"]; ?></h3>
              <span><?php echo $rows[$i]["info_date"]; ?></span>
              <p><?php echo $rows[$i]["content"]; ?></p>
            </div>
          </div>
        </div>
  </div>
</section>
<?php
}
?>
<div style="clear:both"></div>
<?php
//require("pagination/inc.pagination1.php");
//pagelink1($PAGE_COUNT, $maxpage, $my_url, $page, "");
?>





