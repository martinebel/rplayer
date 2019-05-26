<?php
require '../db.php';
$array=array();
switch($_REQUEST['action'])
{
  case "getData":
  $stmt = $dbh->prepare("select grupo.* from clientexgrupo inner join grupo on grupo.idgrupo=clientexgrupo.idgrupo where idcliente=".$_REQUEST["idCliente"]);
  $stmt->execute();
  $result = $stmt->fetchAll();
  foreach($result as $row){
  	array_push($array,array("idgrupo"=> $row["idgrupo"],"nombre"=>mb_strtoupper($row["nombre"],'UTF-8'),"archivo"=>'assets/files/groups/'.$row["archivo"]));

  }
  echo json_encode($array);
  break;
  case "getStatus":
  $stmt = $dbh->prepare("select status from clientexgrupo where idcliente=".$_REQUEST["idCliente"]);
  $stmt->execute();
  $result = $stmt->fetchAll();
  foreach($result as $row){
    echo json_encode($row["status"]);
  }
  break;
}
?>
