

<div class="card shadow mb-4">
	<!-- Card Header - Accordion -->
	<a href="#collapseSearch" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseSearch">
	  <h6 class="m-0 font-weight-bold text-primary"><?php echo _p("SearchTitle"); ?></h6>
	</a>
	<!-- Card Content - Collapse -->
	<div class="collapse show" id="collapseSearch">
		<div class="card-body">
          <form class="form" role="form" action="<?php echo $my_url; ?>" method="post" name="mainform" id="mainform">
            <div class="form-row">
              <div class="form-group row col-md-6">
                <label class="col-md-5 col-form-label"><?php echo _p("MetadataSearchText1"); ?>:</label>
                <div class="col-md-6">
                  <?php
					echo seldata("metadata_id", "form-control", $METADATA_TYPE, $metadata_id, 1);
					?>
                </div>
              </div>
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label"><?php echo _p("MetadataSearchText2");?>:</label>
                <div class="col-md-6">
                  <?php
					echo seldata("table_id", "form-control", $TABLE_ID, $table_id, "", _p("AllDatasets"));
					?>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group row col-md-10">
                <label class="col-md-3 col-form-label"><?php echo _p("MetadataSearchText3"); ?>:</label>
                <div class="col-md-3">
                  <input type="text" class="form-control" name="action_date1" id="action_date1" value="<?php echo $action_date1;?>"/>
                </div>
                <label class="col-form-label">-</label>
                <div class="col-md-3">
                  <input type="text" class="form-control" name="action_date2" id="action_date2" value="<?php echo $action_date2;?>"/>
                </div>
              </div>
            </div>
			<div class="form-row">
              <div class="form-group row col-md-6">
                <label class="col-md-5 col-form-label"><?php echo _p("MetadataColumn4");?>:</label>
                <div class="col-md-6">
                  <?php
					$selQuery = "SELECT tau.user_id, tau.organization||' - '||tau.lastname as user_name FROM ".$schemas.".tausers tau WHERE tau.profile!=3 ORDER BY tau.profile, tau.organization, tau.lastname";
					$row = $db->query($selQuery);
					echo seldatadb("user_id", "form-control", $row, "user_id", "user_name",  $user_id, "", _p("AllUsers"));
					?>
                </div>
              </div>
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label"><?php echo _p("MetadataColumn5"); ?>:</label>
                <div class="col-md-6">
                  <?php
					$selQuery = "SELECT tag.group_id, tag.group_name group_name_mn, tag.group_name_en FROM ".$schemas.".tagroups tag ORDER BY tag.group_name";
					$row = $db->query($selQuery);
					echo seldatadb("group_id", "form-control", $row, "group_id", "group_name_$language_name", $group_id, "", _p("AllGroups"));
					?>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group row col-md-10 justify-content-end">
                <button type="submit" class="btn btn-primary" name="searchmetabttn"><i class="fa fa-search"></i> <?php echo _p("SearchButton"); ?></button>
              </div>
            </div>
          </form>
		</div>
	</div>
</div>
