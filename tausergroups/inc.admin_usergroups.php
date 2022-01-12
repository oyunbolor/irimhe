	<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo _p("UserGroupsTitle"); ?></h1>
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
			
				if (isset($_POST["insertuserbttn"]))
				{
					if (isset($_POST["group_id"]) && isset($_POST["user_id"]))
					{
						$fields = array("group_id", "user_id");
						$checkvalues = array((int) $_POST["group_id"], (int) $_POST["user_id"]);
						var_dump($fields);
						$values = array();
						for ($i=0; $i<sizeof($checkvalues); $i++)
						{
							$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'".$checkvalues[$i]."'");
						}
						
						$result = $db->insert("".$schemas.".tausergroups", $fields, $values);
				
						if(! $result)
							show_notification("error", _p("AddText1"), "");
						else
							show_notification("success", _p("AddText2"), "");
					}
				}
						
				if (($action=="delete") && isset($_GET["group_id"]) && isset($_GET["user_id"]))
				{
					$group_id = (int) $_GET["group_id"];
					$user_id = (int) $_GET["user_id"];
					$wherevalues = "group_id = ".$group_id." AND user_id=".$user_id;
					
					$result = $db->delete("".$schemas.".tausergroups", $wherevalues);
					if(! $result)
						show_notification("error", _p("DeleteText1"), "");
					else
						show_notification("success", _p("DeleteText2"), "");
				}
				
				$page = (isset($_GET["page"]) && (int) $_GET["page"] > 0) ? (int) $_GET["page"] : 1;
				$my_page = "&page=".$page;
				
				$searchQuery = "";
				$search_url = "";
				
				$search_group_id = (isset($_GET["search_group_id"])) ? (int) $_GET["search_group_id"] : 0;
				$search_lastname = (isset($_GET["search_lastname"])) ? pg_prep($_GET["search_lastname"]) : "";
								
				if($search_group_id==0)
				{
					$searchQuery .= "";
					$search_url .= "";
				} else
				{
					$searchQuery .= " AND taug.group_id = ".$search_group_id;
					$search_url .= "&search_group_id=".$search_group_id;
				}
				
				if(empty($search_lastname))
				{
					$searchQuery .= "";
					$search_url .= "";
				}else
				{
					$searchQuery .= " AND lower(tau.lastname) LIKE lower('%".$search_lastname."%')";
					$search_url .= "&search_lastname=".$search_lastname;
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
					require("tausergroups/inc.add_usergroups.php");
				}else
				{
					require("tausergroups/inc.list_usergroups.php");
				}
			} else {
				show_notification("error", _p("NotAccessText"), "");
			}
		?>
    	</div>
    </div>