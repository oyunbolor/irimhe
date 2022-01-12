<?php

if (isset($_POST["searchuserbttn"]))
{
	$searchQuery = "";
	$search_url = "";

	$search_lastname = (isset($_POST["search_lastname"])) ? pg_prep($_POST["search_lastname"]) : "";
	$search_group_id = (isset($_POST["search_group_id"])) ? (int) $_POST["search_group_id"] : 0;
	$search_login_name = (isset($_POST["search_login_name"])) ? pg_prep($_POST["search_login_name"]) : "";
	$search_profile = (isset($_POST["search_profile"])) ? (int) $_POST["search_profile"] : 0;
						
	if(empty($search_lastname))
	{
		$searchQuery .= "";
		$search_url .= "";
	}else
	{
		$searchQuery .= " AND lower(tau.lastname) LIKE lower('%".$search_lastname."%')";
		$search_url .= "&search_lastname=".$search_lastname;
	}

	if($search_group_id==0)
	{
		$searchQuery .= "";
		$search_url .= "";
	} else
	{
		$searchQuery .= " AND tug.group_id = ".$search_group_id;
		$search_url .= "&search_group_id=".$search_group_id;
		
		$valueQuery1 = ", ".$schemas.".tausergroups tug";
		$whereQuery1 = " AND tau.user_id = tug.user_id";
	}
	
	if(empty($search_login_name))
	{
		$searchQuery .= "";
		$search_url .= "";
	}else
	{
		$searchQuery .= " AND lower(tau.login_name) LIKE lower('%".$search_login_name."%')";
		$search_url .= "&search_login_name=".$search_login_name;
	}

	if($search_profile==0)
	{
		$searchQuery .= "";
		$search_url .= "";
	} else
	{
		$searchQuery .= " AND tau.profile = ".$search_profile;
		$search_url .= "&search_profile=".$search_profile;
	}	
}

$sortQuery = " ORDER BY ";

if (isset($_GET["sort"]))
{
	if ($_GET["sort"]==2)
	{
		$sortQuery .= "tau.lastname ";
	}else if ($_GET["sort"]==3)
	{
		$sortQuery .= "tau.profile ";
	}else if ($_GET["sort"]==4)
	{
		$sortQuery .= "tau.organization ";
	}else if ($_GET["sort"]==5)
	{
		$sortQuery .= "tau.login_date ";		
	}else
	{
		$sortQuery .= "tau.login_name ";
	}
}else
{
	$sortQuery .= "tau.user_id ";
}

