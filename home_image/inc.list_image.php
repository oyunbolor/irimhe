<?php
if (isset($_POST["searchimagebttn"])) 
{
	$searchQuery = "";
	$search_url = "";
	$search_title = (isset($_POST["search_title"])) ? pg_prep($_POST["search_title"]) : "";

	if (empty($search_title)) 
	{
		$searchQuery .= "";
		$search_url .= "";
	} else 
	{
		$searchQuery .= " AND lower(hoi.search_title) LIKE lower('%".$search_title."%')";
		$search_url .= "&search_title=".$search_title;
	}
}

$sortQuery = " ORDER BY ";

if (isset($_GET["sort"])) 
{
	if ($_GET["sort"]==1)
	{
		$sortQuery .= " hoi.language";
	}elseif ($_GET["sort"]==2)
	{
		$sortQuery .= " hoi.title";
	}elseif ($_GET["sort"]==3)
	{
		$sortQuery .= " hoi.uploaddate";
	}
} else {
	$sortQuery .= " hoi.image_id";
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
$valueQuery = "COUNT(*) AS num_count FROM tahome_image hoi";
$whereQuery = "WHERE hoi.image_id=hoi.image_id ";
$selQuery = $startQuery . " " . $valueQuery . " ".$valueQuery1." " . $whereQuery . " ".$whereQuery1." " . $searchQuery;

$rows = $db->query($selQuery);

$sum = 0;
if (sizeof($rows) > 0)
	$sum = $rows[0]["num_count"];

$maxpage = ceil($sum / $count);

require("home_image/inc.search_image.php");

$notify = "<strong>Нийт $sum бичлэг байна.</strong>";
?>

<div class="table-responsive">
  <table id="finance_datatables_all" class="table table-bordered table-hover" title_name="<?php echo _p("HomeImage"); ?>" file_name="homeimage" column_name="0, 1, 2, 3, 4" language_name="<?php echo $language_name;?>" page_count="<?php echo $count;?>">
    <thead>
      <tr>
        <th colspan="6"><form class="form-inline float-right" action="<?php echo $my_count.$search_url.$sort_url; ?>" method="post" name="changeform" id="changeform">
		  <label class="mr-2"><?php echo _p("ShowRowsText");?></label>
		  <?php echo seldata("count", "form-control", $RECORD_COUNTS, $count, ""); ?>
        </form></th>
      </tr>
      <tr>
        <th>№</th>
        <th><a href="<?php echo $my_url."&sort=3&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("HomeColumn1"); ?></a></th>
        <th><a href="<?php echo $my_url."&sort=4&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("HomeColumn2"); ?></a></th>
        <th><a href="<?php echo $my_url."&sort=1&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("HomeColumn3"); ?></a></th>
        <th><a href="<?php echo $my_url."&sort=1&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("HomeColumn4"); ?></a></th>
        <th><?php echo _p("Operation");?></th>
      </tr>
    </thead>
    <tbody>
      <?php
		$limit = $count . " OFFSET " . ($page - 1) * $count;
		$startQuery = "SELECT";
		$valueQuery = "hoi.* FROM tahome_image hoi";
		$whereQuery = "WHERE hoi.image_id=hoi.image_id ";
		$selQuery = $startQuery . " " . $valueQuery . " ".$valueQuery1." " . $whereQuery . " ".$whereQuery1." " . $searchQuery . " " . $sortQuery . " LIMIT " . $limit;

		$rows = $db->query($selQuery);
		for ($i = 0; $i < sizeof($rows); $i++) 
		{
		?>
      <tr>
        <td><?php echo (($page - 1) * $count) + $i + 1; ?></td>
        <td><?php echo getdata($LANGUAGE, $rows[$i]["language"]); ?></td>
        <td><?php echo $rows[$i]["title"]; ?></td>
        <td><?php echo $rows[$i]["uploaddate"]; ?></td>
        <td><a href="<?php echo $rows[$i]["file_pathname"]; ?>" target="_blank"><img src="<?php echo $rows[$i]["file_pathname"]; ?>" width="60px"></a></td>
        <td align="center">
          <?php
			if ($sess_profile == 1) 
			{
			?>
          <a href="<?php echo $my_url . $my_page . $search_url . $sort_url . "&action=edit&image_id=" . $rows[$i]["image_id"]; ?>" title="Засварлах"><i class="fa fa-edit"></i></a> <a href="<?php echo $my_url . $search_url . $sort_url . "&action=delete&image_id=" . $rows[$i]["image_id"]; ?>" title="Устгах" onClick="return confirm('Та устгахдаа итгэлтэй байна уу?');"><i class="fa fa-trash"></i></a>
          <?php
            } else if ($rows[$i]["user_id"] == $sess_user_id) 
			{
          	?>
          <a href="<?php echo $my_url . $my_page . $search_url . $sort_url . "&action=edit&image_id=" . $rows[$i]["image_id"]; ?>" title="Засварлах"><i class="fa fa-edit"></i></a> <a href="<?php echo $my_url . $search_url . $sort_url . "&action=delete&image_id=" . $rows[$i]["image_id"]; ?>" title="Устгах" onClick="return confirm('Та устгахдаа итгэлтэй байна уу?');"><i class="fa fa-trash"></i></a></td>
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
      <?php
        if ($sess_profile==1 || $db->isGroupRole($sess_profile, $sess_user_id, 4, 2))
		{
		?>
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
      <?php
        }
        ?>
    </tbody>
  </table>
  <?php
	require("pagination/inc.pagination1.php");
	pagelink1($PAGE_COUNT, $maxpage, $my_url, $page, $search_url.$sort_url);
	?>
</div>


