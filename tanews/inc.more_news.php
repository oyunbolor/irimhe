<?php
if (isset($_GET["id"]))
{
	$id = (int)$_GET["id"];
}else
{
	$id = 0;
}

$i = 0;
$startQuery = "SELECT";
$valueQuery = "mei.* FROM  tamenu_info mei";
$whereQuery = "WHERE mei.id = ".$id;
$selQuery = $startQuery." ".$valueQuery." ".$whereQuery;
$row = $db->query($selQuery);

if (!empty($row))
{
	$id  = $row[$i]["id"];
?>
<div class="table-responsive">  
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th colspan="2"><?php echo _p("MoreText1")." "._p("UsersTitle")." "._p("MoreText2"); ?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th style="width: 30%"><?php echo _p("NewsAddColumn1"); ?>:</th>
          <td><?php
		$values = $db->query("SELECT tamm.menu_name FROM tamenu_main tamm WHERE tamm.menu_id = ".$row[$i]["menu_id"]."");
		if (!empty($values)){
		echo $values[0]["menu_name"]; 
		}
		else 
		{
			echo "";
		}
		?></td>
        </tr>
        <tr>
          <th><?php echo _p("NewsAddColumn2"); ?>:</th>
          <td><?php
		$values = $db->query("SELECT tams.sub_name FROM tamenu_sub tams WHERE tams.sub_id = ".$row[$i]["sub_id"]."");
		if (!empty($values)){
		echo $values[0]["sub_name"]; 
		}
		else 
		{
			echo "";
		} 
		?></td>
        </tr>
        <tr>
          <th><?php echo _p("NewsAddColumn3"); ?>:</th>
          <td><?php
		$values = $db->query("SELECT tam2.sub_name2 FROM tamenu_sub2 tam2 WHERE tam2.sub2_id = ".$row[$i]["sub2_id"]."");
		if (!empty($values)){
		echo $values[0]["sub_name2"]; 
		}
		else 
		{
			echo "";
		}
		?></td>
        </tr>
        <tr>
          <th><?php echo _p("NewsAddColumn4"); ?>:</th>
          <td><?php echo $row[$i]["title"]; ?></td>
        </tr>
        <tr>
          <th><?php echo _p("NewsAddColumn5"); ?>:</th>
          <td><a href="<?php echo $row[$i]["news_image"]; ?>" target="_blank"><img src="<?php echo $row[$i]["news_image"]; ?>" width="80"/></a></td>
        </tr>
        <tr>
          <th><?php echo _p("NewsAddColumn6"); ?>:</th>
          <td><?php echo $row[$i]["abstract"]; ?></td>
        </tr>
        <tr>
			 <td colspan="2"><b><?php echo _p("UsersColumn7"); ?></b><?php echo $row[$i]["content"]; ?></td>
        </tr>
	
        <tr>
          <td colspan="2"><?php
			if($sess_profile==1)
			{ 
			?>
            <a class="btn btn-success" href="<?php echo $my_url.$my_page.$search_url.$sort_url."&action=edit&id=".$id; ?>"><i class="fa fa-edit"></i> <?php echo _p("EditButton");?></a>
            <?php
			}
			?>
            <a class="btn btn-secondary" href="<?php echo $my_url.$my_page.$search_url.$sort_url; ?>"><i class="fa fa-undo"></i> <?php echo _p("BackButton");?></a> </td>
        </tr>
      </tbody>
    </table>
  </div>

<?php
} else {
	$notify ="Таны хайсан мэдээлэл байхгүй байна. <a href=\"".$my_url.$my_page.$search_url.$sort_url."\">Буцах</a>";
	show_notification("error", "", $notify);
}
?>
