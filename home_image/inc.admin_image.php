<h1 class="h3 mb-4 text-gray-800"><?php echo _p("HomeImage"); ?></h1>
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
				
				require("modules/upload_picture.class.php");
				if (isset($_POST["insertimagebttn"]) && (int) $_POST["insertimagebttn"]==1)
				{
					if(isset($_POST["title"]))
					{
						$image = "";
						if (is_uploaded_file($_FILES['image']['tmp_name']))
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

							$path = $path."/".$_MY_CONF["IMAGE_PATH"]."/";
							if (!is_dir($path))
							{
								mkdir($path, 0775);
								chmod($path, 0775);
								copy($file, $path."/index.php");
							}

							$uploader = new pic_upload();
							$uploader->first_values('','','MB','20') ;
							$uploader->uploader_set($_FILES['image'], date("Y", strtotime($today)).date("m", strtotime($today)).date("d", strtotime ($today)).rand(1000, 9999), $path, $PICTURE_TYPES);
								
							if ($uploader->uploaded)
							{
								$image = $uploader->uploaded_files[0];
								$image = $path.$image;
							} else 
							{
								show_notification("error", "", $uploader->error);
							}
						}
						
						$fields = array( "title", "file_pathname", "language", "uploaddate", "user_id");
						$checkvalues = array(pg_prep($_POST["title"]), $image, (int) $_POST["language"], date("Y-m-d H:i:s"), $sess_user_id);

						$values = array();
						for ($i = 0; $i < sizeof($checkvalues); $i++) {
							$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'" . $checkvalues[$i] . "'");
						}
						
						$result = $db->insert("tahome_image", $fields, $values);
						if (!$result)
							show_notification("error", "", "Нэмэх явцад алдаа гарлаа. Та дахин оролдоно уу.");
						else
							show_notification("success", "", "Таны мэдээлэл амжилттай нэмэгдлээ.");
					}
				}
				
				if (isset($_POST["updateimagebttn"]) && (int) $_POST["updateimagebttn"]==1)
		{
			if (isset($_POST["image_id"]) && isset($_POST["title"]))
			{
				$wherevalues = "image_id=".(int) $_POST["image_id"];

				$image = "";
				if (is_uploaded_file($_FILES['image']['tmp_name']))
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

					$path = $path."/".$_MY_CONF["IMAGE_PATH"]."/";
					if (!is_dir($path))
					{
						mkdir($path, 0775);
						chmod($path, 0775);
						copy($file, $path."/index.php");
					}
			
					$uploader = new pic_upload();
					$uploader->first_values('','','MB','20') ;
					$uploader->uploader_set($_FILES['image'], date("Y", strtotime($today)).date("m", strtotime($today)).date("d", strtotime ($today)).rand(1000, 9999), $path, $PICTURE_TYPES);
				
					if ($uploader->uploaded) {
						if (!empty($_POST["file_pathname"]))
							unlink($_POST["file_pathname"]);
						$image = $uploader->uploaded_files[0];
						$image = $path.$image;
					} else {
						show_notification("error", "", $uploader->error);
					}
				} else {
					if(isset($_POST["file_pathname"]) && strlen($_POST["file_pathname"])>0)
					{
						$image = $_POST["file_pathname"];
					}
				}

				$fields = array( "title", "file_pathname", "language", "uploaddate", "user_id");
				$checkvalues = array(pg_prep($_POST["title"]), $image,   pg_prep($_POST["language"]), date("Y-m-d H:i:s"), (int) $_POST["user_id"]);

				$values = array();
				for ($i=0; $i<sizeof($checkvalues); $i++)
				{
					$values[$i] = (empty($checkvalues[$i]) ? "NULL" : "'".$checkvalues[$i]."'");
				}
			
				$result = $db->update("tahome_image", $fields, $values, $wherevalues);
				
				if(! $result)
					show_notification("error", "", "Өөрчлөх явцад алдаа гарлаа. Та дахин оролдоно уу.");
				else
					show_notification("success", "", "Таны мэдээлэл амжилттай засагдлаа.");
			}
		}

				if (($action=="delete") && isset($_GET["image_id"]))
				{
					$image_id = (int) $_GET["image_id"];
					
					if($sess_profile==1)
						$wherevalues = "image_id = ".$image_id;
					else
						$wherevalues = "image_id = ".$image_id." AND user_id = ".$sess_user_id;
						
					$selQuery = "SELECT file_pathname FROM tahome_image WHERE ".$wherevalues;
					$rowfile = $db->query($selQuery);
					 
					$result = $db->delete("tahome_image", $wherevalues);
					if(! $result) {
						show_notification("error", "", "Устгах явцад алдаа гарлаа. Та дахин оролдоно уу.");
					} else {
						show_notification("success", "", "Таны мэдээлэл амжилттай устлаа.");
						if (!empty($rowfile)) 
						{
							if (!empty($rowfile[0]["file_pathname"]))
								unlink($rowfile[0]["file_pathname"]);
						}
					}
				}
				
				$page = (isset($_GET["page"]) && (int) $_GET["page"] > 0) ? (int) $_GET["page"] : 1;
				$my_page = "&page=".$page;
				
				$searchQuery = "";
				$search_url = "";
				$valueQuery1 = "";
				$whereQuery1 = "";

				$search_title = (isset($_GET["search_title"])) ? pg_prep($_GET["search_title"]) : "";


				if (empty($search_title)) 
				{
					$searchQuery .= "";
					$search_url .= "";
				} else 
				{
					$searchQuery .= " AND lower(mei.title) LIKE lower('%".$search_title."%')";
					$search_url .= "&search_title=".$search_title;
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
					require("home_image/inc.edit_image.php");
				}elseif ($action=="add")
				{
					require("home_image/inc.add_image.php");
				}elseif ($action=="export")
				{
					require("home_image/inc.export_image.php");
				}else
				{
					require("home_image/inc.list_image.php");
				}
			} else {
				show_notification("error", _p("NotAccessText"), "");
			}
		?>
</div>
    </div>
