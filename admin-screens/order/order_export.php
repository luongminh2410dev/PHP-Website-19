<?php
//  Include thư viện PHPExcel_IOFactory vào
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$phpExcel = new Spreadsheet();

$phpExcel->getActiveSheet()->setTitle("This Part 1 of tutorial excel");
$phpExcel->setActiveSheetIndex(0)
         ->setCellValue('A1','Utopian.io Rewarding Open Source')
         ->setCellValue('A2','The First in the world');
// // Giả sử chúng ta có mảng dữ liệu cần ghi như sau
// $array_data = array(
// 					0 => array('name' => 'Hieu', 'email' => 'hieu@gmail.com', 'phone' => '0123456789', 'address' => 'address 1'),
// 					1 => array('name' => 'Nam', 'email' => 'nam@gmail.com', 'phone' => '0124567892', 'address' => 'address 2'),
// 					2 => array('name' => 'Tuan', 'email' => 'tuan@gmail.com', 'phone' => '09764346789', 'address' => 'address 3'),
// 					3 => array('name' => 'Mai', 'email' => 'mai@gmail.com', 'phone' => '09876543356', 'address' => 'address 4'),
// 					4 => array('name' => 'Thao', 'email' => 'thao@gmail.com', 'phone' => '0975458979', 'address' => 'address 5'),
// 				);

// // Thiết lập tên các cột dữ liệu
// $objPHPExcel->setActiveSheetIndex(0)
//                             ->setCellValue('A1', "STT")
//                             ->setCellValue('B1', "Name")
//                             ->setCellValue('C1', "Email")
//                             ->setCellValue('D1', "Phone")
//                             ->setCellValue('E1', "Address");

// // Lặp qua các dòng dữ liệu trong mảng $array_data và tiến hành ghi dữ liệu vào file excel
// $i = 2;
// foreach ($array_data as $value) {
// 	$objPHPExcel->setActiveSheetIndex(0)
// 								->setCellValue("A"."$i", "$i")
// 								->setCellValue("B"."$i", $value['name'])
// 	                            ->setCellValue("C"."$i", $value['email'])
// 	                            ->setCellValue("D"."$i", $value['phone'])
// 	                            ->setCellValue("E"."$i", $value['address']);
// 	$i++;
// }
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$fileName.'"'); // file name of excel
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filepath));
// Tiến hành ghi file
$writer = new Xlsx($phpExcel);
$writer->save('hello world.xlsx');
function createFileExcel(){}

?>