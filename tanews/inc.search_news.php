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
                <label class="col-md-4 col-form-label"><?php echo _p("SearchNewsColumn1");?>:</label>
                <div class="col-md-6">
                  <?php
					$selQuery = "SELECT * FROM tamenu_main ORDER BY menu_name ASC";
					$rows = $db->query($selQuery);
					echo seldatadb("search_menu_id", "form-control", $rows, "menu_id", "menu_name", $search_menu_id, "", "Бүх төрөл");
					?>
                </div>
              </div>
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label"><?php echo _p("SearchNewsColumn2");?>:</label>
                <div class="col-md-6">
                  <?php
					$selQuery = "SELECT * FROM tamenu_sub ORDER BY sub_name ASC";
					$row = $db->query($selQuery);
					echo seldatadb("search_sub_name", "form-control", $row, "sub_id", "sub_name",  $search_sub_name, "", "Бүх төрөл");
					?>
                </div>
              </div>
            </div>
			<div class="form-row">
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label"><?php echo _p("SearchNewsColumn3");?>:</label>
                <div class="col-md-6">
                  <?php
					$selQuery = "SELECT * FROM tamenu_sub2 ORDER BY sub_name2 ASC";
					$row = $db->query($selQuery);
					echo seldatadb("search_sub_name2", "form-control", $row, "sub2_id", "sub_name2",  $search_sub_name2, "", "Бүх төрөл");
					?>
                </div>
              </div>
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label"><?php echo _p("SearchNewsColumn4");?>:</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="search_title" id="search_title" value="<?php echo $search_title;?>"/>
                </div>
              </div>
            </div>
			<div class="form-row">
				  <div class="form-group row col-md-6">
					<label class="col-md-4 col-form-label"><?php echo _p("SearchNewsColumn5");?>:</label>
					<div class="col-md-6">
						<?php
							if($sess_profile==1)
								$selQuery = "SELECT tau.user_id, tau.name FROM tauser tau ORDER BY tau.profile, tau.name";
							else
								$selQuery = "SELECT tau.user_id, tau.name FROM tauser tau WHERE tau.user_id = ".$sess_user_id." ORDER BY tau.profile, tau.name";
			
							$row = $db->query($selQuery);
							echo seldatadb("search_user_id", "form-control", $row, "user_id", "name",  $search_user_id, "", "Бүх хэрэглэгч");
							?>
					</div>
				  </div>
				<?php
				if($sess_profile==1)
				{
				?>
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label"><?php echo _p("SearchNewsColumn6");?>:</label>
                <div class="col-md-6">
                  <?php
						$selQuery = "SELECT tag.group_id, tag.group_name FROM tagroups tag ORDER BY tag.group_name";
						$row = $db->query($selQuery);
						echo seldatadb("search_group_id", "form-control", $row, "group_id", "group_name", $search_group_id, "", "Бүх бүлэг");
						?>
                </div>
              </div>
			  <?php
				}
				?>
            </div>
            <div class="form-row">
              <div class="form-group row col-md-10 justify-content-end">
                  <button type="submit" class="btn btn-primary" name="searchnewsbttn"><i class="fa fa-search"></i> <?php echo _p("SearchButton"); ?></button>
              </div>
            </div>
          </form>
		</div>
	</div>
</div>









