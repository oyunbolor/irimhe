
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
                <label class="col-md-4 col-form-label"><?php echo _p("UsersSearchText1"); ?>:</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="search_login_name" id="search_login_name" value="<?php echo $search_login_name;?>"/>
                </div>
              </div>
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label"><?php echo _p("UsersSearchText2"); ?>:</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="search_lastname" id="search_lastname" value="<?php echo $search_lastname;?>"/>
                </div>
              </div>           
            </div>
            <div class="form-row">
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label"><?php echo _p("UsersSearchText3"); ?>:</label>
                <div class="col-md-6">
                  <?php
					echo seldata("search_profile", "form-control", $USER_PROFILE, $search_profile, "", _p("AllTypes"));
					?>
                </div>
              </div>
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label"><?php echo _p("UsersSearchText4"); ?>:</label>
                <div class="col-md-6">
                  <?php
					$selQuery = "SELECT tg.group_id, tg.group_name group_name_mn, tg.group_name_en FROM ".$schemas.".tagroups tg ORDER BY tg.group_name ASC";
					$rows = $db->query($selQuery);
					echo seldatadb("search_group_id", "form-control", $rows, "group_id", "group_name_$language_name", $search_group_id, "", _p("AllGroups"));
					?>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group row col-md-10 justify-content-end">
                <button type="submit" class="btn btn-primary" name="searchuserbttn"><i class="fa fa-search"></i> <?php echo _p("SearchButton"); ?></button>
              </div>
            </div>
          </form>
		</div>
	</div>
</div>