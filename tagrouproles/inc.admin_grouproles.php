	<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo _p("GroupRolesTitle"); ?></h1>
    <div class="row">
    	<div class="col">
    		<?php
			if ($sess_profile==1)
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
			
				if (isset($_POST["insertgrouprolebttn"]))
				{
					if (isset($_POST["group_id"]) && isset($_POST["item_id"]) && isset($_POST["role_id"]))
					{
						$item_id = (int) $_POST["item_id"];
						$group_id = (int) $_POST["group_id"];
						
						if($item_id==0 && $group_id!=0){
							$fields = array("group_id", "item_id", "role_id");
							$group_id = (int) $_POST["group_id"];
							$role_id = (int) $_POST["role_id"];
				
							$count = 0;
							
							for($j = 1; $j < sizeof($ITEM_TYPE)+1; $j++)
							{				
								$checkvalues = array($group_id, $j, $role_id);
								$values = array();
								for ($i=0; $i<sizeof($checkvalues); $i++)
								{
									$values[$i] = (empty($checkvalues[$i]) ? "NULL": "'".$checkvalues[$i]."'");
								}
								
								$result = $db->insert("".$schemas.".tagrouproles", $fields, $values);
								if(! $result)
									show_notification("error", _p("AddText1"), "");
								else
									$count++;
							}
							
							if($count>0)
								show_notification("success", _p("AddText2"), "");					
						
						} elseif($item_id!=0 && $group_id==0){
							$fields = array("group_id", "item_id", "role_id");
							$item_id = (int) $_POST["item_id"];
							$role_id = (int) $_POST["role_id"];
				
							$count = 0;
							
							$selQuery = "SELECT tag.group_id FROM ".$schemas.".tagroups tag";
							$rowcount = $db->query($selQuery);
							
							for($j = 0; $j < sizeof($rowcount); $j++)
							{
								$checkvalues = array($rowcount[$j]["group_id"], $item_id, $role_id);
								$values = array();
								for ($i=0; $i<sizeof($checkvalues); $i++)
								{
									$values[$i] = (empty($checkvalues[$i]) ? "NULL": "'".$checkvalues[$i]."'");
								}
								
								$result = $db->insert("tagrouproles", $fields, $values);
								if(! $result)
									show_notification("error", _p("AddText1"), "");
								else
									$count++;
							}
							
							if($count>0)
								show_notification("success", _p("AddText2"), "");					
						
						} elseif($item_id==0 && $group_id==0){
							$fields = array("group_id", "item_id", "role_id");
							$role_id = (int) $_POST["role_id"];
				
							$count = 0;
							
							$selQuery = "SELECT tag.group_id FROM ".$schemas.".tagroups tag";
							$rowcount = $db->query($selQuery);
							
							for($k = 0; $k < sizeof($rowcount); $k++)
							{
								for($j = 1; $j < sizeof($ITEM_TYPE)+1; $j++)
								{
									$checkvalues = array($rowcount[$k]["group_id"], $j, $role_id);
									$values = array();
									for ($i=0; $i<sizeof($checkvalues); $i++)
									{
										$values[$i] = (empty($checkvalues[$i]) ? "NULL": "'".$checkvalues[$i]."'");
									}
									
									$result = $db->insert("tagrouproles", $fields, $values);
									if(! $result)
										show_notification("error", _p("AddText1"), "");
									else
										$count++;
								}
							}
							
							if($count>0)
								show_notification("success", _p("AddText2"), "");	
						
						} else {
							$fields = array("group_id", "item_id", "role_id");
							$checkvalues = array((int) $_POST["group_id"], (int) $_POST["item_id"], (int) $_POST["role_id"]);
							
							$values = array();
							for ($i=0; $i<sizeof($checkvalues); $i++)
							{
								$values[$i] = (empty($checkvalues[$i]) ? "NULL": "'".$checkvalues[$i]."'");
							}
							
							$result = $db->insert("tagrouproles", $fields, $values);
					
							if(! $result)
								show_notification("error", _p("AddText1"), "");
							else
								show_notification("success", _p("AddText2"), "");
						}
					}
				}
						
				if (($action=="delete") && isset($_GET["group_id"]) && isset($_GET["item_id"]) && isset($_GET["role_id"]))
				{
					$group_id = (int) $_GET["group_id"];
					$item_id = (int) $_GET["item_id"];
					$role_id = (int) $_GET["role_id"];		
					$wherevalues = "group_id = ".$group_id." AND item_id=".$item_id." AND role_id=".$role_id;
					
					$result = $db->delete("tagrouproles", $wherevalues );
					if(! $result)
						show_notification("error", _p("DeleteText1"), "");
					else
						show_notification("success", _p("DeleteText2"), "");
				}
			
				$page = (isset($_GET["page"]) && (int) $_GET["page"] > 0) ? (int) $_GET["page"]: 1;
				$my_page = "&page=".$page;
				
				$searchQuery = "";
				$search_url = "";
				
				$search_group_id = (isset($_GET["search_group_id"])) ? (int) $_GET["search_group_id"]: 0;	
				$search_item_id = (isset($_GET["search_item_id"])) ? (int) $_GET["search_item_id"]: 0;	
				$search_role_id = (isset($_GET["search_role_id"])) ? (int) $_GET["search_role_id"]: 0;			
								
				if($search_group_id==0)
				{
					$searchQuery .= "";
					$search_url .= "";
				} else
				{
					$searchQuery .= " AND tagr.group_id = ".$search_group_id;
					$search_url .= "&search_group_id=".$search_group_id;
				}
				
				if($search_item_id==0)
				{
					$searchQuery .= "";
					$search_url .= "";
				} else
				{
					$searchQuery .= " AND tagr.item_id = ".$search_item_id;
					$search_url .= "&search_item_id=".$search_item_id;
				}	
			
				if($search_role_id==0)
				{
					$searchQuery .= "";
					$search_url .= "";
				} else
				{
					$searchQuery .= " AND tagr.role_id = ".$search_role_id;
					$search_url .= "&search_role_id=".$search_role_id;
				}
					
				$sort_url = "";
				$sort = (isset($_GET["sort"])) ? (int) $_GET["sort"] : 0;
				$sort_type = (isset($_GET["sorttype"])) ? (int) $_GET["sorttype"] : 0;
			
				if ($sort == 0)
					$sort_url .= "";
				else
					$sort_url .= "&sort=".$sort;
			
				if ($sort_type == 0)
					$sort_url .= "";
				else
					$sort_url .= "&sorttype=".$sort_type;
							
				if ($action=="add")
				{
					require("tagrouproles/inc.add_grouproles.php");
				}else
				{
					require("tagrouproles/inc.list_grouproles.php");
				}
			} else {
				show_notification("error", _p("NotAccessText"), "");
			}
		?>
    	</div>
    </div>