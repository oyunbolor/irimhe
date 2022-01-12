<?php

if (isset($_POST["searchsubmenubttn"]))
{
	$searchQuery = "";
	$search_url = "";
	$search_menu_id = (isset($_POST["search_menu_id"])) ? (int) $_POST["search_menu_id"] : 0;

	if($search_menu_id==0)
	{
		$searchQuery .= "";
		$search_url .= "";
	} else
	{
		$searchQuery .= " AND tams.menu_id = ".$search_menu_id;
		$search_url .= "&search_menu_id=".$search_menu_id;
		
	}
	$search_submenu_name = (isset($_POST["search_submenu_name"])) ? (pg_prep($_POST["search_submenu_name"])) : "";
	
	if ($search_submenu_name == "") 
	{
		$searchQuery .= "";
		$search_url .= "";
	} else 
	{
		$searchQuery .= " AND lower(tams.sub_name) LIKE lower('%".$search_submenu_name."%')";
		$search_url .= "&search_submenu_name=".$search_submenu_name;
	}
	
	$search_menu_name_en = (isset($_POST["search_menu_name_en"])) ? pg_prep($_POST["search_menu_name_en"]) : "";
	if(empty($search_menu_name_en))
	{
		$searchQuery .= "";
		$search_url .= "";
	}else
	{
		$searchQuery .= " AND lower(tams.sub_name_en) LIKE lower('%".$search_menu_name_en."%')";
		$search_url .= "&search_menu_name_en=".$search_menu_name_en;
	}
	
}

$sortQuery = " ORDER BY ";

if (isset($_GET["sort"])) 
{
	if ($_GET["sort"]==2)
	{
		$sortQuery .= " tamm.menu_name_en";
	}elseif ($_GET["sort"]==3)
	{
		$sortQuery .= " tams.sub_name";
	}elseif ($_GET["sort"]==4)
	{
		$sortQuery .= " tams.sub_name_en";
	}elseif ($_GET["sort"]==5)
		$sortQuery .= " tams.sub_link";
	else {
    	$sortQuery .= " tamm.menu_name";
	}
} else {
	$sortQuery .= " tamm.menu_id";
}

if (isset($_GET["sorttype"]))
{
	if ($_GET["sorttype"]==2)
	{
		$sorttype = 1;
		$sortQuery .= " ASC";
	}else
	{
		$sorttype = 2;
		$sortQuery .= " DESC";
	}
}else
{
	$sorttype = 1;
	$sortQuery .= " DESC";
}

if(isset($_GET["sort"]) && isset($_GET["sorttype"]))
{
	$sort_url = "";
	$sort = (isset($_GET["sort"])) ? (int) $_GET["sort"] : 0;
	$sort_type = (isset($_GET["sorttype"])) ? (int) $_GET["sorttype"] : 0;

	if($sort==0)
		$sort_url .= "";
	else
		$sort_url .= "&sort=".$sort;
	
	if($sort_type==0)
		$sort_url .= "";
	else
		$sort_url .= "&sorttype=".$sort_type; 
}

$startQuery = "SELECT";
$valueQuery = "tams.* FROM ".$schemas.".tamenu_sub tams, tamenu_main tamm";
$whereQuery = "WHERE tams.menu_id=tamm.menu_id";

$selQuery = $startQuery." ".$valueQuery." ".$whereQuery." ".$searchQuery;

$rows = $db->query($selQuery);

$sum = sizeof($rows);
$maxpage = ceil( $sum / $count);

require("tasubmenu/inc.search_submenu.php");

