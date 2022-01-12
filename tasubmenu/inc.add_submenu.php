<?php
if ($sess_profile==1 || $db->isGroupRole($sess_profile, $sess_user_id, 1, 2))
{
?>
<script language="JavaScript" type="text/javascript">
function addsubmitform(){
	if (document.getElementById("menu_name").value==""){
		alert( "Цэсийн нэрийг оруулна уу" );
	}else if (document.getElementById("menu_name_en").value==""){
		alert( "Цэсийн англи нэрийг оруулна уу" );
	}else {
		document.getElementById("insertmenubttn").value = "1";
		document.mainform.submit();
	}
}
function addsubmitform1(){
	if (document.getElementById("sub_name").value==""){
		alert( "Дэд цэсийн нэр оруулна уу" );
	}else if (document.getElementById("sub_name_en").value==""){
		alert( "Дэд цэсийн англи нэр оруулна уу" );
	}else {
		document.getElementById("insertsubmenubttn").value = "1";
		document.mainform1.submit();
	}
}
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
        <th><?php echo _p("AddText5")." "._p("SubMenuTitle")." "._p("AddText6"); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><form class="form-horizontal" action="<?php echo $my_url.$sort_url; ?>" enctype="multipart/form-data" method="post" name="mainform1" id="mainform1">
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("SubMenuColumn1"); ?> *:</label>
              <div class="col-md-4">
                <?php
				$selQuery = "SELECT DISTINCT tam.menu_id, tam.menu_name FROM tamenu_main tam ORDER BY tam.menu_id";
				$row = $db->query($selQuery);
				if(!empty($row))
					echo seldatadb("menu_id", "form-control", $row, "menu_id", "menu_name", $row[0]["menu_id"]);
				else
					echo seldatadb("menu_id", "form-control", $row, "menu_id", "menu_name", NULL);
					?>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextSelect"); ?></span>
              </div>
			<div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("SubMenuColumn2"); ?> *:</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="sub_name" id="sub_name"/>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar50"); ?></span>
              </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("SubMenuColumn3"); ?></label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="sub_name_en" id="sub_name_en"/>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar50"); ?></span>
            </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("SubMenuColumn4"); ?></label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="sub_link" id="sub_link"  data-toggle="tooltip" title="Тухайн цэсний мэдээ бүтэн гарах бол ?cat=4&type=цэсний нэр байна. Тухайн цэсний мэдээ жагсаалт байдлаар гарах бол ?cat=5&type=цэсний нэр байна."/>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextInt"); ?></span>
            </div>
            <input type="hidden" id="insertsubmenubttn" name="insertsubmenubttn" value="0"/>
            <div class="form-group row col-md-10 justify-content-center">
              <div>
                <button type="button" class="btn btn-success" onclick="addsubmitform1()"><i class="fa fa-save"></i> <?php echo _p("SaveButton");?></button>
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
