<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Código para manejar los datos
} else {
    http_response_code(405);
    echo "Método no permitido";
    exit;
}


// Capturar datos del formulario
$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$mensaje = $_POST['mensaje'] ?? '';

// Nombre del archivo Excel
$archivo = 'clientes.xlsx';

// Verificar si el archivo Excel existe
if (file_exists($archivo)) {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo);
    $sheet = $spreadsheet->getActiveSheet();
} else {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    // Crear encabezados si es un nuevo archivo
    $sheet->setCellValue('A1', 'Nombre');
    $sheet->setCellValue('B1', 'Correo');
    $sheet->setCellValue('C1', 'Mensaje');
}

// Agregar nueva fila con datos
$fila = $sheet->getHighestRow() + 1;
$sheet->setCellValue("A$fila", $nombre);
$sheet->setCellValue("B$fila", $correo);
$sheet->setCellValue("C$fila", $mensaje);

//  Guardar el archivo Excel
$writer = new Xlsx($spreadsheet);
$writer->save($archivo);

echo " Datos guardados correctamente en clientes.xlsx.";
include 'enviar_excel.php';
   //  Ruta del eBook
   $file = "https://drive.google.com/file/d/1bPjX7Tdsj9nu4XlfhGDx3WTSLNHeODUW/view?usp=drive_link"; // Asegúrate de que el archivo existe en tu servidor

   if (file_exists($file)) {
       // Configurar cabeceras HTTP para forzar la descarga
       header("Content-Description: File Transfer");
       header("Content-Type: application/pdf");
       header("Content-Disposition: attachment; filename=" . basename($file));
       header("Expires: 0");
       header("Cache-Control: must-revalidate");
       header("Pragma: public");
       header("Content-Length: " . filesize($file));
       readfile($file);
       exit(); // evitar más salida de datos
   } else {
       http_response_code(404);
       echo "Error: Archivo no encontrado.";
   }
   header("Location: https://drive.google.com/file/d/1bPjX7Tdsj9nu4XlfhGDx3WTSLNHeODUW/view?usp=sharing");
exit();


