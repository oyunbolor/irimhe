<?php
if ($sess_profile==1 || $db->isGroupRole($sess_profile, $sess_user_id, 1, 2))
{

if (isset($_GET["sub2_id"])) 
{
	$sub2_id = (int) $_GET["sub2_id"];
} else {
	$sub2_id = 0;
}
$i = 0;
$startQuery = "SELECT";
$valueQuery = "tam2.*, tamm.menu_id, tamm.menu_name, tams.sub_name FROM tamenu_sub2 tam2, tamenu_main tamm, tamenu_sub tams";
$whereQuery = "WHERE tam2.sub_id=tams.sub_id AND tams.menu_id=tamm.menu_id AND tam2.sub2_id = " . $sub2_id;
$selQuery = $startQuery." ".$valueQuery." ".$whereQuery;
$row = $db->query($selQuery);

if (!empty($row))
{
?>
<script language="JavaScript" type="text/javascript">
function updatesubmitform(){
	if (document.getElementById("sub_name2").value==""){
		alert( "Дэдийн дэд цэсийн нэр оруулна уу" );
	}else if (document.getElementById("sub_name_en2").value==""){
		alert( "Дэдийн дэд цэсийн англи нэр оруулна уу" );
	}else {
		document.getElementById("updatesub2menubttn").value = "1";
		document.mainform.submit();
	}
}
</script>
<div class="table-responsive">
  <table class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th><?php echo _p("EditText3")." "._p("Sub2Menu")." "._p("EditText4"); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
		<form class="form" role="form" action="<?php echo $my_url.$my_page.$search_url.$sort_url; ?>" enctype="multipart/form-data" method="post" name="mainform" id="mainform">
            <input type="hidden" name="sub2_id" id="sub2_id" value="<?php echo $row[$i]["sub2_id"]; ?>">
			<div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn1"); ?> *:</label>
              <div class="col-md-4">
                <?php
					$selQuery = "SELECT tamm.menu_id, tamm.menu_name FROM tamenu_main tamm ORDER BY tamm.menu_name";
					$rows = $db->query($selQuery);
					echo seldatadb("menuname", "form-control", $rows, "menu_id", "menu_name", $row[$i]["menu_id"]);
					$menu_name = $row[$i]["menu_id"];
					?>
              </div>
              </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn2"); ?> *:</label>
              <div class="col-md-4">
                <?php
					$selQuery = "SELECT tams.sub_id, tams.sub_name FROM tamenu_sub tams WHERE tams.menu_id = ".$menu_name." ORDER BY tams.menu_id ASC, tams.sub_name ASC";
					$rows = $db->query($selQuery);
					echo seldatadb("subname", "form-control", $rows, "sub_id", "sub_name", $row[$i]["sub_id"]);
					?>
              </div>
            </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn3"); ?> *:</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="sub_name2" id="sub_name2" value="<?php echo $row[$i]["sub_name2"]; ?>"/>
              </div>
            </div>
			<div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn3"); ?> *:</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="sub_name_en2" id="sub_name_en2" value="<?php echo $row[$i]["sub_name_en2"]; ?>"/>
              </div>
            </div>
			<div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn3"); ?> *:</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="sub_link2" id="sub_link2" value="<?php echo $row[$i]["sub_link2"]; ?>"  data-toggle="tooltip" title="Тухайн цэсний мэдээ бүтэн гарах бол ?cat=4&type=цэсний нэр байна. Тухайн цэсний мэдээ жагсаалт байдлаар гарах бол ?cat=5&type=цэсний нэр байна."/>
              </div>
            </div>
            <input type="hidden" id="updatesub2menubttn" name="updatesub2menubttn" value="0"/>
            <div class="form-group row col-md-10 justify-content-center">
              <div>
                <button type="button" class="btn btn-success" onclick="updatesubmitform()"><i class="fa fa-save"></i> <?php echo _p("SaveButton");?></button>
                <a class="btn btn-warning" href="<?php echo $my_url.$my_page.$search_url.$sort_url; ?>"><i class="fa fa-undo"></i> <?php echo _p("UndoButton");?></a></div>
            </div>
          </form></td>
      </tr>
    </tbody>
  </table>
</div>
<?php
	} else {
	$notify = "Таны хайсан мэдээлэл байхгүй байна. <a href=\"" . $my_url . $my_page . $sort_url . "\">Буцах</a>";
	show_notification("error", "", $notify);
	}
} else {
	$notify = "Таны хандалт буруу байна.";
	show_notification("error", "", $notify);
}
?>
