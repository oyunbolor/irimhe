<h1 class="h3 mb-4 text-gray-800"><?php echo _p("NewsTitle"); ?></h1>
    <div class="row">
    	<div class="col">
  <?php
$my_url .= "?menuitem=".$menuitem;
if (isset($_GET["action"]))
{
	$action = pg_prep($_GET["action"]);
}else
{
	$action = "";
}
if ($sess_profile==1 || $db->isGroupRole($sess_profile, $sess_user_id, 3, 1)) 
{
	require("tanews/inc.admin_export_news.php");
	if ($sess_profile==1 || $db->isGroupRole($sess_profile, $sess_user_id, 3, 2)) 
	{
		require("modules/upload_picture.class.php");
		
		if (isset($_POST["insertnewsbttn"]) && (int) $_POST["insertnewsbttn"]==1)
		{
			if(isset($_POST["title"]) && isset($_POST["menuname"]))
			{
				if(empty($_POST["subname2"]) && empty($_POST["subname"])){ 
					$selQuery = "SELECT menu_link FROM tamenu_main WHERE menu_id=".$_POST["menuname"];
					$row = $db->query($selQuery);
					$menu_link=$row[0]["menu_link"];
				}
				elseif(empty($_POST["subname2"]) && !empty($_POST["subname"]))
				{
					$selQuery = "SELECT sub_link FROM tamenu_sub WHERE sub_id=".$_POST["subname"];
					$row = $db->query($selQuery);
					$menu_link=$row[0]["sub_link"];
				}
				elseif(!empty($_POST["subname2"]))
				{
					$selQuery = "SELECT sub_link2 FROM tamenu_sub2 WHERE sub2_id=".$_POST["subname2"];
					$row = $db->query($selQuery);
					$menu_link=$row[0]["sub_link2"];
				}
				$news_image = "";
					
					if (is_uploaded_file($_FILES['news_image']['tmp_name']))
					{
						$today = date('Y-m-d');
						$file = "files/index.php";
						$year = date("Y", strtotime($today));
						
						$path = "upload/".$year;
						if (!is_dir($path))
						{
							mkdir($path, 0775);
							chmod($path, 0775);
							copy($file, $path."/index.php");
						}
						
						$month = date("m", strtotime($today));
						$path = $path."/".$month;
						if (!is_dir($path))
						{
							mkdir($path, 0775);
							chmod($path, 0775);
							copy($file, $path."/index.php");
						}

						$path = $path."/".$_MY_CONF["NEWS_PATH"]."/";
						if (!is_dir($path))
						{
							mkdir($path, 0775);
							chmod($path, 0775);
							copy($file, $path."/index.php");
						}

						$uploader = new pic_upload();
						$uploader->first_values('','','MB','20') ;
						$uploader->uploader_set($_FILES['news_image'], date("Y", strtotime($today)).date("m", strtotime($today)).date("d", strtotime ($today)), $path, $PICTURE_TYPES);
							
						if ($uploader->uploaded)
						{
							$news_image = $uploader->uploaded_files[0];
							$news_image = $path.$news_image;
						} else 
						{
							show_notification("error", "", $uploader->error);
						}
					}
				
				$fields = array("menu_id", "sub_id", "sub2_id", "menu_link", "title", "abstract","news_image", "content", "language", "info_date", "user_id");

				$checkvalues = array((int) $_POST["menuname"], (int) $_POST["subname"], (int) $_POST["subname2"], $menu_link, pg_prep($_POST["title"]), pg_prep($_POST["abstract"]), $news_image, pg_prep($_POST["content"]), pg_prep($_POST["language"]), date("Y-m-d H:i:s"), $sess_user_id);

				$values = array();
				for ($i = 0; $i < sizeof($checkvalues); $i++) {
					$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'" . $checkvalues[$i] . "'");
				}
				$result = $db->insert(" tamenu_info", $fields, $values);
				if (!$result)
					show_notification("error", "", "Нэмэх явцад алдаа гарлаа. Та дахин оролдоно уу.");
				else
					show_notification("success", "", "Таны мэдээлэл амжилттай нэмэгдлээ.");
			}
		}
		
		if (isset($_POST["updatenewsbttn"]) && (int) $_POST["updatenewsbttn"]==1)
		{
			if (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["menuname"]))
			{
				$wherevalues = "id=".(int) $_POST["id"];

				if(empty($_POST["subname2"]) && empty($_POST["subname"])){ 
					$selQuery = "SELECT menu_link FROM tamenu_main WHERE menu_id=".$_POST["menuname"];
					$row = $db->query($selQuery);
					$menu_link=$row[0]["menu_link"];
				}
				elseif(empty($_POST["subname2"]) && !empty($_POST["subname"]))
				{
					$selQuery = "SELECT sub_link FROM tamenu_sub WHERE sub_id=".$_POST["subname"];
					$row = $db->query($selQuery);
					$menu_link=$row[0]["sub_link"];
				}
				elseif(!empty($_POST["subname2"]))
				{
					$selQuery = "SELECT sub_link2 FROM tamenu_sub2 WHERE sub2_id=".$_POST["subname2"];
					$row = $db->query($selQuery);
					$menu_link=$row[0]["sub_link2"];
				}
				$news_image = "";
				if (is_uploaded_file($_FILES['news_image']['tmp_name']))
				{
					$today = date('Y-m-d');;
					
					$file = "files/index.php";
					$year = date("Y", strtotime($today));
					
					$path = "upload/".$year;
					if (!is_dir($path))
					{
						mkdir($path, 0775);
						chmod($path, 0775);
						copy($file, $path."/index.php");
					}
					
					$month = date("m", strtotime($today));
					$path = $path."/".$month;
					if (!is_dir($path))
					{
						mkdir($path, 0775);
						chmod($path, 0775);
						copy($file, $path."/index.php");
					}

					$path = $path."/".$_MY_CONF["NEWS_PATH"]."/";
					if (!is_dir($path))
					{
						mkdir($path, 0775);
						chmod($path, 0775);
						copy($file, $path."/index.php");
					}
			
					$uploader = new pic_upload();
					$uploader->first_values('','','MB','20') ;
					$uploader->uploader_set($_FILES['news_image'], date("Y", strtotime($today)).date("m", strtotime($today)).date("d", strtotime ($today)), $path, $PICTURE_TYPES);
				
					if ($uploader->uploaded) {
						if (!empty($_POST["news_image"]))
							unlink($_POST["news_image"]);
						$news_image = $uploader->uploaded_files[0];
						$news_image = $path.$news_image;
					} else {
						show_notification("error", "", $uploader->error);
					}
				} else {
					if(isset($_POST["news_image"]) && strlen($_POST["news_image"])>0)
					{
						$news_image = $_POST["news_image"];
						$news_image = $_POST["news_image"];
					}
				}

				$fields = array("menu_id", "sub_id", "sub2_id", "menu_link", "title", "abstract", "news_image", "content", "language", "info_date", "user_id");
				$checkvalues = array((int) $_POST["menuname"], (int) $_POST["subname"], (int) $_POST["subname2"],$menu_link, pg_prep($_POST["title"]), pg_prep($_POST["abstract"]), $news_image, pg_prep($_POST["content"]), pg_prep($_POST["language"]), date("Y-m-d H:i:s"), (int) $_POST["user_id"]);
				
				$values = array();
				for ($i=0; $i<sizeof($checkvalues); $i++)
				{
					$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'".$checkvalues[$i]."'");
				}
			
				$result = $db->update(" tamenu_info", $fields, $values, $wherevalues);
				if(! $result)
					show_notification("error", "", "Өөрчлөх явцад алдаа гарлаа. Та дахин оролдоно уу.");
				else
					show_notification("success", "", "Таны мэдээлэл амжилттай засагдлаа.");
			}
		}

		if (($action=="delete") && isset($_GET["id"]))
		{
			$id = (int) $_GET["id"];
			
			if($sess_profile==1)
				$wherevalues = "id = ".$id;
			else
				$wherevalues = "id = ".$id." AND user_id = ".$sess_user_id;
				
			$selQuery = "SELECT news_image FROM tamenu_info WHERE ".$wherevalues;
			$rowfile = $db->query($selQuery);
			 
			$result = $db->delete("tamenu_info", $wherevalues);
			if(! $result) {
				show_notification("error", "", "Устгах явцад алдаа гарлаа. Та дахин оролдоно уу.");
			} else {
				show_notification("success", "", "Таны мэдээлэл амжилттай устлаа.");
				if (!empty($rowfile)) 
				{
					if (!empty($rowfile[0]["news_image"]))
						unlink($rowfile[0]["news_image"]);
				}
			}
		}
	}

	$count = (isset($_POST["count"]) && (int) $_POST["count"] > 0) ? (int) $_POST["count"] : ((isset($_GET["count"]) && (int) $_GET["count"] > 0) ? (int) $_GET["count"] : 10);
	$my_count = $my_url;
	$my_url .= "&count=".$count;
		
	$page = (isset($_GET["page"]) && (int) $_GET["page"] > 0) ? (int) $_GET["page"] : 1;
	$my_page = "&page=".$page;

	$searchQuery = "";
	$search_url = "";
		
	$valueQuery1 = "";
	$whereQuery1 = "";

	$search_menu_id = (isset($_GET["search_menu_id"])) ? (int) $_GET["search_menu_id"] : 0;
	$search_sub_name = (isset($_GET["search_sub_name"])) ? (int) $_GET["search_sub_name"] : 0;
	$search_sub_name2 = (isset($_GET["search_sub_name2"])) ? (int) $_GET["search_sub_name2"] : 0;
	$search_title = (isset($_GET["search_title"])) ? (pg_prep($_GET["search_title"])) : "";
	$search_user_id = (isset($_GET["search_user_id"])) ? (int) $_GET["search_user_id"] : 0;
	$search_group_id = (isset($_GET["search_group_id"])) ? (int) $_GET["search_group_id"] : 0;

	if($search_menu_id==0)
	{
		$searchQuery .= "";
		$search_url .= "";
	} else
	{
		$searchQuery .= " AND tami.menu_id = ".$search_menu_id;
		$search_url .= "&search_menu_id=".$search_menu_id;
		
	}
	if ($search_sub_name == 0) 
	{
		$searchQuery .= "";
		$search_url .= "";
	} else 
	{
		$searchQuery .= " AND tami.sub_id = ".$search_sub_name;
		$search_url .= "&search_sub_name=".$search_sub_name;
	}
	if ($search_sub_name2 == 0) 
	{
		$searchQuery .= "";
		$search_url .= "";
	} else 
	{
		$searchQuery .= " AND tami.sub2_id = ".$search_sub_name2;
		$search_url .= "&search_sub_name2=".$search_sub_name2;
	}
	if (empty($search_title)) 
	{
		$searchQuery .= "";
		$search_url .= "";
	} else 
	{
		$searchQuery .= " AND lower(tami.title) LIKE lower('%".$search_title."%')";
		$search_url .= "&search_title=".$search_title;
	}
	if($search_user_id==0)
	{
		$searchQuery .= "";
			$search_url .= "";
	} else
	{
		$searchQuery .= " AND tami.user_id = ".$search_user_id;
		$search_url .= "&search_user_id=".$search_user_id;
	}
	if($search_group_id==0)
	{
		$searchQuery .= "";
		$search_url .= "";
	} else
	{
		$searchQuery .= " AND tug.group_id = ".$search_group_id;
		$search_url .= "&search_group_id=".$search_group_id;

		$valueQuery1 = ", tausergroups tug";
		$whereQuery1 = " AND tami.user_id = tug.user_id";
	}

	$sort_url = "";
	$sort = (isset($_GET["sort"])) ? (int) $_GET["sort"]: 0;
	$sort_type = (isset($_GET["sorttype"])) ? (int) $_GET["sorttype"]: 0;

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
		require("tanews/inc.edit_news.php");
	}elseif ($action=="add")
	{
		require("tanews/inc.add_news.php");
	}elseif ($action=="more")
	{
		require("tanews/inc.more_news.php");
	}elseif ($action=="export")
	{
		require("tanews/inc.export_news.php");
	}else
	{
		require("tanews/inc.list_news.php");
	}

} else {
	$notify = "Таны хандалт буруу байна.";
	show_notification("error", "", $notify);
}
	?>
</div>
</div>
