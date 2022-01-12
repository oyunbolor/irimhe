<?php
	require_once('files/phpspreadsheet/vendor/autoload.php');

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	
	if ($sess_profile==1 || $db->isGroupRole($schemas, $sess_profile, $sess_user_id, 3, 1)) 
	{
		if (isset($_POST["excelbttn"]) && (int) $_POST["excelbttn"] == 1) 
		{

			$searchQuery = "";
			
			$export_menu_id = (isset($_POST["export_menu_id"])) ? (int) $_POST["export_menu_id"] : 0;
							
			if($export_menu_id==0)
			{
				$searchQuery .= "";
			} else
			{
				$searchQuery .= " AND tami.menu_id = ".$export_menu_id;
			}
			
			$export_sub_id = (isset($_POST["export_sub_id"])) ? (int) $_POST["export_sub_id"] : 0;
							
			if($export_sub_id==0)
			{
				$searchQuery .= "";
			} else
			{
				$searchQuery .= " AND tami.sub_id = ".$export_sub_id;
			}
			
			$startQuery = "SELECT";
			$valueQuery = "tami.*, tamm.menu_name, concat(tau.organization,' ', tau.lastname) as user_name 
			FROM tamenu_info tami, tausers tau, tamenu_main tamm";
			$whereQuery = "WHERE tami.user_id = tau.user_id AND tami.menu_id = tamm.menu_id";
			$orderQuery = "ORDER BY tamm.menu_name, tami.title";	

			$selQuery = $startQuery." ".$valueQuery." ".$whereQuery." ".$searchQuery." ".$orderQuery;
			
			$rows = $db->query($selQuery);

			if(!empty($rows)) 
			{
				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();
				$writer = new Xlsx($spreadsheet);
				
				$filename = "upload/news.xlsx";
				
				$cellname = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
				"AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ",
				"BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ",
				"CA","CB","CC","CD","CE","CF","CG","CH","CI","CJ","CK","CL","CM","CN","CO","CP","CQ","CR","CS","CT","CU","CV","CW","CX","CY","CZ",
				"DA","DB","DC","DD","DE","DF","DG","DH","DI","DJ","DK","DL","DM","DN","DO","DP","DQ","DR","DS","DT","DU","DV","DW","DX","DY","DZ");
			
				$count_rows = sizeof($rows);
							
				// Header
				$cellcol = 0;		
				$cellrow = $rowstart = 1; 
				
				$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("News"));
				$sheet->getStyle($cellname[$cellcol].$cellrow)->getFont()->setBold(true);
				$cellrow++; 
				$cellrow++; 
				
				$rowstart = $cellrow;
				$cellcol = $celltotal = 0;	
				$sheet->setCellValue($cellname[$cellcol].$cellrow, "№"); $cellcol++; 
				
				$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("NewsColumn6")); $cellcol++; 
				$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("NewsColumn1")); $cellcol++; 
				$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("NewsColumn2")); $cellcol++; 
				$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("NewsColumn3")); $cellcol++; 
				$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("NewsColumn4")); $cellcol++; 
				$sheet->setCellValue($cellname[$cellcol].$cellrow, _p("NewsColumn5")); $cellcol++; 
							
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
				
					$sheet->setCellValue($cellname[$cellcol].$cellrow, getdata($LANGUAGE, $rows[$i]["language"])); $cellcol++;
					$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["menu_name"]); $cellcol++;
					$sub_name = "";
					$values = $db->query("SELECT tamm.sub_name FROM tamenu_sub tamm WHERE tamm.sub_id = ".$rows[$i]["sub_id"]."");
					if (!empty($values))
						$sub_name = $values[0]["sub_name"];
					$sheet->setCellValue($cellname[$cellcol].$cellrow, $sub_name); $cellcol++;
					$sub_name2 = "";
					$values = $db->query("SELECT tamm.sub_name2 FROM tamenu_sub2 tamm WHERE tamm.sub2_id = ".$rows[$i]["sub2_id"]."");
					if (!empty($values))
						$sub_name2 = $values[0]["sub_name2"];
					$sheet->setCellValue($cellname[$cellcol].$cellrow, $sub_name2); $cellcol++;
					$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["title"]); $cellcol++;
					$sheet->setCellValue($cellname[$cellcol].$cellrow, $rows[$i]["abstract"]); $cellcol++;
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

	}
?>
