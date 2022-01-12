<h1 class="h3 mb-4 text-gray-800"><?php echo _p("SubMenuTitle"); ?></h1>
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
				
				if (isset($_POST["insertsubmenubttn"]) && (int) $_POST["insertsubmenubttn"]==1)
				{
					if (isset($_POST["sub_name"]) && isset($_POST["sub_name_en"]))
						{
								$fields = array("menu_id", "sub_name", "sub_name_en", "sub_link");

								$checkvalues = array((int) $_POST["menu_id"], pg_prep($_POST["sub_name"]), pg_prep($_POST["sub_name_en"]), pg_prep($_POST["sub_link"]));
								$values = array();
								for ($i = 0; $i < sizeof($checkvalues); $i++) {
									$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'" . $checkvalues[$i] . "'");
								}
					
								$result = $db->insert("tamenu_sub", $fields, $values);
								if (!$result)
									show_notification("error", "", "Нэмэх явцад алдаа гарлаа. Та дахин оролдоно уу.");
								else
									show_notification("success", "", "Таны мэдээлэл амжилттай нэмэгдлээ.");
						}
				}
				
				if (isset($_POST["updatemenubttn"]) && (int) $_POST["updatemenubttn"]==1)
				{
					if (isset($_POST["sub_name"]) && isset($_POST["sub_name_en"]) && isset($_POST["sub_id"]))
						{
								$wherevalues = "sub_id=".(int) $_POST["sub_id"];
								
								$fields = array("menu_id", "sub_name", "sub_name_en", "sub_link");
								$checkvalues = array((int) $_POST["menu_id"], pg_prep($_POST["sub_name"]), pg_prep($_POST["sub_name_en"]), pg_prep($_POST["sub_link"]));
								$values = array();
								for ($i=0; $i<sizeof($checkvalues); $i++)
								{
									$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'".$checkvalues[$i]."'");
								}
								$result = $db->update("tamenu_sub", $fields, $values, $wherevalues);
								if(! $result)
									show_notification("error", "", "Өөрчлөх явцад алдаа гарлаа. Та дахин оролдоно уу.");
								else
									show_notification("success", "", "Таны мэдээлэл амжилттай засагдлаа.");
						}
				}	

				if (($action=="delete") && isset($_GET["sub_id"]))
				{
					$wherevalues = "sub_id=".(int) $_GET["sub_id"];
				
					$db->delete(".tamenu_sub",$wherevalues);
					
					$result = $db->delete(".tamenu_sub", $wherevalues);
					if(! $result)
						show_notification("error", _p("DeleteText1"), "");
					else
						show_notification("success", _p("DeleteText2"), "");
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
					
				if ($action=="editsub")
				{
					require("tasubmenu/inc.edit_submenu.php");
				}elseif ($action=="export")
				{
					require("tasubmenu/inc.export_submenu.php");
				}elseif ($action=="addsub")
				{
					require("tasubmenu/inc.add_submenu.php");
				}else
				{
					require("tasubmenu/inc.list_submenu.php");
				}
			} else {
				show_notification("error", _p("NotAccessText"), "");
			}
		?>
</div>
    </div>