<?php 
if ($sess_profile==1 || $db->isGroupRole($sess_profile, $sess_user_id, 3, 2)) 
{ 
?>
<script language="JavaScript" type="text/javascript">
function addsubmitform(){
	if (document.getElementById("title").value==""){
		alert( "Гарчиг оруулна уу" );
	}else if (document.getElementById("menuname").value==""){
		alert( "Үндсэн цэс оруулна уу" );
	}else {
		document.getElementById("insertnewsbttn").value = "1";
		document.mainform.submit();
	}
}
</script>

<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th><?php echo _p("AddText5")." "._p("News")." "._p("AddText6"); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><div class="alert alert-warning" role="alert"><?php echo _p("AlertText"); ?></div>
          <form class="form" role="form" action="<?php echo $my_url.$search_url.$sort_url; ?>" enctype="multipart/form-data" method="post" name="mainform" id="mainform">
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("NewsAddColumn1"); ?> *:</label>
              <div class="col-md-4">
                <?php
					echo seldata("language", "form-control", $LANGUAGE, 1);
				?>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextSelect"); ?></span> </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("NewsAddColumn2"); ?> *:</label>
              <div class="col-md-4">
                <?php
					$selQuery = "SELECT * FROM tamenu_main ORDER BY menu_name ASC";
					$rows = $db->query($selQuery);
					echo seldatadb("menuname", "form-control", $rows, "menu_id", "menu_name",  "", "", "Үндсэн цэсээ сонгоно уу" );
					$menuname = 0;
					?>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextSelect"); ?></span> </div>
			<div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("NewsAddColumn3"); ?> *:</label>
              <div class="col-md-4">
               <?php
					$selQuery = "SELECT tams.sub_id, tams.sub_name FROM tamenu_sub tams WHERE tams.menu_id = ".$menuname." ORDER BY tams.menu_id ASC, tams.sub_name ASC";
					$rows = $db->query($selQuery);
					$submenu = 0;
					if(!empty($rows))
						echo seldatadb("subname", "form-control", $rows, "sub_id", "sub_name", $rows[0]["sub_id"]);
					else
						echo seldatadb("subname", "form-control", $rows, "sub_id", "sub_name", "", "", "Дэд цэсээ сонгоно уу" );
					?>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextSelect"); ?></span> </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("NewsAddColumn4"); ?> *:</label>
              <div class="col-md-4">
                <?php
					$selQuery = "SELECT tam2.sub_id, tam2.sub_name2 FROM tamenu_sub2 tam2 WHERE tam2.sub_id = ".$submenu." ORDER BY tam2.sub_id ASC, tam2.sub_name2 ASC";
					$rows = $db->query($selQuery);
					if(!empty($rows))
						echo seldatadb("subname2", "form-control", $rows, "sub_id", "sub_name2", $rows[0]["sub_id"]);
					else
						echo seldatadb("subname2", "form-control", $rows, "sub_id", "sub_name2", "", "", "Дэд цэсээ сонгоно уу" );
					?>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextSelect"); ?></span> </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("NewsAddColumn5"); ?> *:</label>
              <div class="col-md-4">
				<textarea class="form-control"  rows="4" name="title" id="title"></textarea>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar250"); ?></span> </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("NewsAddColumn6"); ?> *:</label>
              <div class="col-md-4">
                <textarea class="form-control"  rows="4" name="abstract" id="abstract"></textarea>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar255"); ?></span> </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("NewsAddColumn7"); ?> *:</label>
              <div class="col-md-4">
                <input type="file" name="news_image" id="news_image" />
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertImage"); ?></span> </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("NewsAddColumn8"); ?> *:</label>
              <div class="col-md-6">
                <textarea  class="ckeditor"  rows="4" name="content" id="content"></textarea>
              </div></div>
			</div>
            <input type="hidden" id="insertnewsbttn" name="insertnewsbttn" value="0"/>
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
	show_notification("error", _p("NotAccessText"), "");
}
?>