$notifytitle =_p("TotalRowsText1")." ".$sum." "._p("TotalRowsText2");
show_notification("info", $notifytitle, "");
?>
<div class="table-responsive">
  <table id="finance_datatables_all" class="table table-bordered table-hover" title_name="<?php echo _p("AddMenuTitle"); ?>" file_name="SubMenu" column_name="0, 1, 2, 3, 4" language_name="<?php echo $language_name;?>" page_count="<?php echo $count;?>">
    <thead>
	 <tr>
        <th colspan="6"><form class="form-inline float-right" action="<?php echo $my_count.$search_url.$sort_url; ?>" method="post" name="changeform" id="changeform">
		  <label class="mr-2"><?php echo _p("ShowRowsText");?></label>
		  <?php echo seldata("count", "form-control", $RECORD_COUNTS, $count, ""); ?>
        </form></th>
      </tr>
      <tr>
        <th>№</th>
        <th><a href="<?php echo $my_url."&sort=1&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("MenuColumn1"); ?></a></th>
        <th><a href="<?php echo $my_url."&sort=2&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("SubMenuColumn1"); ?></a></th>
        <th><a href="<?php echo $my_url."&sort=3&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("SubMenuColumn2"); ?></a></th>
		<th><a href="<?php echo $my_url."&sort=4&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("SubMenuColumn3"); ?></a></th>
        <th><?php echo _p("Operation");?></th>
      </tr>
    </thead>
    <tbody>
      <?php
		$limit = $count . " OFFSET " . ($page - 1) * $count;
		
		$startQuery = "SELECT";
		$valueQuery = "tams.*, tamm.menu_name FROM tamenu_sub tams, tamenu_main tamm";
		$whereQuery = "WHERE tams.menu_id=tamm.menu_id";
		
		$selQuery = $startQuery . " " . $valueQuery . " " . $whereQuery . " ".$searchQuery." " . $sortQuery . " LIMIT " . $limit;
		$rows = $db->query($selQuery);
		for ($i = 0; $i < sizeof($rows); $i++) 
		{
		?>
      <tr>
        <td><?php echo (($page - 1) * $count) + $i + 1; ?></td>
		<td><?php
		$values = $db->query("SELECT tamm.menu_name FROM tamenu_main tamm WHERE tamm.menu_id = ".$rows[$i]["menu_id"]."");
		if (!empty($values)){
		echo $values[0]["menu_name"]; 
		}
		else 
		{
			echo "";
		} 
		?></td>
        <td><?php echo $rows[$i]["sub_name"]; ?></td>
        <td><?php echo $rows[$i]["sub_name_en"]; ?></td>
        <td><?php echo $rows[$i]["sub_link"]; ?></td>
        <td><a href="<?php echo $my_url.$my_page.$search_url.$sort_url."&action=editsub&sub_id=".$rows[$i]["sub_id"]; ?>" title="<?php echo _p("EditTitle"); ?>"><i class="fa fa-edit"></i></a> <a href="<?php echo $my_url.$search_url.$sort_url."&action=delete&sub_id=".$rows[$i]["sub_id"]; ?>" title="<?php echo _p("DeleteTitle"); ?>" onClick="return confirm('<?php echo _p("DeleteText3"); ?>');"><i class="fa fa-trash"></i></a></td>
      </tr>
      <?php
		}
		?>
    </tbody>
  </table>
   <table>
    <tbody>
      <tr>
        <td><?php 
        
		if ($sess_profile==1 || $db->isGroupRole($schemas, $sess_profile, $sess_user_id, 1, 2)) {
		?>
          <a class="btn btn-success" href="<?php echo $my_url.$my_page.$search_url.$sort_url."&action=addsub"; ?>"><i class="fa fa-plus"></i> <?php echo _p("AddButton");?></a>
           <?php 
		}	
        
		if ($sess_profile==1 || $db->isGroupRole($schemas, $sess_profile, $sess_user_id, 1, 1)) {
			if($sum > 0) { 
			?>
          <a class="btn btn-info" href="<?php echo $my_url.$search_url.$sort_url."&action=export"; ?>"><i class="fa fa-file"></i> <?php echo _p("ExportButton");?></a>
          <?php 
			}
		}	
		?></td>
      </tr>
    </tbody>
  </table> 
  </div>
  
  <?php
	require("pagination/inc.pagination1.php");
	pagelink1($count, $maxpage, $my_url, $page, $sort_url);
	?>
