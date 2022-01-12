<?php
if ($sess_profile==1 || $db->isGroupRole($sess_profile, $sess_user_id, 3, 2))
{
	if (isset($_GET["id"])) 
	{
		$id = (int) $_GET["id"];
	} else
	{
		$id = 0;
	}

	$i = 0;
	$startQuery = "SELECT";
	$valueQuery = "mei.* FROM tamenu_info mei";

	if ($sess_profile == 1)
		$whereQuery = "WHERE  mei.id=" . $id;
	else
		$whereQuery = "WHERE mei.id = " . $id . " AND  mei.user_id = " . $sess_user_id;

	$selQuery = $startQuery." ".$valueQuery." ".$whereQuery;

	$row = $db->query($selQuery);
	if (!empty($row))
	{
	?>
<script language="JavaScript" type="text/javascript">
	function updatesubmitform(){
		if (document.getElementById("title").value==""){
			alert( "Гарчиг оруулна уу" );
		}else if (document.getElementById("menuname").value==""){
			alert( "Үндсэн цэс оруулна уу" );
		}else {
			document.getElementById("updatenewsbttn").value = "1";
			document.mainform.submit();
		}
	}
	</script>
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th><?php echo _p("EditText3")." "._p("News")." "._p("EditText4"); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><div class="alert alert-warning" role="alert"><?php echo _p("AlertText"); ?></div>
          <form class="form" role="form" action="<?php echo $my_url.$my_page.$search_url.$sort_url; ?>" enctype="multipart/form-data" method="post" name="mainform" id="mainform">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $row[$i]["user_id"]; ?>">
            <input type="hidden" name="id" id="id" value="<?php echo $row[$i]["id"]; ?>">
            <?php 
				if($sess_profile==1)
				{
				?>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("NewsAddColumn1"); ?> :</label>
              <div class="col-md-4">
                <?php
									echo seldata("language", "form-control", $LANGUAGE, $row[$i]["language"]);
									?>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextSelect"); ?></span> </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("NewsAddColumn2"); ?> :</label>
              <div class="col-md-4">
                <?php
						$selQuery = "SELECT * FROM tamenu_main ORDER BY menu_name ASC";
						$rows = $db->query($selQuery);
						if(!empty($row))
								echo seldatadb("menuname", "form-control", $rows, "menu_id", "menu_name", $row[$i]["menu_id"]);
							else
								echo seldatadb("menuname", "form-control", $rows, "menu_id", "menu_name", NULL);
						$menuid=$row[$i]["menu_id"];
						?>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextSelect"); ?></span> </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("NewsAddColumn3"); ?> :</label>
              <div class="col-md-4">
                <?php
						$selQuery = "SELECT * FROM tamenu_sub mes WHERE mes.menu_id =". $menuid." ORDER BY sub_name ASC";
						$rows = $db->query($selQuery);
						if(!empty($row))
							echo seldatadb("subname", "form-control", $rows, "sub_id", "sub_name", $row[$i]["sub_id"]);
						else
							echo seldatadb("subname", "form-control",  $rows, "sub_id", "sub_name", NULL);
						$subid=$row[$i]["sub_id"];
						?>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextSelect"); ?></span> </div>
            <?php
				} 
            ?>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("NewsAddColumn4"); ?> :</label>
              <div class="col-md-4">
                <?php
						$selQuery = "SELECT * FROM tamenu_sub2 mes WHERE mes.sub_id =". $subid." ORDER BY sub_name2 ASC";
						$rows = $db->query($selQuery);
						if(!empty($row))
							echo seldatadb("subname2", "form-control", $rows, "sub2_id", "sub_name2", $row[$i]["sub2_id"]);
						else
							echo seldatadb("subname2", "form-control",  $rows, "sub2_id", "sub_name2", NULL);
					?>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextSelect"); ?></span> </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("NewsAddColumn5"); ?> *:</label>
              <div class="col-md-6">
				<textarea class="form-control" rows="4" name="title" id="title"><?php echo $row[$i]["title"]; ?></textarea>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar250"); ?></span> </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("NewsAddColumn6"); ?> :</label>
              <div class="col-md-6">
                <textarea class="form-control" rows="4" name="abstract" id="abstract"><?php echo $row[$i]["abstract"]; ?></textarea>
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar150"); ?></span> </div>
            <div class="form-group row col-md-12">
              <label class="col-md-3 col-form-label"><?php echo _p("NewsAddColumn7"); ?>:</label>
              <div class="col-md-6">
                <input type="file" name="news_image" id="news_image" />
              </div>
              <span class="col-md-3 form-text text-muted"><?php echo _p("AlertImage"); ?>
			  <?php if(!empty($row[$i]["news_image"])) { ?>
              <p class="help-block">Зургийн <a href="<?php echo $row[$i]["news_image"]; ?>" target="_blank"><img src="<?php echo $row[$i]["news_image"]; ?>" width="80"/></a> файл байна. </p>
              <?php } ?></span> </div>
			  <input type="hidden" id="news_image" name="news_image" value="<?php echo $row[$i]["news_image"]; ?>"/>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3"><?php echo _p("NewsAddColumn8"); ?> *:</label>
              <div class="col-md-6">
                <textarea id="editor" class="form-control ckeditor" rows="3" name="content" id="content" value="<?php echo $row[$i]["content"]; ?>"></textarea>
              </div></div>
            <input type="hidden" id="updatenewsbttn" name="updatenewsbttn" value="0"/>
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
	$notify = "Таны хайсан мэдээлэл байхгүй байна. <a href=\"" . $my_url . $my_page . $search_url . $sort_url . "\">Буцах</a>";
	show_notification("error", "", $notify);
	}
} else {
	$notify = "Таны хандалт буруу байна.";
	show_notification("error", "", $notify);
}
?>