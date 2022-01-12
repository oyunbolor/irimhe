<?php
if (isset($_GET["id"]))
{
	$id = (int)$_GET["id"];
}else
{
	$id = 0;
}

$actual_url = "?"."$_SERVER[QUERY_STRING]";
$pieces_url = explode("&", $actual_url);
$actual_url=$pieces_url[0]."&".$pieces_url[1];
$my_url .= $actual_url;

$count = (isset($_POST["count"]) && (int) $_POST["count"] > 0) ? (int) $_POST["count"] : ((isset($_GET["count"]) && (int) $_GET["count"] > 0) ? (int) $_GET["count"] : 10);
$my_count = $my_url;
$my_url .= "&count=".$count;

$page = (isset($_GET["page"]) && (int) $_GET["page"] > 0) ? (int) $_GET["page"] : 1;
$my_page = "&page=".$page;

$pieces = explode("&", $my_url);

$actual_link_temp=$pieces[0]."&".$pieces[1];
$actual_link_pieces = explode("index.php", $actual_link_temp);
$actual_link=$actual_link_pieces[1];


$section_title="";
if($_SESSION['irimhe_lang']==1){
	$menuQuery = "SELECT menu_name as menuname FROM tamenu_main WHERE menu_link LIKE '".$actual_link."%'";
	$menuQuery1 = "SELECT sub_name as subname FROM tamenu_sub WHERE sub_link LIKE '".$actual_link."%'";
	$menuQuery2 = "SELECT sub_name2 as subname2 FROM tamenu_sub2 WHERE sub_link2 LIKE '".$actual_link."%'";
}
else {
	$menuQuery = "SELECT menu_name_en  as menuname FROM tamenu_main WHERE menu_link LIKE '".$actual_link."%'";
	$menuQuery1 = "SELECT sub_name_en  as subname FROM tamenu_sub WHERE sub_link LIKE '".$actual_link."%'";
	$menuQuery2 = "SELECT sub_name_en2  as subname2 FROM tamenu_sub2 WHERE sub_link2 LIKE '".$actual_link."%'";
}
$row = $db->query($menuQuery);
$row1 = $db->query($menuQuery1);
$row2 = $db->query($menuQuery2);

if (!empty($row))
{
	$section_title=$row[0]["menuname"]; 
}
elseif(!empty($row1))
{
	$section_title=$row1[0]["subname"]; 
}
elseif(!empty($row2))
{
	$section_title=$row2[0]["subname2"]; 
}

if($_SESSION['irimhe_lang']==1){
	$language=1;
} else {
	$language=2;
}

