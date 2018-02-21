<?php


include_once 'models/MatchModel.php';
class MatchController {

    var $MatchModel = null;
    function __construct() {
        $this->MatchModel = new MatchModel();
    }

    public function getMatches($params) {
        $email = isset($params['id']) ? $params['id'] : '';
        $res = $this->MatchModel->get($email);
        return $res;
    }
	
	//http://underdogs-com.stackstaging.com/Underdogs/apis/Match/exportMatchReport
    
	public function exportMatchReport() {
      ob_clean();
		require('../lib/PHPExcel/PHPExcel.php');

		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Sabari")
									 ->setLastModifiedBy("Sabari")
									 ->setTitle("Office 2007 XLSX Document")
									 ->setSubject("Office 2007 XLSX Document")
									 ->setDescription("Match report.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Test result file");
									 
        $rows = $this->MatchModel->get(0, TRUE);
		
		 foreach($rows as $index => $row) {
		//	 print_r($row);continue;
			 
      // Add new sheet
       $objPHPExcel->createSheet($index); //Setting index when creating

		$objPHPExcel->setActiveSheetIndex($index)
					->setCellValue('A1', 'Date')
					->setCellValue('B1', $row['matchDt'])
					->setCellValue('A2', 'Time')
					->setCellValue('B2', $row['matchTm'])
					->setCellValue('A3', 'Venue')
					->setCellValue('B3', $row['venueNm'])
					->setCellValue('A4', 'Address')
					->setCellValue('B4', ($row['address1'] ? $row['address1'] . ", " : '').($row['address2'] ? $row['address2'] . ", " : '').($row['city'] ? $row['city'] . ", " : '').($row['state'] ? $row['state'] . " " : ''))
					->setCellValue('A5', 'Cost')
					->setCellValue('B5', $row['cost'])
					->setCellValue('A6', 'Slots Remaining')
					->setCellValue('B6', $row['slotsAvail'] . "/" . $row['slotsAlotted']);
					
		$objPHPExcel->setActiveSheetIndex($index)
					->setCellValue('A8', 'Sl No')
					->setCellValue('B8', 'Name')
					->setCellValue('C8', 'Mobile')
					->setCellValue('D8', 'WhatsApp Number')
					->setCellValue('E8', 'Speciality');
					$objPHPExcel->getActiveSheet()->getStyle("A1:A6")->getFont()->setBold( true );
					$objPHPExcel->getActiveSheet()->getStyle("A8:E8")->getFont()->setBold( true );

			$rowIndex = 9;
			foreach($row['usr'] as $usrIndex => $usr) {
				$objPHPExcel->setActiveSheetIndex($index)
					->setCellValue('A' . $rowIndex, ($usrIndex+1))
					->setCellValue('B' . $rowIndex, $usr['uname'])
					->setCellValueExplicit('C' . $rowIndex, $usr['mobile'],PHPExcel_Cell_DataType::TYPE_STRING)
					->setCellValueExplicit('D' . $rowIndex, $usr['whatsapp_no'],PHPExcel_Cell_DataType::TYPE_STRING)
					->setCellValue('E' . $rowIndex, $usr['speciality']);
					$rowIndex++;
				
			}
					
		$objPHPExcel->getActiveSheet()->setTitle($row['venueNm']);
		 }
		 //die;
		 header('Content-type: application/vnd.ms-excel');

 header('Content-Disposition: attachment; filename="file.xlsx"');

 header('Cache-Control: max-age=0');

 header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

 header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');

 header ('Cache-Control: cache, must-revalidate');

 header ('Pragma: public');

 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
ob_clean();
 $objWriter->save("Reports.xls");
      echo '<script>window.location.assign("../Reports.xls");</script>';
	}
}

?>