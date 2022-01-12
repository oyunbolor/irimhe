<?php
if (isset($_POST["searchnewsbttn"])) 
{
	$searchQuery = "";
	$search_url = "";
	$search_menu_id = (isset($_POST["search_menu_id"])) ? (int) $_POST["search_menu_id"] : 0;
	$search_sub_name = (isset($_POST["search_sub_name"])) ? (int) $_POST["search_sub_name"] : 0;
	$search_sub_name2 = (isset($_POST["search_sub_name2"])) ? (int) $_POST["search_sub_name2"] : 0;
	$search_title = (isset($_POST["search_title"])) ? (pg_prep($_POST["search_title"])) : "";
	$search_user_id = (isset($_POST["search_user_id"])) ? (int) $_POST["search_user_id"] : 0;
	$search_group_id = (isset($_POST["search_group_id"])) ? (int) $_POST["search_group_id"] : 0;

	if($search_menu_id==0)
	{
		$searchQuery .= "";
		$search_url .= "";
	} else
	{
		$searchQuery .= " AND tami.menu_id = ".$search_menu_id;
		$search_url .= "&search_menu_id=".$search_menu_id;
		
	}
	if ($search_sub_name == 0) 
	{
		$searchQuery .= "";
		$search_url .= "";
	} else 
	{
		$searchQuery .= " AND tami.sub_id = ".$search_sub_name;
		$search_url .= "&search_sub_name=".$search_sub_name;
	}
	if ($search_sub_name2 == 0) 
	{
		$searchQuery .= "";
		$search_url .= "";
	} else 
	{
		$searchQuery .= " AND tami.sub2_id = ".$search_sub_name2;
		$search_url .= "&search_sub_name2=".$search_sub_name2;
	}
	if (empty($search_title)) 
	{
		$searchQuery .= "";
		$search_url .= "";
	} else 
	{
		$searchQuery .= " AND lower(tami.title) LIKE lower('%".$search_title."%')";
		$search_url .= "&search_title=".$search_title;
	}
	if($search_user_id==0)
	{
		$searchQuery .= "";
			$search_url .= "";
	} else
	{
		$searchQuery .= " AND tami.user_id = ".$search_user_id;
		$search_url .= "&search_user_id=".$search_user_id;
	}
	if($search_group_id==0)
	{
		$searchQuery .= "";
		$search_url .= "";
	} else
	{
		$searchQuery .= " AND tug.group_id = ".$search_group_id;
		$search_url .= "&search_group_id=".$search_group_id;

		$valueQuery1 = ", tausergroups tug";
		$whereQuery1 = " AND tami.user_id = tug.user_id";
	}
}

$sortQuery = " ORDER BY ";

