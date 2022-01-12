<h1 class="h3 mb-4 text-gray-800"><?php echo _p("Sub2MenuTitle"); ?></h1>
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
				
				if (isset($_POST["insertsubmenu2bttn"]) && (int) $_POST["insertsubmenu2bttn"]==1)
				{
					if (isset($_POST["sub_name2"]) && isset($_POST["sub_name_en2"]))
					{
							$fields = array("sub_id", "sub_name2", "sub_name_en2", "sub_link2");

							$checkvalues = array((int) $_POST["subname"], pg_prep($_POST["sub_name2"]), pg_prep($_POST["sub_name_en2"]), pg_prep($_POST["sub_link2"]));
							$values = array();
							for ($i = 0; $i < sizeof($checkvalues); $i++) {
								$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'" . $checkvalues[$i] . "'");
							}
				
							$result = $db->insert("tamenu_sub2", $fields, $values);
							if (!$result)
								show_notification("error", "", "Нэмэх явцад алдаа гарлаа. Та дахин оролдоно уу.");
							else
								show_notification("success", "", "Таны мэдээлэл амжилттай нэмэгдлээ.");
					}
				}
				if (isset($_POST["updatesub2menubttn"]) && (int) $_POST["updatesub2menubttn"]==1)
				{
					if (isset($_POST["sub_name2"]) && isset($_POST["sub_name_en2"]) && isset($_POST["sub2_id"]))
					{
							$wherevalues = "sub2_id=".(int) $_POST["sub2_id"];
							
							$fields = array("sub_id", "sub_name2", "sub_name_en2", "sub_link2");
							$checkvalues = array((int) $_POST["subname"], pg_prep($_POST["sub_name2"]), pg_prep($_POST["sub_name_en2"]), pg_prep($_POST["sub_link2"]));

							$values = array();
							for ($i=0; $i<sizeof($checkvalues); $i++)
							{
								$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'".$checkvalues[$i]."'");
							}
						
							$result = $db->update("tamenu_sub2", $fields, $values, $wherevalues);
							if(! $result)
								show_notification("error", "", "Өөрчлөх явцад алдаа гарлаа. Та дахин оролдоно уу.");
							else
								show_notification("success", "", "Таны мэдээлэл амжилттай засагдлаа.");
					}
				}	

				if (($action == "delete") && isset($_GET["sub2_id"])) 
				{
					$sub2_id = (int) $_GET["sub2_id"];
					if($sess_profile==1){
						$wherevalues = "sub2_id = " . $sub2_id;
					}
					$result = $db->delete("" . "tamenu_sub2", $wherevalues);
					if (!$result)
						show_notification("error", "", "Устгах явцад алдаа гарлаа. Та дахин оролдоно уу.");
					else
						show_notification("success", "", "Таны мэдээлэл амжилттай устлаа.");
				}
				
				$page = (isset($_GET["page"]) && (int) $_GET["page"] > 0) ? (int) $_GET["page"] : 1;
				$my_page = "&page=".$page;
				
				$searchQuery = "";
				$search_url = "";
				
				$search_menu_id = (isset($_POST["search_menu_id"])) ? (int) $_POST["search_menu_id"] : 0;

				if($search_menu_id==0)
				{
					$searchQuery .= "";
					$search_url .= "";
				} else
				{
					$searchQuery .= " AND tams.menu_id = ".$search_menu_id;
					$search_url .= "&search_menu_id=".$search_menu_id;
					
				}
				
				$search_submenu_name = (isset($_POST["search_submenu_name"])) ? (pg_prep($_POST["search_submenu_name"])) : "";
	
				if ($search_submenu_name == "") 
				{
					$searchQuery .= "";
					$search_url .= "";
				} else 
				{
					$searchQuery .= " AND lower(tams.sub_name) LIKE lower('%".$search_submenu_name."%')";
					$search_url .= "&search_submenu_name=".$search_submenu_name;
				}
				
				$search_menu_name_en = (isset($_POST["search_menu_name_en"])) ? pg_prep($_POST["search_menu_name_en"]) : "";
				if(empty($search_menu_name_en))
				{
					$searchQuery .= "";
					$search_url .= "";
				}else
				{
					$searchQuery .= " AND lower(tams.sub_name_en) LIKE lower('%".$search_menu_name_en."%')";
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
					
				if ($action=="sub2edit")
				{
					require("tasub2menu/inc.edit_sub2menu.php");
				}elseif ($action=="export")
				{
					require("tasub2menu/inc.export_sub2menu.php");
				}elseif ($action=="sub2add")
				{
					require("tasub2menu/inc.add_sub2menu.php");
				}else
				{
					require("tasub2menu/inc.list_sub2menu.php");
				}
			} else {
				show_notification("error", _p("NotAccessText"), "");
			}
		?>
</div>
    </div>