if ($id==0){
	$startQuery = "SELECT";
	$valueQuery = "COUNT(*) AS num_count FROM tamenu_info mei";
	$whereQuery = "WHERE  language=$language AND  mei.menu_link="."'$actual_link'";
	$selQuery = $startQuery . " " . $valueQuery . " " . $whereQuery;
	$rows = $db->query($selQuery);

	$sum = 0;
	if (sizeof($rows) > 0)
		$sum = $rows[0]["num_count"];
	$maxpage = ceil($sum / $count);

	$limit = $count . " OFFSET " . ($page - 1) * $count;
	$startQuery = "SELECT";
	$valueQuery = " id, title, abstract, DATE_FORMAT(info_date, '%Y-%m-%d') as info_date FROM tamenu_info";
	$whereQuery = "WHERE  language=$language AND  menu_link LIKE '".$actual_link."%' ORDER BY id DESC"; 
	$selQuery = $startQuery . " " . $valueQuery . " " . $whereQuery .  " LIMIT " . $limit;

	$rows = $db->query($selQuery);
	?>
<section class="page-title text-center" style="background-image:url(images/abstract-background.jpg);">
    <div class="container">
        <div class="title-text">
            <h1><?php echo $section_title; ?></h1>
            <ul class="title-menu clearfix">
                <li>
                    <a href="<?php echo $my_url.$my_page.$search_url.$sort_url; ?>"><?php echo _p("BackButton");?>&nbsp;/</a></div>
                </li>
                <li><?php echo $section_title; ?></li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!-- Contact Section -->
<section class="blog-section section style-four style-five">
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <div class="left-side">
		<?php 
			for ($i = 0; $i < sizeof($rows); $i++) 
			{
			?>
          <div class="item-holder">
            <div class="content-text">
              <h4><?php echo $rows[$i]["title"]; ?></h4>
              <span><?php echo $rows[$i]["info_date"]; ?></span>
              <p><?php echo $rows[$i]["abstract"]; ?></p>
              <div class="text">
                <p>
                  <a href="<?php echo $my_url.$my_page."&action=more&id=".$rows[$i]["id"]; ?>" class="btn-style-one"><?php echo _p("ReadMore"); ?></a>
                </p>
              </div>
            </div>
          </div>
		   <?php
	}
	?>
        </div>
						<?php
				require("pagination/inc.pagination1.php");
		pagelink1($PAGE_COUNT, $maxpage, $my_url, $page, "");
			}
			else{
				// GET-eer id orj irvel medeeg delgerengui harah heseg
				$i = 0;
				$startQuery = "SELECT";
				$valueQuery = "title, content, DATE_FORMAT(info_date, '%Y-%m-%d') as info_date FROM  tamenu_info mei";
				$whereQuery = "WHERE mei.id = ".$id;

				$selQuery = $startQuery . " " . $valueQuery . " " . $whereQuery;
				$rows = $db->query($selQuery);

				?>
				<div class="container">
				<div class="row" style="margin-top: 40px">
				  <div class="col-lg-9">
					<div class="left-side">
					  <div class="item-holder">
						<div class="content-text">
						  <h3><?php echo $rows[$i]["title"]; ?></h3>
						  <span><?php echo $rows[$i]["info_date"]; ?></span>
						  <p><?php echo $rows[$i]["content"]; ?></p>
						</div>
					  </div>
				  </div>
				  
			  <?php
	}
	?>
      </div>
	  
      <div class="col-lg-3">
        <div class="right-side">
          <div class="text-title">
            <h6><?php echo _p("SearchTitle");?></h6>
          </div>
          <div class="search-box">
            <form method="post" action="index.php?cat=7" enctype="multipart/form-data">
              <input class="form-control" type="search" name="search" placeholder="<?php echo _p("SearchButton");?>" required="">
			  <button class="btn btn-info" type="submit" name="searchbttn"><span class="fa fa-search" style=" color: #4169E1"></span> </button>
            </form>
          </div>
          <?php
			if($_SESSION['irimhe_lang']==1){
				$language=1;
			} else {
				$language=2;
			}
			$startQuery = "SELECT";
			$valueQuery = "mei.id, mei.title, mei.menu_link, mei.news_image, mei.content, DATE_FORMAT(info_date, '%Y-%m-%d') as info_date FROM tamenu_info mei, tamenu_sub mes";
			$whereQuery = "WHERE language=$language AND mes.sub_name LIKE 'Цаг үеийн мэдээ%' AND mei.sub_id=mes.sub_id AND mei.info_date> DATE_SUB(CURDATE(), INTERVAL 1 YEAR) ORDER BY mei.info_date DESC LIMIT 20";
			$selQuery = $startQuery . " " . $valueQuery . " " . $whereQuery ;
			$rows = $db->query($selQuery);
			?>
          <div class="tag-list">
            <div class="text-title">
              <h6><?php echo _p("MoreNews");?></h6>
            </div>
			<?php 
			for ($i = 0; $i < sizeof($rows); $i++) 
			{
			?>
			<li>
				<p style="margin-right: 10px; text-align:justify"><a href="<?php echo $rows[$i]["menu_link"]."&action=more&id=".$rows[$i]["id"]; ?>"> 
				<?php echo $rows[$i]["title"]; ?> </a> <small class="pull-right" style="padding-top: 2px; padding-bottom:10px;"><?php echo $rows[$i]["info_date"]; ?></small></p>
			</li>
			<?php
        }
        ?>
          </div>
		  <?php
			$startQuery = "SELECT";
			$valueQuery = "mei.id, mei.title, mei.menu_link, DATE_FORMAT(info_date, '%Y-%m-%d') as info_date  FROM tamenu_info mei, tamenu_sub mes";
			$whereQuery = "WHERE language=$language AND  mes.sub_name LIKE 'Зарлал%' AND mei.sub_id=mes.sub_id ORDER BY mei.info_date DESC LIMIT 4";
			$selQuery = $startQuery . " " . $valueQuery . " " . $whereQuery ;
			$rows = $db->query($selQuery);
			?>
          <div class="tag-list">
            <div class="text-title">
              <h6><?php echo _p("MoreNews1");?></h6>
            </div>
			<?php 
			for ($i = 0; $i < sizeof($rows); $i++) 
			{
			?>
            <li>
			  <p style="margin-right: 10px; text-align:justify"> <a href="<?php echo $rows[$i]["menu_link"]."&action=more&id=".$rows[$i]["id"]; ?>"> 
			  <?php echo $rows[$i]["title"]; ?> </a><small class="pull-right" style="padding-top: 2px; padding-bottom:10px;"> </i> <?php echo $rows[$i]["info_date"]; ?></small> </p>
			  <div class="clearfix"></div>
			</li>
			<?php
			}
			?>
        </div>
      </div>
    </div>
	</div>
					  </div>
				  </div>
  </div>
  </div>
</section>
