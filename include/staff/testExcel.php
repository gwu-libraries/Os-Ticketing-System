<?php

//Here we set the include path and load the librarires
set_include_path(get_include_path() . PATH_SEPARATOR . '../PhpExcel2007/Classes/');
require_once('PHPExcel.php');
require_once('PHPExcel/IOFactory.php');

$excel = new PHPExcel();
$excel->setActiveSheetIndex(0); //we are selecting a worksheet
$excel->getActiveSheet()->setTitle('Products'); //renaming it

//here we fill in the header row
$excel->getActiveSheet()->setCellValue('A1', 'Title');
$excel->getActiveSheet()->setCellValue('B1', 'Price');
$excel->getActiveSheet()->setCellValue('C1', 'Quanity');
$excel->getActiveSheet()->setCellValue('D1', 'Total price');

//here we put some values
$excel->getActiveSheet()->setCellValue('A2', 'Fictional TV set');
$excel->getActiveSheet()->setCellValue('B2', 300);
$excel->getActiveSheet()->setCellValue('C2', 1500);
$excel->getActiveSheet()->setCellValue('D2', '=B2*C2'); //this is how we put formulas, just like using Excel

$excel->getActiveSheet()->setCellValue('A3', 'Fictional mobile phone');
$excel->getActiveSheet()->setCellValue('B3', 200);
$excel->getActiveSheet()->setCellValue('C3', 5000);
$excel->getActiveSheet()->setCellValue('D3', '=B3*C3');

$excel->getActiveSheet()->setCellValue('A4', 'Fictional laptop');
$excel->getActiveSheet()->setCellValue('B4', 1000);
$excel->getActiveSheet()->setCellValue('C4', 2000);
$excel->getActiveSheet()->setCellValue('D4', '=B4*C4');

//some summarizing formulas
$excel->getActiveSheet()->setCellValue('C5', '=SUM(C2:C4)');
$excel->getActiveSheet()->setCellValue('D5', '=SUM(D2:D4)');

//Now we save the created document in the Exce 2007 format
$excelWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$excelWriter->save('/tmp/Products.xlsx');
 $size = filesize('/tmp/Products.xlsx');
                        header('Content-Type: application/vnd.ms-excel');
                        header('Content-Length: '.$size);
                        header('Content-Disposition: attachment; filename='.'Products.xlsx');
                        //header('Content-Transfer-Encoding: ASCII');
                         //header("Content-length: $fsize");
    //header("Cache-control: private"); //use this to open files directly
                        $data='';
                        $fd = fopen ('/tmp/Products.xlsx', "r");
                        while(!feof($fd)) {
                                $data = fread($fd, 2048);
                                //$a=strip_tags($data);
                                echo $data;
                                        }
                                                        
                                fclose ($fd);
?>
