	<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo _p("GroupsTitle"); ?></h1>
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
				
				if (isset($_POST["insertgroupbttn"]) && (int) $_POST["insertgroupbttn"]==1)
				{
					if (isset($_POST["group_name"]) && isset($_POST["group_name_en"]))
					{
							$fields = array("group_name", "group_name_en", "description");

							$checkvalues = array(pg_prep($_POST["group_name"]), pg_prep($_POST["group_name_en"]), pg_prep($_POST["description"]));
							$values = array();
							for ($i = 0; $i < sizeof($checkvalues); $i++) {
								$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'" . $checkvalues[$i] . "'");
							}
							
							$result = $db->insert("tagroups", $fields, $values);
							if (!$result)
								show_notification("error", "", "Нэмэх явцад алдаа гарлаа. Та дахин оролдоно уу.");
							else
								show_notification("success", "", "Таны мэдээлэл амжилттай нэмэгдлээ.");
					}
				}
				
				if (isset($_POST["updategroupbttn"]))
				{
					if (isset($_POST["group_name"]) && !empty($_POST["group_name"]))
					{	
						$wherevalues = "group_id=".(int) $_POST["group_id"];
						$fields = array("group_name", "group_name_en", "description");
						$checkvalues = array($_POST["group_name"], $_POST["group_name_en"], $_POST["description"]);
						
						$values = array();
						for ($i=0; $i<sizeof($checkvalues); $i++)
						{
							$values[$i] = (empty($checkvalues[$i]) ? "NULL": "'".$checkvalues[$i]."'");
						}
						
						$result = $db->update(" tagroups", $fields, $values, $wherevalues);
						if(! $result)
							show_notification("error", "", "Өөрчлөх явцад алдаа гарлаа. Та дахин оролдоно уу.");
						else
							show_notification("success", "", "Таны мэдээлэл амжилттай засагдлаа.");
					}
				}	

				if (($action=="delete") && isset($_GET["group_id"]))
				{
					$wherevalues = "group_id=".(int) $_GET["group_id"];
				
					$db->delete(".tausergroups",$wherevalues);
					
					$result = $db->delete(".tagroups", $wherevalues);
					if(! $result)
						show_notification("error", _p("DeleteText1"), "");
					else
						show_notification("success", _p("DeleteText2"), "");
				}
				
				$page = (isset($_GET["page"]) && (int) $_GET["page"] > 0) ? (int) $_GET["page"] : 1;
				$my_page = "&page=".$page;
				
				$searchQuery = "";
				$search_url = "";
				
				$search_group_name = (isset($_GET["search_group_name"])) ? pg_prep($_GET["search_group_name"]) : "";
										
				if(empty($search_group_name))
				{
					$searchQuery .= "";
					$search_url .= "";
				}else
				{
					$searchQuery .= " AND (lower(tag.group_name) LIKE lower('%".$search_group_name."%') OR lower(tag.group_name_en) LIKE lower('%".$search_group_name."%'))";
					$search_url .= "&search_group_name=".$search_group_name;
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
					require("tagroups/inc.edit_groups.php");
				}elseif ($action=="add")
				{
					require("tagroups/inc.add_groups.php");
				}else
				{
					require("tagroups/inc.list_groups.php");
				}
			} else {
				show_notification("error", _p("NotAccessText"), "");
			}
		?>
    	</div>
    </div>