if (isset($_GET["sorttype"]))
{
	if ($_GET["sorttype"]==2)
	{
		$sorttype = 1;
		$sortQuery .= "ASC";
	}else
	{
		$sorttype = 2;
		$sortQuery .= "DESC";
	}
}else
{
	$sorttype = 1;
	$sortQuery .= "DESC";
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

if (isset($_GET["checkusergroups"]))
{
	$searchQuery .= " AND tau.user_id NOT IN (SELECT tug1.user_id FROM ".$schemas.".tausergroups tug1)";
	$search_url .= "&checkusergroups=1";
}
if (isset($_GET["checkuseraimags"]))
{
	$searchQuery .= "AND tau.user_id IN (SELECT tua.user_id FROM ".$schemas.".tauseraimags tua)";
	$search_url .= "&checkuseraimags=1";
}

$startQuery = "SELECT";
$valueQuery = "tau.* FROM ".$schemas.".tausers tau";
$whereQuery = "WHERE tau.user_id = tau.user_id";

if($sess_profile==1) 
	$whereQuery .= "";
else
	$whereQuery .= " AND tau.user_id = ".$sess_user_id;

$selQuery = $startQuery." ".$valueQuery." ".$valueQuery1." ".$whereQuery." ".$whereQuery1." ".$searchQuery;

$rows = $db->query($selQuery);

$sum = sizeof($rows);
$maxpage = ceil( $sum / $count);

if($sess_profile==1) 
{ 
	if (isset($_GET["checkusergroups"]))
		$sname = "tausers/inc.search_users.php";
	else
		require("tausers/inc.search_users.php");
}

$notifytitle =_p("TotalRowsText1")." ".$sum." "._p("TotalRowsText2");
show_notification("info", $notifytitle, "");
?>

<div class="table-responsive">
  <table id="finance_datatables_all" class="table table-bordered table-hover" title_name="<?php echo _p("UsersTitle"); ?>" file_name="users" column_name="0, 1, 2, 3, 4, 5, 6, 7" language_name="<?php echo $language_name;?>" page_count="<?php echo $count;?>">
    <thead>
      <tr>
        <th colspan="9"><form class="form-inline float-right" action="<?php echo $my_count.$search_url.$sort_url; ?>" method="post" name="changeform" id="changeform">
		  <label class="mr-2"><?php echo _p("ShowRowsText");?></label>
		  <?php echo seldata("count", "form-control", $RECORD_COUNTS, $count, ""); ?>
        </form></th>
      </tr>
      <tr>
        <th>№</th>
        <th><a href="<?php echo $my_url."&sort=3&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("UsersColumn2"); ?></a></th>
        <th><a href="<?php echo $my_url."&sort=4&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("UsersColumn5"); ?></a></th>
        <th><a href="<?php echo $my_url."&sort=1&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("UsersColumn1"); ?></a></th>
        <th><a href="<?php echo $my_url."&sort=2&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("UsersColumn4"); ?></a></th>
        <th><?php echo _p("UsersColumn6"); ?></th>
        <th><?php echo _p("UsersColumn7"); ?></th>
        <th><a href="<?php echo $my_url."&sort=5&sorttype=".$sorttype.$search_url; ?>" style="color:#FFFFFF"><i class="fa fa-sort"></i> <?php echo _p("UsersColumn11"); ?></a></th>
        <th><?php echo _p("Operation");?></th>
      </tr>
    </thead>
    <tbody>
      <?php
		$limit = $count." OFFSET ".($page-1)*$count;
	
		$startQuery = "SELECT";
		$valueQuery = "tau.* FROM ".$schemas.".tausers tau";
		$whereQuery = "WHERE tau.user_id = tau.user_id";
		
		if($sess_profile==1) 
			$whereQuery .= "";
		else
			$whereQuery .= " AND tau.user_id = ".$sess_user_id;
		
		$selQuery = $startQuery." ".$valueQuery." ".$valueQuery1." ".$whereQuery." ".$whereQuery1." ".$searchQuery." ".$sortQuery." LIMIT ".$limit;

		$rows = $db->query($selQuery);
	
		for ($i=0; $i < sizeof($rows); $i++) 
		{
		?>
      <tr>
        <td><?php echo (($page-1)*$count) + $i + 1; ?></td>
        <td><?php echo getdata($USER_PROFILE, $rows[$i]["profile"]); ?></td>
        <td><?php echo $rows[$i]["organization"]; ?></td>
        <td><?php echo $rows[$i]["login_name"]; ?></td>
        <td><?php echo $rows[$i]["lastname"]; ?></td>
        <td><?php echo $rows[$i]["phone"]; ?></td>
        <td><?php echo $rows[$i]["email"]; ?></td>
        <td><?php echo $rows[$i]["login_date"]; ?></td>
        <td><a href="<?php echo $my_url.$my_page.$search_url.$sort_url."&action=more&user_id=".$rows[$i]["user_id"]; ?>" title="<?php echo _p("MoreTitle"); ?>"><i class="fa fa-list-alt"></i></a> <a href="<?php echo $my_url.$my_page.$search_url.$sort_url."&action=edit&user_id=".$rows[$i]["user_id"]; ?>" title="<?php echo _p("EditTitle"); ?>"><i class="fa fa-edit"></i></a>
          <?php 
			if($sess_profile==1)
			{ 
			?>
          <a href="<?php echo $my_url.$search_url.$sort_url."&action=delete&user_id=".$rows[$i]["user_id"]; ?>" title="<?php echo _p("DeleteTitle"); ?>" onClick="return confirm('<?php echo _p("DeleteText3"); ?>');"><i class="fa fa-trash"></i></a> <a href="<?php echo $my_url.$my_page.$search_url.$sort_url."&action=usergroups&user_id=".$rows[$i]["user_id"]; ?>" title="<?php echo _p("UserGroupsTitle"); ?>" ><i class="fa fa-user"></i></a>
          <?php 
			} 
			?>
          <a href="<?php echo $my_url.$my_page.$search_url.$sort_url."&action=password&user_id=".$rows[$i]["user_id"]; ?>" title="<?php echo _p("UsersColumn9"); ?>" ><i class="fa fa-wrench"></i></a></td>
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
		
		if($sess_profile==1) 
		{ 
		?>
      <tr>
        <td><a class="btn btn-success" href="<?php echo $my_url.$search_url.$sort_url."&action=add"; ?>"><i class="fa fa-plus"></i> <?php echo _p("AddButton");?></a> 
          <?php if (isset($_GET["checkusergroups"])) { ?>
            <a class="btn btn-success" href="<?php echo $my_url; ?>"><i class="fa fa-user"></i> <?php echo _p("UsersText1"); ?></a> 
            <?php } ?>
          <?php if (!isset($_GET["checkusergroups"])) { ?>
            <a class="btn btn-success" href="<?php echo $my_url."&checkusergroups=1"; ?>"><i class="fa fa-user"></i> <?php echo _p("UsersText2"); ?></a> 
            <?php } ?>
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