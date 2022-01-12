

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
                <label class="col-md-4 col-form-label"><?php echo _p("SearchMenuColumn1");?>:</label>
                <div class="col-md-6">
                  <?php
					$selQuery = "SELECT * FROM tamenu_main ORDER BY menu_name ASC";
					$rows = $db->query($selQuery);
					echo seldatadb("search_menu_id", "form-control", $rows, "menu_id", "menu_name", $search_menu_id, "", "Бүх төрөл");
					?>
                </div>
              </div>
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label"><?php echo _p("SubMenuColumn1"); ?>:</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="search_submenu_name" id="search_submenu_name" value="<?php echo $search_submenu_name;?>"/>
                </div>
              </div>
            </div>
			<div class="form-row">
              <div class="form-group row col-md-6">
                <label class="col-md-4 col-form-label"><?php echo _p("SubMenuColumn2"); ?>:</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="search_menu_name_en" id="search_menu_name_en" value="<?php echo $search_menu_name_en;?>"/>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group row col-md-10 justify-content-end">
                  <button type="submit" class="btn btn-primary" name="searchsubmenubttn"><i class="fa fa-search"></i> <?php echo _p("SearchButton"); ?></button>
              </div>
            </div>
          </form>
		</div>
	</div>
</div>
