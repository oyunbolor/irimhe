<?php
if ($sess_profile==1 || $db->isGroupRole($sess_profile, $sess_user_id, 1, 2))
{

if (isset($_GET["sub_id"])) 
{
	$sub_id = (int) $_GET["sub_id"];
} else {
	$sub_id = 0;
}
$i = 0;
$startQuery = "SELECT";
$valueQuery = "tams.* FROM tamenu_sub tams";
$whereQuery = "WHERE tams.sub_id = " . $sub_id;
$selQuery = $startQuery." ".$valueQuery." ".$whereQuery;

$row = $db->query($selQuery);

if (!empty($row))
{
?>
<script language="JavaScript" type="text/javascript">
function updatesubmitform(){
	if (document.getElementById("sub_name").value==""){
		alert( "Дэд цэсийн нэрийг оруулна уу" );
	}else if (document.getElementById("sub_name_en").value==""){
		alert( "Дэд цэсийн англи нэрийг оруулна уу" );
	}else {
		document.getElementById("updatemenubttn").value = "1";
		document.mainform.submit();
	}
}
</script>

<div class="table-responsive">
  <table class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th><?php echo _p("EditText3")." "._p("SubMenuTitle")." "._p("EditText4"); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
		<form class="form" role="form" action="<?php echo $my_url.$my_page.$search_url.$sort_url; ?>" enctype="multipart/form-data" method="post" name="mainform" id="mainform">
            <input type="hidden" name="sub_id" id="sub_id" value="<?php echo $row[$i]["sub_id"]; ?>">
			<div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn1"); ?> *:</label>
              <div class="col-md-4">
                <?php
				$selQuery = "SELECT DISTINCT tamm.menu_id, tamm.menu_name FROM tamenu_main tamm ORDER BY tamm.menu_id";
				$rows = $db->query($selQuery);
				if(!empty($rows))
					echo seldatadb("menu_id", "form-control", $rows, "menu_id", "menu_name", $row[$i]["menu_id"]);
				else
					echo seldatadb("menu_id", "form-control", $rows, "menu_id", "menu_name", NULL);
					?>
              </div>
              </div>
			<div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn1"); ?> *:</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="sub_name" id="sub_name"  value="<?php echo $row[$i]["sub_name"]; ?>"/>
              </div>
              </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn2"); ?> *:</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="sub_name_en" id="sub_name_en"  value="<?php echo $row[$i]["sub_name_en"]; ?>"/>
              </div>
            </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn3"); ?> *:</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="sub_link" id="sub_link"  value="<?php echo $row[$i]["sub_link"]; ?>"  data-toggle="tooltip" title="Тухайн цэсний мэдээ бүтэн гарах бол ?cat=4&type=цэсний нэр байна. Тухайн цэсний мэдээ жагсаалт байдлаар гарах бол ?cat=5&type=цэсний нэр байна."/>
              </div>
            </div>
            <input type="hidden" id="updatemenubttn" name="updatemenubttn" value="0"/>
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
