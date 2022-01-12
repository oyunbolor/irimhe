<?php

if (isset($_POST["searchgroupbttn"]))
{
	$searchQuery = "";
	$search_url = "";

	$search_group_name = (isset($_POST["search_group_name"])) ? pg_prep($_POST["search_group_name"]) : "";
						
	if(empty($search_group_name))
	{
		$searchQuery .= "";
		$search_url .= "";
	}else
	{
		$searchQuery .= " AND (lower(tag.group_name) LIKE lower('%".$search_group_name."%') LIKE lower('%".$search_group_name."%'))";
		$search_url .= "&search_group_name=".$search_group_name;
	}
	
}

$sortQuery = " ORDER BY ";

if (isset($_GET["sort"]))
{
	if ($_GET["sort"]==2)
	{
		$sortQuery .= "tag.group_name";
	}
}else
{
	$sortQuery .= "tag.group_id";
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
$valueQuery = "tag.* FROM ".$schemas.".tagroups tag";
$whereQuery = "WHERE tag.group_id = tag.group_id";

$selQuery = $startQuery." ".$valueQuery." ".$whereQuery." ".$searchQuery;

$rows = $db->query($selQuery);

$sum = sizeof($rows);
$maxpage = ceil( $sum / $count);

require("tagroups/inc.search_groups.php");

$notifytitle =_p("TotalRowsText1")." ".$sum." "._p("TotalRowsText2");
show_notification("info", $notifytitle, "");
?>

<div class="table-responsive">
  <table id="finance_datatables_all" class="table table-bordered table-hover" title_name="<?php echo _p("GroupsTitle"); ?>" file_name="groups" column_name="0, 1, 2, 3" language_name="<?php echo $language_name;?>" page_count="<?php echo $count;?>">
    <thead>
      <tr>
        <th colspan="9"><form class="form-inline float-right" action="<?php echo $my_count.$search_url.$sort_url; ?>" method="post" name="changeform" id="changeform">
		  <label class="mr-2"><?php echo _p("ShowRowsText");?></label>
		  <?php echo seldata("count", "form-control", $RECORD_COUNTS, $count, ""); ?>
        </form></th>
      </tr>
      <tr>
        <th>№</th>
        <th><a href="<?php echo $my_url."&sort=1&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("GroupsColumn3"); ?></a></th>
        <th><a href="<?php echo $my_url."&sort=2&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("GroupsColumn4"); ?></a></th>
        <th><?php echo _p("GroupsColumn2"); ?></th>
        <th><?php echo _p("Operation");?></th>
      </tr>
    </thead>
    <tbody>
      <?php
		$limit = $count." OFFSET ".($page-1)*$count;
	
		$startQuery = "SELECT";
		$valueQuery = "tag.* FROM ".$schemas.".tagroups tag";
		$whereQuery = "WHERE tag.group_id = tag.group_id";
		
		$selQuery = $startQuery." ".$valueQuery." ".$whereQuery." ".$searchQuery." ".$sortQuery." LIMIT ".$limit;

		$rows = $db->query($selQuery);
	
		for ($i=0; $i < sizeof($rows); $i++) 
		{
		?>
      <tr>
        <td><?php echo (($page-1)*$count) + $i + 1; ?></td>
        <td><?php echo $rows[$i]["group_name"]; ?></td>
        <td><?php echo $rows[$i]["group_name_en"]; ?></td>
        <td><?php echo $rows[$i]["description"]; ?></td>
        <td><a href="<?php echo $my_url.$my_page.$search_url.$sort_url."&action=edit&group_id=".$rows[$i]["group_id"]; ?>" title="<?php echo _p("EditTitle"); ?>"><i class="fa fa-edit"></i></a> <a href="<?php echo $my_url.$search_url.$sort_url."&action=delete&group_id=".$rows[$i]["group_id"]; ?>" title="<?php echo _p("DeleteTitle"); ?>" onClick="return confirm('<?php echo _p("DeleteText3"); ?>');"><i class="fa fa-trash"></i></a></td>
      </tr>
      <?php
		}
		?>
    </tbody>
  </table>
  <table>
    <tbody>
      <tr>
        <td><a class="btn btn-success" href="<?php echo $my_url.$search_url.$sort_url."&action=add"; ?>"><i class="fa fa-plus"></i> <?php echo _p("AddButton");?></a></td>
      </tr>
    </tbody>
  </table>
  <?php
	require("pagination/inc.pagination1.php");
	pagelink1($PAGE_COUNT, $maxpage, $my_url, $page, $search_url.$sort_url);
	?>
</div>