if (isset($_GET["sort"])) 
{
	if ($_GET["sort"]==2)
	{
		$sortQuery .= " tami.sub_id";
	}elseif ($_GET["sort"]==3)
	{
		$sortQuery .= " tami.sub2_id";
	}elseif ($_GET["sort"]==4)
	{
		$sortQuery .= " tami.title";
	}elseif ($_GET["sort"]==5)
	{
		$sortQuery .= " tami.info_date";
	}elseif ($_GET["sort"]==6)
	{
		$sortQuery .= " tami.language";
	} else {
    	$sortQuery .= " tamm.menu_name";
	}
} else {
	$sortQuery .= " tami.id";
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

if (isset($_GET["sort"]) && isset($_GET["sorttype"])) 
{
	$sort_url = "";
	$sort = (isset($_GET["sort"])) ? (int) $_GET["sort"] : 0;
	$sort_type = (isset($_GET["sorttype"])) ? (int) $_GET["sorttype"] : 0;
	
	if ($sort == 0)
		$sort_url .= "";
	else
		$sort_url .= "&sort=" . $sort;
	
	if ($sort_type == 0)
		$sort_url .= "";
	else
		$sort_url .= "&sorttype=" . $sort_type;
}

$startQuery = "SELECT";
$valueQuery = "COUNT(*) AS num_count FROM tamenu_info tami, tamenu_main tamm";
$whereQuery = "WHERE tami.menu_id=tamm.menu_id";
$selQuery = $startQuery . " " . $valueQuery . " ".$valueQuery1." " . $whereQuery . " ".$whereQuery1." " . $searchQuery;

$rows = $db->query($selQuery);

$sum = 0;
if (sizeof($rows) > 0)
	$sum = $rows[0]["num_count"];

$maxpage = ceil($sum / $count);

require("tanews/inc.search_news.php");

$notifytitle =_p("TotalRowsText1")." ".$sum." "._p("TotalRowsText2");
show_notification("info", $notifytitle, "");
?>

<div class="table-responsive">
  <table id="finance_datatables_all" class="table table-bordered table-hover" title_name="<?php echo _p("News"); ?>" file_name="news" column_name="0, 1, 2, 3, 4, 5, 6" language_name="<?php echo $language_name;?>" page_count="<?php echo $count;?>">
    <thead>
      <tr>
        <th colspan="8"><form class="form-inline float-right" action="<?php echo $my_count.$search_url.$sort_url; ?>" method="post" name="changeform" id="changeform">
		  <label class="mr-2"><?php echo _p("ShowRowsText");?></label>
		  <?php echo seldata("count", "form-control", $RECORD_COUNTS, $count, ""); ?>
        </form></th>
      </tr>
      <tr>
        <th>№</th>
		<th><a href="<?php echo $my_url."&sort=6&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("NewsColumn6");?></a></th>
        <th><a href="<?php echo $my_url."&sort=2&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("NewsColumn1");?></a></th>
        <th><a href="<?php echo $my_url."&sort=3&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("NewsColumn2");?></a></th>
        <th><a href="<?php echo $my_url."&sort=1&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("NewsColumn3");?></a></th>
        <th><a href="<?php echo $my_url."&sort=4&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("NewsColumn4");?></a></th>
        <th><a href="<?php echo $my_url."&sort=5&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("NewsColumn5");?></a></th>

        <th><?php echo _p("Operation");?></th>
      </tr>
    </thead>
    <tbody>
      <?php
		$limit = $count . " OFFSET " . ($page - 1) * $count;
		$startQuery = "SELECT";
		$valueQuery = "tami.*, tamm.menu_name FROM tamenu_info tami, tamenu_main tamm";
		$whereQuery = "WHERE tami.menu_id=tamm.menu_id ";
		$selQuery = $startQuery . " " . $valueQuery . " ".$valueQuery1." " . $whereQuery . " ".$whereQuery1." " . $searchQuery . " " . $sortQuery . " LIMIT " . $limit;

		$rows = $db->query($selQuery);
		for ($i = 0; $i < sizeof($rows); $i++) 
		{
		?>
      <tr>
        <td><?php echo (($page-1)*$count) + $i + 1; ?></td>
		<td><?php echo getdata($LANGUAGE, $rows[$i]["language"]); ?></td>
        <td><?php echo $rows[$i]["menu_name"]; ?></td>
        <td><?php
		$values = $db->query("SELECT tamm.sub_name FROM tamenu_sub tamm WHERE tamm.sub_id = ".$rows[$i]["sub_id"]."");
		if (!empty($values)){
		echo $values[0]["sub_name"]; 
		}
		else 
		{
			echo "";
		} 
		?></td>
        <td><?php
		$values = $db->query("SELECT tamm.sub_name2 FROM tamenu_sub2 tamm WHERE tamm.sub2_id = ".$rows[$i]["sub2_id"]."");
		if (!empty($values)){
		echo $values[0]["sub_name2"]; 
		}
		else 
		{
			echo "";
		}
		?></td>
        <td><?php echo $rows[$i]["title"]; ?></td>
        <td><?php echo $rows[$i]["info_date"]; ?></td>
        
        <td align="center"><a href="<?php echo $my_url.$my_page.$search_url.$sort_url."&action=more&id=".$rows[$i]["id"]; ?>" title="Дэлгэрэнгүй харах"><span class="fa fa-list-alt"></span></a>
          <?php
			if ($sess_profile == 1) 
			{
			?>
          <a href="<?php echo $my_url . $my_page . $search_url . $sort_url . "&action=edit&id=" . $rows[$i]["id"]; ?>" title="Засварлах"><i class="fa fa-edit"></i></a> <a href="<?php echo $my_url . $search_url . $sort_url . "&action=delete&id=" . $rows[$i]["id"]; ?>" title="Устгах" onClick="return confirm('Та устгахдаа итгэлтэй байна уу?');"><i class="fa fa-trash"></i></a>
          <?php
            } else if ($rows[$i]["user_id"] == $sess_user_id) 
			{
          	?>
          <a href="<?php echo $my_url . $my_page . $search_url . $sort_url . "&action=edit&id=" . $rows[$i]["id"]; ?>" title="Засварлах"><i class="fa fa-edit"></i></a> <a href="<?php echo $my_url . $search_url . $sort_url . "&action=delete&id=" . $rows[$i]["id"]; ?>" title="Устгах" onClick="return confirm('Та устгахдаа итгэлтэй байна уу?');"><i class="glyphicon glyphicon-trash"></i></a></td>
        <?php
            }
            ?>
		</tr>
      <?php
		}
		?>
    </tbody>
  </table>
  <table>
    <tbody>
      <tr>
        <td>
		<?php 
        
		if ($sess_profile==1 || $db->isGroupRole($schemas, $sess_profile, $sess_user_id, 1, 2)) {
		?>
          <a class="btn btn-success" href="<?php echo $my_url.$my_page.$search_url.$sort_url."&action=add"; ?>"><i class="fa fa-plus"></i> <?php echo _p("AddButton");?></a>
           <?php 
		}	
        
		if ($sess_profile==1 || $db->isGroupRole($schemas, $sess_profile, $sess_user_id, 1, 1)) {
			if($sum > 0) { 
			?>
          <a class="btn btn-info" href="<?php echo $my_url.$search_url.$sort_url."&action=export"; ?>"><i class="fa fa-file"></i> <?php echo _p("ExportButton");?></a>
          <?php 
			}
		}	
		?>
		</td>
      </tr>
    </tbody>
  </table>
  <?php
	require("pagination/inc.pagination1.php");
	pagelink1($PAGE_COUNT, $maxpage, $my_url, $page, $search_url.$sort_url);
	?>
</div>
