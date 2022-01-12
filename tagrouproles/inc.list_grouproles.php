<?php
if (isset($_POST["searchgrouprolebttn"]))
{
	$searchQuery = "";
	$search_url = "";
	
	$search_group_id = (isset($_POST["search_group_id"])) ? (int) $_POST["search_group_id"]: 0;					
	$search_item_id = (isset($_POST["search_item_id"])) ? (int) $_POST["search_item_id"]: 0;	
	$search_role_id = (isset($_POST["search_role_id"])) ? (int) $_POST["search_role_id"]: 0;
		
	if($search_group_id==0)
	{
		$searchQuery .= "";
		$search_url .= "";
	} else
	{
		$searchQuery .= " AND tagr.group_id = ".$search_group_id;
		$search_url .= "&search_group_id=".$search_group_id;
	}
	
	if($search_item_id==0)
	{
		$searchQuery .= "";
		$search_url .= "";
	} else
	{
		$searchQuery .= " AND tagr.item_id = ".$search_item_id;
		$search_url .= "&search_item_id=".$search_item_id;
	}

	if($search_role_id==0)
	{
		$searchQuery .= "";
		$search_url .= "";
	} else
	{
		$searchQuery .= " AND tagr.role_id = ".$search_role_id;
		$search_url .= "&search_role_id=".$search_role_id;
	}		
} 

$sortQuery = " ORDER BY ";

if (isset($_GET["sort"])) 
{
	if ($_GET["sort"] == 2) 
	{
		$sortQuery .= " tagr.item_id";
	} else if ($_GET["sort"] == 3) 
	{
		$sortQuery .= " tagr.role_id";
	} else
	{
		$sortQuery .= " tag.group_name";		
	}
} else 
{
    $sortQuery .= " tag.group_name";
}

if (isset($_GET["sorttype"])) 
{
    if ($_GET["sorttype"] == 2) 
	{
        $sorttype = 1;
        $sortQuery .= " ASC";
    } else {
        $sorttype = 2;
        $sortQuery .= " DESC";
    }
} else {
    $sorttype = 2;
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
$valueQuery = "tagr.* FROM ".$schemas.".tagrouproles tagr, ".$schemas.".tagroups tag";
$whereQuery = "WHERE tagr.group_id = tag.group_id";

$selQuery = $startQuery." ".$valueQuery." ".$whereQuery." ".$searchQuery;

$rows = $db->query($selQuery);

$sum = sizeof($rows);
$maxpage = ceil( $sum / $count);

require("tagrouproles/inc.search_grouproles.php");

$notifytitle =_p("TotalRowsText1")." ".$sum." "._p("TotalRowsText2");
show_notification("info", $notifytitle, "");
?>

<div class="table-responsive">
  <table id="finance_datatables_all" class="table table-bordered table-hover" title_name="<?php echo _p("GroupRolesTitle"); ?>" file_name="grouproles" column_name="0, 1, 2, 3" language_name="<?php echo $language_name;?>" page_count="<?php echo $count;?>">
    <thead>
      <tr>
        <th colspan="5"><form class="form-inline float-right" action="<?php echo $my_count.$search_url.$sort_url; ?>" method="post" name="changeform" id="changeform">
		  <label class="mr-2"><?php echo _p("ShowRowsText");?></label>
		  <?php echo seldata("count", "form-control", $RECORD_COUNTS, $count, ""); ?>
        </form></th>
      </tr>
      <tr>
        <th>№</th>
        <th><a href="<?php echo $my_url."&sort=1&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("GroupRolesColumn1");?></a></th>
        <th><a href="<?php echo $my_url."&sort=2&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("GroupRolesColumn3");?></a></th>
        <th><a href="<?php echo $my_url."&sort=3&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("GroupRolesColumn2");?></a></th>
        <th><?php echo _p("Operation");?></th>
      </tr>
    </thead>
    <tbody>
      <?php
		$limit = $count." OFFSET ".($page-1)*$count;
		$startQuery = "SELECT";		
		$valueQuery = "tagr.*, tag.group_name group_name_mn, tag.group_name_en FROM ".$schemas.".tagrouproles tagr, ".$schemas.".tagroups tag";
		$whereQuery = "WHERE tagr.group_id = tag.group_id";
		
		$selQuery = $startQuery." ".$valueQuery." ".$whereQuery." ".$searchQuery." ".$sortQuery." LIMIT ".$limit;
	
		$rows = $db->query($selQuery);
		
		for ($i=0; $i < sizeof($rows); $i++) 
		{
		?>
      <tr>
        <td><?php echo (($page-1)*$count) + $i + 1; ?></td>
        <td><?php echo $rows[$i]["group_name_$language_name"]; ?></td>
        <td><?php echo getdata($ITEM_TYPE, $rows[$i]["item_id"]); ?></td>
        <td><?php echo getdata($ROLE_TYPE, $rows[$i]["role_id"]); ?></td>
        <td><a href="<?php echo $my_url.$search_url.$sort_url."&action=delete&group_id=".$rows[$i]["group_id"]."&item_id=".$rows[$i]["item_id"]."&role_id=".$rows[$i]["role_id"]; ?>" title="<?php echo _p("DeleteTitle"); ?>" onClick="return confirm('<?php echo _p("DeleteText3"); ?>');"><i class="fa fa-trash"></i></a></td>
      </tr>
      <?php
		}
		?>
    </tbody>
  </table>
  <table>
    <tbody>
      <tr>
        <td><a class="btn btn-success" href="<?php echo $my_url.$my_page.$search_url.$sort_url."&action=add"; ?>"><i class="fa fa-plus"></i> <?php echo _p("AddButton");?></a></td>
      </tr>
    </tbody>
  </table>
  <?php
	require("pagination/inc.pagination1.php");
	pagelink1($PAGE_COUNT, $maxpage, $my_url, $page, $search_url.$sort_url);
	?>
</div>
