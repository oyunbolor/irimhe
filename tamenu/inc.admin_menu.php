<h1 class="h3 mb-4 text-gray-800"><?php echo _p("MenuTitle"); ?></h1>
    <div class="row">
    	<div class="col">
			<?php
			if($sess_profile==1) 
			{		  
				$my_url .= "?menuitem=".$menuitem;
				
				$count = (isset($_POST["count"]) && (int) $_POST["count"] > 0) ? (int) $_POST["count"] : ((isset($_GET["count"]) && (int) $_GET["count"] > 0) ? (int) $_GET["count"] : 10);
				$my_count = $my_url;
				$my_url .= "&count=".$count;
					
				if (isset($_GET["action"]))
				{
					$action = pg_prep($_GET["action"]);
				}else
				{
					$action = "";
				}
				
				if (isset($_POST["insertmenubttn"]) && (int) $_POST["insertmenubttn"]==1)
				{
					if (isset($_POST["menu_name"]) && isset($_POST["menu_name_en"]))
					{
							$fields = array("menu_name", "menu_name_en", "menu_link");

							$checkvalues = array(pg_prep($_POST["menu_name"]), pg_prep($_POST["menu_name_en"]), pg_prep($_POST["menu_link"]));
							$values = array();
							for ($i = 0; $i < sizeof($checkvalues); $i++) {
								$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'" . $checkvalues[$i] . "'");
							}
				
							$result = $db->insert("tamenu_main", $fields, $values);
							if(! $result)
								show_notification("error", _p("DeleteText1"), "");
							else
								show_notification("success", _p("DeleteText2"), "");
					}
				}
				
				if (isset($_POST["updatemenubttn"]) && (int) $_POST["updatemenubttn"]==1)
				{
					if (isset($_POST["menu_name"]) && isset($_POST["menu_name_en"]) && isset($_POST["menu_id"]))
					{
							$wherevalues = "menu_id=".(int) $_POST["menu_id"];
							
							$fields = array("menu_name", "menu_name_en", "menu_link");
							$checkvalues = array(pg_prep($_POST["menu_name"]), pg_prep($_POST["menu_name_en"]), pg_prep($_POST["menu_link"]));

							$values = array();
							for ($i=0; $i<sizeof($checkvalues); $i++)
							{
								$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'".$checkvalues[$i]."'");
							}
						
							$result = $db->update("tamenu_main", $fields, $values, $wherevalues);
							if(! $result)
								show_notification("error", _p("DeleteText1"), "");
							else
								show_notification("success", _p("DeleteText2"), "");
					}
				}	

				if (($action=="delete") && isset($_GET["menu_id"]))
				{
					$wherevalues = "menu_id=".(int) $_GET["menu_id"];
				
					$db->delete(".tamenu_main",$wherevalues);
					
					$result = $db->delete("tamenu_main", $wherevalues);
					if(! $result)
						show_notification("error", _p("DeleteText1"), "");
					else
						show_notification("success", _p("DeleteText2"), "");
				}
				
				$page = (isset($_GET["page"]) && (int) $_GET["page"] > 0) ? (int) $_GET["page"] : 1;
				$my_page = "&page=".$page;
				
				$searchQuery = "";
				$search_url = "";
				
				$search_menu_id = (isset($_GET["search_menu_id"])) ? (int) $_GET["search_menu_id"] : 0;
				if($search_menu_id==0)
				{
					$searchQuery .= "";
					$search_url .= "";
				} else
				{
					$searchQuery .= " AND tamm.menu_id = ".$search_menu_id;
					$search_url .= "&search_menu_id=".$search_menu_id;
					
				}
										
				$search_menu_name = (isset($_POST["search_menu_name"])) ? (pg_prep($_POST["search_menu_name"])) : "";
	
				if ($search_menu_name == "") 
				{
					$searchQuery .= "";
					$search_url .= "";
				} else 
				{
					$searchQuery .= " AND lower(tamm.menu_name) LIKE lower('%".$search_menu_name."%')";
					$search_url .= "&search_menu_name=".$search_menu_name;
				}
				
				$search_menu_name_en = (isset($_POST["search_menu_name_en"])) ? pg_prep($_POST["search_menu_name_en"]) : "";
				if(empty($search_menu_name_en))
				{
					$searchQuery .= "";
					$search_url .= "";
				}else
				{
					$searchQuery .= " AND lower(tamm.menu_name_en) LIKE lower('%".$search_menu_name_en."%')";
					$search_url .= "&search_menu_name_en=".$search_menu_name_en;
				}	
				$sort_url = "";
				$sort = (isset($_GET["sort"])) ? (int) $_GET["sort"] : 0;
				$sort_type = (isset($_GET["sorttype"])) ? (int) $_GET["sorttype"] : 0;
				
				if($sort == 0)
					$sort_url .= "";
				else
					$sort_url .= "&sort=".$sort;
				
				if($sort_type == 0)
					$sort_url .= "";
				else
					$sort_url .= "&sorttype=".$sort_type; 		
					
				if ($action=="edit")
				{
					require("tamenu/inc.edit_menu.php");
				}elseif ($action=="export")
				{
					require("tamenu/inc.export_menu.php");
				}elseif ($action=="add")
				{
					require("tamenu/inc.add_menu.php");
				}else
				{
					require("tamenu/inc.list_menu.php");
				}
			} else {
				show_notification("error", _p("NotAccessText"), "");
			}
		?>
</div>
    </div>
