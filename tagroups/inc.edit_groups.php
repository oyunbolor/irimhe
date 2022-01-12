<?php
if (isset($_GET["group_id"]))
{
	$group_id = (int)$_GET["group_id"];
}else
{
	$group_id = 0;
}

$i = 0;

$startQuery = "SELECT";
$valueQuery = "tag.* FROM ".$schemas.".tagroups tag";
$whereQuery = "WHERE tag.group_id = ".$group_id;

$selQuery = $startQuery." ".$valueQuery." ".$whereQuery;

$row = $db->query($selQuery);

if (!empty($row))
{
?>
<script language="JavaScript" type="text/javascript">
function updatesubmitform(){
	if (document.getElementById("group_name").value==""){
		alert("<?php echo _p("EnterText1")." "._p("GroupsColumn3")." "._p("EnterText2");?>");
	}else {
		document.getElementById("updategroupbttn").value = "1";
		document.mainform.submit();
	}
}
</script>

<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th><?php echo _p("EditText3")." "._p("AddMenuTitle")." "._p("EditText4"); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><div class="alert alert-warning" role="alert"><?php echo _p("AlertText"); ?></div>
          <form class="form" role="form" action="<?php echo $my_url.$my_page.$search_url.$sort_url; ?>" enctype="multipart/form-data" method="post" name="mainform" id="mainform">
            <input type="hidden" name="group_id" id="group_id" value="<?php echo $row[$i]["group_id"]; ?>">
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("GroupsColumn3"); ?> *:</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="group_name"  id="group_name" value="<?php echo $row[$i]["group_name"]; ?>"/>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar50"); ?></span> </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("GroupsColumn4"); ?>:</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="group_name_en" id="group_name_en" value="<?php echo $row[$i]["group_name_en"]; ?>"/>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar50"); ?></span> </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("GroupsColumn2"); ?>:</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="description" id="description" value="<?php echo $row[$i]["description"]; ?>" />
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar150"); ?></span> </div>
              </div>
            <input type="hidden" id="updategroupbttn" name="updategroupbttn" value="0"/>
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
	$notify = " <a class=\"btn btn-danger\" href=\"".$my_url.$my_page.$search_url.$sort_url."\"><i class=\"fa fa-undo\"></i> "._p("BackButton")." </a>";
	show_notification("error", _p("NotRowText"), $notify);
}
?>
