<?php
if ($sess_profile==1 || $db->isGroupRole($sess_profile, $sess_user_id, 4, 2))
{
	if (isset($_GET["image_id"])) 
	{
		$image_id = (int) $_GET["image_id"];
	} else
	{
		$image_id = 0;
	}

	$i = 0;
	$startQuery = "SELECT";
	$valueQuery = "hoi.* FROM tahome_image hoi";

	if ($sess_profile == 1)
		$whereQuery = "WHERE  hoi.image_id=" . $image_id;
	else
		$whereQuery = "WHERE hoi.image_id = " . $image_id . " AND  hoi.user_id = " . $sess_user_id;

	$selQuery = $startQuery." ".$valueQuery." ".$whereQuery;

	$row = $db->query($selQuery);
	if (!empty($row))
	{
	?>
<script language="JavaScript" type="text/javascript">
function updatesubmitform(){
		if (document.getElementById("title").value==""){
			alert( "Гарчиг оруулна уу" );
		}else {
			document.getElementById("updateimagebttn").value = "1";
			document.mainform.submit();
		}
	}
</script>

<div class="table-responsive">
  <table class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th><?php echo _p("EditText3")." "._p("AddMenuTitle")." "._p("EditText4"); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
		<form class="form" role="form" action="<?php echo $my_url.$my_page.$search_url.$sort_url; ?>" enctype="multipart/form-data" method="post" name="mainform" id="mainform">
            <input type="hidden" name="image_id" id="image_id" value="<?php echo $row[$i]["image_id"]; ?>">
			<input type="hidden" name="user_id" id="user_id" value="<?php echo $row[$i]["user_id"]; ?>">
			<div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn1"); ?> *:</label>
              <div class="col-md-4">
                <?php
						echo seldata("language", "form-control", $LANGUAGE, $row[$i]["language"]);
						?>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextSelect"); ?></span>
              </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn2"); ?> *:</label>
              <div class="col-md-4">
                <input type="text" class="form-control" name="title"  id="title" value="<?php echo $row[$i]["title"]; ?>"/>
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertTextChar250"); ?></span> 
            </div>
            <div class="form-group row col-md-12">
              <label class="col-form-label col-md-3 text-danger"><?php echo _p("MenuColumn3"); ?> *:</label>
              <div class="col-md-4">
               <input type="file" name="image" id="image" />
              </div>
			  <span class="col-md-3 form-text text-muted"><?php echo _p("AlertImage"); ?></span>
			  <?php if(!empty($row[$i]["file_pathname"])) { ?>
			  <p class="help-block">Зургийн <a href="<?php echo $row[$i]["file_pathname"]; ?>" target="_blank"><img src="<?php echo $row[$i]["file_pathname"]; ?>" width="80"/></a> файл байна. </p>
              <?php } ?>
			  <input type="hidden" id="file_pathname" name="file_pathname" value="<?php echo $row[$i]["file_pathname"]; ?>"/>
            </div>
            <input type="hidden" id="updateimagebttn" name="updateimagebttn" value="0"/>
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
