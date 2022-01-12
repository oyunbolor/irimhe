<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container" style="width: 1200px">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarLinks" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarLinks" class="collapse navbar-collapse">
	
        <ul class="nav navbar-nav">
			<li class="nav-item active">
				  <a class="nav-link" href="index.php"><i class="fa fa-home"></i></a>
			</li>
          <?php
                $selQuery = "SELECT  menu_name menu_name_mn, menu_name_en, menu_id, menu_link FROM tamenu_main ORDER BY location";
                $rows = $db->query($selQuery);
                for ($i = 0; $i < sizeof($rows); $i++) {
                    $selQuery_sub = "SELECT sub_name sub_name_mn, sub_name_en, sub_link, sub_id, menu_id  FROM tamenu_sub WHERE menu_id=" . $rows[$i]['menu_id'];
                    $pro_row = $db->query($selQuery_sub);
					
                    if (!empty($pro_row)) {
                        ?>
          <li class="nav-item dropdown @@blogs"> 
		  <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><?php echo $rows[$i]["menu_name_$language_name"]; ?> </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php
                                for ($j = 0; $j < sizeof($pro_row); $j++) {
                                    $selQuery_subsub = "SELECT sub_name2 sub_name2_mn, sub_name_en2 sub_name2_en, sub_link2 FROM tamenu_sub2 WHERE sub_id=" . $pro_row[$j]['sub_id'];
									$sub_row = $db->query($selQuery_subsub);
                                    if (!empty($sub_row)) {
                                        ?>
              <li class="dropdown dropdown-submenu dropright"> 
			  <a class="dropdown-item dropdown-toggle" href="#!" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $pro_row[$j]["sub_name_$language_name"]; ?></a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php
                                                for ($k = 0; $k < sizeof($sub_row); $k++) {
                                                    ?>
                  <li><a class="dropdown-item" href="<?php echo $sub_row[$k]['sub_link2']; ?>"><?php echo $sub_row[$k]["sub_name2_$language_name"]; ?></a></li>
                  <?php
                                                }
                                                ?>
                </ul>
              </li>
              <?php
                                    } else if (empty($sub_row)) {
                                        ?>
              <li><a class="dropdown-item" href="<?php echo $pro_row[$j]['sub_link']; ?>"><?php echo $pro_row[$j]["sub_name_$language_name"]; ?></a></li>
              <?php
                                    }
                                }
                                ?>
            </ul>
          </li>
          <?php
                    } else if (empty($pro_row)) {
                        ?>
          <li class="nav-item active"><a class="nav-link" href="<?php echo $rows[$i]['menu_link']; ?>" target="_blank"><?php echo $rows[$i]["menu_name_$language_name"]; ?></a></li>
          <?php
                    }
                }
                ?>
        </ul>
      </div>
  </div>
</nav>
<!--End Main Header -->