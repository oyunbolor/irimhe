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
</script>

<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th><?php echo _p("AddText5")." "._p("AddMenuTitle")." "._p("AddText6"); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><div class="alert alert-warning" role="alert"><?php echo _p("AlertText"); ?></div>
		<form class="form-horizontal" action="<?php echo $my_url.$sort_url; ?>" enctype="multipart/form-data" method="post" name="mainform" id="mainform">
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn1"); ?> *:</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="menu_name" id="menu_name"/>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar50"); ?></span>
              </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn2"); ?></label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="menu_name_en" id="menu_name_en"/>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar50"); ?></span>
            </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("MenuColumn3"); ?></label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="menu_link" id="menu_link"  data-toggle="tooltip" title="Тухайн цэсний мэдээ бүтэн гарах бол ?cat=4&type=цэсний нэр байна. Тухайн цэсний мэдээ жагсаалт байдлаар гарах бол ?cat=5&type=цэсний нэр байна."/>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar50"); ?></span>
            </div>
            <input type="hidden" id="insertmenubttn" name="insertmenubttn" value="0"/>
            <div class="form-group row col-md-10 justify-content-center">
              <div>
                <button type="button" class="btn btn-success" onclick="addsubmitform()"><i class="fa fa-save"></i> <?php echo _p("SaveButton");?></button>
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
