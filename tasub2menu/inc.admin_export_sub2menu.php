<?php
	require_once('files/phpspreadsheet/vendor/autoload.php');

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	
	if ($sess_profile==1 || $db->isGroupRole($schemas, $sess_profile, $sess_user_id, 1, 1)) 
	{
		if (isset($_POST["excelbttn"]) && (int) $_POST["excelbttn"] == 1) 
		{

			$searchQuery = "";
			
			$export_org_id = (isset($_POST["export_org_id"])) ? (int) $_POST["export_org_id"] : 0;
							
			if($export_org_id==0)
			{
				$searchQuery .= "";
			} else
			{
				$searchQuery .= " AND tabo.org_id = ".$export_org_id;
			}
			
			$startQuery = "SELECT";
			$valueQuery = "tabo.*,  tau.organization||' - '|| tau.lastname as user_name 
			FROM ".$schemas.".tabasinorg tabo, ".$schemas.".tausers tau";
			$whereQuery = "WHERE tabo.user_id = tau.user_id AND tabo.org_status = 't'";
			if($checkorg==1) 
			{
				$whereQuery .= " AND EXISTS(SELECT * FROM ".$schemas.".tauserbasins taub 
				WHERE tabo.org_id = taub.org_id AND taub.user_id IN (SELECT user_id FROM ".$schemas.".tauserbasins WHERE user_id = ".$sess_user_id."))";
			}
			$orderQuery = "ORDER BY tabo.org_name";	

			$selQuery = $startQuery." ".$valueQuery." ".$whereQuery." ".$searchQuery." ".$orderQuery;
			
			$rows = $db->query($selQuery);

			if(!empty($rows)) 
			{
				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();
				$writer = new Xlsx($spreadsheet);
				
				$filename = "upload/basinorg.xlsx";
				
				$cellname = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
				"AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ",
				"BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ",
				"CA","CB","CC","CD","CE","CF","CG","CH","CI","CJ","CK","CL","CM","CN","CO","CP","CQ","CR","CS","CT","CU","CV","CW","CX","CY","CZ",
				"DA","DB","DC","DD","DE","DF","DG","DH","DI","DJ","DK","DL","DM","DN","DO","DP","DQ","DR","DS","DT","DU","DV","DW","DX","DY","DZ");
			
				$count_rows = sizeof($rows);
							
				// Header
				$cellcol = 0;		
				$cellrow = $rowstart = 1; 
				
				$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("BasinTitle"));
				$sheet->getStyle($cellname[$cellcol].$cellrow)->getFont()->setBold(true);
				$cellrow++; 
				$cellrow++; 
				
				$rowstart = $cellrow;
				$cellcol = $celltotal = 0;	
				$sheet->mergeCells($cellname[$cellcol].$cellrow.":".$cellname[$cellcol].$cellrow);
				$sheet->setCellValue($cellname[$cellcol].$cellrow, "№"); $cellcol++; 
				
				for($j=2; $j<11; $j++) {
					$sheet->setCellValue($cellname[$cellcol].$cellrow, $BASIN_ROW_ID[$j]); $cellcol++;
				}
							
				$sheet->mergeCells($cellname[$cellcol].$cellrow.":".$cellname[$cellcol].$cellrow);
				$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("DataEntryUserName")); $cellcol++;
				$celltotal = $cellcol-1;
				$cellrow++;
				
				$sheet->getStyle($cellname[0].$rowstart.":".$cellname[$celltotal].($cellrow-1))->getFont()->setBold(true);
				$sheet->getStyle($cellname[0].$rowstart.":".$cellname[$celltotal].($cellrow-1))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

				// Data
				for ($i=0; $i < $count_rows; $i++)
				{	
					$cellcol = 0; 
					
					$sheet->setCellValue($cellname[$cellcol].$cellrow, $i+1); $cellcol++;
					//$j = 1;
					//$sheet->setCellValue($cellname[$cellcol].$cellrow, getdata($org_status, $rows[$i][$BASIN_TABLE_ID[$j]])); $cellcol++;
					
					for($j=2; $j<11; $j++) {
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i][$BASIN_TABLE_ID[$j]]); $cellcol++;
					}

					$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["user_name"]); $cellcol++;
					
					$cellrow++;
				}
				
				$sheet->getStyle($cellname[0].$rowstart.":".$cellname[$celltotal].($cellrow-1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

				// Close file
				$writer->save($filename);
				header('Location: '.$filename.'');
			} else {
				show_notification("error", _p("NotDataFileText"), "");
			}
		}

		if (isset($_POST["shpbttn"]) && (int) $_POST["shpbttn"] == 1) 
		{

			$searchQuery = "";
			
			$export_org_id = (isset($_POST["export_org_id"])) ? (int) $_POST["export_org_id"] : 0;
							
			if($export_org_id==0)
			{
				$searchQuery .= "";
			} else
			{
				$searchQuery .= " AND tabo.org_id = ".$export_org_id;
			}
						
			$startQuery = "SELECT";
			$valueQuery = "tabo.org_id bid, tabo.org_name namemon, tabo.org_name_en nameeng, tabo.total_area barea FROM ".$schemas.".tabasinorg tabo";
			$whereQuery = "WHERE tabo.org_status = 't'";	
			if($checkorg==1) 
			{
				$whereQuery .= " AND EXISTS(SELECT * FROM ".$schemas.".tauserbasins taub 
				WHERE tabo.org_id = taub.org_id AND taub.user_id IN (SELECT user_id FROM ".$schemas.".tauserbasins WHERE user_id = ".$sess_user_id."))";
			}
			$orderQuery = "ORDER BY tabo.org_name";

			$selQuery = $startQuery." ".$valueQuery." ".$whereQuery." ".$searchQuery." ".$orderQuery;
			
			$rows = $db->query($selQuery);

			if(!empty($rows)) 
			{
				$execute_file = $_MY_CONF["OGR2OGR_FILE2"];
				$file_format = "-f \"ESRI Shapefile\"";
				$output_path = 'upload/';
				$output_file = "basin.shp";
				$pg_format = "PG:\"host=".$_MY_CONF["DATABASE_SERVER"]." port=".$_MY_CONF["DATABASE_PORT"]." dbname=".$_MY_CONF["DATABASE_NAME"]." user=".$_MY_CONF["DATABASE_USER"]." password=".$_MY_CONF["DATABASE_PASS"]."\"";
				$cpg_format = "-lco ENCODING=UTF-8"; 

				$command = $execute_file." ".$file_format." ".$output_path.$output_file." ".$pg_format." -sql \"".$selQuery."\" ".$cpg_format;
				//echo $command;
				exec($command);
				
				if (file_exists($output_path.$output_file)) {
					
					$archive_file_name = $output_path."basin.zip";

					$zip = new ZipArchive;

					if ($zip->open($archive_file_name, ZipArchive::CREATE) === TRUE)
					{
						$files = array('basin.shp', 'basin.shx', 'basin.dbf', 'basin.prj', 'basin.cpg');
				
						
						// Add files to the zip file
						foreach ($files as $file) {
							$zip->addFile($output_path.$file, $file);
						}
						// All files are added, so close the zip file.
						$zip->close();
						
						foreach ($files as $file) {
							unlink($output_path.$file);
						}
						
						header('Content-type: application/zip'); 
						header('Content-Disposition: attachment; filename='.basename($archive_file_name));
						ob_clean();
						flush();
						readfile($archive_file_name);
						exit;
					}
				}
			} else {
				show_notification("error", _p("NotDataFileText"), "");
			}
		}

	}
?>
