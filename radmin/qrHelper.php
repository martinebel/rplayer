<?php
  include('../api/phpqrcode/qrlib.php');
$array=array();

$carpeta= explode('/',$_SERVER["REQUEST_URI"]);
$tempDir = "../assets/img/";
//admin
$codeContents = 'http://'.$_REQUEST["ip"]."/".$carpeta[1].'/radmin';
$fileNameAdmin = 'QRCode_Admin.png';
$pngAbsoluteFilePath = $tempDir.$fileNameAdmin;
QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_L, 10);

//cliente
$codeContents = 'http://'.$_REQUEST["ip"]."/".$carpeta[1];
$fileNameCliente = 'QRCode_Clientes.png';
$pngAbsoluteFilePath = $tempDir.$fileNameCliente;
QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_L, 10);


array_push($array,array(
  "qrAdmin"=>'../assets/img/'.$fileNameAdmin,
  "qrCliente"=>'../assets/img/'.$fileNameCliente,
  "dataAdmin"=>'http://'.$_REQUEST["ip"]."/".$carpeta[1].'/radmin',
  "dataCliente"=>'http://'.$_REQUEST["ip"]."/".$carpeta[1]
));
echo json_encode($array);
?>
