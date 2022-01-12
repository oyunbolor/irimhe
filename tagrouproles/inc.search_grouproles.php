
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
                <label class="col-md-4 col-form-label"><?php echo _p("GroupRolesColumn1");?>:</label>
                <div class="col-md-6">
                  <?php
					$selQuery = "SELECT tag.group_id, tag.group_name group_name_mn, tag.group_name_en FROM ".$schemas.".tagroups tag ORDER BY tag.group_name";
					$row = $db->query($selQuery);
					echo seldatadb("search_group_id", "form-control", $row, "group_id", "group_name_$language_name", $search_group_id, "", _p("AllGroups"));
					?>
                </div>
              </div>
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label"><?php echo _p("GroupRolesColumn2");?>:</label>
                <div class="col-md-6">
                  <?php
					echo seldata("search_role_id", "form-control", $ROLE_TYPE, $search_role_id, "", _p("AllRoles"));
					?>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label"><?php echo _p("GroupRolesColumn3");?>:</label>
                <div class="col-md-6">
                  <?php
					echo seldata("search_item_id", "form-control", $ITEM_TYPE, $search_item_id, "", _p("AllDatasets"));
					?>
                </div>
              </div>
              <div class="form-group row col-md-4 justify-content-end">
                  <button type="submit" class="btn btn-primary" name="searchgrouprolebttn"><i class="fa fa-search"></i> <?php echo _p("SearchButton"); ?></button>
              </div>
            </div>
          </form>
		</div>
	</div>
</div>
