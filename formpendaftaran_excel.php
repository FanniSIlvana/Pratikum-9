<?php

include 'koneksi.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Tempat Lahir');
$sheet->setCellValue('D1', 'Asal Sekolah');
$sheet->setCellValue('E1', 'No. HP');
$sheet->setCellValue('F1', 'Alamat');

$query = mysqli_query($koneksi, "select * from pendaftaran");
$i = 2;
$no = 1;

while($row = mysqli_fetch_array($query)){
	$sheet->setCellValue('A' . $i, $no++);
	$sheet->setCellValue('B' . $i, $row['nama']);
	$sheet->setCellValue('C' . $i, $row['tempat_lahir']);
	$sheet->setCellValue('D' . $i, $row['asal_sekolah']);
	$sheet->setCellValue('E' . $i, $row['no_hp']);
	$sheet->setCellValue('F' . $i, $row['alamat']);
	$i++;
}

$styleArray = [
	'borders' => [
		'allBorders' => [
			'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		],
	],
];
$i = $i - 1;
$sheet->getStyle('A1:F'.$i)->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$writer->save('Report Data Pendaftaran Siswa Baru.xlsx');

?>