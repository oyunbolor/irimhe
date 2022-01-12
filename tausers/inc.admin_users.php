	<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo _p("UsersTitle"); ?></h1>
    <div class="row">
    	<div class="col">
    		<?php
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
				
			if($sess_profile==1) 
			{
				
				if (isset($_POST["insertuserbttn"]) && (int) $_POST["insertuserbttn"]==1)
				{
					if (isset($_POST["login_name"]) && isset($_POST["login_passwd"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["organization"]))
					{
						$login_date = date("Y-m-d H:i:s");
						$login_session = generateSessionString(16);
					
						$fields = array("login_name", "login_passwd", "firstname", "lastname", "organization", "phone", "email", "profile", "login_status", "login_date", "login_session");
						$checkvalues = array($_POST["login_name"], md5($_POST["login_passwd"]), $_POST["firstname"], $_POST["lastname"],$_POST["organization"], $_POST["phone"], $_POST["email"], $_POST["profile"], $_POST["login_status"], $login_date, $login_session);
				
						$values = array();
						for ($i=0; $i<sizeof($checkvalues); $i++)
						{
							$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'".$checkvalues[$i]."'");
						}
						$result = $db->insert("tausers", $fields, $values);
						
						if(! $result)
							show_notification("error", _p("AddText1"), "");
						else 
							show_notification("success", _p("AddText2"), "");
					}
				}
				
				if (($action=="delete") && isset($_GET["user_id"]))
				{
					$wherevalues = "user_id=".(int) $_GET["user_id"];
                    $result = $db->delete("".$schemas.".tausergroups", $wherevalues);
					$result = $db->delete("".$schemas.".tausers", $wherevalues);
					
					if(! $result) 
						show_notification("error", _p("DeleteText1"), "");
					else
						show_notification("success", _p("DeleteText2"), "");
				}
			}	
					
			if (isset($_POST["updateuserbttn"]) && (int) $_POST["updateuserbttn"]==1)
			{
				if (isset($_POST["login_name"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["user_id"]) && isset($_POST["organization"]))
				{	
					
					$wherevalues = "user_id=".(int) $_POST["user_id"];
					$fields = array("login_name", "firstname", "lastname", "organization", "phone", "email", "profile", "login_status");
					$checkvalues = array($_POST["login_name"], $_POST["firstname"], $_POST["lastname"],$_POST["organization"], $_POST["phone"], $_POST["email"], $_POST["profile"], $_POST["login_status"]);
			
					$values = array();
					for ($i=0; $i<sizeof($checkvalues); $i++)
					{
						$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'".$checkvalues[$i]."'");
					}
					
					$result = $db->update("".$schemas.".tausers", $fields, $values, $wherevalues);
					if(! $result)
						show_notification("error", _p("EditText1"), "");
					else
						show_notification("success", _p("EditText2"), "");
				}
			}
							
			if (isset($_POST["updatepassbttn"]) && (int) $_POST["updatepassbttn"]==1)
			{
				if (isset($_POST["login_passwd"]) && isset($_POST["user_id"]))
				{	
					$wherevalues = "user_id=".(int) $_POST["user_id"];
					
					$fields = array("login_passwd");
					$values = array("'".md5($_POST["login_passwd"])."'");
					
					$result = $db->update("".$schemas.".tausers", $fields, $values, $wherevalues);
					if(! $result)
						show_notification("error", _p("EditText1"), "");
					else
						show_notification("success", _p("EditText2"), "");
				}
			}	
			
			$page = (isset($_GET["page"]) && (int) $_GET["page"] > 0) ? (int) $_GET["page"] : 1;
			$my_page = "&page=".$page;
			
			$searchQuery = "";
			$search_url = "";
				
			$valueQuery1 = "";
			$whereQuery1 = "";
			
			$search_lastname = (isset($_GET["search_lastname"])) ? pg_prep($_GET["search_lastname"]) : "";
			$search_group_id = (isset($_GET["search_group_id"])) ? (int) $_GET["search_group_id"] : 0;
			$search_login_name = (isset($_GET["search_login_name"])) ? pg_prep($_GET["search_login_name"]) : "";
			$search_profile = (isset($_GET["search_profile"])) ? (int) $_GET["search_profile"] : 0;
									
			if(empty($search_lastname))
			{
				$searchQuery .= "";
				$search_url .= "";
			}else
			{
				$searchQuery .= " AND lower(tau.lastname) LIKE lower('%".$search_lastname."%')";
				$search_url .= "&search_lastname=".$search_lastname;
			}
			
			if($search_group_id==0)
			{
				$searchQuery .= "";
				$search_url .= "";
			} else
			{
				$searchQuery .= " AND tug.group_id = ".$search_group_id;
				$search_url .= "&search_group_id=".$search_group_id;
				
				$valueQuery1 = ", ".$schemas.".tausergroups tug";
				$whereQuery1 = " AND tau.user_id = tug.user_id";
			}
			
			if(empty($search_login_name))
			{
				$searchQuery .= "";
				$search_url .= "";
			}else
			{
				$searchQuery .= " AND lower(tau.login_name) LIKE lower('%".$search_login_name."%')";
				$search_url .= "&search_login_name=".$search_login_name;
			}
			
			if($search_profile==0)
			{
				$searchQuery .= "";
				$search_url .= "";
			} else
			{
				$searchQuery .= " AND tau.profile = ".$search_profile;
				$search_url .= "&search_profile=".$search_profile;
			}	
			
			$sort_url = "";
			$sort = (isset($_GET["sort"])) ? (int) $_GET["sort"] : 0;
			$sort_type = (isset($_GET["sorttype"])) ? (int) $_GET["sorttype"] : 0;
			
			if($sort==0)
				$sort_url .= "";
			else
				$sort_url .= "&sort=".$sort;
			
			if($sort_type==0)
				$sort_url .= "";
			else
				$sort_url .= "&sorttype=".$sort_type; 		
				
			if ($action=="edit")
			{
				require("tausers/inc.edit_users.php");
			}elseif ($action=="add")
			{
				require("tausers/inc.add_users.php");
			}elseif ($action=="more")
			{
				require("tausers/inc.more_users.php");
			}elseif ($action=="usergroups")
			{
				require("tausers/inc.admin_usergroups.php");
			}elseif ($action=="password")
			{
				require("tausers/inc.edit_password.php");
			}else
			{
				require("tausers/inc.list_users.php");
			}
			?>
    	</div>
    </div>