<?php
if ($sess_profile==1 || $db->isGroupRole($sess_profile, $sess_user_id, 1, 2))
{
?>
<script language="JavaScript" type="text/javascript">
function addsubmitform2(){
	if (document.getElementById("sub_name2").value==""){
		alert( "Дэдийн дэд цэсийн нэр оруулна уу" );
	}else if (document.getElementById("sub_name_en2").value==""){
		alert( "Дэдийн дэд цэсийн англи нэр оруулна уу" );
	}else {
		document.getElementById("insertsubmenu2bttn").value = "1";
		document.mainform2.submit();
	}
}
</script>
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th><?php echo _p("AddText5")." "._p("Sub2Menu")." "._p("AddText6"); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><div class="alert alert-warning" role="alert"><?php echo _p("AlertText"); ?></div>
		<form class="form-horizontal" action="<?php echo $my_url.$sort_url; ?>" enctype="multipart/form-data" method="post" name="mainform2" id="mainform2">
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("Sub2MenuColumn1"); ?> :</label>
              <div class="col-md-4">
                <?php
					$selQuery = "SELECT DISTINCT tamm.menu_id, tamm.menu_name FROM tamenu_main tamm ORDER BY tamm.menu_name";
					$rows = $db->query($selQuery);
					echo seldatadb("menuname", "form-control", $rows, "menu_id", "menu_name", $rows[0]["menu_id"]);
					$menuname = $rows[0]["menu_id"];
					?>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextSelect"); ?></span>
              </div>
			<div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("Sub2MenuColumn2"); ?> :</label>
              <div class="col-md-4">
                <?php
					$selQuery = "SELECT tams.sub_id, tams.sub_name FROM tamenu_sub tams WHERE tams.menu_id = ".$menuname." ORDER BY tams.menu_id ASC, tams.sub_name ASC";
					$rows = $db->query($selQuery);
					echo seldatadb("subname", "form-control", $rows, "sub_id", "sub_name", $rows[0]["sub_id"]);
					?>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextSelect"); ?></span>
              </div>
			<div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("Sub2MenuColumn3"); ?> *:</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="sub_name2" id="sub_name2"/>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar50"); ?></span>
              </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("Sub2MenuColumn4"); ?> *:</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="sub_name_en2" id="sub_name_en2"/>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar50"); ?></span>
            </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("Sub2MenuColumn5"); ?></label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="sub_link2" id="sub_link2"   data-toggle="tooltip" title="Тухайн цэсний мэдээ бүтэн гарах бол ?cat=4&type=цэсний нэр байна. Тухайн цэсний мэдээ жагсаалт байдлаар гарах бол ?cat=5&type=цэсний нэр байна."/>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextInt"); ?></span>
            </div>
            <input type="hidden" id="insertsubmenu2bttn" name="insertsubmenu2bttn" value="0"/>
            <div class="form-group row col-md-10 justify-content-center">
              <div>
                <button type="button" class="btn btn-success" onclick="addsubmitform2()"><i class="fa fa-save"></i> <?php echo _p("SaveButton");?></button>
                <a class="btn btn-warning" href="<?php echo $my_url.$my_page.$search_url.$sort_url; ?>"><i class="fa fa-undo"></i> <?php echo _p("UndoButton");?></a></div>
            </div>
          </form></td>
      </tr>
    </tbody>
  </table>
	
</div>
<?php 
} else {
		$notify ="Таны хандалт буруу байна.";
		show_notification("error", "", $notify);
}
?>
