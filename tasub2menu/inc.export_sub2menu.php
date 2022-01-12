<?php 
if ($sess_profile==1 || $db->isGroupRole($schemas, $sess_profile, $sess_user_id, 1, 1)) 
{
?>
<script language="JavaScript" type="text/javascript">
function excelsubmitform(){
	document.getElementById("excelbttn").value = "1";
	document.getElementById("shpbttn").value = "0";
	document.mainform.submit();
}
</script>

<div class="card shadow mb-4">
	<!-- Card Header - Accordion -->
	<a href="#collapseExcel" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseExcel">
	  <h6 class="m-0 font-weight-bold text-primary"><?php echo _p("ExportButton"); ?></h6>
	</a>
	<!-- Card Content - Collapse -->
	<div class="collapse show" id="collapseExcel">
		<div class="card-body">
          <form class="form" role="form" action="<?php echo $my_url; ?>" method="post" name="mainform" id="mainform">
            <div class="form-row">
              <div class="form-group row col-md-8">
                <label class="col-md-3 col-form-label"><?php echo _p("SearchMenuColumn1"); ?>:</label>
                <div class="col-md-5">
                  <?php
					$selQuery = "SELECT * FROM tamenu_main ORDER BY menu_name ASC";
					$rows = $db->query($selQuery);
					echo seldatadb("search_menu_id", "form-control", $rows, "menu_id", "menu_name", $search_menu_id, "", "Бүх төрөл");
					?>
                </div>
              </div>
            </div>	
            <input type="hidden" id="excelbttn" name="excelbttn" value="0"/>
            <div class="form-row">
              <div class="form-group row col-md-6 justify-content-center">
			    <div>
                <button type="button" class="btn btn-success" onclick="excelsubmitform()"><i class="fa fa-bar-chart"></i> <?php echo _p("ExcelButton");?></button>
				 <a class="btn btn-warning" href="<?php echo $my_url.$my_page.$search_url.$sort_url; ?>"><i class="fa fa-undo"></i> <?php echo _p("BackButton");?></a> </div>
              </div>
            </div>			
          </form>
		</div>
	</div>
</div>
<?php 
} else {
	show_notification("error", _p("NotAccessText"), "");
}
?>