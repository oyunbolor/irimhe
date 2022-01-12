<?php
if ($sess_profile==1 || $db->isGroupRole($sess_profile, $sess_user_id, 4, 2))
{
?>
<script language="JavaScript" type="text/javascript">
function addsubmitform(){
	if (document.getElementById("title").value==""){
		alert( "Гарчиг оруулна уу" );
	}else {
		document.getElementById("insertimagebttn").value = "1";
		document.mainform.submit();
	}
}
</script>

<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th><?php echo _p("AddText5")." "._p("HomeImage")." "._p("AddText6"); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><form class="form-horizontal" action="<?php echo $my_url.$sort_url; ?>" enctype="multipart/form-data" method="post" name="mainform" id="mainform">
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("HomeAddColumn1"); ?> </label>
              <div class="col-md-4">
                <?php
								echo seldata("language", "form-control", $LANGUAGE, 1);
								?>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextSelect"); ?></span> </div>
              </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("HomeAddColumn2"); ?></label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="title"  id="title"/>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar250"); ?></span> 
            </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("HomeAddColumn3"); ?></label>
              <div class="col-md-4">
					<input type="file" name="image" id="image" />
				</div>
				<span class="col-md-3 form-text text-muted"><?php echo _p("AlertImage"); ?></span>
            </div>
            <input type="hidden" id="insertimagebttn" name="insertimagebttn" value="0"/>
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
