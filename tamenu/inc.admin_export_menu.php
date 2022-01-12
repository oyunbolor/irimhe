<?php
	if ($sess_profile==1 || $db->isGroupRole($schemas, $sess_profile, $sess_user_id, 1, 1)) 
	{
		if (isset($_POST["excelbttn"]) && (int) $_POST["excelbttn"] == 1) 
		{
		
			$searchQuery = "";
				
			$reference_code = (isset($_POST["reference_code"])) ? (int) $_POST["reference_code"] : 0;	
				
			if($reference_code==0)
			{
				$searchQuery .= "";
			}else
			{
				$searchQuery .= " AND taps.reference_code = ".$reference_code;
			}

			$startQuery = "SELECT";
			$valueQuery = "taps.*, tapn.phylum_name_mn, tafn.family_name_mn, taon.order_name_mn, tagn.genus_name, tagn.genus_name_mn, tapl.species_name_mn, tapl.species_name, tcrn.reference_name  FROM ".$schemas.".takingdomname takn,".$schemas.".taphylumname tapn,".$schemas.".taclassname tacn,".$schemas.".tafamilyname tafn,".$schemas.".taordername taon,".$schemas.".tagenusname tagn,".$schemas.".taplantname tapl,".$schemas.".taplantstatus taps, ".$schemas.".tcreferencestatus tcrn ";
			$whereQuery = "WHERE tapl.species_code = taps.species_code AND tapl.genus_code = tagn.genus_code AND tagn.family_code = tafn.family_code AND tafn.order_code = taon.order_code AND taon.class_code=tacn.class_code AND tacn.phylum_code=tapn.phylum_code  AND tapn.kingdom_code=takn.kingdom_code AND taps.status_id = taps.status_id AND taps.reference_code=tcrn.reference_code";

			if($checkaimag==1) 
			{
				$whereQuery .= " AND EXISTS(SELECT * FROM ".$schemas.".taaimagusers taua WHERE taua.aimag_code = vs.aimag_code AND taua.user_id in (SELECT user_id FROM ".$schemas.".tausergroups WHERE user_id = ".$sess_user_id."))";
			}

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
					
					$filename = "upload/plantstatus.xlsx";
					
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
					
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("FloraMenu2Sub3"));
					$cellrow++; 
							
					$cellcol = 0;				
					$sheet->setCellValue($cellname[$cellcol].$cellrow, "№"); $cellcol++; 
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("PlantresourceColumn1")); $cellcol++;
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("PlantresourceColumn2")); $cellcol++;
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("PlantresourceColumn3")); $cellcol++;
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("PlantresourceColumn4")); $cellcol++;
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("PlantresourceColumn5")); $cellcol++;
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("PlantresourceColumn6")); $cellcol++;
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("PlantresourceColumn7")); $cellcol++;
					$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("PlantStatusColumn1")); $cellcol++;
					$cellrow++;
				
					// Data
					for ($i=0; $i < $count_rows; $i++)
					{	
						$cellcol = 0; 
						
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $i+1); $cellcol++;
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["kingdom_name_mn"]); $cellcol++;
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["phylum_name_mn"]); $cellcol++;
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["class_name_mn"]); $cellcol++;
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["order_name_mn"]); $cellcol++;
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["family_name_mn"]); $cellcol++;
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["genus_name_mn"]); $cellcol++;
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["species_name_mn"]); $cellcol++;
						$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["reference_name"]); $cellcol++;
						; $cellcol++;
						
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



