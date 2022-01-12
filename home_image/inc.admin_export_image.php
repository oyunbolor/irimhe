<?php
	if ($sess_profile==1 || $db->isGroupRole($schemas, $sess_profile, $sess_user_id, 1, 1)) 
	{
		if (isset($_POST["excelbttn"]) && (int) $_POST["excelbttn"] == 1) 
		{
		
			$searchQuery = "";
				
			$export_title = (isset($_GET["export_title"])) ? pg_prep($_GET["export_title"]) : "";


				if (empty($export_title)) 
				{
					$searchQuery .= "";
					$search_url .= "";
				} else 
				{
					$searchQuery .= " AND lower(mei.title) LIKE lower('%".$export_title."%')";
					$search_url .= "&export_title=".$export_title;
				}

			$startQuery = "SELECT";
			$valueQuery = "hoi.* FROM tahome_image hoi";
			$whereQuery = "WHERE hoi.image_id=hoi.image_id ";
			
			$selQuery = $startQuery." ".$valueQuery." ".$whereQuery." ".$searchQuery." ".$orderQuery;
			
			$rows = $db->query($selQuery);

			if(!empty($rows)) 
			{
				if (isset($_POST["excelbttn"]) && (int) $_POST["excelbttn"] == 1) 
					{
					/** PHPExcel */
					require("files/phpexcel/PHPExcel.php");
						
					/** PHPExcel_Writer_Excel2007 */
					require("files/phpexcel/PHPExcel/Writer/Excel2007.php");
					
					/** PHPExcel_IOFactory */
					require("files/phpexcel/PHPExcel/IOFactory.php");
					
					// Create new PHPExcel object
					$objPHPExcel = new PHPExcel();
					
					// Reader file
					$objReader = PHPExcel_IOFactory::createReader('Excel2007');
					$objPHPExcel = $objReader->load("files/example.xlsx");
					
					$filename = "upload/image.xlsx";
					
					$cellname = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
					"AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ",
					"BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ");
				
					$count_rows = sizeof($rows);
						
					// Writer file
					$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
					
					// Active sheet
					$objPHPExcel->setActiveSheetIndex(0);
					$sheet = $objPHPExcel->getActiveSheet(); 
				
					// Header
					$cellcol = 0;		
					$cellrow = 1; 
					
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("HomeImage"));
					$cellrow++; 
							
					$cellcol = 0;				
					$sheet->setCellValue($cellname[$cellcol].$cellrow, "№"); $cellcol++; 
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("HomeColumn1")); $cellcol++;
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("HomeColumn2")); $cellcol++;
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("HomeColumn3")); $cellcol++;
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("HomeColumn4")); $cellcol++;
					$cellrow++;
				
					// Data
					for ($i=0; $i < $count_rows; $i++)
					{	
						$cellcol = 0; 
						
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $i+1); $cellcol++;
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["language"]); $cellcol++;
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["title"]); $cellcol++;
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["uploaddate"]); $cellcol++;
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["file_pathname"]); $cellcol++;
						
						$cellrow++;
					}
					
					// Close file
					$objWriter->save($filename);
					header('Location: '.$filename.'');
					
				}
			} else {
				show_notification("error", _p("NotDataFileText"), "");
			}
		}
	} else {
		show_notification("error", _p("NotAccessText"), "");
	}
?>



